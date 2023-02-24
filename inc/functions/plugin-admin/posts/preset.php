<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get a preset robots.txt file and save as live robots.txt file data.
 *
 * @param string $presetCallback The preset function to hook
 *
 * @return string The status of the task: updated|error
 */
function preset(string $presetCallback): string
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Default to error if preset function is not found.
    $status = 'error';

    // Hook the preset callback function.
    if (true === function_exists('\RobotstxtManager\PluginAdmin\Preset\\'.$presetCallback)) {
        // Get preset robots.txt file data from preset function.
        $robotstxt = call_user_func('\RobotstxtManager\PluginAdmin\Preset\\'.$presetCallback);

        // Save robots.txt file.
        \RobotstxtManager\option\update(
            [
                'robotstxt' => $robotstxt,
            ]
        );

        $status = 'updated';
    }

    return $status;
}
