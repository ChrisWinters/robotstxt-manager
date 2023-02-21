<?php
/**
 * Plugin admin template: settings|default tab.
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
<input type="hidden" name="action" value="robotstxt" />
<input type="hidden" name="tab" value="settings" />

<table class="form-table">
	<tbody>
		<tr>
		<td>
			<div class="text-dark font-weight-bold p-0 m-0 h5"><?php \esc_html_e('Saved robots.txt file', 'robotstxt-manager'); ?></div>
			<p class="description">&bull; <a href="<?php echo \esc_url(\get_bloginfo('url')); ?>/robots.txt" target="_blank"><?php \esc_html_e('view robots.txt file', 'robotstxt-manager'); ?></p>
		</td>
		</tr>
		<tr>
		<td>
			<textarea name="robotstxt" cols="65" rows="20" class="w-100"><?php echo \esc_html(\RobotstxtManager\option\setting('robotstxt')); ?></textarea><br />
		</td>
		</tr>
	</tbody>
</table>
