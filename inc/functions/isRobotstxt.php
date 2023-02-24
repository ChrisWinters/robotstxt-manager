<?php
/**
 * Public function.
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Check if called file is the robots.txt file.
 */
function isRobotstxt(): bool
{
    if (true === filter_has_var(INPUT_SERVER, 'REQUEST_URI')) {
        $filename = filter_input(
            INPUT_SERVER,
            'REQUEST_URI',
            FILTER_UNSAFE_RAW,
            FILTER_NULL_ON_FAILURE
        );
    } else {
        if (isset($_SERVER['REQUEST_URI'])) {
            $request_uri = htmlspecialchars(
                \wp_unslash($_SERVER['REQUEST_URI']), ENT_QUOTES, 'UTF-8'
            );

            $filename = filter_var(
                $request_uri,
                FILTER_UNSAFE_RAW,
                FILTER_NULL_ON_FAILURE
            );
        } else {
            $filename = null;
        }
    }

    if ('/robots.txt' === $filename || 'robots.txt' === $filename) {
        return true;
    }

    return false;
}
