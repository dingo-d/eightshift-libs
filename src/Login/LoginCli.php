<?php

/**
 * Class that registers WPCLI command for Login.
 *
 * @package EightshiftLibs\Login
 */

declare(strict_types=1);

namespace EightshiftLibs\Login;

use EightshiftLibs\Cli\AbstractCli;

/**
 * Class LoginCli
 */
class LoginCli extends AbstractCli
{

	/**
	 * Output dir relative path.
	 */
	public const OUTPUT_DIR = 'src/Login';

	/**
	 * Get WPCLI command doc.
	 *
	 * @return array
	 */
	public function getDoc(): array
	{
		return [
			'shortdesc' => 'Generates Login class file.',
		];
	}

	public function __invoke(array $args, array $assocArgs) // phpcs:ignore
	{

		$className = $this->getClassShortName();

		// Read the template contents, and replace the placeholders with provided variables.
		$class = $this->getExampleTemplate(__DIR__, $className);

		// Replace stuff in file.
		$class = $this->renameClassName($className, $class);
		$class = $this->renameNamespace($assocArgs, $class);
		$class = $this->renameUse($assocArgs, $class);

		// Output final class to new file/folder and finish.
		$this->outputWrite(static::OUTPUT_DIR, $className, $class);
	}
}
