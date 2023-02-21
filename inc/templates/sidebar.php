<?php
/**
 * Plugin admin template part.
 *
 * @include /inc/templates/footer.php
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<div class="postbox">
	<div class="h5 p-1 font-weight-bold">
		<?php echo \esc_html(\RobotstxtManager\settings('plugin_name')); ?>
	</div>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul>
				<li>&bull; <a href="https://github.com/ChrisWinters/robotstxt-manager" target="_blank"><?php \esc_html_e('Plugin Home Page', 'robotstxt-manager'); ?></a></li>
				<li>&bull; <a href="https://github.com/ChrisWinters/robotstxt-manager/issues" target="_blank"><?php \esc_html_e('Bugs & Feature Request', 'robotstxt-manager'); ?></a></li>
			</ul>
		</div>
	</div>
</div>

<div class="postbox">
	<div class="h5 p-1 font-weight-bold">
		<?php \esc_html_e('Robots.txt Help', 'robotstxt-manager'); ?>
	</div>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
		</div>
	</div>
</div>
