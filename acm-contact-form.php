<?php
/**
 * Plugin Name: Atlas Content Modeler - Contact Form
 * Plugin URI: https://rfmeier.net/
 * Description: A contact form example using the ACM crud api.
 * Author: Ryan Meier
 * Author URI: https://rfmeier.net/
 * Text Domain: acm-contact-form
 * Domain Path: /languages
 * Version: 0.1.0
 * Requires at least: 5.9
 * Requires PHP: 7.3
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package ACM_Contact_Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ACM_CONTACT_FORM_VERSION', '0.1.0' );
define( 'ACM_CONTACT_FORM_FILE', __FILE__ );
define( 'ACM_CONTACT_FORM_DIR', dirname( ACM_CONTACT_FORM_FILE ) );

require ACM_CONTACT_FORM_DIR . '/includes/functions.php';
require ACM_CONTACT_FORM_DIR . '/includes/shortcodes.php';
require ACM_CONTACT_FORM_DIR . '/includes/callbacks.php';
require ACM_CONTACT_FORM_DIR . '/includes/rest-callbacks.php';
