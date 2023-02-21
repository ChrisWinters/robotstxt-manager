<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Load plugin menu, stylesheet, and templates.
 */
function displayAdmin(): void
{
    // Plugin admin menu and templates.
    \add_submenu_page(
        'options-general.php',
        \RobotstxtManager\settings('plugin_name'),
        \RobotstxtManager\settings('plugin_name'),
        'manage_options',
        'robotstxt-manager',
        function () {
            return;
        }
    );
}
