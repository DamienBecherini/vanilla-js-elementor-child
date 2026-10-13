<?php
/**
 * Bootstraps / Encapsulates the Theme
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc;

use VANILLA_JS_ELEMENTOR_CHILD\Inc\Traits\Singleton;

class Main
{

  use Singleton;

  protected function __construct()
  {
    // load classes.
    Assets::getInstance();
    Shortcodes::getInstance();

    $this->setup_hooks();
  }

  protected function setup_hooks()
  {
    // Disable plugins and themes auto-updates: updates are applied manually, after being tested,
    // to avoid regressions on client sites under a maintenance contract
    add_filter('plugins_auto_update_enabled', '__return_false');
    add_filter('themes_auto_update_enabled', '__return_false');

    // Remove some panels from WordPress admin Dashboard
    add_action('wp_dashboard_setup', [$this, "disable_default_dashboard_widgets"]);

    // Move Yoast to bottom of posts edit screen
    add_filter( 'wpseo_metabox_prio', [$this, 'yoastseotobottom']);

  } /* protected function setup_hooks() - END */

  /** Disable some Widgets in the Dashboard */
  public function disable_default_dashboard_widgets()
  {

    if (current_user_can('manage_options')) {
      // From the Dashboard Screen, open the screen option tab and inspect the input you want to hide for it's value with the Developper Tools

      remove_action('welcome_panel', 'wp_welcome_panel');

      remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress.com Blog
      remove_meta_box('dashboard_secondary', 'dashboard', 'side');
      remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Press Widget
      remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Recent Drafts

      // remove_meta_box('dashboard_php_nag',               'dashboard', 'normal');
      // remove_meta_box('dashboard_browser_nag',           'dashboard', 'normal');
      // remove_meta_box('dashboard_site_health',           'dashboard', 'normal'); // Site Heal State

      remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
      remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Right Now
      remove_meta_box('network_dashboard_right_now', 'dashboard', 'normal');
      remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
      remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Incoming Links
      remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins

      remove_meta_box('e-dashboard-overview', 'dashboard', 'normal'); // Elementor
      remove_meta_box('try_gutenberg_panel', 'dashboard', 'normal'); // Try Gutenberg
      remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal'); // Yost SEO
      remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); // Gravity Form
      remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal'); // WP Mail SMTP
    }
  }

  // Move Yoast to bottom of posts edit screen
  function yoastseotobottom() {
    return 'low';
  }
}