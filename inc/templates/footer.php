<?php
/**
 * Plugin admin template part.
 *
 * @include /inc/functions/plugin-admin/view/displayAdmin.php
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
					</div><!-- .inside -->
				</div><!-- .postbox -->
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<?php // require_once \RobotstxtManager\settings('template_path').'sidebar.php';?>
			</div>

			<br class="clear" />
		</div><!-- #post-body -->
	</div><!-- #poststuff -->
	<div class="clearfix">
		<div class="float-left text-left"><small>&#9829; <?php echo \esc_html(\RobotstxtManager\settings('plugin_name')); ?> - <?php \esc_html_e('Version', 'robotstxt-manager'); ?> <?php echo \esc_html(\RobotstxtManager\settings('plugin_version')); ?></small></div>
		<div class="float-right text-right"><a href="#top"><span class="dashicons-before dashicons-arrow-up"><?php \esc_html_e('top', 'robotstxt-manager'); ?></span></a></div>
	</div>
</div><!-- .wrap -->

<br class="clear" />
