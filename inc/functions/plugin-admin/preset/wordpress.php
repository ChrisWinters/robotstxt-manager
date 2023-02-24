<?php
/**
 * Public admin area function: settings tab.
 */

namespace RobotstxtManager\PluginAdmin\Preset;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * A WordPress ready robots.txt file with all rules included.
 */
function wordPress(): string
{
    $txt = "User-agent: *\n";
    $txt .= "Disallow: *?\n";
    $txt .= "Disallow: /wp-\n";
    $txt .= "Disallow: /wp-*\n";
    $txt .= "Disallow: *.inc$\n";
    $txt .= "Disallow: *.php$\n";
    $txt .= "Disallow: */feed\n";
    $txt .= "Disallow: */author\n";
    $txt .= "Disallow: */comment\n";
    $txt .= "Disallow: */comments\n";
    $txt .= "Disallow: */trackback\n";
    $txt .= "Disallow: */feed/\n";
    $txt .= "Disallow: */author/\n";
    $txt .= "Disallow: */comment/\n";
    $txt .= "Disallow: */comments/\n";
    $txt .= "Disallow: */trackback/\n";
    $txt .= "Disallow: /feed\n";
    $txt .= "Disallow: /author\n";
    $txt .= "Disallow: /comment\n";
    $txt .= "Disallow: /comments\n";
    $txt .= "Disallow: /trackback\n";
    $txt .= "Disallow: /feed/\n";
    $txt .= "Disallow: /author/\n";
    $txt .= "Disallow: /comment/\n";
    $txt .= "Disallow: /comments/\n";
    $txt .= "Disallow: /trackback/\n";
    $txt .= "Disallow: /cgi-bin/\n";
    $txt .= "Disallow: /wp-admin/\n";
    $txt .= "Disallow: /wp-content/\n";
    $txt .= "Disallow: /wp-includes/\n";
    $txt .= "Disallow: /wp-login.php\n";
    $txt .= "Disallow: /wp-content/cache/\n";
    $txt .= "Disallow: /wp-content/themes/\n";
    $txt .= "Disallow: /wp-content/plugins/\n";
    $txt .= "Allow: /wp-content/uploads/\n";
    $txt .= 'Allow: /wp-admin/admin-ajax.php';

    return $txt;
}
