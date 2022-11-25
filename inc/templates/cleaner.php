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
<h2><?php \esc_html_e('Robots.txt cleaner', 'robotstxt-manager'); ?></h2>
<p class="description"><?php \esc_html_e('Tools to help you with robots.txt file issues.', 'robotstxt-manager'); ?></p>
<hr />

<form enctype="multipart/form-data" method="post" action="<?php echo \admin_url('options-general.php?page=robotstxt-manager&tab=cleaner#notice'); ?>">
<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
<input type="hidden" name="action" value="cleaner" />
	<section>
	<h3 id="scanSettingsTitle"><?php \esc_html_e('Check for other robots.txt file settings', 'robotstxt-manager'); ?></h3>
	<p class="description" id="scanSettingsDesc"><?php \esc_html_e('If you are having problems with a websites robots.txt file to displaying properly, it is possible that old robots.txt file data left over from other plugins is conflicting. Click the "scan for old data" button below to scan the network for left over data. If any is found, a notice will display with a new button to automatically clean out the left over data.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-data" class="btn btn-secondary" value="scan for old data" aria-describedby="scanSettingsTitle,scanSettingsDesc" aria-label="<?php \esc_html_e('Select to scan for old Robots.txt file data.', 'robotstxt-manager'); ?>">
	</div>
	</section>
	<?php if ('error' === $this->getSetting('checkdata')) { ?>
		<hr />
		<section>
		<h3 id="foundSettingsTitle"><?php \esc_html_e('Old robots.txt file settings found', 'robotstxt-manager'); ?></h3>
		<p class="description" id="foundSettingsDesc"><?php \esc_html_e('Click the "remove old data" button below to purge the old settings.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="clean-data" class="btn btn-primary" value="remove old data" aria-describedby="foundSettingsTitle,foundSettingsDesc" aria-label="<?php \esc_html_e('Select to remove old Robots.txt file data.', 'robotstxt-manager'); ?>">
		</div>
	</section>
	<?php } ?>

	<hr class="my-5" />

	<section>
	<h3 id="scanFileTitle"><?php \esc_html_e('Check for a real robots.txt file', 'robotstxt-manager'); ?></h3>
	<p class="description" id="scanFileDesc"><?php \esc_html_e('If network/website changes do not appear to override the robots.txt file or if the file is blank, it is possible that a plugin created a physical (hard) robots.txt file. Click the "scan for physical file" button below to check the website for a real robots.txt file. If one is found, a notice will display with a new button allowing you to delete the file.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-physical" class="btn btn-secondary" value="scan for physical file" aria-describedby="scanFileTitle,scanFileDesc" aria-label="<?php \esc_html_e('Select to scan for a real robots.txt file.', 'robotstxt-manager'); ?>">
	</div>
	</section>

	<?php if ('error' === $this->getSetting('checkphysical')) { ?>
		<hr />
		<section>
		<h3 class="text-danger font-weight-bold pl-0" id="foundFileTitle"><?php \esc_html_e('A real robots.txt file was found', 'robotstxt-manager'); ?></h3>
		<p class="description" id="foundFileDesc"><?php \esc_html_e('Click the "delete physical file" button below to delete the real robots.txt file.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="clean-physical" class="btn btn-primary" value="delete physical file" aria-describedby="foundFileTitle,foundFileDesc" aria-label="<?php \esc_html_e('Select to delete the robots.txt file.', 'robotstxt-manager'); ?>">
		</div>
		</section>
	<?php } ?>

	<hr class="my-5" />

	<section>
	<h3 id="scanRewriteTitle"><?php \esc_html_e('Check for robots.txt rewrite rule', 'robotstxt-manager'); ?></h3>
	<p class="description" id="scanRewriteDesc"><?php \esc_html_e('If your robots.txt files are blank, it is possible the website is missing the rewrite rule index.php?robots=1. Click the "scan for missing rule" button below to scan the for the missing rule. If the rule is missing, a notice will display with a new button to automatically add the rule for you.', 'robotstxt-manager'); ?></p>
	<div class="mt-3">
		<input type="submit" name="check-rewrite" class="btn btn-secondary" value="scan for missing rule" aria-describedby="scanRewriteTitle,scanRewriteDesc" aria-label="<?php \esc_html_e('Select to scan for missing rewrite rule.', 'robotstxt-manager'); ?>">
	</div>
	</section>

	<?php if ('error' === $this->getSetting('checkrewrite')) { ?>
		<hr />
		<section>
		<h3 class="text-danger font-weight-bold pl-0" id="noRewriteTitle"><?php \esc_html_e('The rewrite rule is missing', 'robotstxt-manager'); ?></h3>
		<p class="description" id="noRewriteDesc"><?php \esc_html_e('Click the "correct missing rule" button below to add the missing rule.', 'robotstxt-manager'); ?></p>
		<div class="mt-3">
			<input type="submit" name="add-rewrite" class="btn btn-primary" value="correct missing rule" aria-describedby="noRewriteTitle,noRewriteDesc" aria-label="<?php \esc_html_e('Select to add the missing rewrite rule.', 'robotstxt-manager'); ?>">
		</div>
		</section>
	<?php } ?>
	<br />
</form>
