<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package EightshiftLibs\Blocks
 */

declare(strict_types=1);

namespace EightshiftLibs\Blocks;

use EightshiftLibs\Exception\InvalidBlock;
use EightshiftLibs\Exception\InvalidManifest;
use EightshiftLibs\Helpers\Components;
use EightshiftLibs\Services\ServiceInterface;

/**
 * Class Blocks
 */
abstract class AbstractBlocks implements ServiceInterface, RenderableBlockInterface
{

	/**
	 * Full data of blocks, settings and wrapper data.
	 *
	 * @var array
	 */
	protected $blocks = [];

	/**
	 * Create custom project color palette
	 *
	 * These colors are fetched from the main manifest.json file located in src/blocks folder.
	 *
	 * @return void
	 */
	public function changeEditorColorPalette(): void
	{
		$colors = $this->getSettings()['globalVariables']['colors'] ?? [];

		if ($colors) {
			\add_theme_support('editor-color-palette', $colors);
		}
	}

	/**
	 * Register align wide option in editor
	 *
	 * @return void
	 */
	public function addThemeSupport(): void
	{
		\add_theme_support('align-wide');
	}

	/**
	 * Get blocks full data from global settings, blocks and wrapper
	 *
	 * You should never call this method directly. Instead you should call $this->blocks.
	 *
	 * @return void
	 */
	public function getBlocksDataFullRaw(): void
	{
		if (!$this->blocks) {
			$settings = $this->getSettings();
			$wrapper = $this->getWrapper();
			$components = $this->getComponents();

			$blocks = array_map(
				function ($block) use ($settings) {
					// Add additional data to the block settings.
					$namespace = $block['namespace'] ?? '';

					// Check if namespace is defined in block or in global manifest settings.
					$block['namespace'] = !empty($namespace) ? $namespace : $settings['namespace'];
					$block['blockFullName'] = "{$block['namespace']}/{$block['blockName']}";

					return $block;
				},
				$this->getBlocksData()
			);

			$this->blocks = [
				'dependency' => [
					'components' => $this->buildDependencyComponentsTree($components),
					'blocks' => $this->buildDependencyBlocksTree($blocks, $components),
				],
				'blocks' => $blocks,
				'components' => $components,
				'wrapper' => $wrapper,
				'settings' => $settings,
			];
		}
	}

	/**
	 * Get blocks full data in raw format by item. Used with filter on the frontend.
	 *
	 * @param string $key Key to get data from array.
	 *
	 * @return array
	 */
	public function getBlocksDataFullRawItem(string $key = 'blocks'): array
	{
		if (defined('WP_CLI') && !getenv('TEST')) {
			return [];
		}

		return $key ? $this->blocks[$key] : $this->blocks;
	}

	/**
	 * Get all blocks with full block name
	 *
	 * Used to limit what blocks are going to be used in your project using allowed_block_types filter.
	 *
	 * @hook allowed_block_types_all Available from WP 5.8.
	 *
	 * @param bool|string[] $allowedBlockTypes Array of block type slugs, or boolean to enable/disable all.
	 * @param \WP_Block_Editor_Context $blockEditorContext The current block editor context.
	 *
	 * @return bool|string[] Boolean if you want to disallow or allow all blocks, or a list of allowed blocks.
	 */
	public function getAllBlocksList($allowedBlockTypes, \WP_Block_Editor_Context $blockEditorContext)
	{
		if (gettype($allowedBlockTypes) === 'boolean') {
			return $allowedBlockTypes;
		}

		$allowedBlockTypes = array_map(
			function ($block) {
				return $block['blockFullName'];
			},
			$this->blocks['blocks'] ?? []
		);

		// Allow reusable block.
		$allowedBlockTypes[] = 'core/block';
		$allowedBlockTypes[] = 'core/template';

		return $allowedBlockTypes;
	}

