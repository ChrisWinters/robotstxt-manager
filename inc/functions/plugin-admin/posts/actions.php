<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe update plugin settings, then return user back to plugin admin area.
 */
function actions(): void
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Filtered but not sanitized post object.
    $postObject = \RobotstxtManager\PluginAdmin\postObject();

    // Get tab for redirect from hidden input.
    $tab = (true !== empty($postObject['tab'])) ? $postObject['tab'] : 'settings';

    // Redirect user back to plugin admin area.
    \RobotstxtManager\PluginAdmin\postRedirect(
        'success',
        $tab
    );
}
