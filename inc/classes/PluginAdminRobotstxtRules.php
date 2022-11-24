<?php
/**
 * Manager Class.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Manual Rule Detection & Suggestions.
 */
final class PluginAdminRobotstxtRules
{
    /**
     * Get the Upload Path Rule.
     */
    public function getUploadPath(): string
    {
        // Get Upload Dir For This Website.
        $uploadDir = \wp_upload_dir(null, false, true);

        if (true === empty($uploadDir['basedir'])) {
            return \esc_html__('Upload Path Not Set', 'robotstxt-manager');
        }

        // Split The Path.
        $contents = explode('uploads', $uploadDir['basedir']);

        // Return The Path.
        return 'Allow: /wp-content/uploads'.end($contents).'/';
    }

    /**
     * Get Theme Path Rule.
     */
    public function getThemePath(): string
    {
        // Build Path For Theme.
        $pathToThemes = \get_stylesheet_directory();
        $themePath = 'Allow: '.strstr($pathToThemes, '/wp-content/themes').'/';

        return $themePath;
    }

    /**
     * Get Website Sitemap URL Rule.
     */
    public function getSitemapUrl(): string
    {
        // Get Site URL.
        $sitemapUrlBase = \get_option('siteurl');

        // Base XML File Locations To check.
        $rootXmlFileLocation = get_headers($sitemapUrlBase.'/sitemap.xml');
        $altXmlFileLocation = get_headers($sitemapUrlBase.'/sitemaps/sitemap.xml');

        // Check if xml sitemap exists.
        if (true === isset($rootXmlFileLocation[0]) && 'HTTP/1.1 200 OK' === $rootXmlFileLocation[0]) {
            // http://domain.com/sitemap.xml.
            $url = $sitemapUrlBase.'/sitemap.xml';
        } elseif (true === isset($altXmlFileLocation[0]) && 'HTTP/1.1 200 OK' === $altXmlFileLocation[0]) {
            // http://domain.com/sitemaps/sitemap.xml.
            $url = $sitemapUrlBase.'/sitemaps/sitemap.xml';
        } else {
            $url = '';
        }

        // Return the url or empty if no sitemap.
        return (!empty($url)) ? 'Sitemap: '.$url : '';
    }
}