	/**
	 * Get all blocks with full block name
	 *
	 * Used to limit what blocks are going to be used in your project using allowed_block_types filter.
	 *
	 * @hook allowed_block_types This is a WP 5 - WP 5.7 compatible hook callback. Will not work with WP 5.8!
	 *
	 * @param bool|string[] $allowedBlockTypes Array of block type slugs, or boolean to enable/disable all.
	 * @param \WP_Post $post The post resource data.
	 *
	 * @return bool|string[] Boolean if you want to disallow or allow all blocks, or a list of allowed blocks.
	 */
	public function getAllBlocksListOld($allowedBlockTypes, \WP_Post $post)
	{
		if (gettype($allowedBlockTypes) === 'boolean') {
			return $allowedBlockTypes;
		}

		$allowedBlockTypes = array_map(
			function ($block) {
				return $block['blockFullName'];
			},
			$this->blocks['blocks'] ?? []
		);

		// Allow reusable block.
		$allowedBlockTypes[] = 'core/block';
		$allowedBlockTypes[] = 'core/template';

		return $allowedBlockTypes;
	}

	/**
	 * Method used to register all custom blocks with data fetched from blocks manifest.json
	 *
	 * @throws InvalidBlock Throws error if blocks are missing.
	 *
	 * @return void
	 */
	public function registerBlocks(): void
	{
		$blocks = $this->blocks['blocks'] ?? [];

		if (!$blocks) {
			throw InvalidBlock::missingBlocksException();
		}

		foreach ($blocks as $block) {
			$this->registerBlock($block);
		}
	}

	/**
	 * Method used to really register Gutenberg blocks
	 *
	 * It uses native register_block_type() function from WP.
	 *
	 * @param array $blockDetails Full Block Manifest details.
	 *
	 * @return void
	 */
	public function registerBlock(array $blockDetails): void
	{
		\register_block_type(
			$blockDetails['blockFullName'],
			[
				'render_callback' => [$this, 'render'],
				'attributes' => $this->getAttributes($blockDetails),
			]
		);
	}

	/**
	 * Provides block registration callback method for rendering when using wrapper option
	 *
	 * @param array  $attributes Array of attributes as defined in block's manifest.json.
	 * @param string $innerBlockContent Block's content if using inner blocks.
	 *
	 * @throws InvalidBlock Throws error if block view is missing.
	 *
	 * @return string Html template for block.
	 */
	public function render(array $attributes, string $innerBlockContent): string
	{
		// Block details is unavailable in this method so we are fetching block name via attributes.
		$blockName = $attributes['blockName'] ?? '';

		// Get block view path.
		$templatePath = $this->getBlockViewPath($blockName);

		// Get block wrapper view path.
		$wrapperPath = "{$this->getWrapperPath()}/wrapper.php";

		// Check if wrapper component exists.
		if (!file_exists($wrapperPath)) {
			throw InvalidBlock::missingWrapperViewException($wrapperPath);
		}

		// Check if actual block exists.
		if (!file_exists($templatePath)) {
			throw InvalidBlock::missingViewException($blockName, $templatePath);
		}

		// If everything is ok, return the contents of the template (return, NOT echo).
		ob_start();
		include $wrapperPath;
		$output = ob_get_clean();

		unset($blockName, $templatePath, $wrapperPath, $attributes, $innerBlockContent);

		return (string)$output;
	}

	/**
	 * Create custom category to assign all custom blocks
	 *
	 * This category will be shown on all blocks list in "Add Block" button.
	 *
	 * @hook block_categories_all Available from WP 5.8.
	 *
	 * @param array[] $categories Array of categories for block types.
	 * @param \WP_Block_Editor_Context $blockEditorContext The current block editor context.
	 *
	 * @return array[] Array of categories for block types.
	 */
	public function getCustomCategory(array $categories, \WP_Block_Editor_Context $blockEditorContext): array
	{
		return array_merge(
			$categories,
			[
				[
					'slug' => 'eightshift',
					'title' => \esc_html__('Eightshift', 'eightshift-libs'),
					'icon' => 'admin-settings',
				],
			]
		);
	}

	/**
	 * Create custom category to assign all custom blocks
	 *
	 * This category will be shown on all blocks list in "Add Block" button.
	 *
	 * @hook block_categories This is a WP 5 - WP 5.7 compatible hook callback. Will not work with WP 5.8!
	 *
	 * @param array[] $categories Array of categories for block types.
	 * @param \WP_Post $post Post being loaded.
	 *
	 * @return array[] Array of categories for block types.
	 */
	public function getCustomCategoryOld(array $categories, \WP_Post $post): array
	{
		return array_merge(
			$categories,
			[
				[
					'slug' => 'eightshift',
					'title' => \esc_html__('Eightshift', 'eightshift-libs'),
					'icon' => 'admin-settings',
				],
			]
		);
	}

