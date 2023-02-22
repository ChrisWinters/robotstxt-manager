<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update robots.txt file with preset robots.txt file data.
 *
 * @param array $postObject filtered post object data from the cleaner tab
 *
 * @return string The status of the task: error|clean|cleaned|previous|physical|rewrite
 */
function cleaner(array $postObject = []): string
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    return 'clean';
}
