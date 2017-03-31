<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Disable or Delete Network/Website Robots.txt File Settings
 * @location classes/class-process.php
 * @call RobotstxtManager_Disable::instance();
 * 
 * @method init()           Manage Disable Post Inputs
 * @method disableWebsite() Disable Robots.txt File On A Unique Website
 * @method disableDefault() Disable Network Robots.txt File On A Unique Website
 * @method enableDefault()  Enable Network Robots.txt File On A Unique Website
 * @method instance()       Create Instance
 */
if ( ! class_exists( 'RobotstxtManager_Disable' ) )
{
    class RobotstxtManager_Disable extends RobotstxtManager_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Manage Disable Post Inputs
         */
        final public function init()
        {
            // Delete All Settings
            if ( filter_input( INPUT_POST, 'disable' ) == 'delete' ) {
                $this->deleteWebsite();
            }

            // Disable Robots.txt File
            if ( filter_input( INPUT_POST, 'disable' ) == 'website' ) {
                $this->disableWebsite();
            }

            // Error: Display Message
            if ( ! filter_input( INPUT_POST, 'disable' ) ) {
                parent::message( 'disablefailed', 'error' );
            }
        }


        /**
         * @about Delete All Settings
         */
        final private function deleteWebsite()
        {
            // Delete Options
            delete_option( $this->option_name . 'robotstxt' );
            delete_option( $this->option_name . 'status' );
            delete_option( $this->option_name . 'cleaner_old_data' );
            delete_option( $this->option_name . 'cleaner_physical' );
            delete_option( $this->option_name . 'cleaner_rewrite' );

            // Display Message
            parent::message( 'deletewebsite', 'updated' );
        }


        /**
         * @about Disable Robots.txt File
         */
        final private function disableWebsite()
        {
            // Clear Status Option
            delete_option( $this->option_name . 'status' );

            // Display Message
            parent::message( 'disablewebsite', 'updated' );
        }


        /**
         * @about Create Instance
         */
        public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}
