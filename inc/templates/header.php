<?php
/**
 * Plugin admin template part.
 *
 * @include /inc/functions/plugin-admin/view/includeTemplates.php
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap">
	<h1><span class="dashicons dashicons-admin-site-alt3 mt-1 pt-1"></span> <?php
        echo \esc_html(\RobotstxtManager\settings('plugin_name')); ?>: <small><?php
        echo \esc_html(\RobotstxtManager\settings('plugin_about')); ?></small></h1>

	<?php echo \RobotstxtManager\PluginAdmin\View\navigationTabs(); ?>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="postbox">
					<div class="inside" id="top">