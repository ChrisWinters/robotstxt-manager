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
	 * Robots.txt Called
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
		/**
		 * If Multisite is enabled.
		 *
		 * @source https://developer.wordpress.org/reference/functions/is_multisite/
		 */
		if ( true === is_multisite() ) {
			/**
			 * Retrieve the current site ID.
			 *
			 * @source https://developer.wordpress.org/reference/functions/get_current_blog_id/
			 */
			$site_id = get_current_blog_id();

			/**
			 * Switch the current blog.
			 *
			 * @source https://developer.wordpress.org/reference/functions/switch_to_blog/
			 */
			switch_to_blog( $site_id );
		}

		/**
		 * Retrieves an option value based on an option name.
		 *
		 * @source https://developer.wordpress.org/reference/functions/get_option/
		 */
		$website_option = get_option( ROBOTSTXT_MANAGER_PLUGIN_NAME );
		$robotstxt_file = '';

		if ( true !== empty( $website_option['disable'] ) ) {
			return;
		}

		if ( true !== empty( $website_option['robotstxt'] ) ) {
			$robotstxt_file = $website_option['robotstxt'];
		}

		if ( true !== empty( $robotstxt_file ) ) {
			header( 'Status: 200 OK', true, 200 );
			header( 'Content-Type: text/plain; charset=utf-8' );

			/**
			 * Fires when displaying the robots.txt file.
			 *
			 * @since 2.1.0
			 */
			do_action( 'do_robotstxt' );

			$public = get_option( 'blog_public' );

			if ( '0' === $public ) {
				$output .= "Disallow: /\n";
			} else {
				$output = $robotstxt_file;
			}

			/**
			 * Filters the robots.txt output.
			 *
			 * @since 3.0.0
			 *
			 * @param string $output Robots.txt output.
			 * @param bool   $public Whether the site is considered "public".
			 */
			echo apply_filters( 'robots_txt', $output, $public );
			exit;
		}
	}
}
