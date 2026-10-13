<?php
/**
 * WordPress related helpers functions
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc\Helpers;

/** Get current page Slug.
 * 
 * @TODO test it
 * NOT TESTED -> Wont work if posts/pages arn't at root level
 */
function get_the_slug()
{
  // global $post;
  // $slug = $post->post_name ?? '';

  // Get the queried object and sanitize it
  $current_page = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());
  if (isset($current_page->post_name)) {
    $slug = $current_page->post_name;
  } elseif(isset($current_page->name)) {
    $slug = $current_page->name;
  } else {
    $slug = null;
  }

  if (!$slug) {
    $slug = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
  }

  return $slug;
}

if (!function_exists(__NAMESPACE__ . '\print_die')){
  function print_die($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    wp_die();
  }
}

if (!function_exists(__NAMESPACE__ . '\pre_print_r')){
  function pre_print_r($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
  }
}