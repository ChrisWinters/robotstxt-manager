<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Admin Area Display
 * @location robotstxt-manager.php
 * @call RobotstxtManager_AdminArea::instance();
 * 
 * @method init()       Init Admin Actions
 * @method menu()       Load Admin Area Menu
 * @method display()    Display Website Admin Templates
 * @method tabs()       Load Admin Area Tabs
 * @method instance()   Class Instance
 */
if ( ! class_exists( 'RobotstxtManager_AdminArea' ) )
{
    class RobotstxtManager_AdminArea extends RobotstxtManager_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;

        // Tab Names
        private $tabs;


        /**
         * @about Init Admin Actions
         */
        final public function init()
        {
            // Website Menu Link
            add_action( 'admin_menu', array( $this, 'menu' ) );

            // Unqueue Scripts Within Plugin Admin Area
            if ( parent::qString( 'page' ) == $this->plugin_name ) {
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            }

            // Tab Names: &tab=home
            $this->tabs = array(
                'home'      => __( 'Home', 'robotstxt-manager' ),
                'cleaner'   => __( 'Cleaner', 'robotstxt-manager' ),
            );
        }


        /**
         * @about Plugin Menu
         */
        final public function menu()
        {
            add_submenu_page(
                'options-general.php',
                $this->plugin_title,
                $this->menu_name,
                'manage_options',
                $this->plugin_name,
                array( $this, 'display' )
            );
        }


        /**
         * @about Enqueue Stylesheet and jQuery
         */
        final public function enqueue()
        {
            wp_enqueue_style( $this->plugin_name, plugins_url( '/assets/style.css', $this->plugin_file ), '', date( 'YmdHis', time() ), 'all' );
        }


        /**
         * @about Display Website Admin Templates
         */
        final public function display()
        {
            // Admin Header
            require_once( $this->templates .'/header.php' );

            // Switch Between Tabs
            switch ( parent::qString( 'tab' ) ) {
                case 'home':
                default:
                    require_once( $this->templates .'/home.php' );
                break;

                case 'cleaner':
                    require_once( $this->templates .'/cleaner.php' );
                break;
            }

            // Admin Footer
            require_once( $this->templates .'/footer.php' );
        }


        /**
         * @about Admin Area Tabs
         * @return string $html Tab Display
         */
        final public function tabs()
        {
            $html = '<h2 class="nav-tab-wrapper">';

            // Set Current Tab
            $current = ( parent::qString( 'tab' ) ) ? parent::qString( 'tab' ) : key( $this->tabs );

            foreach( $this->tabs as $tab => $name ) {
                // Current Tab Class
                $class = ( $tab == $current ) ? ' nav-tab-active' : '';

                // Tab Links
                $html .= '<a href="?page='. parent::qString( 'page' ) .'&tab='. $tab .'" class="nav-tab'. $class .'">'. $name .'</a>';
            }

            $html .= '</h2><br />';

            return $html;
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
