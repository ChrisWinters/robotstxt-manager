<?php
/**
 * Frontend function.
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display saved robots.txt file.
 */
function robotstxt(): void
{
    // Only display if robots.txt file is being called.
    if (false === \RobotstxtManager\isRobotstxt()) {
        return;
    }

    // Get robots.txt file to display.
    $robotstxt = \RobotstxtManager\option\setting('robotstxt');
    $publicBlog = \get_option('blog_public');

    // Site is not public, disallow indexing.
    if ('0' === $publicBlog) {
        $robotstxt = "Disallow: /\n";
    }

    // Display saved robotstxt file.
    if (true !== empty($robotstxt)) {
        header('Status: 200 OK', true, 200);
        header('Content-Type: text/plain; charset=utf-8');

        echo \esc_html($robotstxt);
        exit;
    }
}
