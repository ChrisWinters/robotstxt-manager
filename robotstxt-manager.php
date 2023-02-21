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

/**
 * Plugin settings.
 *
 * @param string $key the array key to get the value for
 */
function settings(string $key): string|array
{
    $settings = [
        'plugin_version' => '2.0.0',
        'plugin_name' => \__('Robots.txt Manager', 'robotstxt-manager'),
        'plugin_about' => \__('A Simple Robots.txt Manager Plugin For WordPress.', 'robotstxt-manager'),
        'security_message' => \__('You are not authorized to perform this action.', 'robotstxt-manager'),
        'template_path' => dirname(__FILE__).'/inc/templates/',
    ];

    return $settings[$key];
}

// Include plugin functions before loading plugin.
require_once __DIR__.'/inc/functions/isRobotstxt.php';
require_once __DIR__.'/inc/functions/robotstxt.php';
require_once __DIR__.'/inc/functions/registerPlugin.php';

require_once __DIR__.'/inc/functions/option/delete.php';
require_once __DIR__.'/inc/functions/option/get.php';
require_once __DIR__.'/inc/functions/option/setting.php';
require_once __DIR__.'/inc/functions/option/update.php';

require_once __DIR__.'/inc/functions/plugin-admin/postObject.php';
require_once __DIR__.'/inc/functions/plugin-admin/postRedirect.php';
require_once __DIR__.'/inc/functions/plugin-admin/queryString.php';
require_once __DIR__.'/inc/functions/plugin-admin/securityCheck.php';

require_once __DIR__.'/inc/functions/plugin-admin/posts/actions.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/delete.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/robotstxt.php';

require_once __DIR__.'/inc/functions/plugin-admin/view/displayAdmin.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/enqueueScripts.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/includeTemplates.php';

// Init plugin.
\add_action(
    'plugins_loaded',
    '\RobotstxtManager\loadPlugin'
);

/**
 * Load all plugin features.
 */
function loadPlugin(): void
{
    // Maybe display robots.txt file.
    \RobotstxtManager\robotstxt();

    // Get current locale.
    $getLocale = \apply_filters(
        'plugin_locale',
        \get_locale(),
        'robotstxt-manager'
    );

    if (true === file_exists(__FILE__.'/lang/'.$getLocale.'.mo')) {
        // Load a .mo file into the text domain $textdomain.
        \load_textdomain(
            'robotstxt-manager',
            __FILE__.'/lang/'.$getLocale.'.mo'
        );

        // Loads translated strings.
        \load_plugin_textdomain(
            'robotstxt-manager',
            false,
            '/lang/'
        );
    }

    // Load plugin menu and admin area templates.
    \add_action(
        'admin_menu',
        '\RobotstxtManager\PluginAdmin\View\displayAdmin'
    );

    // Enqueue plugin admin area stylesheet.
    \add_action(
        'admin_enqueue_scripts',
        '\RobotstxtManager\PluginAdmin\View\enqueueScripts'
    );

    // Update robots.txt file.
    \add_action(
        'admin_post_robotstxt',
        '\RobotstxtManager\PluginAdmin\Posts\actions'
    );

    // Delete plugin settings.
    \add_action(
        'admin_post_delete',
        '\RobotstxtManager\PluginAdmin\Posts\actions'
    );
}

// Validate plugin on activation and preset plugin data.
\register_activation_hook(
    __FILE__,
    '\RobotstxtManager\registerPlugin'
);
