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

    // HTML Output.
    $html = '<h2 class="nav-tab-wrapper">';

    foreach ($adminTabs as $tab => $name) {
        $class = '';

        if ($tab === $currentTab) {
            $class = ' nav-tab-active';
        }

        $html .= '<a href="?page='.$pageName.
        '&tab='.$tab.'" class="nav-tab'.$class.'">'.$name.'</a>';
    }

    $html .= '</h2><br />';

    return $html;
}
