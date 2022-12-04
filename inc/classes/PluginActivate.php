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
 * Plugin setup on activation.
 */
final class PluginActivate
{
    /**
     * Required WordPress version.
     *
     * @var int
     */
    private static $requiredWPVersion = 4.9;

    /**
     * Init plugin validation and setup.
     */
    public static function init(): void
    {
        // Compare and require a version of WordPress.
        self::requiredWordPress();

        // Setup default plugin settings.
        self::setupPlugin();
    }

    /**
     * Compare and require a version of WordPress.
     */
    private static function requiredWordPress(): void
    {
        if (
            true === version_compare(
                \get_bloginfo('version'), self::$requiredWPVersion, '<'
            )
        ) {
            \wp_die(
                sprintf(
                    __('WordPress version %s is required.', 'robotstxt-manager'),
                    self::$requiredWPVersion
                )
            );
        }
    }

    /**
     * Setup default plugin settings.
     */
    private static function setupPlugin(): void
    {
        $settings = \get_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);

        // Maybe set default robots.txt file.
        if (true === empty($settings['robotstxt'])) {
            $robotstxt = "# robots.txt\n";
            $robotstxt .= "User-agent: *\n";
            $robotstxt .= "Disallow: /wp-admin/\n";
            $robotstxt .= "Allow: /wp-admin/admin-ajax.php\n";

            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                [
                    'robotstxt' => $robotstxt,
                ]
            );
        }
    }
}
