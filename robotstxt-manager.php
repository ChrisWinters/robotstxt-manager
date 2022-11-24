<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 1.1.0
 * License: GNU GPL
 * Copyright (c) 2017-2022 Chris W.
 * Author: Chris Winters
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: robotstxt-manager.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
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

final class InitPlugin
{
    public function __construct()
    {
        // Hook admin area.
        \add_action(
            'init',
            [
                $this,
                'admin',
            ]
        );
    }

    /**
     * Plugin admin area management.
     */
    public function admin(): void
    {
        if (false === \is_admin()) {
            return;
        }

        // Save plugin settings.
        $adminSave = new \RobotstxtManager\PluginAdminSave(
            new \RobotstxtManager\PluginAdminNotices(),
            new \RobotstxtManager\PluginAdminPresets(),
            new \RobotstxtManager\PluginAdminCleaner()
        );

        $adminSave->init();

        // Display plugin admin area.
        $robotstxtRules = new PluginAdminRobotstxtRules();
        $adminArea = new \RobotstxtManager\PluginAdmin($robotstxtRules);
        $adminArea->init();
    }
}

// Display Robots.txt file.
new \RobotstxtManager\Robotstxt();

// Plugin translation strings.
new \RobotstxtManager\PluginLocale();

// Init plugin backend.
new \RobotstxtManager\InitPlugin();

// Plugin activation checks.
\register_activation_hook(
    __FILE__,
    [
        'RobotstxtManager\PluginActivate',
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
