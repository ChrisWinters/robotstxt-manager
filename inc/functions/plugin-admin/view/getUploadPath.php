<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Build upload path rule.
 */
function getUploadPath(): string
{
    // Get Upload Dir For This Website.
    $upload_dir = \wp_upload_dir(null, false, true);

    if (true === empty($upload_dir['basedir'])) {
        return \esc_html__('Upload directory not defined.', 'robotstxt-manager');
    }

    // Split the path.
    $contents = explode('uploads', $upload_dir['basedir']);

    return 'Allow: /wp-content/uploads'.end($contents).'/';
}
