<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Process Plugin Updates/Changes
 * @location robotstxt-manager.php
 * @call RobotstxtManager_Process::instance();
 * 
 * @method init()       Init Admin Actions
 * @method update()     Call Update Classes
 * @method instance()   Class Instance
 */
if ( ! class_exists( 'RobotstxtManager_Process' ) )
{
    class RobotstxtManager_Process extends RobotstxtManager_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Update Settings
         */
        final public function init()
        {
            // Plugin Admin Only
            if ( filter_input( INPUT_POST, 'type' ) && parent::qString( 'page' ) == $this->plugin_name ) {
                add_action( 'admin_init', array( $this, 'process') );
            }
        }


        /**
         * @about Call Update Classes
         */
        final public function process()
        {
            // Form Security Check
            parent::validate();

            // Update Website Robots.txt File
            if ( filter_input( INPUT_POST, 'type' ) == "update" ) {
                $this->update();
            }

            // Update Network Presets
            if ( filter_input( INPUT_POST, 'type' ) == "presets" ) {
                RobotstxtManager_Presets::instance();
            }

            // Disable / Delete Settings
            if ( filter_input( INPUT_POST, 'type' ) == "status" ) {
                RobotstxtManager_Disable::instance();
            }

            // Check/Clean Old Plugin Data / Rewrite Data
            if ( filter_input( INPUT_POST, 'type' ) == "cleaner" ) {
                RobotstxtManager_Cleaner::instance();
            }
        }


        /**
         * @about Update Network Robots.txt, Status & Preset Options
         */
        final public function update()
        {
            // Get Post Data
            $robotstxt = filter_input( INPUT_POST, 'robotstxt_file', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

            // Save Network Robots.txt File
            if ( $robotstxt ) {
                // Save Robots.txt File
                update_option( $this->option_name . 'robotstxt', array( 'robotstxt' => $robotstxt ), 'yes' );

                // Change Status
                update_option( $this->option_name . 'status', true, 'yes' );

                // Display Message
                parent::message( 'websiteupdated', 'updated' );
            }

            // Error: Display Message
            if ( ! filter_input( INPUT_POST, 'robotstxt_file' ) ) {
                parent::message( 'updatefailed', 'error' );
            }
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
