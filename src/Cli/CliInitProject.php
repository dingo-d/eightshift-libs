<?php

/**
 * Class that registers WPCLI command initial setup of theme project.
 *
 * @package EightshiftLibs\Cli
 */

declare(strict_types=1);

namespace EightshiftLibs\Cli;

use EightshiftLibs\Build\BuildCli;
use EightshiftLibs\CiExclude\CiExcludeCli;
use EightshiftLibs\ConfigProject\ConfigProjectCli;
use EightshiftLibs\GitIgnore\GitIgnoreCli;
use EightshiftLibs\Readme\ReadmeCli;
use EightshiftLibs\Setup\SetupCli;

/**
 * Class CliInitProject
 */
class CliInitProject extends AbstractCli
{
	/**
	 * CLI command name
	 *
	 * @var string
	 */
	public const COMMAND_NAME = 'setup_project';

	/**
	 * All classes for initial theme setup for project.
	 * Append INIT_THEME_CLASSES in the final output.
	 *
	 * @var class-string[]
	 */
	public const INIT_PROJECT_CLASSES = [
		GitIgnoreCli::class,
		SetupCli::class,
		CiExcludeCli::class,
		BuildCli::class,
		ReadmeCli::class,
		ConfigProjectCli::class,
	];

	/**
	 * Get WPCLI command name
	 *
	 * @return string
	 */
	public function getCommandName(): string
	{
		return self::COMMAND_NAME;
	}

	/**
	 * Get WPCLI command doc
	 *
	 * @return array<string, array<int, array<string, bool|string>>|string>
	 */
	public function getDoc(): array
	{
		return [
			'shortdesc' => 'Generates initial setup for WordPress theme project with all files to run a client project. For example: gitignore file for the full WordPress project, continuous integration exclude files, etc.', // phpcs:ignore Generic.Files.LineLength.TooLong
		];
	}

	/* @phpstan-ignore-next-line */
	public function __invoke(array $args, array $assocArgs) // phpcs:ignore
	{
		if (!function_exists('\add_action')) {
			$this->runReset();
			\WP_CLI::log('--------------------------------------------------');
		}

		$classes = array_merge(
			CliInitTheme::INIT_THEME_CLASSES,
			self::INIT_PROJECT_CLASSES
		);

		$this->getEvalLoop($classes, true, $assocArgs);

		\WP_CLI::log('--------------------------------------------------');

		\WP_CLI::log((string)shell_exec('npm run start')); // phpcs:ignore

		\WP_CLI::log('--------------------------------------------------');

		\WP_CLI::success('All commands are finished.');
	}
}
