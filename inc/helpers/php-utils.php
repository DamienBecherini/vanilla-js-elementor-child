<?php
/**
 * PHP related helpers functions
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc\Helpers;

function delete_unique_value_from_simple_array($val, $arr)
{
  // look for the value position
  $key = array_search($val, $arr, true);
  // if a position was found
  if ($key !== false) {
    // remove the value from the array
    array_splice($arr, $key, 1);
  }
  return $arr;
}

function delete_unique_value_from_associative_array($val, $arr)
{
  // look for the value position
  $key = array_search($val, $arr, true);
  // if a position was found
  if ($key !== false) {
    // remove the value from the array
    unset($arr[$key]);
  }
  return $arr;
}