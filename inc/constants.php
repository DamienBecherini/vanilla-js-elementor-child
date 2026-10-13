<?php
/**
 * CONSTANTS
 */
define('VANILLA_JS_ELEMENTOR_CHILD_VERSION', time());

// THEME
if (!defined('VANILLA_JS_ELEMENTOR_CHILD_TEXTDOMAIN')) {
	define('VANILLA_JS_ELEMENTOR_CHILD_TEXTDOMAIN', wp_get_theme()->get('TextDomain'));
}

if (!defined('VANILLA_JS_ELEMENTOR_CHILD_NAME')) {
	define('VANILLA_JS_ELEMENTOR_CHILD_NAME', wp_get_theme()->get('Name'));
}