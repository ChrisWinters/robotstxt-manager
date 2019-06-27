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

// Display Robots.txt File.
$robotstxt_manager_robotstxt = new Robotstxt();
