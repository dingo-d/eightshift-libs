<?php
/**
 * File containing the invalid service exception class
 *
 * @package Eightshiftlibs\Exception
 */

declare( strict_types=1 );

namespace Eightshiftlibs\Exception;

/**
 * Class Invalid_Service.
 *
 * @since 0.1.0
 */
final class FinalInvalidService extends \InvalidArgumentException implements GeneralExceptionInterface {

  /**
   * Create a new instance of the exception for a service class name that is
   * not recognized.
   *
   * @param string $service Class name of the service that was not recognized.
   *
   * @return static
   *
   * @since 0.1.0
   */
  public static function from_service( $service ) {
    $message = sprintf(
      esc_html__( 'The service %s is not recognized and cannot be registered.', 'eightshift-libs' ),
      is_object( $service )
        ? get_class( $service )
        : (string) $service
    );

    return new static( $message );
  }
}
