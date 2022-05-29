<?php 

/**
 * Plugin Name: Users Table
 * Plugin URI:
 * Description: A simple wordpress plugin to show a table of users
 * Version: 0.1.0
 * Author: Amir Arabnezhad 
 * Author URI:
 * License: MIT
 */

 namespace Amirition\UTable;

 if (!class_exists(AmiritionUTable::class) && is_readable(__DIR__.'/vendor/autoload.php')) {
  /** @noinspection PhpIncludeInspection */
  require_once __DIR__.'/vendor/autoload.php';
}

class_exists(AmiritionUTable::class) && AmiritionUTable::instance();