<?php
/**
 * Private admin area function: cleaner tab.
 */

namespace RobotstxtManager\PluginAdmin\Cleaner;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Delete old robots.txt file plugin data.
 */
function cleanPrevious(): string
{
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Remove options.
    \delete_option('pc_robotstxt');
    \delete_option('kb_robotstxt');
    \delete_option('cd_rdte_content');

    // Remove filters.
    \remove_filter('robots_txt', 'cd_rdte_filter_robots');
    \remove_filter('robots_txt', 'ljpl_filter_robots_txt');
    \remove_filter('robots_txt', 'robots_txt_filter');

    // Run check again.
    $status = \RobotstxtManager\PluginAdmin\Cleaner\checkPrevious();

    if ('clean' === $status) {
        return 'cleaned';
    }

    return $status;
}
