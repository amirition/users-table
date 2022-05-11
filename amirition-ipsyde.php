<?php 

/**
 * Plugin Name: Amirition Inpsyde Test
 * Plugin URI:
 * Description: Test Assignment to Show WordPress Users on Frontend 
 * Version: 0.1.0
 * Author: Amir Arabnezhad 
 * Author URI:
 * License: MIT
 */

 namespace Amirition\Inpsyde; 

 if (!class_exists(AmiritionInpsyde::class) && is_readable(__DIR__.'/vendor/autoload.php')) {
  /** @noinspection PhpIncludeInspection */
  require_once __DIR__.'/vendor/autoload.php';
}

class_exists(AmiritionInpsyde::class) && AmiritionInpsyde::instance();