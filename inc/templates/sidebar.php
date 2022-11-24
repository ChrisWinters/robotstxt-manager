<?php
/**
 * Plugin Admin Template.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<div class="postbox">
	<h3 class="text-dark font-weight-bold pb-0">
		<?php \esc_html_e('Robots.txt Manager', 'robotstxt-manager'); ?>
	</h3>
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
	<h3 class="text-dark font-weight-bold pb-0">
		<?php \esc_html_e('Robots.txt Help', 'robotstxt-manager'); ?>
	</h3>
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
