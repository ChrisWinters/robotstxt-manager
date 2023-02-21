<?php
/**
 * Public admin area function.
 */

namespace RobotstxtManager\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Return to plugin admin area with status message flag.
 */
function postRedirect(
    string $status = 'success',
    string $tab = 'settings'
): void {
    \wp_redirect(
        \admin_url(
            'options-general.php?page=robotstxt-manager&tab='.$tab.'&status='.$status
        )
    );

    exit;
}
