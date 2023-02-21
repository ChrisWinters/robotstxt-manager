<?php
/**
 * Public admin area function: settings tab.
 */

namespace RobotstxtManager\PluginAdmin\Preset;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Full site open robots.txt file.
 */
function open(): string
{
    $txt = "User-agent: *\n";
    $txt .= 'Disallow:';

    return $txt;
}
