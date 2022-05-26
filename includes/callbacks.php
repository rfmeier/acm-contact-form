<?php
/**
 * General callbacks for ACM Contact Form plugin.
 *
 * @since 0.1.0
 * @package ACM_Contact_Form
 * @subpackage Callbacks
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'acm_contact_form_register_shortcode' );
/**
 * Callback for WordPress 'init' action.
 *
 * @since 0.1.0
 *
 * Register the shortcode.
 *
 * @return void
 */
function acm_contact_form_register_shortcode(): void {
	add_shortcode( 'acm_contact_form', 'acm_contact_form_render_form' );
}

add_filter( 'option_atlas_content_modeler_post_types', 'acm_contact_form_disable_contact_rest_endpoints', 10, 2 );
/**
 * Callback for WordPress 'option{option_name}' filter.
 *
 * Alter the atlas_content_modeler_post_types option so
 * contact endpoints are not created by default.
 *
 * @since 0.1.0
 *
 * @param mixed  $value       The option value.
 * @param string $option_name The option name.
 *
 * @return mixed The option value.
 */
function acm_contact_form_disable_contact_rest_endpoints( $value, string $option_name ) {
	if ( isset( $value['contact']['show_in_rest'] ) ) {
		$value['contact']['show_in_rest'] = false;
	}

	return $value;
}

add_action( 'wp_enqueue_scripts', 'acm_contact_form_enqueue_scripts' );
/**
 * Callback for WordPress 'wp_enqueue_scripts' action.
 *
 * Enqueue contact form scripts if shortcode is present.
 *
 * @since 0.1.0
 *
 * @return void
 */
function acm_contact_form_enqueue_scripts(): void {
	global $post;

	if ( empty( $post->post_content ) || ! has_shortcode( $post->post_content, 'acm_contact_form' ) ) {
		return;
	}

	$assets = acm_contact_form_get_js_dependencies();

	wp_enqueue_script(
		'acm-contact-form',
		plugins_url( 'assets/js/acm-contact-form.js', ACM_CONTACT_FORM_FILE ),
		wp_parse_args(
			$assets['dependencies'],
			array()
		),
		acm_contact_form_assets_version(),
		true
	);
}
