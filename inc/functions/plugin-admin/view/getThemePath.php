<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Build allow current theme rule.
 */
function getThemePath(): string
{
    return 'Allow: '.strstr(\get_stylesheet_directory(), '/wp-content/themes').'/';
}
