<?php
/**
 * Primary Class
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace RobotstxtManager;

use RobotstxtManager\Robotstxt;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Robots.txt Manager
 */
final class RobotstxtManager {
	/**
	 * Init Plugin
	 */
	public static function init() {
		$robotstxt = new Robotstxt();

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
	}
}
