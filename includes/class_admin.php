<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Admin Area Display & Functionality
 */
if ( ! class_exists( 'RobotstxtManager_Admin' ) )
{
    class RobotstxtManager_Admin extends RobotstxtManager_Helper
    {
        // Website URL: get_bloginfo( 'url' )
        private $base_url;

        // The plugin_root_name
        private $plugin_name;
        
        // Plugin filename.php
        private $plugin_file;
        
        // Current Plugin Version
        private $plugin_version;
        
        // Plugin Menu name
        private $menu_name;
        
        // Path To Plugin Templates
        private $templates;

        // Plugin Extension
        public $rtm;

        // Disable Plugin Features
        private $disabler;


        /**
         * Set Class Vars
         */
        function __construct( array $args = null )
        {
            // Require Array
            if( ! is_array( $args ) ) { return; }

            // Set Vars
            $this->base_url         = $args['base_url'];
            $this->plugin_name      = $args['plugin_name'];
            $this->plugin_file      = $args['plugin_file'];
            $this->plugin_version   = $args['plugin_version'];
            $this->menu_name        = $args['menu_name'];
            $this->templates        = $args['templates'];
        }


        /**
         * Init Admin Functions & Filters
         * 
         * @return void
         */
        final public function initAdmin()
        {
            // Website Menu Link
            add_action( 'admin_menu', array( &$this, 'displayMenu' ) );

            // Update Website
            add_filter( 'rtm_update_website', array( &$this, 'updateWebsite') );

            // Update A Websites Robots.txt With Preset Robots.txt File
            add_filter( 'rtm_preset_website', array( &$this, 'presetWebsite') );

            // Extended Class: Get Website Robots.txt File
            add_filter( 'rtm_website_robotstxt', array( &$this, 'getRobotstxt') );

            // Extended Class: Current Plugin Status
            add_filter( 'rtm_plugin_status', array( &$this, 'getPluginStatus') );

            // Extended Class: Website Uplaod Path
            add_filter( 'rtm_upload_path', array( &$this, 'getUploadPath') );

            // Extended Class: Active Theme Path
            add_filter( 'rtm_theme_path', array( &$this, 'getThemePath') );

            // Extended Class: Website Sitemap URL
            add_filter( 'rtm_sitemap_url', array( &$this, 'getSitemapUrl') );

            // Plugin Extension
            if ( defined( 'RTM_Api' ) ) { $this->rtm = new RTM_Extension(); }

            // Only If Page Is Plugin Admin Area
            if ( filter_input( INPUT_GET, 'page', FILTER_UNSAFE_RAW ) == $this->plugin_name ) {
                // Admin Area Protection
                add_action( 'admin_init', array( &$this, 'protectAdmin' ) );

                // Disable / Delete Features
                add_action( 'admin_init', array( &$this, 'initDisabler' ) );

                // Add CSS
                add_action( 'admin_enqueue_scripts', array( &$this, 'loadScripts' ) );

                // Set Post Action Redirect
                if ( filter_input( INPUT_POST, 'robotstxt_manager' ) ) {
                    add_action( 'wp_loaded', array( &$this, 'pluginRedirect' ) );
                }
            }
        }


        /**
         * Init Disabler Class & Filters
         * 
         * @return void
         */
        final public function initDisabler()
        {
            // Disable Plugin / Delete Plugin Settings
            $this->disabler = new RobotstxtManager_Disabler();

            // Disable Website
            add_filter( 'rtm_disable_website', array( $this->disabler, 'disableWebsite') );

            // Delete Website
            add_filter( 'rtm_delete_website', array( $this->disabler, 'deleteWebsite') );
        }


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
                case 'presetupdated':
                    $message = __( '<u>Preset Option Updated</u>: The preset has been saved as the robots.txt file. Click the "update website" button to publish the robots.txt file.' );
                break;
                case 'websiteupdated':
                    $message = __( '<u>Website Settings Updated</u>: ' );
                break;
            }

            // Throw Message
            if ( ! empty( $message ) ) {
                add_settings_error( $slug, $slug, $message, $type );
            }
        }


        /**
         * Redirect To Plugin Admin
         * 
         * @return void
         */
        final public function pluginRedirect()
        {
            // Website Redirect
            if ( is_admin() ) {
                $url = $this->base_url . '/wp-admin/options-general.php?page=' . $this->plugin_name;

                // Return JS
                echo '<script type="text/javascript">';
                echo 'document.location.href="' . $url . '";';
                echo '</script>';
            }
        }


        /**
         * Display Admin Templates
         * 
         * @return html
         */
        final public function displayAdmin()
        {
            //
            // Update Plugin
            //

            // Update Website Robots.txt File
            apply_filters( 'rtm_update_website', false );

            // Save Preset For Robots.txt File
            apply_filters( 'rtm_preset_website', false );

            // Disable / Delete Actions
            do_action( 'rtm_disable_website' );
            do_action( 'rtm_delete_website' );

            // Update Settings
            if ( defined( 'RTM' ) ) { apply_filters( 'rtm_settings', false ); }


            //
            // Template Variables
            //

            // Website Textarea: Get A Websites Unique Robots.txt File
            $get_website_robotstxt = apply_filters( 'rtm_website_robotstxt', false );

            // Website Input Field: Get Upload Path/Dir For This Website
            $get_upload_path = apply_filters( 'rtm_upload_path', false );

            // Website Input Field: Get Active Theme Path
            $get_theme_path = apply_filters( 'rtm_theme_path', false );

            // Website Input Field: Get Sitemap URL
            $get_sitemap_url = apply_filters( 'rtm_sitemap_url', false );

            // Admin Header
            require_once( $this->templates .'/header.php' );

            // Switch Between Tabs
            switch ( filter_input( INPUT_GET, 'tab', FILTER_UNSAFE_RAW ) ) {
                case 'home':
                default:
                    // Home Tab Template
                    require_once( $this->templates .'/home.php' );
                break;
            }

            // Admin Footer
            require_once( $this->templates .'/footer.php' );
        }


        /**
         * Display Textarea With Robots.txt File
         * 
         * @param string $robotstxt_file robots.txt file
         * @param int $textarea_cols number of columns in textarea
         * @param int $textarea_rows nubmer of rows in textarea
         * @param bool $readonly true to endable
         * @return html
         */
        final private function echoTextarea( $robotstxt_file, $textarea_cols, $textarea_rows, $readonly = false )
        {
            // Define Textarea Settings
            $cols = is_numeric( $textarea_cols ) ? $textarea_cols : '65';
            $rows = is_numeric( $textarea_rows ) ? $textarea_rows : '25';

            // If Set, Display Robots.txt File
            $file = ( ! empty( $robotstxt_file ) ) ? htmlspecialchars( $robotstxt_file ) : '';

            // Readonly Marker
            $readonly_html = $readonly === true ? ' readonly' : '';
            $readonly_name = $readonly === true ? '_readonly' : '';

            // Return Textarea
            echo '<textarea name="robotstxt_file' . $readonly_name . '" cols="' . $cols . '" rows="' . $rows . '" class="textarea"' .  $readonly_html . '>' . $file . '</textarea>';
        }


        /**
         * Display Preset Radios
         * 
         * @return html
         */
        final private function echoPresets()
        {
            // Selected Preset, If Any
            $selected_preset = get_option( 'robotstxt_manager_preset' ) ? get_option( 'robotstxt_manager_preset' ) : false;

            // Input Radio Data
            $inputs = array(
                'default'       => __( 'Default Robots.txt File: The plugins default installed robots.txt file.', 'robotstxt-manager' ),
                'default-alt'   => __( 'Alternative Robots.txt File: Simular to the plugins default robots.txt file, with more disallows.', 'robotstxt-manager' ),
                'wordpress'     => __( 'Wordpress Limited Robots.txt File: Only disallows wp-includes and wp-admin.', 'robotstxt-manager' ),
                'open'          => __( 'Open Robots.txt File: Fully open robots.txt file, no disallows.', 'robotstxt-manager' ),
                'blogger'       => __( 'A Bloggers Robots.txt File: Optimized for blog focused Wordpress websites.', 'robotstxt-manager' ),
                'google'        => __( 'Google Robots.txt File: A Google friendly robots.txt file.', 'robotstxt-manager' ),
                'block'         => __( 'Lockdown Robots.txt File: Disallow everything, prevent spiders from indexing the website.', 'robotstxt-manager' )
            );

            // Start HTML
            $html = '<h3>' . __( 'Robots.txt File Presets', 'robotstxt-manager' ) . '</h3>';

            // Create Radios
            foreach( $inputs as $input => $desc ) {
                // Preset Input
                $html .= '<p><input type="radio" name="preset" value="' . $input . '" id="' . $input . '" />';

                // Set Active Preset
                if ( $selected_preset == $input ) {
                    $html .= '<span class="showing">' . __( 'Showing!', 'robotstxt-manager' ) . '</span>';
                }

                // Label For Input
                $html .= ' <label for="' . $input . '">' . $desc . '</label></p>';
            }

            // Submit Button / Close Form
            $html .= '<p><input type="submit" name="submit" value=" update website " style="margin-top:15px;" /></p>';
            $html .= '</form>';

            // Return The HTML
            echo $html;
        }


        /**
         * Display Disable / Delete Checkboxes
         * 
         * @return string
         */
        final private function echoRemoves()
        {
            // Get The Plugins Status Based On The Admin Area
            $status = $this->getPluginStatus();

            // Website Disable
            if ( $status == true ) {
                echo '<p class="textright"><label>' . __( 'Disable the saved robots.txt file on this website, restoring the default Wordpress robots.txt file.', 'robotstxt-manager' ) . '</label> <input type="checkbox" name="disable" value="website" /></p>';
            }

            // Website Delete
            echo '<p class="textright"><label>' . __( 'WARNING: Delete all settings related to the Robots.txt Manager Plugin.', 'robotstxt-manager' ) . '</label> <input type="checkbox" name="disable" value="all" /></p>';
            echo '<p class="textright"><input type="submit" name="submit" value=" submit " style="margin-top:15px;" onclick="return confirm(\'' . __( "Are You Sure You Want To Submit This?", "multisite-robotstxt-manager" ) . '\');" /></p>';


            // Submit Button / Close Form
            echo '</form>';
        }


        /**
         * Extend Setting Options
         * 
         * @return html
         */
        final private function echoSettings()
        {
            if ( defined( 'RTM_Api' ) && is_plugin_active( RTM_PRO ) ) {
                return $this->rtm->extendSettings();
            }
        }


        /**
         * Display Plugin Status Messages
         * 
         * @return html
         */
        final private function statusMessages()
        {
            // Get The Plugins Status Based On The Admin Area
            $status = $this->getPluginStatus();

            // Website : Plugin Active
            if ( $status ) {
                $html = '<p><span class="active">' . __( 'Robots.txt Manager is Active', 'robotstxt-manager' ) . '</span>: ' . sprintf( __( '<a href="%1$s/robots.txt" target="_blank">Click here</a> to view this websites customized robots.txt file.', 'robotstxt-manager' ), $this->base_url ) . '</p>';
            }

            // Website : Plugin Inactive
            if ( ! $status ) {
                $html = '<p><span class="inactive">' . __( 'Robots.txt Manager is Disabled', 'robotstxt-manager' ) . '</span>: ' . sprintf( __( '<a href="%1$s/robots.txt" target="_blank">Click here</a> to view this websites default Wordpress robots.txt file.', 'robotstxt-manager' ), $this->base_url ) . '</p>';
            }

            // Return HTML
            return $html = isset( $html ) ? $html : '';
        }


        /**
         * Saves A Preset As The Websites Robots.txt File
         * 
         * @return void
         */
        final public function presetWebsite()
        {
            if ( filter_input( INPUT_POST, 'robotstxt_manager' ) == "presets" ) {
                // Form Security Check
                do_action( 'rtm_validate_action' );

                // Define Preset Var
                $preset = filter_input( INPUT_POST, 'preset', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

                // Clear Settings
                delete_option( 'robotstxt_manager_robotstxt' );
                delete_option( "robotstxt_manager_preset" );
                delete_option( "robotstxt_manager_status" );

                // Enable Plugin
                add_option( "robotstxt_manager_status", '1', '', 'no' );

                // Get Preset Robots.txt Files Class
                $preset_robotstxt_file = new RobotstxtManager_Presets();

                // Default Robots.txt Preset
                if ( $preset == "default" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->defaultRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'default', '', 'no' );
                }

                // Default Alt Robots.txt Preset
                if ( $preset == "default-alt" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->defaultAltRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'default-alt', '', 'no' );
                }

                // Wordpress Limited Robots.txt Preset
                if ( $preset == "wordpress" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->wordpressRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'wordpress', '', 'no' );
                }

                // Open Robots.txt Preset
                if ( $preset == "open" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->openRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'open', '', 'no' );
                }

                // Blogger Style Robots.txt Preset
                if ( $preset == "blogger" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->bloggerRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'blogger', '', 'no' );
                }

                // Blocked Robots.txt Preset
                if ( $preset == "block" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->blockedRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'block', '', 'no' );
                }

                // Google Robots.txt Preset
                if ( $preset == "google" ) {
                    // Update Robots.txt File
                    add_option( 'robotstxt_manager_robotstxt', $preset_robotstxt_file->googleRobotstxt(), '', 'no' );

                    // Define Preset Being Used
                    add_option( 'robotstxt_manager_preset', 'google', '', 'no' );
                }

                // Display Message
                $this->throwMessage( 'presetupdated', 'updated' );
            }
        }


        /**
         * Update a Websites Robots.txt File
         * 
         * @param int $blog_id current websites id
         * @return void
         */
        final public function updateWebsite()
        {
            // Post: Update Website Robots.txt File
            if ( filter_input( INPUT_POST, 'robotstxt_manager' ) == "website" ) {
                // Form Security Check
                do_action( 'rtm_validate_action' );

                // Filter Robots.txt File
                $robotstxt_file = filter_input( INPUT_POST, 'robotstxt_file', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

                // Clear Saved Options
                delete_option( 'robotstxt_manager_append' );
                delete_option( 'robotstxt_manager_robotstxt' );
                delete_option( 'robotstxt_manager_status' );

                // Enable Plugin For Website
                add_option( 'robotstxt_manager_status', '1', '', 'no' );

                // Update Robots.txt File
                add_option( 'robotstxt_manager_robotstxt', $robotstxt_file, '', 'no' );

                // Display Message
                $this->throwMessage( 'websiteupdated', 'updated' );
            }
        }


        /**
         * Protect Admin Area From Lower Users
         * 
         * @return void
         */
	final public function protectAdmin()
        {
            // Nobody Can Access
            $user_can_access = false;

            // Authorized Users Can Access
            if ( current_user_can( 'edit_posts' ) ) {
                $user_can_access = true;
            }

            // Redirect Invalid Users
            if ( ! $user_can_access ) {
                wp_safe_redirect( admin_url( 'index.php' ) );
                exit;
            }
	}


        /**
         * Include CSS
         * 
         * @return void
         */
        function loadScripts()
        {
            // Register the CSS File
            wp_register_style(
                $this->plugin_name . '-default',
                plugins_url( '/templates/style.css', $this->plugin_file ),
                '',
                $this->plugin_version,
                'all'
            );

            // Add CSS To Header
            wp_enqueue_style( $this->plugin_name . '-default' );
        }


        /**
         * Valid Users and Settings Menu
         * 
         * @return void
         */
        final public function displayMenu()
        {
            // Logged in users only
            if( ! is_user_logged_in() ) { return; }

            // Website Admin Menu
            if( is_admin() ) {
                add_options_page(
                        $this->menu_name,
                        $this->menu_name,
                        'manage_options',
                        $this->plugin_name,
                        array( &$this, 'displayAdmin' )
                );
            }
        }
    }
}