	/**
	 * Locate and return template part with passed attributes for wrapper
	 *
	 * Used to render php block wrapper view.
	 *
	 * @param string $src String with URL path to template.
	 * @param array  $attributes Attributes array to pass in template.
	 * @param null   $innerBlockContent If using inner blocks content pass the data.
	 *
	 * @throws InvalidBlock Throws an error if wrapper file doesn't exist.
	 *
	 * @return void Includes an HTML view, or throws an error if the view is missing.
	 */
	public function renderWrapperView(string $src, array $attributes, $innerBlockContent = null): void
	{
		if (!file_exists($src)) {
			throw InvalidBlock::missingWrapperViewException($src);
		}

		include $src;

		unset($src, $attributes, $innerBlockContent);
	}

	/**
	 * Get blocks absolute path
	 *
	 * Prefix path is defined by project config.
	 *
	 * @return string
	 */
	abstract protected function getBlocksPath(): string;

	/**
	 * Get blocks custom folder absolute path
	 *
	 * @return string
	 */
	protected function getBlocksCustomPath(): string
	{
		return "{$this->getBlocksPath()}/custom";
	}

	/**
	 * Get blocks components folder absolute path
	 *
	 * @return string
	 */
	protected function getBlocksComponentsPath(): string
	{
		return "{$this->getBlocksPath()}/components";
	}

	/**
	 * Get block view absolute path
	 *
	 * @param string $blockName Block Name value to get a path.
	 *
	 * @return string
	 */
	protected function getBlockViewPath(string $blockName): string
	{
		return "{$this->getBlocksCustomPath()}/{$blockName}/{$blockName}.php";
	}

	/**
	 * Get wrapper folder full absolute path
	 *
	 * @return string
	 */
	protected function getWrapperPath(): string
	{
		return "{$this->getBlocksPath()}/wrapper";
	}

	/**
	 * Get wrapper manifest data from wrapper manifest.json file
	 *
	 * @throws InvalidBlock Throws error if wrapper settings manifest.json is missing.
	 *
	 * @return array
	 */
	protected function getWrapper(): array
	{
		$manifestPath = "{$this->getWrapperPath()}/manifest.json";

		if (!file_exists($manifestPath)) {
			throw InvalidBlock::missingWrapperManifestException($manifestPath);
		}

		$settings = implode(' ', (array)file($manifestPath));
		$settings = json_decode($settings, true);

		return $settings;
	}

	/**
	 * Get all components in the components folder.
	 *
	 * @throws InvalidBlock Throws error thera are no components in the project.
	 *
	 * @return array
	 */
	protected function getComponents(): array
	{

		$paths = preg_grep('/^([^.])/', (array) scandir($this->getBlocksComponentsPath()) ?? []);

		if (!$paths && !defined('WP_CLI')) {
			throw InvalidBlock::missingComponentsException();
		}

		$components = array_diff((array)$paths, ['..', '.']);

		$output = [];

		if (!$components) {
			return $output;
		}

		foreach ($components as $component) {
			$output[] = $this->getComponent((string)$component);
		}

		return $output;
	}

	/**
	 * Get component manifest data from component manifest.json file
	 *
	 * @param string $componentName Name of the component.
	 *
	 * @throws InvalidBlock Throws error if wrapper settings manifest.json is missing.
	 *
	 * @return array
	 */
	protected function getComponent(string $componentName): array
	{
		$manifestPath = "{$this->getBlocksComponentsPath()}/{$componentName}/manifest.json";

		if (!file_exists($manifestPath) && !defined('WP_CLI')) {
			throw InvalidBlock::missingComponentManifestException($manifestPath);
		}

		$settings = implode(' ', (array)file($manifestPath));
		$settings = json_decode($settings, true);

		return $settings;
	}

	/**
	 * Get blocks global settings manifest data from settings manifest.json file
	 *
	 * @throws InvalidBlock Throws error if global manifest settings key namespace is missing.
	 * @throws InvalidBlock Throws error if global settings manifest.json is missing.
	 *
	 * @return array
	 */
	protected function getSettings(): array
	{
		$manifestPath = "{$this->getBlocksPath()}/manifest.json";

		if (!file_exists($manifestPath)) {
			throw InvalidBlock::missingSettingsManifestException($manifestPath);
		}

		$settings = implode(' ', (array)file(($manifestPath)));
		$settings = json_decode($settings, true);

		if (!isset($settings['namespace'])) {
			throw InvalidBlock::missingNamespaceException();
		}

		return $settings;
	}

