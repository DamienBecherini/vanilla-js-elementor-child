<?php
/**
 * Enqueue theme assets
 * 
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc;

use VANILLA_JS_ELEMENTOR_CHILD\Inc\Traits\Singleton;

class Assets
{
  use Singleton;

  protected function __construct()
  {
    // load class
    $this->setup_hooks();
  }

  protected function setup_hooks()
  {
    add_action('after_setup_theme', [$this, 'load_theme_textdomain']);

    // add_action('admin_enqueue_scripts', [$this, 'registerAdminScripts']);
    add_action('wp_enqueue_scripts', [$this, 'registerFrontEndScripts']);

    // Include scroll top button in the footer
    add_action( 'wp_footer', function(){ get_template_part('template-parts/scrolltopbutton'); });
  }

  /** Register Frontend scripts and javascript variables   */
  function registerFrontEndScripts($hook)
  {
    // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
    $parent_version = wp_get_theme()->get('Version');
    // $child_version is based of the file modification time using PHP’s filemtime function
    $child_style_css_version = filemtime(get_stylesheet_directory() . '/style.css');

    wp_enqueue_style(
      'childtheme-style',
      get_stylesheet_directory_uri() . '/style.css',
      [
        'hello-elementor-theme-style',
      ],
      $parent_version . $child_style_css_version //'1.0.0'
    );

    wp_enqueue_script( 
      'childtheme-js',
      get_stylesheet_directory_uri() .'/assets/js/dist/main.js',
      array(), //array("jquery"),
      filemtime(get_stylesheet_directory() . '/assets/js/dist/main.js'), //'1.0.0',
      false
    );


  }

  public function load_theme_textdomain()
  {
    load_theme_textdomain('vanilla-js-elementor-child', get_stylesheet_directory() . '/languages');
  }

}