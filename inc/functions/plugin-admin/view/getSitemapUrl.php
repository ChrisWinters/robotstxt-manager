<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Build sitemap rule.
 */
function getSitemapUrl(): string
{
    return 'Sitemap: '.\site_url('/wp-sitemap.xml');
}
