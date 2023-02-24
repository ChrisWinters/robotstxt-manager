<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update robots.txt file with preset robots.txt file data.
 *
 * @param array $postObject filtered post object data from the cleaner tab
 *
 * @return string The status of the task: error|clean|cleaned|previous|physical|rewrite
 */
function cleaner(array $postObject = []): string
{
    // Required security check.
    \RobotstxtManager\PluginAdmin\securityCheck();

    // Default to update failed.
    $status = 'error';

    // Remove old robots.txt file plugin data left over by other plugins.
    if (true !== empty($postObject['clean-previous'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\cleanPrevious();
    }

    // Delete a physical robots.txt file at the root of the domain.
    if (true !== empty($postObject['clean-physical'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\cleanPhysical();
    }

    // Add missing robots.txt rewrite rule in the WordPress rewrite_rules object.
    if (true !== empty($postObject['clean-rewrite'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\cleanRewrite();
    }

    // Check for old robots.txt file plugin data left over by other plugins.
    if (true !== empty($postObject['check-previous'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\checkPrevious();
    }

    // Check for a physical robots.txt file at the root of the domain.
    if (true !== empty($postObject['check-physical'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\checkPhysical();
    }

    // Check for robots.txt rewrite rule in the WordPress rewrite_rules object.
    if (true !== empty($postObject['check-rewrite'])) {
        $status = \RobotstxtManager\PluginAdmin\cleaner\checkRewrite();
    }

    return $status;
}
