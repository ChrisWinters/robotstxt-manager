<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 1.1.0
 * License: GNU GPLv3
 * Copyright (c) 2017-2022 Chris W.
 * Author: tribalNerd, Chris Winters
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: robotstxt-manager.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

define('ROBOTSTXT_MANAGER_DIR', __DIR__);
define('ROBOTSTXT_MANAGER_FILE', __FILE__);
define('ROBOTSTXT_MANAGER_VERSION', '1.1.0');
define('ROBOTSTXT_MANAGER_PLUGIN_DIR', dirname(__FILE__));
define('ROBOTSTXT_MANAGER_PLUGIN_NAME', 'robotstxt-manager');
define('ROBOTSTXT_MANAGER_SETTING_PREFIX', 'robotstxt_manager_');

require_once dirname(__FILE__).'/inc/autoload-classes.php';

\add_action(
    'plugins_loaded',
    function () {
        // Retrieves the current locale.
        $getLocale = \apply_filters(
            'plugin_locale',
            \get_locale(),
            ROBOTSTXT_MANAGER_PLUGIN_NAME
        );

        $pluginPath = ROBOTSTXT_MANAGER_PLUGIN_DIR;
        $loadMoFile = $pluginPath.'/lang/'.$getLocale.'.mo';

        if (true === file_exists($loadMoFile)) {
            // Load a .mo file into the text domain $textdomain.
            \load_textdomain(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                $loadMoFile
            );
        }

        // Loads a plugin’s translated strings.
        \load_plugin_textdomain(
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            false,
            ROBOTSTXT_MANAGER_FILE.'/lang/'
        );

        if (true === \is_admin()) {
            $adminSave = new Plugin_Admin_Save();
            $adminSave->init();

            $admin = new Plugin_Admin();
            $admin->init();
        }

        new \RobotstxtManager\Robotstxt();
    }
);

// Plugin activation checks.
\register_activation_hook(
    __FILE__,
    [
        'RobotstxtManager\Plugin_Activate',
        'init',
    ]
);
/*
// Plugin update checker
if (true === file_exists(dirname(__FILE__).'/puc/plugin-update-checker.php')) {
    require_once dirname(__FILE__).'/puc/plugin-update-checker.php';

    $robotstxt_manager_updater = \Puc_v4_Factory::buildUpdateChecker(
        'https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/updates.json',
        __FILE__,
        'robotstxt-manager'
    );
}
 */
