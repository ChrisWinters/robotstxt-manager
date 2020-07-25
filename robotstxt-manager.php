<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: https://github.com/ChrisWinters/robotstxt-manager
 * Description: A Simple Robots.txt Manager For WordPress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo
 * Version: 1.0.5
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
define( 'ROBOTSTXT_MANAGER_VERSION', '1.0.5' );
define( 'ROBOTSTXT_MANAGER_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'ROBOTSTXT_MANAGER_PLUGIN_NAME', 'robotstxt-manager' );
define( 'ROBOTSTXT_MANAGER_SETTING_PREFIX', 'robotstxt_manager_' );

require_once dirname( __FILE__ ) . '/inc/autoload-classes.php';

/**
 * Hooks a function on to a specific action.
 *
 * @source https://developer.wordpress.org/reference/functions/add_action/
 *
 * Fires once activated plugins have loaded.
 *
 * @source https://developer.wordpress.org/reference/hooks/plugins_loaded/
 */
\add_action(
	'plugins_loaded',
	function() {
		/**
		 * Call the functions added to a filter hook.
		 *
		 * @source https://developer.wordpress.org/reference/functions/apply_filters/
		 *
		 * Retrieves the current locale.
		 *
		 * @source https://developer.wordpress.org/reference/functions/get_locale/
		 */
		$get_locale = \apply_filters(
			'plugin_locale',
			\get_locale(),
			ROBOTSTXT_MANAGER_PLUGIN_NAME
		);

		$plugin_path  = ROBOTSTXT_MANAGER_PLUGIN_DIR;
		$load_mo_file = $plugin_path . '/lang/' . $get_locale . '.mo';

		if ( true === file_exists( $load_mo_file ) ) {
			/**
			 * Load a .mo file into the text domain $textdomain.
			 *
			 * @source https://developer.wordpress.org/reference/functions/load_textdomain/
			 */
			\load_textdomain(
				ROBOTSTXT_MANAGER_PLUGIN_NAME,
				$load_mo_file
			);
		}

		/**
		 * Loads a plugin’s translated strings.
		 *
		 * @source https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
		 */
		\load_plugin_textdomain(
			ROBOTSTXT_MANAGER_PLUGIN_NAME,
			false,
			ROBOTSTXT_MANAGER_FILE . '/lang/'
		);

		/**
		 * Determines whether the current request is for an administrative interface page.
		 *
		 * @source https://developer.wordpress.org/reference/functions/is_admin/
		 */
		if ( true === is_admin() ) {
			$admin_save = new Plugin_Admin_Save();
			$admin_save->init();

			$admin = new Plugin_Admin();
			$admin->init();
		}

		new \RobotstxtManager\Robotstxt();
	}
);



/**
 * Set the activation hook for a plugin.
 *
 * @source https://developer.wordpress.org/reference/functions/register_activation_hook/
 */
\register_activation_hook(
	__FILE__,
	array(
		'RobotstxtManager\Plugin_Activate',
		'init',
	)
);


/**
 * Plugin update checker
 */
if ( file_exists( dirname( __FILE__ ) . '/puc/plugin-update-checker.php' ) ) {
	require_once dirname( __FILE__ ) . '/puc/plugin-update-checker.php';

	$robotstxt_manager_updater = \Puc_v4_Factory::buildUpdateChecker(
		'https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/updates.json',
		__FILE__,
		'robotstxt-manager'
	);
}
