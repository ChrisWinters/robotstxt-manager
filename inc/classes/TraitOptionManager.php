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
     */
    public function getOption(): array
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
     * @param string $settingName Name Of Option To Get.
     */
    public function getSetting(string $settingName): string
    {
        $getOption = $this->getOption();

        if (true === isset($getOption[$settingName])) {
            return $getOption[$settingName];
        }

        return '';
    }

    /**
     * Update Option Array.
     *
     * @param array $optionArray Prepared Option Array.
     */
    public function updateOption(array $optionArray): void
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
     * @param string $settingName  Name Of Option To Save.
     * @param mixed  $settingValue The Value To Save.
     */
    public function updateSetting(string $settingName, mixed $settingValue): void
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
     */
    public function delOption(): void
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
     * @param string $settingName Name Of Option To Delete.
     */
    public function delSetting(string $settingName): void
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
     */
    public function allOptions(): array
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
            }
        }

        return $options;
    }

    /**
     * Admin Area / Admin Level User Only.
     */
    private function validateUpdate(): bool
    {
        $status = false;

        if (true === \is_admin() &&
            true === \current_user_can('manage_options')) {
            $status = true;
        }

        return $status;
    }
}