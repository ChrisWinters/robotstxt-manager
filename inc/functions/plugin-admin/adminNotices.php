<?php
/**
 * Public admin area function.
 */

namespace RobotstxtManager\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display admin area notice.
 */
function adminNotices(): void
{
    $currentPage = \RobotstxtManager\PluginAdmin\queryString('page');

    if ('robotstxt-manager' !== (string) $currentPage) {
        return;
    }

    $status = \RobotstxtManager\PluginAdmin\queryString('status');

    if (true === empty($status)) {
        return;
    }

    // Get notice marker.
    $notice = \RobotstxtManager\option\get('notice');

    if (true === empty($notice)) {
        return;
    }

    $noticeType = ('error' === $status) ? 'error' : 'success';

    // Delete notice marker.
    \RobotstxtManager\option\delete('notice');

    $message = \RobotstxtManager\settings($notice.'_message');

    // Display notice.
    echo '<div class="notice notice-'.$noticeType.' is-dismissible"><p>'.$message.'</p></div>';
}
