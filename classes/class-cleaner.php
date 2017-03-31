<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Check & Clean Previous Robots.txt Data
 * @location classes/class-process.php
 * @call RobotstxtManager_Cleaner::instance();
 * 
 * @method init()           Call Check / Clean Methods
 * @method checkData()      Check For Old Plugin Data
 * @method cleanData()      Remove Old Plugin Data
 * @method checkPhysical()  Check For Phsyical Robots.txt File
 * @method cleanPhysical()  Remove Physical Robots.txt File
 * @method checkRewrite()   Check For Missing Rewrite Rules
 * @method AddRewrite()     Add Missing Rewrite Rule
 * @method instance()       Create Instance
 */
if ( ! class_exists( 'RobotstxtManager_Cleaner' ) )
{
    class RobotstxtManager_Cleaner extends RobotstxtManager_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Call Check / Clean Methods
         */
        final public function init()
        {
            // Check For Old Plugin Data
            if ( filter_input( INPUT_POST, 'cleaner' ) == "check-data" ) {
                $this->checkData();
            }

            // Remove Old Plugin Data
            if ( filter_input( INPUT_POST, 'cleaner' ) == "clean-data" ) {
                $this->cleanData();
            }

            // Check For Physical Robots.txt File
            if ( filter_input( INPUT_POST, 'cleaner' ) == "check-physical" ) {
                $this->checkPhysical();
            }

            // Remove Physical Robots.txt File
            if ( filter_input( INPUT_POST, 'cleaner' ) == "clean-physical" ) {
                $this->cleanPhysical();
            }

            // Check For Missing Rewrite Rules
            if ( filter_input( INPUT_POST, 'cleaner' ) == "check-rewrite" ) {
                $this->checkRewrite();
            }

            // Add Missing Rewrite Rule
            if ( filter_input( INPUT_POST, 'cleaner' ) == "add-rewrite" ) {
                $this->AddRewrite();
            }
        }


        /**
         * @about Check For Old Plugin Data
         */
        final private function checkData()
        {
            // Old Data Found
            if( get_option( 'pc_robotstxt' ) || get_option( 'kb_robotstxt' ) || get_option( 'cd_rdte_content' ) ) {
                // Set Marker
                update_option( $this->option_name . 'cleaner_old_data', true, 'no' );

                // Display Message
                parent::message( 'yesolddata', 'error' );

            // All Good
            } else {
                delete_option( $this->option_name . 'cleaner_old_data' );

                // Display Message
                parent::message( 'noolddata', 'updated' );
            }
        }


        /**
         * @about Remove Old Plugin Data
         */
        final private function cleanData()
        {
            // Remove Options
            if( get_option( 'pc_robotstxt' ) ) { delete_option( 'pc_robotstxt' ); }
            if( get_option( 'kb_robotstxt' ) ) { delete_option( 'kb_robotstxt' ); }
            if( get_option( 'cd_rdte_content' ) ) {
                delete_option( 'cd_rdte_content' );
                remove_filter( 'robots_txt', 'cd_rdte_filter_robots' );
            }

            // Remove Other Plugin Filters
            remove_filter( 'robots_txt', 'ljpl_filter_robots_txt' );
            remove_filter( 'robots_txt', 'robots_txt_filter' );

            // Run Check Again
            $this->checkData();
        }


        /**
         * @about Check For Phsyical Robots.txt File
         */
        final private function checkPhysical()
        {
            // Robots.txt File Found
            if ( file_exists ( get_home_path() . 'robots.txt' ) ) {
                // Set Marker
                update_option( $this->option_name . 'cleaner_physical', true, 'no' );

                // Display Message
                parent::message( 'yesphysical', 'error' );

            // All Good
            } else {
                delete_option( $this->option_name . 'cleaner_physical' );

                // Display Message
                parent::message( 'nophysical', 'updated' );
            }
        }


        /**
         * @about Remove Physical Robots.txt File
         */
        final private function cleanPhysical()
        {
            // Remove Robots.txt File
            if ( is_writable( get_home_path() . 'robots.txt' ) ) {
                unlink( get_home_path() . 'robots.txt' );
            }

            // Robots.txt File Found
            if ( file_exists ( get_home_path() . 'robots.txt' ) ) {
                // Remove Marker
                delete_option( $this->option_name . 'cleaner_physical' );

                // Display Message
                parent::message( 'badphysical', 'error' );

            // All Good
            } else {
                delete_option( $this->option_name . 'cleaner_physical' );

                // Display Message
                parent::message( 'nophysical', 'updated' );
            }
        }


        /**
         * @about Check For Missing Rewrite Rules
         */
        final private function checkRewrite()
        {
            // Get Rewrite Rules
            $rules = get_option( 'rewrite_rules' );

            // Flush Rules If Needed
            if( empty( $rules ) ) { flush_rewrite_rules(); }

            // Error No Rewrite Rule Found
            if( ! in_array( "index.php?robots=1", (array) $rules ) ) {
                // Set Marker
                update_option( $this->option_name . 'cleaner_rewrite', true, 'no' );

                // Display Message
                parent::message( 'norewrite', 'error' );

            // All Good
            } else {
                delete_option( $this->option_name . 'cleaner_rewrite' );

                // Display Message
                parent::message( 'yesrewrite', 'updated' );
            }
        }


        /**
         * @about Add Missing Rewrite Rule
         */
        final private function addRewrite()
        {
            // Get Rewrite Rules
            $rules = get_option( 'rewrite_rules' );

            // Add Missing Rule
            if( ! in_array( "index.php?robots=1", (array) $rules ) ) {
                // Set Proper Keys
                $rule_key = "robots\.txt$";
                $rules[ $rule_key ] = 'index.php?robots=1';

                // Update Rules
                update_option( 'rewrite_rules', $rules );

                // Flush Rules
                flush_rewrite_rules();
            }

            // Recheck Rewrite Rules
            $this->checkRewrite();
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
