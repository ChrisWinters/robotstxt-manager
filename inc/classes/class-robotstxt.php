<?php
/**
 * Manager Class
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
 * Display Robots.txt File If Called
 */
final class Robotstxt {
	/**
	 * Check File Being Called
	 */
	public function __construct() {
		if ( false !== strpos( filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL ), 'robots.txt' ) ) {
			$this->robotstxt();
		}
	}


	/**
	 * Display Robots.txt File
	 */
	private function robotstxt() {
		$get_option = get_option( ROBOTSTXT_MANAGER_PLUGIN_NAME );

		if ( true !== empty( $get_option['robotstxt'] ) ) {
			header( 'Status: 200 OK', true, 200 );
			header( 'Content-type: text/plain; charset=' . get_bloginfo( 'charset' ) );

			/**
			 * Fires when displaying the robots.txt file.
			 *
			 * @since 2.1.0
			 */
			do_action( 'do_robotstxt' );

			/*
			 * Escaping for HTML blocks.
			 * https://developer.wordpress.org/reference/functions/esc_html/
			 */
			echo esc_html( $get_option['robotstxt'] );
			exit;
		}
	}
}//end class
