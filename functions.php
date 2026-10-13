<?php
/**
 * Theme functions and definitions
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// CONSTANTS
require_once get_stylesheet_directory() . '/inc/constants.php';

// Autoloader : Auto include classes from /inc/ folder
require_once get_stylesheet_directory() . '/inc/helpers/autoloader.php';

// Get Theme Class Instance
function vanilla_js_elementor_child_get_theme_instance()
{
	\VANILLA_JS_ELEMENTOR_CHILD\Inc\Main::getInstance();
}
vanilla_js_elementor_child_get_theme_instance();
