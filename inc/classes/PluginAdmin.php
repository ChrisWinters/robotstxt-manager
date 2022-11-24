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
     * Set Class Params.
     *
     * @return void
     */
    public function __construct(PluginAdminRobotstxtRules $robotstxtRules)
    {
        if (false === \is_admin()) {
            return;
        }

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
     *
     * @return void
     */
    public function init()
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
     *
     * @return void
     */
    public function menu()
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
     *
     * @return void
     */
    public function enqueue()
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
     *
     * @return void
     */
    public function display()
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
     *
     * @return string $html Tab Display
     */
    public function tabs()
    {
        $html = '<h2 class="nav-tab-wrapper">';

        if (true !== empty($this->queryString('tab'))) {
            $currentTab = $this->queryString('tab');
        } else {
            $currentTab = key($this->adminTabs);
        }

        $pageName = $this->queryString('page');

        $postType = '';
        if (ROBOTSTXT_MANAGER_PLUGIN_NAME === $this->queryString('post_type')) {
            $postType = '&post_type='.$this->queryString('post_type');
        }

        foreach ($this->adminTabs as $tab => $name) {
            $class = '';
            if ($tab === $currentTab) {
                $class = ' nav-tab-active';
            }

            $html .= '<a href="?page='.$pageName.
            '&tab='.$tab.$postType.
            '" class="nav-tab'.$class.'">'.$name.'</a>';
        }

        $html .= '</h2><br />';

        return $html;
    }
}
