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
 * Save/Update Plugin Settings.
 */
final class PluginAdminSave
{
    use TraitOptionManager;
    use TraitQueryString;

    /**
     * Plugin Admin Post Object.
     *
     * @var array
     */
    public $postObject = [];

    /**
     * Form post action.
     *
     * @var object
     */
    public $postAction;

    /**
     * Plugin Admin Notices.
     *
     * @var object
     */
    public $notices;

    /**
     * Setup Class.
     */
    public function __construct(PluginAdminNotices $notices)
    {
        if (false === \is_admin()) {
            return;
        }

        if ($this->queryString('page') !== ROBOTSTXT_MANAGER_PLUGIN_NAME) {
            return;
        }

        $this->postAction = filter_input(INPUT_POST, 'action');

        if (true === empty($this->postAction)) {
            return;
        }

        $postObjectArray = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        $this->postObject = $this->unsetPostItems($postObjectArray);

        $this->notices = $notices;
    }

    /**
     * Init Admin Update.
     */
    public function init()
    {
        if ($this->queryString('page') !== ROBOTSTXT_MANAGER_PLUGIN_NAME) {
            return;
        }

        if (true === empty($this->postAction)) {
            return;
        }

        \add_action(
            'admin_init',
            [
                $this,
                'update',
            ]
        );
    }

    /**
     * Update Plugin Settings.
     */
    public function update()
    {
        $this->securityCheck();

        /**
         * Sanitizes title, replacing whitespace with dashes.
         * Limits the output to alphanumeric characters,
         * underscore (_) and dash (-). Whitespace becomes a dash.
         */
        $action = \sanitize_title_with_dashes($this->postAction);

        if ('update' === $action) {
            $this->updateAction();
        }

        if ('delete' === $action) {
            $this->deleteAction();
        }

        if ('presets' === $action) {
            $presets = new PluginAdminPresets($this->postObject, $this->notices);
            $presets->setPresetRobotstxt();
        }

        if ('cleaner' === $action) {
            $cleaner = new PluginAdminCleaner($this->postObject, $this->notices);
            $cleaner->cleanerAction();
        }
    }

    /**
     * Unset Post Objects.
     *
     * @param array $post Form Post Object.
     *
     * @return array|void
     */
    public function unsetPostItems($post)
    {
        unset($post['action']);
        unset($post['submit']);
        unset($post[ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce']);
        unset($post['_wp_http_referer']);

        if (true !== empty($post)) {
            unset($post['section']);

            return $post;
        } elseif (true === isset($post['section']) && 'update' !== $post['section']) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'inputError',
                ]
            );
        }
    }

    /**
     * Update Plugin Setting.
     */
    private function updateAction()
    {
        $message = false;

        $count = 0;

        if (true !== empty($this->postObject)) {
            $this->updateOption($this->postObject);
            $message = true;
        }

        if (true === empty($this->postObject)) {
            $this->delOption();
            $message = true;
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'updateSuccess',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'updateError',
                ]
            );
        }
    }

    /**
     * Delete Plugin Setting.
     */
    private function deleteAction()
    {
        $this->delOption();

        if (true === empty($this->getOption())) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'deleteSuccess',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'deleteError',
                ]
            );
        }
    }

    /**
     * Form Validation.
     */
    private function securityCheck()
    {
        $message = \__('You are not authorized to perform this action.', 'robotstxt-manager');

        if (filter_input(INPUT_GET, 'page') !== ROBOTSTXT_MANAGER_PLUGIN_NAME) {
            \wp_die(\esc_html($message));
        }

        if (false === current_user_can('manage_options')) {
            \wp_die(\esc_html($message));
        }

        if (false === \check_admin_referer(
            ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
            ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
        )
        ) {
            \wp_die(\esc_html($message));
        }
    }
}
