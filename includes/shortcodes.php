<?php
/**
 * Shortcode functions for ACM Contact Form plugin.
 *
 * @since 0.1.0
 * @package ACM_Contact_Form
 * @subpackage Shortcodes
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display the contact form content for the 'acm_contact_form' shortcode.
 *
 * Callback for WordPress add_shortcode() function parameter.
 *
 * @since 0.1.0
 *
 * @param array  $atts    Attribute array.
 * @param string $content Optional content.
 *
 * @return string
 */
function acm_contact_form_render_form( $atts, string $content = '' ): string {
	ob_start();

	?>
	<div id="acm-contact-form"></div>
	<?php

	return ob_get_clean();
}
