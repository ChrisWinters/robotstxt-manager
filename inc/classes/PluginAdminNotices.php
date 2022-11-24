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
 * Plugin Admin Area Notices.
 */
final class PluginAdminNotices
{
    /**
     * Plugin Admin Notices.
     *
     * @var array
     */
    public $message = [];

    /**
     * Set Class Params.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = [
            'update_success' => \__(
                'Settings Updated.',
                'includes'
            ),
            'update_error' => \__(
                'Settings Update Failed.',
                'includes'
            ),
            'input_error' => \__(
                'A Selection Is Required.',
                'includes'
            ),
            'delete_success' => \__(
                'Settings Deleted.',
                'includes'
            ),
            'delete_fail' => \__(
                'Settings Delete Failed.',
                'includes'
            ),
            'preset_success' => \__(
                'Robots.txt file updated with selected preset.',
                'includes'
            ),
            'preset_error' => \__(
                'The robots.txt file was not updated.',
                'includes'
            ),
            'checkdata_notice' => \__(
                'Old robots.txt file data found! Click the "remove old data" button to remove the old data.',
                'includes'
            ),
            'checkdata_done' => \__(
                'No old robots.txt file data found.',
                'includes'
            ),
            'checkphysical_notice' => \__(
                'A real robots.txt file was found within the websites root directory. Click the "delete physical file" to delete the robots.txt file.',
                'includes'
            ),
            'checkphysical_done' => \__(
                'A physical robots.txt file was not found.',
                'includes'
            ),
            'checkphysical_error' => \__(
                'The plugin was unable to delete the robots.txt file due to file permissions. Manual deletion required.',
                'includes'
            ),
            'checkrewrite_notice' => \__(
                'This website is missing the robots.txt Rewrite Rule. Click the "correct missing rules" button to add the missing rule.',
                'includes'
            ),
            'checkrewrite_done' => \__(
                'Proper Rewrite Rule found.',
                'includes'
            ),
        ];
    }

    /**
     * Update Success Notice.
     */
    public function updateSuccess()
    {
        echo \wp_kses_post($this->successMessage($this->message['update_success']));
    }

    /**
     * Update Error Notice.
     */
    public function updateError()
    {
        echo \wp_kses_post($this->errorMessage($this->message['update_error']));
    }

    /**
     * Invalid Input Error Notice.
     */
    public function inputError()
    {
        echo \wp_kses_post($this->errorMessage($this->message['input_error']));
    }

    /**
     * Delete Success Notice.
     */
    public function deleteSuccess()
    {
        echo \wp_kses_post($this->successMessage($this->message['delete_success']));
    }

    /**
     * Delete Error Notice.
     */
    public function deleteError()
    {
        echo \wp_kses_post($this->errorMessage($this->message['delete_error']));
    }

    /**
     * Preset Update Success Notice.
     */
    public function presetSuccess()
    {
        echo \wp_kses_post($this->successMessage($this->message['preset_success']));
    }

    /**
     * Preset Update Error Notice.
     */
    public function presetError()
    {
        echo \wp_kses_post($this->errorMessage($this->message['preset_error']));
    }

    /**
     * Cleaner Check Data Notice.
     */
    public function checkDataNotice()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkdata_notice']));
    }

    /**
     * Cleaner Check Data Done.
     */
    public function checkDataDone()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkdata_done']));
    }

    /**
     * Cleaner Check Physical Robots.txt Notice.
     */
    public function checkPhysicalNotice()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkphysical_notice']));
    }

    /**
     * Cleaner Check Physical Robots.txt Done.
     */
    public function checkPhysicalDone()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkphysical_done']));
    }

    /**
     * Cleaner Check Physical Robots.txt Permission Error.
     */
    public function checkPhysicalError()
    {
        echo \wp_kses_post($this->errorMessage($this->message['checkphysical_error']));
    }

    /**
     * Cleaner Check Rewrite Rules Notice.
     */
    public function checkRewriteNotice()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkrewrite_notice']));
    }

    /**
     * Cleaner Check Rewrite Rules Done.
     */
    public function checkRewriteDone()
    {
        echo \wp_kses_post($this->successMessage($this->message['checkrewrite_done']));
    }

    /**
     * Success Message HTML.
     *
     * @param string $message The Notice To Display.
     *
     * @return html
     */
    public function successMessage($message)
    {
        return '<div class="notice notice-success is-dismissible"><p>'.$message.'</p></div>';
    }

    /**
     * Error Message HTML.
     *
     * @param string $message The Notice To Display.
     *
     * @return html
     */
    public function errorMessage($message)
    {
        return '<div class="notice notice-error is-dismissible"><p>'.$message.'</p></div>';
    }
}
