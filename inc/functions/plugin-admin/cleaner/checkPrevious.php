<?php
/**
 * Private admin area function: cleaner tab.
 */

namespace RobotstxtManager\PluginAdmin\Cleaner;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Check for old robots.txt files from other plugins.
 */
function checkPrevious(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Used in inc/templates/cleaner.php to display clean up button.
    if (
        \get_option('pc_robotstxt') ||
        \get_option('kb_robotstxt') ||
        \get_option('cd_rdte_content')
    ) {
        \RobotstxtManager\option\update('clean-previous', 'cleaner');

        return 'previous';
    }

    // Trash cleanup.
    \RobotstxtManager\option\delete('cleaner');

    return 'clean';
}
