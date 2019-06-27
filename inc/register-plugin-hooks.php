<?php
/**
 * WordPress Plugin Hooks
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
 * Set the activation hook for a plugin.
 * https://developer.wordpress.org/reference/functions/register_activation_hook/
 */
register_activation_hook(
	ROBOTSTXT_MANAGER_FILE,
	[
		'RobotstxtManager\Plugin_Activate',
		'init',
	]
);
