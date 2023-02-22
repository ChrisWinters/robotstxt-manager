<?php
/**
 * Plugin admin template: cleaner tab.
 *
 * @include /inc/functions/plugin-admin/view/includeTemplates.php
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);
?>
<input type="hidden" name="action" value="cleaner" />

<p class="text-dark font-weight-bold h4"><?php \esc_html_e('Check For Old Robots.txt File Settings', 'robotstxt-manager'); ?></p>
<p class="description"><?php \esc_html_e('If you are having problems with a websites robots.txt file to displaying properly, it is possible that old robots.txt file data left over from other plugins is conflicting. Click the "scan for old data" button below to scan the network for left over data. If any is found, a notice will display with a new button to automatically clean out the left over data.', 'robotstxt-manager'); ?></p>
<div class="mt-3"><input type="submit" name="check-previous" id="submit" class="button button-secondary" value="scan for old data"></div>

<?php if ('clean-previous' === \RobotstxtManager\option\get('cleaner')) { ?>
	<hr />
	<p class="text-danger font-weight-bold h4"><?php \esc_html_e('Old Robots.txt File Settings Found', 'robotstxt-manager'); ?></p>
	<p class="description"><?php \esc_html_e('Click the "remove old data" button below to purge the old settings.', 'robotstxt-manager'); ?></p>
	<div class="mt-3"><input type="submit" name="clean-previous" id="submit" class="button button-primary" value="remove old data"></div>
<?php } ?>

</form>
