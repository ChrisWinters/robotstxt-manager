<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: http://technerdia.com
 * Description: A Simple Robots.txt Manager For Wordpress.
 * Tags: technerdia, tribalnerd
 * Version: 0.0.1
 * License: GPL
 * Copyright (c) 2016, techNerdia LLC.
 * Author: tribalNerd, Chris Winters
 * Author URI: http://techNerdia.com/
 * Text Domain: robotstxt-manager
 * Domain Path: /languages/
 */

// Wordpress check
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Define Constants
 * 
 * @return array
 */
if( function_exists( 'RobotstxtManagerConstants' ) )
{
    RobotstxtManagerConstants( Array(
        'ROBOTSTXT_MANAGER_BASE_URL'         => get_bloginfo( 'url' ),
        'ROBOTSTXT_MANAGER_VERSION'          => '0.0.1',
        'ROBOTSTXT_MANAGER_WP_MIN_VERSION'   => '3.8',

        'ROBOTSTXT_MANAGER_PLUGIN_FILE'      => __FILE__,
        'ROBOTSTXT_MANAGER_PLUGIN_DIR'       => dirname( __FILE__ ),
        'ROBOTSTXT_MANAGER_PLUGIN_BASE'      => plugin_basename( __FILE__ ),

        'ROBOTSTXT_MANAGER_MENU_NAME'        => 'Robots.txt Manager',
        'ROBOTSTXT_MANAGER_PAGE_NAME'        => 'Robots.txt Manager for Wordpress',
        'ROBOTSTXT_MANAGER_PAGE_ABOUT'       => 'A Simple Robots.txt Manager Plugin For Wordpress.',
        'ROBOTSTXT_MANAGER_PLUGIN_NAME'      => 'robotstxt_manager',

        'ROBOTSTXT_MANAGER_INCLUDES'         => dirname( __FILE__ ) .'/includes',
        'ROBOTSTXT_MANAGER_TEMPLATES'        => dirname( __FILE__ ) .'/templates'
    ) );
}


/**
 * Loop Through Constants
 * 
 * @param $constants_array array
 * @return void
 */
function RobotstxtManagerConstants( $constants_array )
{
    foreach( $constants_array as $name => $value ) {
        define( $name, $value, true );
    }
}


/**
 * Register Classes & Include
 * 
 * @param $class string Class Name
 * @return void
 */
spl_autoload_register( function ( $class )
{
    if( strpos( $class, 'RobotstxtManager_' ) !== false ) {
        $class_name = str_replace( 'RobotstxtManager_', "", $class );

        // If The Class Exists
        if( file_exists( ROBOTSTXT_MANAGER_INCLUDES .'/class_'. strtolower( $class_name ) .'.php' ) ) {
            // Include Classes
            include_once( ROBOTSTXT_MANAGER_INCLUDES .'/class_'. strtolower( $class_name ) .'.php' );
        }
    }

    // Plugin Extension
    if ( class_exists( 'RTM_Api' ) ) { require_once( WP_PLUGIN_DIR . '/' . RTM ); }
} );


/**
 * Load Plugin
 */
class robotstxt_manager
{
    /**
     * Backend Facing
     */
    final public static function backend() {
        if( is_admin() ) {

            // Form Validation
            add_filter( 'rtm_validate_action', array( 'robotstxt_manager', 'validateActions' ) );

            // Admin Area Display & Functionality
            $RobotstxtManager_Admin = new RobotstxtManager_Admin( array(
                'base_url' => ROBOTSTXT_MANAGER_BASE_URL,
                'plugin_name' => ROBOTSTXT_MANAGER_PLUGIN_NAME,
                'plugin_file' => ROBOTSTXT_MANAGER_PLUGIN_FILE,
                'plugin_version' => ROBOTSTXT_MANAGER_VERSION,
                'menu_name' => ROBOTSTXT_MANAGER_MENU_NAME,
                'templates' => ROBOTSTXT_MANAGER_TEMPLATES
            ) );

            // Init Admin Functions & Filters
            $RobotstxtManager_Admin->initAdmin();
        }
    }


