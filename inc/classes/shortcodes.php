<?php
/**
 * Add Shortcodes
 *
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc;

use VANILLA_JS_ELEMENTOR_CHILD\Inc\Traits\Singleton;

class Shortcodes
{
  use Singleton;

  protected function __construct()
  {
    // load class
    $this->setup_hooks();
  }

  protected function setup_hooks()
  {
    // Year Shortcode
    add_shortcode('lci-year', function() {
      $year = date('Y');
      return $year;
    });

    add_shortcode('a', [$this, 'linkshortcode']);
  }

  // [a href="services-web"]text[/a] will print a link to the page services-web
  public function linkshortcode( $atts = array(), $content = null ) {
    // start buffer
    ob_start();

    $a = shortcode_atts( array(
          'href' => '',
      'id' => '',
      'class' => '',
      ), $atts );

    $pageSlug = $a['href'];
    $id = sanitize_html_class($a['id']);
    $id = (empty($id))? '':'/#'.$id;
    $classes = esc_attr($a['class']);
    $url = esc_url(get_site_url(null, $pageSlug).$id);

    echo '<a href="'.$url.'" class="site-link '.$classes.'">'.esc_html($content).'</a>';

    // return buffered output
    return ob_get_clean();
  }

}
