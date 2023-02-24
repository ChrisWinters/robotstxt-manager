<?php
/**
 * Public admin area function: view.
 */

namespace RobotstxtManager\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Include plugin admin area templates.
 */
function includeTemplates(): void
{
    $selectedTab = \RobotstxtManager\PluginAdmin\queryString('tab');
    $currentTab = (true !== empty($selectedTab)) ? $selectedTab : 'settings';
    $templatePath = \RobotstxtManager\settings('template_path');

    if (true === file_exists($templatePath.$currentTab.'.php')) {
        include_once $templatePath.'header.php';
        include_once $templatePath.$currentTab.'.php';
        include_once $templatePath.'footer.php';
    }
}
