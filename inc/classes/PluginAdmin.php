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
 * Load WordPress Plugin Admin Area.
 */
final class PluginAdmin
{
    use TraitOptionManager;
    use TraitQueryString;

    /**
     * Admin Area Template Tabs.
     *
     * @var array
     */
    public $adminTabs = [];

    /**
     * Saved Robots.txt File.
     *
     * @var string
     */
    public $robotstxt;

    /**
     * Upload Path Rule.
     *
     * @var string
     */
    public $uploadPath;

    /**
     * Theme Path Rule.
     *
     * @var string
     */
    public $themePath;

    /**
     * Website Sitemap URL Rule.
     *
     * @var string
     */
    public $sitemapUrl;

    /**
     * Maybe setup admin area variables.
     *
     * @param PluginAdminRobotstxtRules $robotstxtRules Manual Rule Suggestions.
     */
    public function __construct(PluginAdminRobotstxtRules $robotstxtRules)
    {
        // Plugin admin navigation tabs.
        $this->adminTabs = [
            'settings' => \esc_html__('Settings', 'robotstxt-manager'),
            'cleaner' => \esc_html__('Cleaner', 'robotstxt-manager'),
        ];

        // Saved Robots.txt File.
        $this->robotstxt = $this->getSetting('robotstxt');

        // Settings Template Extra Robots.txt Rule Statements.
        $this->uploadPath = $robotstxtRules->getUploadPath();
        $this->themePath = $robotstxtRules->getThemePath();
        $this->sitemapUrl = $robotstxtRules->getSitemapUrl();
    }

    /**
     * Init Admin Display.
     */
    public function init(): void
    {
        \add_action(
            'admin_menu',
            [
                $this,
                'menu',
            ]
        );

        if ($this->queryString('page') === ROBOTSTXT_MANAGER_PLUGIN_NAME) {
            \add_action(
                'admin_enqueue_scripts',
                [
                    $this,
                    'enqueue',
                ]
            );
        }
    }

    /**
     * Generate Settings Menu.
     */
    public function menu(): void
    {
        \add_submenu_page(
            'options-general.php',
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            \__('Robots.txt Manager', 'robotstxt-manager'),
            'manage_options',
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            [
                $this,
                'display',
            ]
        );
    }

    /**
     * Enqueue Stylesheet and jQuery.
     */
    public function enqueue(): void
    {
        \wp_enqueue_style(
            ROBOTSTXT_MANAGER_PLUGIN_NAME,
            \plugins_url('/assets/css/style.min.css', ROBOTSTXT_MANAGER_FILE),
            '',
            gmdate('YmdHis', time()),
            'all'
        );
    }

    /**
     * Display Admin Templates.
     */
    public function display(): void
    {
        $dir = dirname(ROBOTSTXT_MANAGER_FILE);
        $tab = $this->queryString('tab');

        include_once $dir.'/inc/templates/header.php';

        if (true === file_exists($dir.'/inc/templates/'.$tab.'.php')) {
            include_once $dir.'/inc/templates/'.$tab.'.php';
        } else {
            include_once $dir.'/inc/templates/settings.php';
        }

        include_once $dir.'/inc/templates/footer.php';
    }

    /**
     * Display Admin Area Tabs.
     */
    public function tabs(): string
    {
        $menuItem = \__('Menu item', 'robotstxt-manager');
        $currentTab = key($this->adminTabs);

        $html = '<div class="nav-tab-wrapper" role="navigation" aria-label="Plugin tab menu">';
        $html .= '<a href="#post-body-content" class="screen-reader-shortcut">Skip to plugin settings</a>';

        if (true !== empty($this->queryString('tab'))) {
            $currentTab = $this->queryString('tab');
        }

        $pageName = $this->queryString('page');

        foreach ($this->adminTabs as $tab => $name) {
            $active = '';
            $class = '';

            if ($tab === $currentTab) {
                $class = ' nav-tab-active';
                $active = \__('Active ', 'robotstxt-manager');
            }

            $html .= '<a href="?page='.$pageName.
            '&tab='.$tab.
            '" class="nav-tab'.$class.'" aria-label="'.$active.$menuItem.': '.$name.'">'.$name.'</a>';
        }

        $html .= '</div><br />';

        return $html;
    }
}
