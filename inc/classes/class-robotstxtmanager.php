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

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Core
 */
final class RobotstxtManager {
	/**
	 * Init Plugin
	 */
	public static function init() {
		// Display Robots.txt File.
		$robotstxt = new Robotstxt();

		/*
		 * Determines whether the current request is for an administrative interface page.
		 * https://developer.wordpress.org/reference/functions/is_admin/
		 */
		if ( true === is_admin() ) {
			// Save Plugin Admin Data.
			$admin_save = new Plugin_Admin_Save();
			$admin_save->init();

			// Display Plugin Admin.
			$admin = new Plugin_Admin();
			$admin->init();
		}
	}
}
