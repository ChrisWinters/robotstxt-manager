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
use RobotstxtManager\Trait_Query_String as TraitQueryString;

/**
 * Load WordPress Plugin Admin Area
 */
final class Plugin_Admin {
	use TraitOptionManager;
	use TraitQueryString;

	/**
	 * Admin Area Template Tabs.
	 *
	 * @var array
	 */
	public $admin_tabs = array();

	/**
	 * Saved Robots.txt File.
	 *
	 * @var string
	 */
	public $robotstxt;

	/**
	 * Upload Path Rule.
	 *
	 * @var string
	 */
	public $uploadpath;

	/**
	 * Theme Path Rule.
	 *
	 * @var string
	 */
	public $themepath;

	/**
	 * Website Sitemap URL Rule.
	 *
	 * @var string
	 */
	public $sitemapurl;


	/**
	 * Set Class Params
	 *
	 * @return void
	 */
	public function __construct() {
		/*
		 * Escaping for HTML blocks.
		 * https://developer.wordpress.org/reference/functions/esc_html__/
		 */
		$this->admin_tabs = array(
			'settings' => esc_html__( 'Settings', 'robotstxt-manager' ),
			'cleaner'  => esc_html__( 'Cleaner', 'robotstxt-manager' ),
		);

		// Saved Robots.txt File.
		$this->robotstxt = $this->get_setting( 'robotstxt' );

		// Settings Template Extra Robots.txt Rule Statements.
		$robotstxt_rules  = new Plugin_Admin_Robotstxt_Rules();
		$this->uploadpath = $robotstxt_rules->get_uploadpath();
		$this->themepath  = $robotstxt_rules->get_themepath();
		$this->sitemapurl = $robotstxt_rules->get_sitemapurl();
	}//end __construct()


	/**
	 * Init Admin Display
	 *
	 * @return void
	 */
	public function init() {
		/*
		 * Fires before the administration menu loads in the admin.
		 * https://developer.wordpress.org/reference/hooks/admin_menu/
		 */
		add_action(
			'admin_menu',
			array(
				$this,
				'menu',
			)
		);

		if ( $this->query_string( 'page' ) === ROBOTSTXT_MANAGER_PLUGIN_NAME ) {
			/*
			 * Enqueue Scripts For Plugin Admin
			 * https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
			 */
			add_action(
				'admin_enqueue_scripts',
				array(
					$this,
					'enqueue',
				)
			);
		}
	}//end init()


	/**
	 * Generate Settings Menu
	 *
	 * @return void
	 */
	public function menu() {
		/*
		 * Add Settings Page Options
		 * https://developer.wordpress.org/reference/functions/add_submenu_page/
		 */
		add_submenu_page(
			'options-general.php',
			ROBOTSTXT_MANAGER_PLUGIN_NAME,
			__( 'Robots.txt Manager', 'robotstxt-manager' ),
			'manage_options',
			ROBOTSTXT_MANAGER_PLUGIN_NAME,
			array(
				$this,
				'display',
			)
		);
	}//end menu()


	/**
	 * Enqueue Stylesheet and jQuery
	 *
	 * @return void
	 */
	public function enqueue() {
		/*
		 * Enqueue a CSS stylesheet.
		 * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		 *
		 * Retrieves a URL within the plugins directory.
		 * https://developer.wordpress.org/reference/functions/plugins_url/
		 */
		wp_enqueue_style(
			ROBOTSTXT_MANAGER_PLUGIN_NAME,
			plugins_url( '/assets/css/style.min.css', ROBOTSTXT_MANAGER_FILE ),
			'',
			gmdate( 'YmdHis', time() ),
			'all'
		);
	}//end enqueue()


	/**
	 * Display Admin Templates
	 *
	 * @return void
	 */
	public function display() {
		$dir = dirname( ROBOTSTXT_MANAGER_FILE );
		$tab = $this->query_string( 'tab' );

		include_once $dir . '/inc/templates/header.php';

		if ( true === file_exists( $dir . '/inc/templates/' . $tab . '.php' ) ) {
			include_once $dir . '/inc/templates/' . $tab . '.php';
		} else {
			include_once $dir . '/inc/templates/settings.php';
		}

		include_once $dir . '/inc/templates/footer.php';
	}//end display()


	/**
	 * Display Admin Area Tabs
	 *
	 * @return string $html Tab Display
	 */
	public function tabs() {
		$html = '<h2 class="nav-tab-wrapper">';

		if ( true !== empty( $this->query_string( 'tab' ) ) ) {
			$current_tab = $this->query_string( 'tab' );
		} else {
			$current_tab = key( $this->admin_tabs );
		}

		$pagename = $this->query_string( 'page' );

		$posttype = '';
		if ( ROBOTSTXT_MANAGER_PLUGIN_NAME === $this->query_string( 'post_type' ) ) {
			$posttype = '&post_type=' . $this->query_string( 'post_type' );
		}

		foreach ( $this->admin_tabs as $tab => $name ) {
			$class = '';
			if ( $tab === $current_tab ) {
				$class = ' nav-tab-active';
			}

			$html .= '<a href="?page=' . $pagename .
			'&tab=' . $tab . $posttype .
			'" class="nav-tab' . $class . '">' . $name . '</a>';
		}

		$html .= '</h2><br />';

		return $html;
	}//end tabs()
}//end class
