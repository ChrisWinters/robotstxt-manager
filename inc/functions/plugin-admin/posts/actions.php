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

    // Default to update failed.
    $status = 'error';

    // Filtered but not sanitized post object.
    $postObject = \RobotstxtManager\PluginAdmin\postObject();

    // Get tab for redirect from hidden input.
    $tab = (true !== empty($postObject['tab'])) ? $postObject['tab'] : 'settings';

    // Updated saved robots.txt file.
    if ('robotstxt' === $postObject['action']) {
        $status = \RobotstxtManager\PluginAdmin\Posts\robotstxt($postObject['robotstxt']);
    }

    // Use preset and update saved robots.txt file.
    if ('preset' === $postObject['action'] && true !== empty($postObject['preset'])) {
        $status = \RobotstxtManager\PluginAdmin\Posts\preset($postObject['preset']);
    }

    // Delete all plugin settings.
    if ('delete' === $postObject['action'] && 'delete' === $postObject['confirm']) {
        $status = \RobotstxtManager\PluginAdmin\Posts\delete();
    }

    // Redirect user back to plugin admin area.
    \RobotstxtManager\PluginAdmin\postRedirect(
        $status,
        $tab
    );
}
