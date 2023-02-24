<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Tab navigation within plugin admin area.
 */
function navigationTabs(): string
{
    $pageName = \RobotstxtManager\PluginAdmin\queryString('page');
    $selectedTab = \RobotstxtManager\PluginAdmin\queryString('tab');
    $adminTabs = \RobotstxtManager\settings('admin_tabs');

    $currentTab = key($adminTabs);

    if (true !== empty($selectedTab)) {
        $currentTab = $selectedTab;
    }

    $menuItem = \__('Menu item', 'robotstxt-manager');

    $html = '<div class="nav-tab-wrapper" role="navigation" aria-label="Plugin tab menu">';
    $html .= '<a href="#post-body-content" class="screen-reader-shortcut">'.\__('Skip to plugin settings', 'robotstxt-manager').'</a>';
    $html .= '<ul class="p-0 m-0" id="nav">';

    foreach ($adminTabs as $tab => $name) {
        $active = '';
        $class = ' mb-0';

        if ($tab === $currentTab) {
            $class = ' nav-tab-active';
            $active = \__('Active ', 'robotstxt-manager');
        }

        $html .= '<li class="nav-tab'.$class.'">';
        $html .= '<a href="?page='.$pageName.'&tab='.$tab.'#wpbody-content" aria-label="'.$active.$menuItem.': '.$name.'">'.$name.'</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';
    $html .= '</div>';

    return $html;
}