	/**
	 * Get blocks attributes
	 *
	 * This method combines default, block and wrapper attributes.
	 * Default attributes are hardcoded in this lib.
	 * Block attributes are provided by block manifest.json file.
	 *
	 * @param array $blockDetails Block Manifest details.
	 *
	 * @return array
	 */
	protected function getAttributes(array $blockDetails): array
	{
		$blockName = $blockDetails['blockName'];

		return array_merge(
			[
				'blockName' => [
					'type' => 'string',
					'default' => $blockName,
				],
				'blockFullName' => [
					'type' => 'string',
					'default' => $blockDetails['blockFullName'],
				],
				'blockClass' => [
					'type' => 'string',
					'default' => "block-{$blockName}",
				],
				'blockJsClass' => [
					'type' => 'string',
					'default' => "js-block-{$blockName}",
				],
			],
			$this->getSettings()['attributes'] ?? [],
			$this->blocks['wrapper']['attributes'],
			$this->prepareComponentAttributes($blockDetails),
			$blockDetails['attributes']
		);
	}

	/**
	 * Iterate over component object in block manifest and search and replace the component attributes with new one.
	 * Search and replace the component attributes with new one.
	 *
	 * @param array  $component Object of component manifests to iterate.
	 * @param string $realComponentName Reacl component name defined in the component manifest.
	 * @param string $newComponentName New component name to search and replace the original.
	 */
	protected function prepareComponentAttribute(array $component, string $realComponentName, string $newComponentName): array
	{
		$componentAttributes = $component['attributes'] ?? [];

		// Check if realComponentName and newComponentName are not the same. If so do the replace of the attribute names.
		if ($realComponentName === $newComponentName) {
			return $componentAttributes;
		}

		return array_reduce(
			array_keys($componentAttributes),
			static function ($output, $name) use ($realComponentName, $newComponentName, $componentAttributes) {
				$output[str_replace($realComponentName, $newComponentName, $name)] = $componentAttributes[$name];
				return $output;
			},
			[]
		);
	}

	/**
	 * Iterate over component object in block manifest and check if the component exists in the project.
	 * If components contains more component this function will run recursively.
	 *
	 * @param array  $blockDetails Object of component manifests to iterate.
	 * @param string $parentAttributeName Use parent attribute name to determine if the name has changed in the parent component.
	 *
	 * @return array
	 */
	protected function prepareComponentAttributes(array $blockDetails, $parentAttributeName = null): array
	{
		$output = [];

		if (!isset($blockDetails['components'])) {
			return [];
		}

		if (isset($blockDetails['attributes'])) {
			$componentAttributes = $blockDetails['attributes'];
		}

		$globalData = $this->getBlocksDataFullRawItem('dependency');

		foreach ($blockDetails['components'] as $newComponentName => $realComponentName) {
			$component = $this->getComponent($realComponentName);

			if (isset($component['components'])) {
				$outputAttributes = $this->prepareComponentAttributes($component, $newComponentName);
			} else {
				// Use parent attribute name to determine if the name has changed in the parent component.
				if (
					$parentAttributeName !== $newComponentName &&
					$realComponentName !== $newComponentName &&
					(isset($globalData[$newComponentName]) || array_key_exists($newComponentName, $globalData))
				) {
					$newComponentName = $parentAttributeName;
				}

				$outputAttributes = $this->prepareComponentAttribute($component, $realComponentName, $newComponentName);
			}

			$output = array_merge(
				$output,
				$outputAttributes,
				$componentAttributes ?? []
			);
		}

		return $output ?? [];
	}

	/**
	 * Build components dependency tree for blocks.
	 *
	 * @param array $blocks List of all blocks.
	 * @param array $components List of all components.
	 *
	 * @return array
	 */
	private function buildDependencyBlocksTree(array $blocks, array $components): array
	{
		$output = [];

		foreach ($blocks as $item) {
			$blockName = $item['blockName'] ?? '';
			$componentsItem = $item['components'] ?? [];

			$output[$blockName] = array_unique($this->buildDependencyComponentsInnerTree($componentsItem, $components));
		}

		return $output;
	}

