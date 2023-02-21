<?php
/**
 * Public admin area function: settings tab.
 */

namespace RobotstxtManager\PluginAdmin\Preset;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * A WordPress ready robots.txt file simplified for most websites.
 */
function simplified(): string
{
    $txt = "User-agent: *\n";
    $txt .= "Disallow: /feed\n";
    $txt .= "Disallow: /comment\n";
    $txt .= "Disallow: /comments\n";
    $txt .= "Disallow: /trackback\n";
    $txt .= "Disallow: /feed/\n";
    $txt .= "Disallow: /comment/\n";
    $txt .= "Disallow: /comments/\n";
    $txt .= "Disallow: /trackback/\n";
    $txt .= "Disallow: /wp-admin/\n";
    $txt .= "Disallow: /wp-includes/\n";
    $txt .= "Disallow: /wp-login.php\n";
    $txt .= "Disallow: /wp-content/\n";
    $txt .= "Allow: /wp-content/uploads/\n";
    $txt .= 'Allow: /wp-admin/admin-ajax.php';

    return $txt;
}
