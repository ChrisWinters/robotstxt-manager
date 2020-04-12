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

use RobotstxtManager\Trait_Option_Manager as TraitOptionManager;

/**
 * Manage Robots.txt File Presets
 */
final class Plugin_Admin_Presets {
	use TraitOptionManager;

	/**
	 * Plugin Admin Post Object.
	 *
	 * @var array
	 */
	public $post_object = array();

	/**
	 * Plugin_Admin_Notices
	 *
	 * @var object
	 */
	public $notices;


	/**
	 * Setup Class
	 *
	 * @param array  $post_object Post Object Array.
	 * @param object $notices     Notices Class Object.
	 */
	public function __construct( $post_object = array(), $notices = array() ) {
		$this->post_object = $post_object;
		$this->notices     = $notices;
	}//end __construct()


	/**
	 * Save Preset Robots.txt As Main Robots.txt
	 */
	public function set_preset_robotstxt() {
		$message = false;
		$preset  = '';

		if ( true !== empty( $this->post_object['preset'] ) ) {
			$preset = $this->post_object['preset'];
		}

		switch ( $preset ) {
			case 'default-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->default_robotstxt() ) );
				$message = true;
				break;

			case 'defaultalt-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->defaultAlt_robotstxt() ) );
				$message = true;
				break;

			case 'wordpress-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->wordpress_robotstxt() ) );
				$message = true;
				break;

			case 'open-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->open_robotstxt() ) );
				$message = true;
				break;

			case 'blogger-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->blogger_robotstxt() ) );
				$message = true;
				break;

			case 'block-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->blocked_robotstxt() ) );
				$message = true;
				break;

			case 'google-robotstxt':
				$this->update_option( array( 'robotstxt' => $this->google_robotstxt() ) );
				$message = true;
				break;
		}

		if ( true === $message ) {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'preset_success',
				)
			);
		} else {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'preset_error',
				)
			);
		}
	}


	/**
	 * Default Robots.txt File
	 */
	private function default_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= "Disallow: /feed\n";
		$txt .= "Disallow: /feed/\n";
		$txt .= "Disallow: /cgi-bin/\n";
		$txt .= "Disallow: /comment\n";
		$txt .= "Disallow: /comments\n";
		$txt .= "Disallow: /trackback\n";
		$txt .= "Disallow: /comment/\n";
		$txt .= "Disallow: /comments/\n";
		$txt .= "Disallow: /trackback/\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /wp-content/\n";
		$txt .= "Disallow: /wp-includes/\n";
		$txt .= "Disallow: /wp-login.php\n";
		$txt .= "Allow: /wp-admin/admin-ajax.php\n";

		return $txt;
	}


	/**
	 * Default-Alt Robots.txt File
	 */
	private function defaultalt_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= "Disallow: */feed\n";
		$txt .= "Disallow: */feed/\n";
		$txt .= "Disallow: */comment/\n";
		$txt .= "Disallow: */comments/\n";
		$txt .= "Disallow: */trackback/\n";
		$txt .= "Disallow: */comment\n";
		$txt .= "Disallow: */comments\n";
		$txt .= "Disallow: */trackback\n";
		$txt .= "Disallow: /feed\n";
		$txt .= "Disallow: /feed/\n";
		$txt .= "Disallow: /cgi-bin/\n";
		$txt .= "Disallow: /comment\n";
		$txt .= "Disallow: /comment/\n";
		$txt .= "Disallow: /comments\n";
		$txt .= "Disallow: /comments/\n";
		$txt .= "Disallow: /trackback\n";
		$txt .= "Disallow: /trackback/\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /wp-content/\n";
		$txt .= "Disallow: /wp-includes/\n";
		$txt .= "Disallow: /wp-login.php\n";
		$txt .= "Allow: /wp-admin/admin-ajax.php\n";

		return $txt;
	}


	/**
	 * WordPress Only Robots.txt File
	 */
	private function wordpress_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /wp-includes/\n";
		$txt .= "Allow: /wp-admin/admin-ajax.php\n";

		return $txt;
	}


	/**
	 * Open Robots.txt File
	 */
	private function open_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= 'Disallow:';

		return $txt;
	}


	/**
	 * Blogger Robots.txt File
	 */
	private function blogger_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= "Disallow: *?\n";
		$txt .= "Disallow: *.inc$\n";
		$txt .= "Disallow: *.php$\n";
		$txt .= "Disallow: */feed\n";
		$txt .= "Disallow: */feed/\n";
		$txt .= "Disallow: */author\n";
		$txt .= "Disallow: */comment/\n";
		$txt .= "Disallow: */comments/\n";
		$txt .= "Disallow: */trackback/\n";
		$txt .= "Disallow: */comment\n";
		$txt .= "Disallow: */comments\n";
		$txt .= "Disallow: */trackback\n";
		$txt .= "Disallow: /wp-\n";
		$txt .= "Disallow: /wp-*\n";
		$txt .= "Disallow: /feed\n";
		$txt .= "Disallow: /feed/\n";
		$txt .= "Disallow: /author\n";
		$txt .= "Disallow: /cgi-bin/\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /comment/\n";
		$txt .= "Disallow: /comments/\n";
		$txt .= "Disallow: /trackback/\n";
		$txt .= "Disallow: /comment\n";
		$txt .= "Disallow: /comments\n";
		$txt .= "Disallow: /trackback\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /wp-content/\n";
		$txt .= "Disallow: /wp-includes/\n";
		$txt .= "Disallow: /wp-login.php\n";
		$txt .= "Disallow: /wp-content/cache/\n";
		$txt .= "Disallow: /wp-content/themes/\n";
		$txt .= "Disallow: /wp-content/plugins/\n";
		$txt .= "Allow: /wp-admin/admin-ajax.php\n";

		return $txt;
	}


	/**
	 * Disallow Website Robots.txt File
	 */
	private function blocked_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= 'Disallow: /';

		return $txt;
	}


	/**
	 * Google Friendly Robots.txt File
	 */
	private function google_robotstxt() {
		$txt  = "# robots.txt\n";
		$txt .= "User-agent: *\n";
		$txt .= "Disallow: /wp-\n";
		$txt .= "Disallow: /feed\n";
		$txt .= "Disallow: /feed/\n";
		$txt .= "Disallow: /author\n";
		$txt .= "Disallow: /cgi-bin/\n";
		$txt .= "Disallow: /wp-admin/\n";
		$txt .= "Disallow: /comment/\n";
		$txt .= "Disallow: /comments/\n";
		$txt .= "Disallow: /trackback/\n";
		$txt .= "Disallow: /comment\n";
		$txt .= "Disallow: /comments\n";
		$txt .= "Disallow: /trackback\n";
		$txt .= "Disallow: /wp-content/\n";
		$txt .= "Disallow: /wp-includes/\n";
		$txt .= "Disallow: /wp-login.php\n";
		$txt .= "Disallow: /wp-content/cache/\n";
		$txt .= "Disallow: /wp-content/themes/\n";
		$txt .= "Disallow: /wp-content/plugins/\n";
		$txt .= "Allow: /wp-content/uploads\n";
		$txt .= "Allow: /wp-content/uploads/\n";
		$txt .= "Allow: /wp-admin/admin-ajax.php\n";
		$txt .= "\n";
		$txt .= "# google bot\n";
		$txt .= "User-agent: Googlebot\n";
		$txt .= "Disallow: /wp-*\n";
		$txt .= "Disallow: *?\n";
		$txt .= "Disallow: *.inc$\n";
		$txt .= "Disallow: *.php$\n";
		$txt .= "Disallow: */feed\n";
		$txt .= "Disallow: */feed/\n";
		$txt .= "Disallow: */author\n";
		$txt .= "Disallow: */comment/\n";
		$txt .= "Disallow: */comments/\n";
		$txt .= "Disallow: */trackback/\n";
		$txt .= "Disallow: */comment\n";
		$txt .= "Disallow: */comments\n";
		$txt .= "Disallow: */trackback\n";
		$txt .= "\n";
		$txt .= "# google image bot\n";
		$txt .= "User-agent: Googlebot-Image\n";
		$txt .= "Allow: /*\n";

		return $txt;
	}
}//end class