    /**
     * Activate Plugin: Validate Plugin & Install Default Features
     * 
     * @return void
     */
    final public static function activate()
    {
        // Wordpress Version Check
        global $wp_version;

        // Network Activate Only
        if( function_exists( 'is_network_admin' ) && is_network_admin() ) {
            wp_die( __( '<b>Activation Failed</b>: The ' . ROBOTSTXT_MANAGER_PAGE_NAME . ' Plugin can only be activated within the a Websites Plugin Admin only. Download and install the plugin, "Multisite Robots.txt Manager" for Multisite Network Wordpress installs.', 'robotstxt-manager' ) );
        }

        // Version Check
        if( version_compare( $wp_version, ROBOTSTXT_MANAGER_WP_MIN_VERSION, "<" ) ) {
            wp_die( __( '<b>Activation Failed</b>: The ' . ROBOTSTXT_MANAGER_PAGE_NAME . ' plugin requires WordPress ' . ROBOTSTXT_MANAGER_WP_MIN_VERSION . ' or higher. Please Upgrade Wordpress, then try activating this plugin again.', 'robotstxt-manager' ) );
        }
    }


    /**
     * Inject Plugin Links
     * 
     * @return array
     */
    final public static function links( $links, $file )
    {
        // Get Current URL
        $request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL );

        // Links To Inject
        if ( $file == ROBOTSTXT_MANAGER_PLUGIN_BASE && strpos( $request_uri, "plugins.php" ) !== false ) {
            $links[] = '<a href="options-general.php?page=' . ROBOTSTXT_MANAGER_PLUGIN_NAME . '">'. __( 'Website Settings', 'robotstxt-manager' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/rtm/#faq" target="_blank">'. __( 'F.A.Q.', 'robotstxt-manager' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/help/" target="_blank">'. __( 'Support', 'robotstxt-manager' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/feedback/" target="_blank">'. __( 'Feedback', 'robotstxt-manager' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/donate/" target="_blank">'. __( 'Donations', 'robotstxt-manager' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/rtm/" target="_blank">'. __( 'PRO Details', 'robotstxt-manager' ) .'</a>';
        }

        return $links;
    }


    /**
     * Form / Plugin Validation
     * 
     * @return void
     */
    final public static function validateActions()
    {
        // Plugin Admin Area Only
        if ( filter_input( INPUT_GET, 'page', FILTER_UNSAFE_RAW ) != ROBOTSTXT_MANAGER_PLUGIN_NAME ) {
            wp_die( __( 'You are not authorized to perform this action.', 'robotstxt-manager' ) );
        }

        // Validate Nonce Action
        if( ! check_admin_referer( ROBOTSTXT_MANAGER_PLUGIN_NAME . '_action', ROBOTSTXT_MANAGER_PLUGIN_NAME . '_nonce' ) ) {
            wp_die( __( 'You are not authorized to perform this action.', 'robotstxt-manager' ) );
        }
    }


    /**
     * Frontend Facing
     */
    final public static function frontend() {
        if( ! is_admin() & ! is_network_admin() ) {
            // Display Robots.txt File
            $RobotstxtManager_Public = new RobotstxtManager_Public();

            // Detect Robots.txt File & Set Display Action
            $RobotstxtManager_Public->initRobotstxt();
        }
    }
}

// Activate Plugin
register_activation_hook( __FILE__, array( 'robotstxt_manager', 'activate' ) );

// Inject Links Into Plugin Admins
add_filter( 'plugin_row_meta', array( 'robotstxt_manager', 'links' ), 10, 2 );

// Init Frontend
add_action( 'plugins_loaded', array( 'robotstxt_manager', 'frontend' ), 0 );

// Init Backend
add_action( 'init', array( 'robotstxt_manager', 'backend' ), 0 );
