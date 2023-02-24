<?php
/**
 * Public admin area function.
 */

namespace RobotstxtManager\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Builds filtered post object array.
 */
function postObject(): array
{
    $postObject = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    if (
        true === empty($postObject['_wp_http_referer']) ||
        true === empty($postObject['robotstxt_manager_nonce'])
    ) {
        return [];
    }

    unset($postObject['_wp_http_referer']);
    unset($postObject['robotstxt_manager_nonce']);

    if (true === empty($postObject)) {
        return [];
    }

    return $postObject;
}
