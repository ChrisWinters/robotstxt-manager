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
<form enctype="multipart/form-data" method="post" action="">
<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
<input type="hidden" name="action" value="cleaner" />
	<h2 class="text-dark font-weight-bold pl-0"><?php \esc_html_e('Check For Old Robots.txt File Settings', 'robotstxt-manager'); ?></h2>
	<p class="description"><?php \esc_html_e('If you are having problems with a websites robots.txt file to displaying properly, it is possible that old robots.txt file data left over from other plugins is conflicting. Click the "scan for old data" button below to scan the network for left over data. If any is found, a notice will display with a new button to automatically clean out the left over data.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-data" id="submit" class="button button-secondary" value="scan for old data">
	</div>

	<?php if ('error' === $this->getSetting('checkdata')) { ?>
		<hr />
		<h3 class="text-danger font-weight-bold pl-0"><?php \esc_html_e('Old Robots.txt File Settings Found', 'robotstxt-manager'); ?></h3>
		<p class="description"><?php \esc_html_e('Click the "remove old data" button below to purge the old settings.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="clean-data" id="submit" class="button button-primary" value="remove old data">
		</div>
	<?php } ?>

	<hr class="my-5" />

	<h2 class="text-dark font-weight-bold pl-0"><?php \esc_html_e('Check For Real (physical) Robots.txt File', 'robotstxt-manager'); ?></h2>
	<p class="description"><?php \esc_html_e('If network/website changes do not appear to override the robots.txt file or if the file is blank, it is possible that a plugin created a physical (hard) robots.txt file. Click the "scan for physical file" button below to check the website for a real robots.txt file. If one is found, a notice will display with a new button allowing you to delete the file.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-physical" id="submit" class="button button-secondary" value="scan for physical file">
	</div>

	<?php if ('error' === $this->getSetting('checkphysical')) { ?>
		<hr />
		<h3 class="text-danger font-weight-bold pl-0"><?php \esc_html_e('A Real Robots.txt File Was Found', 'robotstxt-manager'); ?></h3>
		<p class="description"><?php \esc_html_e('Click the "delete physical file" button below to delete the real robots.txt file.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="clean-physical" id="submit" class="button button-primary" value="delete physical file">
		</div>
	<?php } ?>

	<hr class="my-5" />

	<h2 class="text-dark font-weight-bold pl-0"><?php \esc_html_e('Check For Robots.txt Rewrite Rule', 'robotstxt-manager'); ?></h2>
	<p class="description"><?php \esc_html_e('If your robots.txt files are blank, it is possible the website is missing the rewrite rule index.php?robots=1. Click the "scan for missing rule" button below to scan the for the missing rule. If the rule is missing, a notice will display with a new button to automatically add the rule for you.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-rewrite" id="submit" class="button button-secondary" value="scan for missing rule">
	</div>

	<?php if ('error' === $this->getSetting('checkrewrite')) { ?>
		<hr />
		<h3 class="text-danger font-weight-bold pl-0"><?php \esc_html_e('Website Rewrite Rule Missing', 'robotstxt-manager'); ?></h3>
		<p class="description"><?php \esc_html_e('Click the "add missing rule" button below to add the missing rule.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="add-rewrite" id="submit" class="button button-primary" value="correct missing rule">
		</div>
	<?php } ?>
</form>
