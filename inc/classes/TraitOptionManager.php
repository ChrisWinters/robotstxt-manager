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
    public function getOption()
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
    public function getSetting($settingName)
    {
        $getOption = $this->getOption();

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
    public function updateOption($optionArray)
    {
        if (false === $this->validateUpdate()) {
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
    public function updateSetting($settingName, $settingValue)
    {
        if (false === $this->validateUpdate()) {
            return;
        }

        $getOption = $this->getOption();

        if (true !== empty($getOption[$settingName])) {
            unset($getOption[$settingName]);
        }

        $getOption[$settingName] = $settingValue;

        $this->updateOption($getOption);
    }

    /**
     * Delete Option.
     *
     * @return void
     */
    public function delOption()
    {
        if (false === $this->validateUpdate()) {
            return;
        }

        $getOption = $this->getOption();

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
    public function delSetting($settingName)
    {
        if (false === $this->validateUpdate()) {
            return;
        }

        $getOption = $this->getOption();

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
            $this->delOption();
        }
    }

    /**
     * Get All Saved Plugin Options.
     *
     * @return array
     */
    public function allOptions()
    {
        $options = [];

        $getOption = $this->getOption();

        if (true !== empty($getOption)) {
            $options = $getOption;
        }

        if (defined('WP_DEBUG') && true === WP_DEBUG) {
            $loadedOptions = \wp_load_alloptions();

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
    private function validateUpdate()
    {
        $status = true;

        if (false === \is_admin() || false === \current_user_can('manage_options')) {
            $status = false;
        }

        return $status;
    }
}
