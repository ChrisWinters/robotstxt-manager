<?php
/**
 * Plugin Name: Robots.txt Manager
 * Plugin URI: http://technerdia.com
 * Description: A Simple Robots.txt Manager For Wordpress.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo, plugin, network, wpmu, multisite, technerdia, tribalnerd
 * Version: 0.1.0
 * License: GNU GPLv3
 * Copyright (c) 2017 Chris Winters
 * Author: tribalNerd, Chris Winters
 * Author URI: http://techNerdia.com/
 * Text Domain: robotstxt-manager
 */

// Wordpress check
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Define Constants
 */
if( function_exists( 'RobotstxtManagerConstants' ) )
{
    RobotstxtManagerConstants( Array(
        'ROBOTSTXT_MANAGER_BASE_URL'        => get_bloginfo( 'url' ),
        'ROBOTSTXT_MANAGER_VERSION'         => '0.1.0',
        'ROBOTSTXT_MANAGER_WP_MIN_VERSION'  => '3.8',

        'ROBOTSTXT_MANAGER_PLUGIN_FILE'     => __FILE__,
        'ROBOTSTXT_MANAGER_PLUGIN_DIR'      => dirname( __FILE__ ),
        'ROBOTSTXT_MANAGER_PLUGIN_BASE'     => plugin_basename( __FILE__ ),

        'ROBOTSTXT_MANAGER_MENU_NAME'       => __( 'Robots.txt Manager', 'robotstxt-manager' ),
        'ROBOTSTXT_MANAGER_PAGE_NAME'       => __( 'Robots.txt Manager', 'robotstxt-manager' ),
        'ROBOTSTXT_MANAGER_PAGE_ABOUT'      => __( 'A Simple Robots.txt Manager Plugin For Wordpress.', 'robotstxt-manager' ),
        'ROBOTSTXT_MANAGER_PLUGIN_NAME'     => 'robotstxt-manager',
        'ROBOTSTXT_MANAGER_OPTION_NAME'     => 'robotstxt_manager_',

        'ROBOTSTXT_MANAGER_CLASSES'         => dirname( __FILE__ ) .'/classes',
        'ROBOTSTXT_MANAGER_TEMPLATES'       => dirname( __FILE__ ) .'/templates'
    ) );
}


/**
 * @about Loop Through Constants
 */
function RobotstxtManagerConstants( $constants_array )
{
    foreach( $constants_array as $name => $value ) {
        define( $name, $value, true );
    }
}


/**
 * @about Register Classes & Include
 */
spl_autoload_register( function ( $class )
{
    if( strpos( $class, 'RobotstxtManager_' ) !== false ) {
        $class_name = str_replace( 'RobotstxtManager_', "", $class );

        // If the Class Exists, Include the Class
        if( file_exists( ROBOTSTXT_MANAGER_CLASSES .'/class-'. strtolower( $class_name ) .'.php' ) ) {
            include_once( ROBOTSTXT_MANAGER_CLASSES .'/class-'. strtolower( $class_name ) .'.php' );
        }
    }
} );


/**
 * @about Run Plugin
 */
if( ! class_exists( 'robotstxt_manager' ) )
{
    class robotstxt_manager
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Initiate Plugin
         */
        final public function init()
        {
            // Activate Plugin
            register_activation_hook( __FILE__, array( $this, 'activate' ) );

            // Inject Plugin Links
            add_filter( 'plugin_row_meta', array( $this, 'links' ), 10, 2 );

            // Display Robots.txt File
            add_action( 'init', array( $this, 'robotstxt' ), 0 );

            // Load Admin Area
            RobotstxtManager_AdminArea::instance();

            // Update Settings
            RobotstxtManager_Process::instance();
        }


        /**
         * @about Activate Plugin
         */
        final public static function activate()
        {
            // Wordpress Version Check
            global $wp_version;

            // Version Check
            if( version_compare( $wp_version, ROBOTSTXT_MANAGER_WP_MIN_VERSION, "<" ) ) {
                wp_die( __( '<b>Activation Failed</b>: The ' . ROBOTSTXT_MANAGER_PAGE_NAME . ' plugin requires WordPress ' . ROBOTSTXT_MANAGER_WP_MIN_VERSION . ' or higher. Please Upgrade Wordpress, then try activating this plugin again.', 'robotstxt-manager' ) );
            }
        }


        /**
         * @about Inject Links Into Plugin Admin
         * @param array $links Default links for this plugin
         * @param string $file The name of the plugin being displayed
         * @return array $links The links to inject
         */
        final public function links( $links, $file )
        {
            // Get Current URL
            $request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL );

            // Links To Inject
            if ( $file == ROBOTSTXT_MANAGER_PLUGIN_BASE && strpos( $request_uri, "plugins.php" ) !== false ) {
                $links[] = '<a href="options-general.php?page=' . ROBOTSTXT_MANAGER_PLUGIN_NAME . '">'. __( 'Website Settings', 'robotstxt-manager' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/rtm/#faq" target="_blank">'. __( 'F.A.Q.', 'robotstxt-manager' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/help/" target="_blank">'. __( 'Support', 'robotstxt-manager' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/feedback/" target="_blank">'. __( 'Feedback', 'robotstxt-manager' ) .'</a>';
            }

            return $links;
        }


        /**
         * @about Display Robots.txt File
         */
        final public function robotstxt() {
            if( ! is_admin() && ! is_network_admin() ) {
                new RobotstxtManager_Robotstxt();
            }
        }


        /**
        * @about Create Instance
        */
        final public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}

add_action( 'after_setup_theme', array( 'robotstxt_manager', 'instance' ), 0 );
