<?php
/**
 * Private admin area function.
 */

namespace RobotstxtManager\option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Delete a WordPress option.
 *
 * @param string $appendOptionName optional string to add to the option name
 */
function delete(
    string $appendOptionName = ''
): void {
    $appendOptionName = (true !== empty($appendOptionName)) ? '-'.$appendOptionName : '';

    \delete_option('robotstxt-manager'.$appendOptionName);
}
