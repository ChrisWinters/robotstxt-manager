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
function checkPhysical(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Used in inc/templates/cleaner.php to display clean up button.
    if (true === file_exists(\get_home_path().'robots.txt')) {
        \RobotstxtManager\option\update('clean-physical', 'cleaner');

        return 'physical';
    }

    // Trash cleanup.
    \RobotstxtManager\option\delete('cleaner');

    return 'clean';
}
