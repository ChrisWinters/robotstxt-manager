<?php
/**
 * Public function.
 */

namespace RobotstxtManager\option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get setting from saved plugin option data.
 *
 * @param string $settingKey       the key name to get from the setting option array
 * @param string $appendOptionName optional string to add to the option name
 */
function setting(
    string $settingKey,
    string $appendOptionName = ''
): string|array|bool {
    $option = \RobotstxtManager\option\get($appendOptionName);

    if (true !== empty($option[$settingKey])) {
        $setting = $option[$settingKey];
    }

    return (true === isset($setting)) ? $setting : '';
}
