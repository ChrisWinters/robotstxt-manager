<?php
/**
 * Autoload Classes.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Register Classes.
 *
 * @param string $class Loaded Classes.
 */
function AutoloadClasses($class)
{
    // Namespace Prefix.
    $prefix = 'RobotstxtManager\\';

    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Build Class Name.
    $relativeClass = str_replace('\\', '', substr($class, $len));

    // Replace Dir Separators and Replace Namespace with Base Dir.
    $file = ROBOTSTXT_MANAGER_DIR.'/inc/classes/'.$relativeClass.'.php';

    // Include File.
    if (true === file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('RobotstxtManager\AutoloadClasses');
