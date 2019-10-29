<?php
/**
 * File that holds the registrable Field interface.
 *
 * @package Eightshift_Libs\Routes
 */

declare( strict_types=1 );

namespace Eightshift_Libs\Routes;

/**
 * Interface Registrable.
 *
 * An object that can be registered.
 *
 * @since 0.2.0
 */
interface Registrable_Field {

  /**
   * Register the rest field.
   *
   * A register method holds register_rest_field funtion to register api field.
   *
   * @return void
   *
   * @since 0.8.0 Removing type hinting void for php 7.0.
   * @since 0.2.0
   */
  public function register_field();
}