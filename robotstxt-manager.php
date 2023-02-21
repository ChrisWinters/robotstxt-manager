<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 2.0.0
 * License: GNU GPLv3
 * Author: Chris Winters
 * Text Domain: robotstxt-manager
 * Author URI: https://github.com/ChrisWinters
 * Copyright ( c ) 2017-2023 Chris Winters.
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

// Include plugin functions before loading plugin.
require_once __DIR__.'/inc/functions/registerPlugin.php';

// Validate plugin on activation and preset plugin data.
\register_activation_hook(
    __FILE__,
    '\RobotstxtManager\registerPlugin'
);
