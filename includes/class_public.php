<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Forward Facing: Full Time Classes & Functions
 */
if ( ! class_exists( 'RobotstxtManager_Public' ) )
{
    class RobotstxtManager_Public
    {
        /**
         * Detect Robots.txt File
         * Set Action To Display Robots.txt File
         */
        final public function initRobotstxt()
        {
            // Check if robots.txt file is being called
            if ( strpos( filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL ), "robots.txt" ) !== false ){
                // Initiate Robots.txt File
                add_action( 'init', array( &$this, 'displayRobotstxt' ) );
            }
        }


        /**
         * Display Robots.txt File
         * 
         * @return string
         */
        final public function displayRobotstxt()
        {
            // If Active, Display Robots.txt File
            if( get_option( 'robotstxt_manager_status' ) && get_option( "robotstxt_manager_robotstxt" ) ) {
                // Return Proper Headers
                header( 'Status: 200 OK', true, 200 );
                header( 'Content-type: text/plain; charset=' . get_bloginfo( 'charset' ) );

                // Wordpress Action
                do_action( 'do_robotstxt' );

                // Return Robots.txt File
                echo get_option( "robotstxt_manager_robotstxt" );

                // Stop WP
                exit;
            }
        }
    }
}
