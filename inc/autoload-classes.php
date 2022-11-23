<?php
/**
 * Autoload Classes.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
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
function robotstxtmanager_register_classes($class)
{
    // Namespace Prefix.
    $prefix = 'RobotstxtManager\\';

    // Move To Next Rgistered autoloader.
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Build Class Name.
    $relativeClass = strtolower(str_replace('_', '-', substr($class, $len)));

    // Replace Dir Separators and Replace Namespace with Base Dir.
    $file = ROBOTSTXT_MANAGER_DIR.'/inc/classes/class-'.str_replace('\\', '/', $relativeClass).'.php';

    // Include File.
    if (true === file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('RobotstxtManager\robotstxtmanager_register_classes');
