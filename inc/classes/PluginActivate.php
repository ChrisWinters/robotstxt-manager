<?php
/**
 * WordPress Class.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Activation Rules.
 */
final class PluginActivate
{
    /**
     * Init Plugin Activation.
     */
    public static function init(): void
    {
        $requiredWPVersion = 3.8;

        if (true === version_compare(\get_bloginfo('version'), $requiredWPVersion, '<')) {
            \wp_die(\esc_html__('WordPress version '.$requiredWPVersion.' is required.', 'robotstxt-manager'));
        }

        // Maybe Save Robots.txt As Plugin Robots.txt.
        self::setRobotstxt();
    }

    /**
     * Maybe Set Plugin Robots.txt.
     */
    public static function setRobotstxt(): void
    {
        $settings = \get_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);

        // Set Plugin Robots.txt From Website Robots.txt.
        if (true === empty($settings['robotstxt']) && true !== empty(self::getWebsiteRobotstxt())) {
            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                [
                    'robotstxt' => self::getWebsiteRobotstxt(),
                ]
            );
        }

        // Set Plugin Robots.txt Based On Default WordPress robots.txt - Unable To Read Robots.txt.
        if (true === empty($settings['robotstxt']) && true === empty(self::getWebsiteRobotstxt())) {
            $presetRobotstxt = "User-agent: *\n";
            $presetRobotstxt .= "Disallow: /wp-admin/\n";
            $presetRobotstxt .= "Allow: /wp-admin/admin-ajax.php\n";

            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                [
                    'robotstxt' => $presetRobotstxt,
                ]
            );
        }
    }

    /**
     * Get Local Website Robots.txt File Body.
     */
    public static function getWebsiteRobotstxt(): string
    {
        $robotstxt = '';

        // Retrieve the raw response from the HTTP request using the GET method.
        $websiteRobotstxt = \wp_remote_get(\get_home_url().'/robots.txt');

        if (true !== empty($websiteRobotstxt['response']['code']) && '200' === $websiteRobotstxt['response']['code'] && true !== empty($websiteRobotstxt['body'])) {
            $robotstxt = $websiteRobotstxt['body'];
        }

        return $robotstxt;
    }
}
