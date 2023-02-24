<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Save empty file data or clean/sanitize text data as robots.txt file.
 *
 * @param string $robotstxt robots.txt file markup to save
 *
 * @return string The status of the task on success: saved
 */
function robotstxt($robotstxt = ''): string
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    if (true !== empty($robotstxt)) {
        // Strip all whitespace.
        $whitespace = str_replace(' ', '', trim($robotstxt));

        // Add formatting back.
        $format = str_replace(':', ': ', trim($whitespace));

        // Sanitize post data.
        $robotstxt = \htmlspecialchars(strip_tags($format));
    }

    // Save robots.txt file.
    \RobotstxtManager\option\update(
        [
            'robotstxt' => $robotstxt,
        ]
    );

    return 'saved';
}
