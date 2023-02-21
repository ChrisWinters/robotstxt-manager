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
		<?php \esc_html_e('Robots.txt help', 'robotstxt-manager'); ?>
	</div>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul>
				<li>&bull; <a href="https://wordpress.org/support/article/search-engine-optimization/#robots-txt-optimization" target="_blank"><?php \esc_html_e('Robots.txt Optimization Tips', 'robotstxt-manager'); ?></a></li>
				<li>&bull; <a href="http://www.askapache.com/seo/wordpress-robotstxt-seo/" target="_blank"><?php \esc_html_e('AskAapche Robots.txt Example', 'robotstxt-manager'); ?></a></li>
				<li>&bull; <a href="https://developers.google.com/webmasters/control-crawl-index/docs/faq" target="_blank"><?php \esc_html_e('Google Robots.txt F.A.Q.', 'robotstxt-manager'); ?></a></li>
				<li>&bull; <a href="https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt" target="_blank"><?php \esc_html_e('Robots.txt Specifications', 'robotstxt-manager'); ?></a></li>
				<li>&bull; <a href="http://www.robotstxt.org/db.html" target="_blank"><?php \esc_html_e('Web Robots Database', 'robotstxt-manager'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
