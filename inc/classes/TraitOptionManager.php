<?php
/**
 * Class Trait.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get and Set Plugin Options.
 */
trait TraitOptionManager
{
    /**
     * Get Option Data.
     *
     * @return array
     */
    public function get_option()
    {
        $getOption = \get_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);

        if (true !== empty($getOption)) {
            return $getOption;
        }

        return [];
    }

    /**
     * Get Option Setting.
     *
     * @param mixed $settingName Name Of Option To Get.
     *
     * @return string
     */
    public function get_setting($settingName)
    {
        $getOption = $this->get_option();

        if (true === isset($getOption[$settingName])) {
            return $getOption[$settingName];
        }

        return false;
    }

    /**
     * Update Option Array.
     *
     * @param mixed $optionArray Prepared Option Array.
     *
     * @return void
     */
    public function update_option($optionArray)
    {
        if (false === $this->validate_update()) {
            return;
        }

        \update_option(
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            $optionArray
        );
    }

    /**
     * Update Setting Within Option.
     *
     * @param mixed $settingName  Name Of Option To Save.
     * @param mixed $settingValue The Value To Save.
     */
    public function update_setting($settingName, $settingValue)
    {
        if (false === $this->validate_update()) {
            return;
        }

        $getOption = $this->get_option();

        if (true !== empty($getOption[$settingName])) {
            unset($getOption[$settingName]);
        }

        $getOption[$settingName] = $settingValue;

        $this->update_option($getOption);
    }

    /**
     * Delete Option.
     *
     * @return void
     */
    public function del_option()
    {
        if (false === $this->validate_update()) {
            return;
        }

        $getOption = $this->get_option();

        if (true === isset($getOption)) {
            \delete_option(ROBOTSTXT_MANAGER_PLUGIN_NAME);
        }
    }

    /**
     * Delete Option Setting.
     *
     * @param mixed $settingName Name Of Option To Delete.
     *
     * @return void
     */
    public function del_setting($settingName)
    {
        if (false === $this->validate_update()) {
            return;
        }

        $getOption = $this->get_option();

        if (true === isset($getOption[$settingName])) {
            unset($getOption[$settingName]);
        }

        if (true !== empty($getOption)) {
            \update_option(
                ROBOTSTXT_MANAGER_PLUGIN_NAME,
                $getOption
            );
        }

        if (true === empty($getOption)) {
            $this->del_option();
        }
    }

    /**
     * Get All Saved Plugin Options.
     *
     * @return array
     */
    public function all_options()
    {
        $options = [];

        $getOption = $this->get_option();

        if (true !== empty($getOption)) {
            $options = $getOption;
        }

        if (defined('WP_DEBUG') && true === WP_DEBUG) {
            $loadedOptions = wp_load_alloptions();

            foreach ($loadedOptions as $name => $value) {
                if (false !== stristr($name, ROBOTSTXT_MANAGER_SETTING_PREFIX)) {
                    $options[$name] = $value;
                }

                if (false !== stristr($name, 'Fs_')) {
                    $options[$name] = $value;
                }
            }
        }

        return $options;
    }

    /**
     * Admin Area / Admin Level User Only.
     *
     * @return array
     */
    private function validate_update()
    {
        $status = true;

        if (false === \is_admin() || false === \current_user_can('manage_options')) {
            $status = false;
        }

        return $status;
    }
}
