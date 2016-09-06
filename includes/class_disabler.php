<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Disable Plugin / Delete Plugin Settings
 */
if ( ! class_exists( 'RobotstxtManager_Disabler' ) )
{
    class RobotstxtManager_Disabler
    {
        /**
         * Display Messages To User
         * 
         * @return void
         */
        final public function throwMessage( $slug, $notice_type = false ) {
            // Set Message Type, Default Error
            $type = ( $notice_type == "updated" ) ? "updated" : "error";

            // Clear Message
            $message = '';

            // Switch Between Tabs
            switch ( $slug ) {
                case 'websitedisabled':
                    $message = __( '<u>Website Disabled</u>: The Robots.txt Manager Plugin is no longer managing the robots.txt file on this website. Click the "update website" button to reenable the website.' );
                break;
                case 'settingsdeleted':
                    $message = __( '<u>Settings Deleted</u>: All Robots.txt Manager Plugin settings have been removed. To re-enable: Save a preset robots.txt file or create your own robots.txt file, then click the "update website" button.' );
                break;
            }

            // Throw Message
            if ( ! empty( $message ) ) {
                add_settings_error( $slug, $slug, $message, $type );
            }
        }


        /**
         * Detect Disable Post
         * Disable Plugin On Single Website
         * 
         * @return void
         */
        final public function disableWebsite()
        {
            // If Status Change
            if ( filter_input( INPUT_POST, 'disable' ) == "website" ) {
                // Form Security Check
                do_action( 'rtm_validate_action' );

                // Clear Option
                delete_option( "robotstxt_manager_status" );

                // Display Message
                $this->throwMessage( 'websitedisabled', 'updated' );
            }
        }


        /**
         * Delete All Plugin Data
         * 
         * @return void
         */
        final public function deleteWebsite()
        {
            // If Status Change
            if ( filter_input( INPUT_POST, 'disable' ) == "all" ) {
                // Form Security Check
                do_action( 'rtm_validate_action' );

                // Delete Settings
                delete_option( 'robotstxt_manager_robotstxt' );
                delete_option( 'robotstxt_manager_preset' );
                delete_option( 'robotstxt_manager_status' );
                delete_option( 'robotstxt_manager_settings' );

                // Display Message
                $this->throwMessage( 'settingsdeleted', 'updated' );
            }
        }
    }
}
