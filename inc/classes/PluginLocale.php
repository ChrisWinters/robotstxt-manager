<?php
/**
 * Manager Class.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Loads translation files and strings.
 */
final class PluginLocale
{
    /**
     * Get the current locale and init loading of translation files.
     */
    public function __construct()
    {
        \add_action(
            'plugins_loaded',
            [
                $this,
                'init',
            ]
        );
    }

    /**
     * Load .mo files into the text domain and load translated strings.
     */
    public function init()
    {
        // Retrieves the current locale.
        $getLocale = \apply_filters(
            'plugin_locale',
            \get_locale(),
            ROBOTSTXT_MANAGER_PLUGIN_NAME
        );

        $loadMoFile = ROBOTSTXT_MANAGER_PLUGIN_DIR.'/lang/'.$getLocale.'.mo';

        if (true === file_exists($loadMoFile)) {
            // Load a .mo file into the text domain $textdomain.
            \load_textdomain(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                $loadMoFile
            );
        }

        // Loads a plugin’s translated strings.
        \load_plugin_textdomain(
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            false,
            ROBOTSTXT_MANAGER_FILE.'/lang/'
        );
    }
}
