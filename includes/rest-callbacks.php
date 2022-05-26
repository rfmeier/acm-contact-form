<?php
/**
 * REST callbacks for ACM Contact Form plugin.
 *
 * @since 0.1.0
 * @package ACM_Contact_Form
 * @subpackage REST
 */

declare(strict_types=1);

use function WPE\AtlasContentModeler\API\insert_model_entry;
use function WPE\AtlasContentModeler\API\array_extract_by_keys;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'rest_api_init', 'acm_contact_form_register_contact_routes' );
/**
 * Callback for WordPress 'rest_api_init' action.
 *
 * Register rest routes.
 *
 * @since 0.1.0
 *
 * @return void
 */
function acm_contact_form_register_contact_routes(): void {
	register_rest_route(
		'acm',
		'/contacts/',
		array(
			'methods'             => 'POST',
			'callback'            => 'acm_contact_form_rest_create_contact',
			'permission_callback' => '__return_true',
		)
	);
}

/**
 * Callback for WordPress register_rest_route() 'callback' parameter.
 *
 * Handle POST acm/contacts/ endpoint.
 *
 * @since 0.1.0
 *
 * @param \WP_REST_Request $request The request object.
 *
 * @return array|\WP_Error|\WP_REST_Response
 */
function acm_contact_form_rest_create_contact( \WP_REST_Request $request ) {
	$post_data  = array( 'post_status' => 'publish' );
	$model_data = array_extract_by_keys(
		(array) $request->get_json_params(),
		array( 'name', 'email', 'comment' )
	);

	$model_id = insert_model_entry( 'contact', $model_data, $post_data );
	if ( is_wp_error( $model_id ) ) {
		$model_id->add_data( array( 'status' => 400 ) );

		return $model_id;
	}

	return rest_ensure_response(
		array(
			'success' => true,
			'data'    => 'The contact was successfully submitted',
		)
	);
}

add_filter( 'rest_post_dispatch', 'acm_contact_form_handle_custom_error_response', 10, 3 );
/**
 * Callback for WordPress 'rest_post_dispatch' filter.
 *
 * Convert an error response to a custom format only for wpe/atlas endpoints.
 *
 * @since 0.1.0
 *
 * @param \WP_REST_Response $response The response object.
 * @param \WP_REST_Server   $server   The server object.
 * @param \WP_REST_Request  $request  The request object.
 *
 * @return \WP_REST_Response
 */
function acm_contact_form_handle_custom_error_response( $response, $server, $request ) {
	if ( strpos( $response->get_matched_route(), 'acm/contacts' ) < 0 ) {
		return $response;
	}

	if ( ! $response->is_error() ) {
		return $response;
	}

	$response->set_data(
		acm_contact_form_format_error_data( $response->get_data() )
	);

	return $response;
}
