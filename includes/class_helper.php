<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Admin Area Helper Functions
 */
if ( ! class_exists( 'RobotstxtManager_Helper' ) )
{
    class RobotstxtManager_Helper
    {
        /**
         * Get A Websites Unique Robots.txt File
         * 
         * @param int $blog_id current website id
         * @return string
         */
        final public function getRobotstxt()
        {
            return $robotstxt = get_option( 'robotstxt_manager_robotstxt' ) ? get_option( 'robotstxt_manager_robotstxt' ) : '';
        }


        /**
         * Get The Current Status Of The Plugin
         * 
         * @return bool
         */
        final public function getPluginStatus()
        {
            return $stauts = get_option( 'robotstxt_manager_status' ) ? true : false;
        }


        /**
         * Get and Retrn the Theme Path Within Allow Statement
         * 
         * @param int $blog_id current website id
         * @return html
         */
        final public function getThemePath()
        {
            // Build Path For Theme
            $path_to_themes = get_stylesheet_directory();
            $theme_path = 'Allow: ' . strstr( $path_to_themes, '/wp-content/themes' ) . '/';

            // Return The Path
            return $theme_path;
        }


        /**
         * Get and Retrn the Upload Path
         * 
         * @param int $blog_id current website id
         * @return html
         */
        final public function getUploadPath()
        {
            // Get Upload Dir For This Website
            $upload_dir = wp_upload_dir();

            // Split The Path
            $contents = explode( 'uploads', $upload_dir['basedir'] );

            // Return The Path
            $allow = 'Allow: /wp-content/uploads' . end( $contents ) . '/';
            return $upload_path = ( ! empty( $upload_dir['basedir'] ) ) ? $allow : 'Upload Path Not Set';
        }


        /**
         * Get and Retrn the Sitemap URL
         * 
         * @param int $blog_id current website id
         * @return html
         */
        final public function getSitemapUrl()
        {
            // Base XML File Locations To check
            $root_xml_file_location = get_headers( ROBOTSTXT_MANAGER_BASE_URL . '/sitemap.xml' );
            $alt_xml_file_location = get_headers( ROBOTSTXT_MANAGER_BASE_URL . '/sitemaps/sitemap.xml' );

            // Check if xml sitemap exists
            if ( $root_xml_file_location && $root_xml_file_location[0] == 'HTTP/1.1 200 OK' ) {
                // http://domain.com/sitemap.xml
                $url = ROBOTSTXT_MANAGER_BASE_URL . '/sitemap.xml';

            } elseif ( $alt_xml_file_location && $alt_xml_file_location[0] == 'HTTP/1.1 200 OK' ) {
                // http://domain.com/sitemaps/sitemap.xml
                $url = ROBOTSTXT_MANAGER_BASE_URL . '/sitemaps/sitemap.xml';
 
            } else {
                $url = '';
            }

            // Return the url or empty if no sitemap
            return $sitemap_url = ( ! empty( $url ) ) ? 'Sitemap: ' . $url : 'No Sitemap Found';
        }


        /**
         * Display Input Submit Button
         * 
         * @param string $text submit button value
         * @return html
         */
        final public function echoSubmit( $text )
        {
            // Define Button Text
            $button_text = ( ! empty( $text ) ) ? $text : 'submit';

            return '<input type="submit" name="submit" value=" ' . $button_text . ' " />';
        }


        /**
         * Display Form
         * 
         * @param string $location input post value
         * @param bool $close form close tag
         * @return html
         */
        final public function echoForm( $location, $close = false )
        {
            if ( $close === true ) {
                echo '</form>';
            } else {
                echo '<form enctype="multipart/form-data" method="post" action="">';
                echo '<input type="hidden" name="robotstxt_manager" value="' . $location . '" />';
                wp_nonce_field( ROBOTSTXT_MANAGER_PLUGIN_NAME . '_action', ROBOTSTXT_MANAGER_PLUGIN_NAME . '_nonce' );
            }
        }
    }
}
