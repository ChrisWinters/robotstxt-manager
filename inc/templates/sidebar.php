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
<aside class="postbox">
	<h3><?php echo \esc_html(\RobotstxtManager\settings('plugin_name')); ?></h3>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul class="list-group list-group-flush p-0">
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/robotstxt-manager" target="_blank"><?php \esc_html_e('Plugin Home Page', 'robotstxt-manager'); ?></a></li>
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/robotstxt-manager/issues" target="_blank"><?php \esc_html_e('Bugs & Feature Request', 'robotstxt-manager'); ?></a></li>
			</ul>
		</div>
	</div>
</aside>

<aside class="postbox">
	<h3><?php \esc_html_e('Robots.txt Help', 'robotstxt-manager'); ?></h3>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul class="list-group list-group-flush p-0">
				<li class="list-group-item"><a href="https://wordpress.org/support/article/search-engine-optimization/#robots-txt-optimization" target="_blank"><?php \esc_html_e('Robots.txt Optimization Tips', 'robotstxt-manager'); ?></a></li>
				<li class="list-group-item"><a href="http://www.askapache.com/seo/wordpress-robotstxt-seo/" target="_blank"><?php \esc_html_e('AskAapche Robots.txt Example', 'robotstxt-manager'); ?></a></li>
				<li class="list-group-item"><a href="https://developers.google.com/webmasters/control-crawl-index/docs/faq" target="_blank"><?php \esc_html_e('Google Robots.txt F.A.Q.', 'robotstxt-manager'); ?></a></li>
				<li class="list-group-item"><a href="https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt" target="_blank"><?php \esc_html_e('Robots.txt Specifications', 'robotstxt-manager'); ?></a></li>
				<li class="list-group-item"><a href="http://www.robotstxt.org/db.html" target="_blank"><?php \esc_html_e('Web Robots Database', 'robotstxt-manager'); ?></a></li>
			</ul>
		</div>
	</div>
</aside>
