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
 * Robots.txt
 */
final class Robotstxt {
	/**
	 * Maybe start robots.txt display
	 */
	public function __construct() {
		if ( true === $this->is_robotstxt_file() ) {
			$this->display();
		}
	}


	/**
	 * Display robots.txt file
	 */
	private function display() {
		$robotstxt   = $this->get_robotstxt();
		$blog_public = \get_option( 'blog_public' );

		if ( '0' === $blog_public ) {
			$robotstxt = "Disallow: /\n";
		}

		if ( true !== empty( $robotstxt ) ) {
			header( 'Status: 200 OK', true, 200 );
			header( 'Content-Type: text/plain; charset=utf-8' );

			/**
			 * Escaping for HTML blocks.
			 *
			 * @source https://developer.wordpress.org/reference/functions/esc_html/
			 */
			echo \esc_html( $robotstxt );
			exit;
		}
	}


	/**
	 * Get robots.txt file
	 *
	 * @return string
	 */
	private function get_robotstxt() : string {
		/**
		 * Retrieve the current site ID.
		 *
		 * @source https://developer.wordpress.org/reference/functions/get_current_blog_id/
		 */
		$blog_id = \get_current_blog_id();

		if ( $blog_id > 0 &&
			true === function_exists( 'switch_to_blog' ) ) {
			/**
			 * Switch the current blog.
			 *
			 * @source https://developer.wordpress.org/reference/functions/switch_to_blog/
			 */
			\switch_to_blog( $blog_id );
		}

		/**
		 * Retrieves an option value based on an option name.
		 *
		 * @source https://developer.wordpress.org/reference/functions/get_option/
		 */
		$settings = \get_option( ROBOTSTXT_MANAGER_PLUGIN_NAME );

		if ( $blog_id > 0 &&
			true === function_exists( 'restore_current_blog' ) ) {
			/**
			 * Restore the current blog, after calling restore_current_blog().
			 *
			 * @source https://developer.wordpress.org/reference/functions/restore_current_blog/
			 */
			\restore_current_blog();
		}

		$robotstxt = '';

		if ( true !== empty( $settings['disable'] ) ) {
			return null;
		}

		if ( true !== empty( $settings['robotstxt'] ) ) {
			$robotstxt = $settings['robotstxt'];
		}

		if ( true !== empty( $robotstxt ) ) {
			$public = \get_option( 'blog_public' );

			if ( '0' === $public ) {
				$robotstxt = "Disallow: /\n";
			}
		}

		if ( true !== empty( $user_robotstxt ) ) {
			$robotstxt = $user_robotstxt;
		}

		return (string) $robotstxt;
	}


	/**
	 * Check if called file is robots.txt file
	 */
	private function is_robotstxt_file() : bool {
		if ( true === filter_has_var( INPUT_SERVER, 'REQUEST_URI' ) ) {
			$filename = filter_input(
				INPUT_SERVER,
				'REQUEST_URI',
				FILTER_UNSAFE_RAW,
				FILTER_NULL_ON_FAILURE
			);
		} else {
			if ( isset( $_SERVER['REQUEST_URI'] ) ) {
				/**
				 * Remove slashes from a string or array of strings.
				 *
				 * @source https://developer.wordpress.org/reference/functions/wp_unslash/
				 */
				$request_uri = \wp_unslash( $_SERVER['REQUEST_URI'] );
				$filename    = filter_var(
					$request_uri,
					FILTER_UNSAFE_RAW,
					FILTER_NULL_ON_FAILURE
				);
			} else {
				$filename = null;
			}
		}

		if ( '/robots.txt' === $filename || 'robotst.txt' === $filename ) {
			return true;
		}

		return false;
	}
}
