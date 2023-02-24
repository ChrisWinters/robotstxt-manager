<?php
/**
 * Private admin area function: cleaner tab.
 */

namespace RobotstxtManager\PluginAdmin\Cleaner;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Add missing robots.txt rewrite rule.
 */
function cleanRewrite(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Get Rewrite Rules.
    $rules = \get_option('rewrite_rules');

    // Add Missing Rule.
    if (true !== in_array('index.php?robots=1', (array) $rules, true)) {
        // Set Proper Keys.
        $ruleKey = 'robots\.txt$';
        $rules[$ruleKey] = 'index.php?robots=1';

        // Update Rules.
        \update_option('rewrite_rules', $rules);

        // Flush Rules.
        \flush_rewrite_rules();
    }

    // Run check again.
    $status = \RobotstxtManager\PluginAdmin\Cleaner\checkRewrite();

    if ('clean' === $status) {
        return 'cleaned';
    }

    return $status;
}
