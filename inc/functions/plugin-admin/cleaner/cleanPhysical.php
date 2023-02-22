<?php
/**
 * Private admin area function: cleaner tab.
 */

namespace RobotstxtManager\PluginAdmin\Cleaner;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Check for a physical robots.txt file.
 */
function cleanPhysical(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Maybe remove physical Robots.txt file.
    if (true === file_exists(\get_home_path().'robots.txt') && true === is_writable(\get_home_path().'robots.txt')) {
        unlink(realpath(\get_home_path().'robots.txt'));
    }

    // Run check again.
    $status = \RobotstxtManager\PluginAdmin\Cleaner\checkPhysical();

    if ('clean' === $status) {
        return 'cleaned';
    }

    return $status;
}
