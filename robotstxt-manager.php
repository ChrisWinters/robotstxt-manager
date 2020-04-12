<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 1.0.3
 * License: GNU GPLv3
 * Copyright ( c ) 2017-2019 Chris W.
 * Author: tribalNerd, Chris Winters
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: robotstxt-manager
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace RobotstxtManager;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ROBOTSTXT_MANAGER_DIR', __DIR__ );
define( 'ROBOTSTXT_MANAGER_FILE', __FILE__ );
define( 'ROBOTSTXT_MANAGER_VERSION', '1.0.3' );
define( 'ROBOTSTXT_MANAGER_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'ROBOTSTXT_MANAGER_PLUGIN_NAME', 'robotstxt-manager' );
define( 'ROBOTSTXT_MANAGER_SETTING_PREFIX', 'robotstxt_manager_' );

require_once dirname( __FILE__ ) . '/inc/autoload-classes.php';

/*
 * Hooks a function on to a specific action.
 * https://developer.wordpress.org/reference/functions/add_action/
 *
 * Fires once activated plugins have loaded.
 * https://developer.wordpress.org/reference/hooks/plugins_loaded/
 */
add_action(
	'plugins_loaded',
	array(
		'RobotstxtManager\Translate',
		'init',
	)
);

add_action(
	'plugins_loaded',
	array(
		'RobotstxtManager\RobotstxtManager',
		'init',
	)
);

/*
 * Set the activation hook for a plugin.
 * https://developer.wordpress.org/reference/functions/register_activation_hook/
 */
register_activation_hook(
	__FILE__,
	array(
		'RobotstxtManager\Plugin_Activate',
		'init',
	)
);

if ( true === file_exists( dirname( __FILE__ ) . '/puc/plugin-update-checker.php' ) ) {
	require_once dirname( __FILE__ ) . '/puc/plugin-update-checker.php';
	$robotstxt_manager_updater = \Puc_v4_Factory::buildUpdateChecker(
		'https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/updates.json',
		__FILE__,
		'robotstxt-manager-updater'
	);
}
