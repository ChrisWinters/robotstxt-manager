<?php
/**
 * Public Facing Class Instances
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

/*
 * Determines whether the current request is for an administrative interface page.
 * https://developer.wordpress.org/reference/functions/is_admin/
 */
if ( true === is_admin() ) {
	// Save Plugin Admin Data.
	$robotstxt_manager_plugin_admin_save = new \RobotstxtManager\Plugin_Admin_Save();
	$robotstxt_manager_plugin_admin_save->init();

	// Display Plugin Admin.
	$robotstxt_manager_plugin_admin = new \RobotstxtManager\Plugin_Admin();
	$robotstxt_manager_plugin_admin->init();
}
