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

use RobotstxtManager\Trait_Option_Manager as TraitOptionManager;

/**
 * Robots.txt Cleaner Tool.
 */
final class Plugin_Admin_Cleaner
{
    use TraitOptionManager;

    /**
     * Post Object Array.
     *
     * @var array
     */
    public $post_object = [];

    /**
     * Notices Class Object.
     *
     * @var object
     */
    public $notices = [];

    /**
     * Setup Class.
     *
     * @param array  $post_object Post Object Array.
     * @param object $notices     Notices Class Object.
     */
    public function __construct($post_object = [], $notices = [])
    {
        $this->post_object = $post_object;
        $this->notices = $notices;
    }

    /**
     * Cleaner Actions.
     */
    public function cleaner_action()
    {
        // Check for old plugin data.
        if (true !== empty($this->post_object['check-data'])) {
            $this->checkdata();
        }

        // Clean plugin data.
        if (true !== empty($this->post_object['clean-data'])) {
            $this->cleandata();
        }

        // Check for real robots.txt file.
        if (true !== empty($this->post_object['check-physical'])) {
            $this->checkphysical();
        }

        // Remove real robots.txt file.
        if (true !== empty($this->post_object['clean-physical'])) {
            $this->cleanphysical();
        }

        // Check for robots.txt file rewrite rules.
        if (true !== empty($this->post_object['check-rewrite'])) {
            $this->checkrewrite();
        }

        // Add missing robots.txt file rewrite rules.
        if (true !== empty($this->post_object['add-rewrite'])) {
            $this->addrewrite();
        }
    }

    /**
     * Check For Old Plugin Data.
     */
    public function checkdata()
    {
        $message = false;

        // Old Data Found, Set Marker.
        if (\get_option('pc_robotstxt') || \get_option('kb_robotstxt') || \get_option('cd_rdte_content')) {
            $this->update_option(['checkdata' => 'error']);
            $message = true;
        } else {
            $this->del_setting('checkdata');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkdata_notice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkdata_done',
                ]
            );
        }
    }

    /**
     * Remove Old Plugin Data.
     */
    public function cleandata()
    {
        // Remove Options.
        \delete_option('pc_robotstxt');
        \delete_option('kb_robotstxt');
        \delete_option('cd_rdte_content');

        // Remove Filters.
        \remove_filter('robots_txt', 'cd_rdte_filter_robots');
        \remove_filter('robots_txt', 'ljpl_filter_robots_txt');
        \remove_filter('robots_txt', 'robots_txt_filter');

        // Run Check Again.
        $this->checkData();
    }

    /**
     * Check For Phsyical Robots.txt File.
     */
    public function checkphysical()
    {
        $message = false;

        // Robots.txt File Found.
        if (true === file_exists(\get_home_path().'robots.txt')) {
            $this->update_option(['checkphysical' => 'error']);
            $message = true;
        } else {
            $this->del_setting('checkphysical');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkphysical_notice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkphysical_done',
                ]
            );
        }
    }

    /**
     * Remove Physical Robots.txt File.
     */
    public function cleanphysical()
    {
        // Remove Robots.txt File.
        if (true === file_exists(\get_home_path().'robots.txt') && true === is_writable(\get_home_path().'robots.txt')) {
            unlink(realpath(\get_home_path().'robots.txt'));
        }

        // Robots.txt File Found.
        if (true === file_exists(\get_home_path().'robots.txt')) {
            $this->del_setting('checkphysical');

            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkphysical_error',
                ]
            );
        } else {
            $this->checkphysical();
        }
    }

    /**
     * Check For Missing Rewrite Rules.
     */
    public function checkrewrite()
    {
        $message = false;

        // Get Rewrite Rules.
        $rules = \get_option('rewrite_rules');

        // Flush Rules If Needed.
        if (empty($rules)) {
            \flush_rewrite_rules();
        }

        // Error No Rewrite Rule Found, Set Marker.
        if (true !== in_array('index.php?robots=1', (array) $rules, true)) {
            $this->update_option(['checkrewrite' => 'error']);
            $message = true;
        } else {
            $this->del_setting('checkrewrite');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkrewrite_notice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkrewrite_done',
                ]
            );
        }
    }

    /**
     * Add Missing Rewrite Rule.
     */
    public function addrewrite()
    {
        // Get Rewrite Rules.
        $rules = \get_option('rewrite_rules');

        // Add Missing Rule.
        if (true !== in_array('index.php?robots=1', (array) $rules, true)) {
            // Set Proper Keys.
            $rule_key = 'robots\.txt$';
            $rules[$rule_key] = 'index.php?robots=1';

            // Update Rules.
            \update_option('rewrite_rules', $rules);

            // Flush Rules.
            \flush_rewrite_rules();
        }

        // Recheck Rewrite Rules.
        $this->checkRewrite();
    }
}
