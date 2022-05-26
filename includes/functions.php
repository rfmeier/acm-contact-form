<?php
/**
 * General functions for ACM Contact Form plugin.
 *
 * @since 0.1.0
 * @package ACM_Contact_Form
 * @subpackage Functions
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Format error data for custom response format.
 *
 * Changes the way errors are returned for a rest response.
 *
 * @since 0.1.0
 *
 * @param array $data The error data.
 *
 * @return array The formatted error object.
 */
function acm_contact_form_format_error_data( array $data ): array {
	$formatted = array();

	if ( isset( $data['code'] ) && isset( $data['message'] ) ) {
		$formatted[ $data['code'] ][] = $data['message'];
	}

	if ( ! empty( $data['additional_errors'] ) ) {
		foreach ( $data['additional_errors'] as $index => $error ) {
			$formatted[ $error['code'] ][] = $error['message'];
		}
	}

	return acm_contact_form_format_response_data( false, $formatted );
}

/**
 * Format a response for ACM response format.
 *
 * @since 0.1.0
 *
 * @param bool  $success Response status.
 * @param array $data    The response data.
 *
 * @return array The response data as an array.
 */
function acm_contact_form_format_response_data( bool $success, array $data ): array {
	return compact( 'success', 'data' );
}

/**
 * Get the version for assets.
 *
 * If WP_DEBUG, set the version to current timestamp.
 *
 * @since 0.1.0
 *
 * @return string The version to use.
 */
function acm_contact_form_assets_version(): string {
	$version = ACM_CONTACT_FORM_VERSION;

	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		$version = time();
	}

	return (string) $version;
}

/**
 * Get the javascript dependencies.
 *
 * @since 0.1.0
 *
 * @return array Associative array of javascript dependencies.
 */
function acm_contact_form_get_js_dependencies(): array {
	$asset_path   = ACM_CONTACT_FORM_DIR . '/assets/js/acm-contact-form.asset.php';
	$dependencies = array(
		'dependencies' => array(),
		'version'      => array(),
	);

	if ( file_exists( $asset_path ) ) {
		$assets = include $asset_path;

		$dependencies = wp_parse_args( $assets, $dependencies );
	}

	return $dependencies;
}
