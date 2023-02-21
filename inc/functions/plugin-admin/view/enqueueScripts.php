<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue plugin admin area stylesheet.
 */
function enqueueScripts(): void
{
    $currentPage = \RobotstxtManager\PluginAdmin\queryString('page');

    // Only start loading within plugin admin areas.
    if (true === empty($currentPage)) {
        return;
    }

    // Only load within this plugins admin area.
    if ('robotstxt-manager' !== $currentPage) {
        return;
    }

    \wp_enqueue_style(
        'robotstxt-manager',
        \plugins_url(
            '/robotstxt-manager/assets/css/style.min.css'
        ),
        [],
        \RobotstxtManager\settings('plugin_version'),
        'all'
    );
}
