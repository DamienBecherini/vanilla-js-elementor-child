<?php
/**
 * Singleton design pattern code
 * 
 */

namespace VANILLA_JS_ELEMENTOR_CHILD\Inc\Traits;

trait Singleton
{
  private static $instance;

  final public static function getInstance()
  {
    if (!self::$instance) {
      // new self() will refer to the class that uses the trait
      self::$instance = new self();

      do_action(sprintf('VANILLA_JS_ELEMENTOR_CHILD_singleton_init%s', get_called_class()));
    }
    return self::$instance;
  }

  // Prevent cloning of the instance
  private function __clone()
  {
  }

  // Prevent deserialization of the instance
  public function __wakeup()
  {
    throw new \LogicException('Cannot unserialize a singleton.');
  }
}