<?php
/**
 * WordPress Class.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Activation Rules.
 */
final class Plugin_Activate
{
    /**
     * Init Plugin Activation.
     */
    public static function init()
    {
        $wp_version = \get_bloginfo('version');

        if (true === version_compare($wp_version, 3.8, '<')) {
            \wp_die(\esc_html__('WordPress 3.8 is required. Please upgrade WordPress and try again.', 'robotstxt-manager'));
        }

        // Maybe Save Robots.txt As Plugin Robots.txt.
        self::set_robotstxt();
    }

    /**
     * Maybe Set Plugin Robots.txt.
     */
    public static function set_robotstxt()
    {
        $plugin_option = \get_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);

        // Set Plugin Robots.txt From Website Robots.txt.
        if (true === empty($plugin_option['robotstxt']) && true !== empty(self::get_website_robotstxt())) {
            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                [
                    'robotstxt' => self::get_website_robotstxt(),
                ]
            );
        }

        // Set Plugin Robots.txt Based On Default WordPress robots.txt - Unable To Read Robots.txt.
        if (true === empty($plugin_option['robotstxt']) && true === empty(self::get_website_robotstxt())) {
            $preset_robotstxt = "User-agent: *\n";
            $preset_robotstxt .= "Disallow: /wp-admin/\n";
            $preset_robotstxt .= "Allow: /wp-admin/admin-ajax.php\n";

            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                [
                    'robotstxt' => $preset_robotstxt,
                ]
            );
        }
    }

    /**
     * Get Local Website Robots.txt File Body.
     */
    public static function get_website_robotstxt()
    {
        $robotstxt = '';

        /*
         * Retrieve the raw response from the HTTP request using the GET method.
         *
         * https://developer.wordpress.org/reference/functions/wp_remote_get/
         */
        $website_robotstxt = \wp_remote_get(\get_home_url().'/robots.txt');

        if (true !== empty($website_robotstxt['response']['code']) && '200' === $website_robotstxt['response']['code'] && true !== empty($website_robotstxt['body'])) {
            $robotstxt = $website_robotstxt['body'];
        }

        return $robotstxt;
    }
}
