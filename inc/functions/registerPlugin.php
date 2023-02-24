<?php
/**
 * Backend function.
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Register plugin features.
 */
function registerPlugin(): void
{
    global $pagenow;

    if (
        false === \is_admin() ||
        'plugins.php' !== $pagenow ||
        false === \current_user_can('manage_options')
    ) {
        \wp_die(\RobotstxtManager\settings('security_message'));
    }

    // Maybe get already saved robots.txt file.
    $robotstxt = \RobotstxtManager\option\setting('robotstxt');

    // Robots.txt file set, ignore setup.
    if (true !== empty($robotstxt)) {
        return;
    }

    // Set default WordPress ready robots.txt file.
    \RobotstxtManager\option\update(
        [
            'robotstxt' => \RobotstxtManager\PluginAdmin\Preset\wordPress(),
        ]
    );
}
