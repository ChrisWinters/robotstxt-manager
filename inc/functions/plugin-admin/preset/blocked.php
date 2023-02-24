<?php
/**
 * Public admin area function: settings tab.
 */

namespace RobotstxtManager\PluginAdmin\Preset;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Disallow website robots.txt file.
 */
function blocked(): string
{
    $txt = "User-agent: *\n";
    $txt .= 'Disallow: /';

    return $txt;
}