	/**
	 * Build components dependency tree for blocks.
	 *
	 * @param array $components List of all blocks.
	 *
	 * @return array
	 */
	private function buildDependencyComponentsTree(array $components): array
	{
		$output = [];

		foreach ($components as $item) {
			$componentName = $item['componentName'] ?? '';
			$componentsItem = $item['components'] ?? [];

			if (!$componentName) {
				continue;
			}

			$output[$componentName] = array_unique($this->buildDependencyComponentsInnerTree($componentsItem, $components));
		}

		return $output;
	}

	/**
	 * Build inner recursive dependency tree for components.
	 *
	 * @param array $componentsList List of components to check.
	 * @param array $components List of all components.
	 *
	 * @return array
	 */
	private function buildDependencyComponentsInnerTree(array $componentsList, array $components): array
	{
		$output = [];

		if (!$componentsList) {
			return $output;
		}

		foreach ($componentsList as $key => $value) {
			$items = array_values(
				array_filter(
					$components,
					function ($item) use ($value) {
						$componentName = $item['componentName'] ?? '';

						return $componentName === $value;
					}
				)
			)[0] ?? [];

			$items = $items['components'] ?? [];

			$output[] = $key;

			if ($items) {
				$output[] = $this->buildDependencyComponentsInnerTree($items, $components);
			}
		}

		return Components::flattenArray($output);
	}

	/**
	 * Throws error if manifest key blockName is missing
	 *
	 * @throws InvalidBlock Throws error if block name is missing.
	 *
	 * @return array
	 */
	private function getBlocksData(): array
	{
		return array_map(
			function (string $blockPath) {
				$block = implode(' ', (array)file(($blockPath)));

				$block = $this->parseManifest($block);

				if (!isset($block['blockName'])) {
					throw InvalidBlock::missingNameException($blockPath);
				}

				if (!isset($block['classes'])) {
					$block['classes'] = [];
				}

				if (!isset($block['attributes'])) {
					$block['attributes'] = [];
				}

				if (!isset($block['hasInnerBlocks'])) {
					$block['hasInnerBlocks'] = false;
				}

				return $block;
			},
			(array)glob("{$this->getBlocksCustomPath()}/*/manifest.json")
		);
	}

	/**
	 * Helper method to check the validity of JSON string
	 *
	 * @link https://stackoverflow.com/a/15198925/629127
	 *
	 * @param string $string JSON string to validate.
	 *
	 * @throws InvalidManifest Error in the case json file has errors.
	 *
	 * @return array Parsed JSON string into an array.
	 */
	private function parseManifest(string $string): array
	{
		$result = json_decode($string, true);

		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				$error = '';
				break;
			case JSON_ERROR_DEPTH:
				$error = \esc_html__('The maximum stack depth has been exceeded.', 'eightshift-libs');
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$error = \esc_html__('Invalid or malformed JSON.', 'eightshift-libs');
				break;
			case JSON_ERROR_CTRL_CHAR:
				$error = \esc_html__('Control character error, possibly incorrectly encoded.', 'eightshift-libs');
				break;
			case JSON_ERROR_SYNTAX:
				$error = \esc_html__('Syntax error, malformed JSON.', 'eightshift-libs');
				break;
			case JSON_ERROR_UTF8:
				$error = \esc_html__('Malformed UTF-8 characters, possibly incorrectly encoded.', 'eightshift-libs');
				break;
			case JSON_ERROR_RECURSION:
				$error = \esc_html__('One or more recursive references in the value to be encoded.', 'eightshift-libs');
				break;
			case JSON_ERROR_INF_OR_NAN:
				$error = \esc_html__('One or more NAN or INF values in the value to be encoded.', 'eightshift-libs');
				break;
			case JSON_ERROR_UNSUPPORTED_TYPE:
				$error = \esc_html__('A value of a type that cannot be encoded was given.', 'eightshift-libs');
				break;
			default:
				$error = \esc_html__('Unknown JSON error occurred.', 'eightshift-libs');
				break;
		}

		if ($error !== '') {
			throw InvalidManifest::manifestStructureException($error);
		}

		return $result;
	}
}
