<?php
/**
 * The Theme/Frontend Enqueue specific functionality.
 *
 * @package Eightshiftlibs\Enqueue
 */

declare( strict_types=1 );

namespace Eightshiftlibs\Enqueue;

use Eightshiftlibs\Manifest\ManifestDataInterface;

/**
 * Class Enqueue
 *
 * @since 2.0.0
 */
class EnqueueTheme extends AbstractAssets {

  const THEME_SCRIPT_URI = 'application.js';
  const THEME_STYLE_URI  = 'application.css';

  /**
   * Instance variable of manifest data.
   *
   * @var ManifestDataInterface
   *
   * @since 2.0.0
   */
  protected $manifest;

  /**
   * Create a new admin instance.
   *
   * @param ManifestDataInterface $manifest Inject manifest which holds data about assets from manifest.json.
   *
   * @since 2.0.0
   * @since 2.2.0 removed Config from the dependency.
   */
  public function __construct( ManifestDataInterface $manifest ) {
    $this->manifest = $manifest;
  }

  /**
   * Register all the hooks
   *
   * @since 2.0.0
   *
   * @return void
   */
  public function register() {
    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 10 );
    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
  }

  /**
   * Register the Stylesheets for the front end of the theme.
   *
   * @since 2.0.0
   * @since 2.0.3 Added methods for overrides.
   *              Fixed static calls from config class.
   * @since 2.2.0 Removed config dependency.
   *
   * @return void
   */
  public function enqueue_styles() {
    $handle = "{$this->manifest->get_config()->get_project_prefix()}-theme-styles";

    \wp_register_style(
      $handle,
      $this->manifest->get_assets_manifest_item( static::THEME_STYLE_URI ),
      $this->get_frontend_style_dependencies(),
      $this->manifest->get_config()->get_project_version(),
      $this->get_media()
    );

    \wp_enqueue_style( $handle );
  }

  /**
   * Register the JavaScript for the front end of the theme.
   *
   * @since 2.0.0
   * @since 2.0.3 Added methods for overrides.
   *              Fixed static calls from config class.
   * @since 2.2.0 Removed config dependency.
   *
   * @return void
   */
  public function enqueue_scripts() {
    $handle = "{$this->manifest->get_config()->get_project_prefix()}-scripts";

    \wp_register_script(
      $handle,
      $this->manifest->get_assets_manifest_item( static::THEME_SCRIPT_URI ),
      $this->get_frontend_script_dependencies(),
      $this->manifest->get_config()->get_project_version(),
      $this->script_in_footer()
    );

    \wp_enqueue_script( $handle );

    foreach ( $this->get_localizations() as $object_name => $data_array ) {
      \wp_localize_script( $handle, $object_name, $data_array );
    }
  }
}
