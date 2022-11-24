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
 * Robots.txt Cleaner Tool.
 */
final class PluginAdminCleaner
{
    use TraitOptionManager;

    /**
     * Post Object Array.
     *
     * @var array
     */
    public $postObject = [];

    /**
     * Notices Class Object.
     *
     * @var object
     */
    public $notices = [];

    /**
     * Setup Class.
     *
     * @param array  $postObject Post Object Array.
     * @param object $notices    Notices Class Object.
     */
    public function init($postObject = [], $notices = []): void
    {
        $this->postObject = $postObject;
        $this->notices = $notices;
    }

    /**
     * Cleaner Actions.
     */
    public function cleanerAction(): void
    {
        // Check for old plugin data.
        if (true !== empty($this->postObject['check-data'])) {
            $this->checkData();
        }

        // Clean plugin data.
        if (true !== empty($this->postObject['clean-data'])) {
            $this->cleanData();
        }

        // Check for real robots.txt file.
        if (true !== empty($this->postObject['check-physical'])) {
            $this->checkPhysical();
        }

        // Remove real robots.txt file.
        if (true !== empty($this->postObject['clean-physical'])) {
            $this->cleanPhysical();
        }

        // Check for robots.txt file rewrite rules.
        if (true !== empty($this->postObject['check-rewrite'])) {
            $this->checkRewrite();
        }

        // Add missing robots.txt file rewrite rules.
        if (true !== empty($this->postObject['add-rewrite'])) {
            $this->addRewrite();
        }
    }

    /**
     * Check For Old Plugin Data.
     */
    public function checkData(): void
    {
        $message = false;

        // Old Data Found, Set Marker.
        if (\get_option('pc_robotstxt') || \get_option('kb_robotstxt') || \get_option('cd_rdte_content')) {
            $this->updateOption(['checkdata' => 'error']);
            $message = true;
        } else {
            $this->delSetting('checkdata');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkDataNotice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkDataDone',
                ]
            );
        }
    }

    /**
     * Remove Old Plugin Data.
     */
    public function cleanData(): void
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
     * Check For Physical Robots.txt File.
     */
    public function checkPhysical(): void
    {
        $message = false;

        // Robots.txt File Found.
        if (true === file_exists(\get_home_path().'robots.txt')) {
            $this->updateOption(['checkphysical' => 'error']);
            $message = true;
        } else {
            $this->delSetting('checkphysical');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkPhysicalNotice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkPhysicalDone',
                ]
            );
        }
    }

    /**
     * Remove Physical Robots.txt File.
     */
    public function cleanPhysical(): void
    {
        // Remove Robots.txt File.
        if (true === file_exists(\get_home_path().'robots.txt') && true === is_writable(\get_home_path().'robots.txt')) {
            unlink(realpath(\get_home_path().'robots.txt'));
        }

        // Robots.txt File Found.
        if (true === file_exists(\get_home_path().'robots.txt')) {
            $this->delSetting('checkphysical');

            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkPhysicalError',
                ]
            );
        } else {
            $this->checkPhysical();
        }
    }

    /**
     * Check For Missing Rewrite Rules.
     */
    public function checkRewrite(): void
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
            $this->updateOption(['checkrewrite' => 'error']);
            $message = true;
        } else {
            $this->delSetting('checkrewrite');
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkRewriteNotice',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'checkRewriteDone',
                ]
            );
        }
    }

    /**
     * Add Missing Rewrite Rule.
     */
    public function addRewrite(): void
    {
        // Get Rewrite Rules.
        $rules = \get_option('rewrite_rules');

        // Add Missing Rule.
        if (true !== in_array('index.php?robots=1', (array) $rules, true)) {
            // Set Proper Keys.
            $ruleKey = 'robots\.txt$';
            $rules[$ruleKey] = 'index.php?robots=1';

            // Update Rules.
            \update_option('rewrite_rules', $rules);

            // Flush Rules.
            \flush_rewrite_rules();
        }

        // Recheck Rewrite Rules.
        $this->checkRewrite();
    }
}
