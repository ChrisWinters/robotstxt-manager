<?php
/**
 * Manager Class.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Robots.txt.
 */
final class Robotstxt
{
    /**
     * Maybe start robots.txt display.
     */
    public function __construct()
    {
        if (true === $this->is_robotstxt_file()) {
            $this->display();
        }
    }

    /**
     * Display robots.txt file.
     */
    private function display()
    {
        $robotstxt = $this->get_robotstxt();
        $blog_public = \get_option('blog_public');

        if ('0' === $blog_public) {
            $robotstxt = "Disallow: /\n";
        }

        if (true !== empty($robotstxt)) {
            header('Status: 200 OK', true, 200);
            header('Content-Type: text/plain; charset=utf-8');

            echo \esc_html($robotstxt);
            exit;
        }
    }

    /**
     * Get robots.txt file.
     */
    private function get_robotstxt(): string
    {
        $blog_id = \get_current_blog_id();

        if ($blog_id > 0 &&
            true === function_exists('switch_to_blog')) {
            \switch_to_blog($blog_id);
        }

        $settings = \get_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);

        if ($blog_id > 0 &&
            true === function_exists('restore_current_blog')) {
            \restore_current_blog();
        }

        $robotstxt = '';

        if (true !== empty($settings['disable'])) {
            return null;
        }

        if (true !== empty($settings['robotstxt'])) {
            $robotstxt = $settings['robotstxt'];
        }

        if (true !== empty($robotstxt)) {
            $public = \get_option('blog_public');

            if ('0' === $public) {
                $robotstxt = "Disallow: /\n";
            }
        }

        if (true !== empty($user_robotstxt)) {
            $robotstxt = $user_robotstxt;
        }

        return (string) $robotstxt;
    }

    /**
     * Check if called file is robots.txt file.
     */
    private function is_robotstxt_file(): bool
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
                $request_uri = htmlspecialchars(\wp_unslash($_SERVER['REQUEST_URI']), ENT_QUOTES, 'UTF-8');
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
}
