<?php
if( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

// Wordpress Uninstall Check
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; }


/**
 * Uninstall Pluing Features
 */
if ( ! class_exists( 'RobotstxtManager_Uninstall' ) )
{
    class RobotstxtManager_Uninstall
    {
        /**
         * Run Uninstall Function
         * 
         * @return void
         */
        public function __construct() {
            // Valid Users Only
            if( ! is_user_logged_in() && ! current_user_can( 'manage_options' ) ) { wp_die( __( 'Unauthorized Access.', 'multisite-robotstxt-manager' ) ); }

            // Run Function
            $this->uninstall();																											/** run uninstall */
        }


        /**
         * Remove Features
         * 
         * @return void
         */
        final public function uninstall() {
            // Remove Options
            delete_option( "robotstxt_manager" );
            delete_option( "robotstxt_manager_preset" );
            delete_option( "robotstxt_manager_status" );

            return;
        }
    }
}

// Run Class
$RobotstxtManager_Uninstall = new RobotstxtManager_Uninstall();