<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 3.0.0
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
        'plugin_version' => '3.0.0',
        'plugin_name' => \__('Robots.txt Manager', 'robotstxt-manager'),
        'plugin_about' => \__('A Simple Robots.txt Manager Plugin For WordPress.', 'robotstxt-manager'),
        'security_message' => \__('You are not authorized to perform this action.', 'robotstxt-manager'),
        'saved_message' => \__('Updated robots.txt file.', 'robotstxt-manager'),
        'updated_message' => \__('Updated robots.txt file from selected preset.', 'robotstxt-manager'),
        'deleted_message' => \__('Deleted all robots.txt manager settings.', 'robotstxt-manager'),
        'error_message' => \__('No action taken. Select an option first.', 'robotstxt-manager'),
        'clean_message' => \__('Cleaner: No action needs to be taken.', 'robotstxt-manager'),
        'cleaned_message' => \__('Cleaner: Issue has been resolved.', 'robotstxt-manager'),
        'previous_message' => \__('Cleaner: Old robots.txt file data found.', 'robotstxt-manager'),
        'physical_message' => \__('Cleaner: A physical robots.txt file was found.', 'robotstxt-manager'),
        'rewrite_message' => \__('Cleaner: Required robots.txt rewrite missing.', 'robotstxt-manager'),
        'version_message' => \__('WordPress 3.8 is required! Upgrade WordPress and try again.', 'robotstxt-manager'),
        'preset_viewer' => '/wp-content/plugins/robotstxt-manager/inc/functions/presetViewer.php?p=',
        'template_path' => dirname(__FILE__).'/inc/templates/',
        'admin_tabs' => [
            'settings' => \__('Settings', 'robotstxt-manager'),
            'cleaner' => \__('Cleaner', 'robotstxt-manager'),
        ],
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

require_once __DIR__.'/inc/functions/plugin-admin/adminNotices.php';
require_once __DIR__.'/inc/functions/plugin-admin/postObject.php';
require_once __DIR__.'/inc/functions/plugin-admin/postRedirect.php';
require_once __DIR__.'/inc/functions/plugin-admin/queryString.php';
require_once __DIR__.'/inc/functions/plugin-admin/securityCheck.php';

require_once __DIR__.'/inc/functions/plugin-admin/cleaner/checkPhysical.php';
require_once __DIR__.'/inc/functions/plugin-admin/cleaner/checkPrevious.php';
require_once __DIR__.'/inc/functions/plugin-admin/cleaner/checkRewrite.php';
require_once __DIR__.'/inc/functions/plugin-admin/cleaner/cleanPhysical.php';
require_once __DIR__.'/inc/functions/plugin-admin/cleaner/cleanPrevious.php';
require_once __DIR__.'/inc/functions/plugin-admin/cleaner/cleanRewrite.php';

require_once __DIR__.'/inc/functions/plugin-admin/posts/actions.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/cleaner.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/delete.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/preset.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/robotstxt.php';

require_once __DIR__.'/inc/functions/plugin-admin/preset/alternative.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/blocked.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/blogger.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/google.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/open.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/simplified.php';
require_once __DIR__.'/inc/functions/plugin-admin/preset/wordpress.php';

require_once __DIR__.'/inc/functions/plugin-admin/view/getSitemapUrl.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/getThemePath.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/getUploadPath.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/displayAdmin.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/enqueueScripts.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/includeTemplates.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/navigationTabs.php';

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

    // Set preset as robots.txt file.
    \add_action(
        'admin_post_preset',
        '\RobotstxtManager\PluginAdmin\Posts\actions'
    );

    // Run cleaner actions.
    \add_action(
        'admin_post_cleaner',
        '\RobotstxtManager\PluginAdmin\Posts\actions'
    );

    // Delete plugin settings.
    \add_action(
        'admin_post_delete',
        '\RobotstxtManager\PluginAdmin\Posts\actions'
    );

    // Plugin admin area notices.
    \add_action(
        'admin_notices',
        '\RobotstxtManager\PluginAdmin\adminNotices'
    );
}

// Validate plugin on activation and preset plugin data.
\register_activation_hook(
    __FILE__,
    '\RobotstxtManager\registerPlugin'
);

// Plugin update checker
if (true === file_exists(dirname(__FILE__).'/puc/plugin-update-checker.php')) {
    require_once dirname(__FILE__).'/puc/plugin-update-checker.php';

    $robotstxtManagerPuc = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
        'https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/updates.json',
        __FILE__,
        'robotstxt-manager'
    );
}
