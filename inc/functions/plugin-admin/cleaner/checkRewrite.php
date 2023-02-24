<?php
/**
 * Private admin area function: cleaner tab.
 */

namespace RobotstxtManager\PluginAdmin\Cleaner;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Check for missing rewrite rules.
 */
function checkRewrite(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Get Rewrite Rules.
    $rules = \get_option('rewrite_rules');

    // Flush Rules If Needed.
    if (empty($rules)) {
        \flush_rewrite_rules();
    }

    // Error No Rewrite Rule Found, Set Marker.
    // Used in inc/templates/cleaner.php to display clean up button.
    if (true !== in_array('index.php?robots=1', (array) $rules, true)) {
        \RobotstxtManager\option\update('clean-rewrite', 'cleaner');

        return 'rewrite';
    }

    // Trash cleanup.
    \RobotstxtManager\option\delete('cleaner');

    return 'clean';
}
