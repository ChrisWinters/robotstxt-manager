<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Delete all plugin settings.
 *
 * @return string The status of the task: deleted|error
 */
function delete(): string
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    // All plugin data should easily be removed.
    $status = 'deleted';

    // Delete all possible option set by the plugin.
    \RobotstxtManager\option\delete('cleaner');
    \RobotstxtManager\option\delete('notice');
    \RobotstxtManager\option\delete();

    // Get all saved options.
    $allOptions = wp_load_alloptions();

    // Validate plugin data was removed.
    foreach ((array) $allOptions as $slug => $values) {
        // Mostly useful for development but might as well include it.
        if (true === str_contains($slug, 'robotstxt-manager')) {
            $status = 'error';
        }
    }

    return $status;
}
