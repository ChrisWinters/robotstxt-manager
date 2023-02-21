<?php
/**
 * Public admin area function.
 */

namespace RobotstxtManager\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get a variable from a query string and sanitizes it for use.
 *
 * @param string $get the variable to get from the query string
 */
function queryString(string $get): string
{
    $string = filter_input(
        INPUT_GET,
        $get,
        FILTER_UNSAFE_RAW,
        FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK
    );

    if (true !== isset($string)) {
        return '';
    }

    return preg_replace('/\s/', '', strtolower($string));
}
