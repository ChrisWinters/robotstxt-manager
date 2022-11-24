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
					</div><!-- .inside -->
				</div><!-- .postbox -->
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<?php require_once dirname(ROBOTSTXT_MANAGER_FILE).'/inc/templates/sidebar.php'; ?>
			</div>

			<br class="clear" />
		</div><!-- #post-body -->
	</div><!-- #poststuff -->

	<div class="clearfix">
		<div class="float-left text-left">
			<small>&#9829; <?php \esc_html_e('Robots.txt Manager', 'robotstxt-manager'); ?></small>
		</div>
		<div class="float-right text-right">
			<a href="#top"><span class="dashicons-before dashicons-arrow-up"><?php \esc_html_e('top', 'robotstxt-manager'); ?></span></a>
		</div>
	</div>
</div><!-- .wrap -->

<br class="clear" />
