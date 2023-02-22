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
			<span class="description small"><?php \esc_html_e('Saving an empty robots.txt file will restore the default WordPress robots.txt file.', 'robotstxt-manager'); ?></span>
		</td>
		</tr>
	</tbody>
</table>

<?php \submit_button(\esc_html__('update robots.txt file', 'robotstxt-manager')); ?>
</form>

<hr />

<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);

?>
<input type="hidden" name="action" value="preset" />
<input type="hidden" name="tab" value="settings" />

<table class="form-table">
	<tbody>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 m-0 h5"><?php \esc_html_e('Robots.txt file presets', 'robotstxt-manager'); ?></div>
			<p class="description"><?php \esc_html_e('Select a WordPress ready preset robots.txt file to load and use.', 'robotstxt-manager'); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row"><label for="simplified"><?php \esc_html_e('Simplified robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="simplified" id="simplified" /> <span class="description"><?php \esc_html_e('Simplified rules that will work with most WordPress setups.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'simplified'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="alternative"><?php \esc_html_e('Alternative robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="alternative" id="alternative" /> <span class="description"><?php \esc_html_e('Similar to the simplified robots.txt file, with more disallows.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'alternative'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="wordpress"><?php \esc_html_e('WordPress robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="wordpress" id="wordpress" /> <span class="description"><?php \esc_html_e('Includes all possible rules, use as a base to create a custom file.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'wordpress'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="blogger"><?php \esc_html_e('Blogger friendly robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="blogger" id="blogger" /> <span class="description"><?php \esc_html_e('Optimized for blog focused WordPress websites.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'blogger'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="google"><?php \esc_html_e('Google friendly robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="google" id="google" /> <span class="description"><?php \esc_html_e('A Google friendly robots.txt file.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'google'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="open"><?php \esc_html_e('Open robots.txt file', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="open" id="open" /> <span class="description"><?php \esc_html_e('Fully open robots.txt file, no disallows.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'open'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="blocked"><?php \esc_html_e('Disallow entire website', 'robotstxt-manager'); ?></label></th>
		<td><input type="radio" name="preset" value="blocked" id="blocked" /> <span class="description"><?php \esc_html_e('Disallow everything, prevent spiders from indexing the website.', 'robotstxt-manager'); ?> <span class="small">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'blocked'); ?>" target="_blank"><?php \esc_html_e('view', 'robotstxt-manager'); ?></a>]</span></span></td>
		</tr>
	</tbody>
</table>

<?php \submit_button(\esc_html__('change robots.txt file', 'robotstxt-manager')); ?>

</form>

<br /><br /><hr />

<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);
?>
<input type="hidden" name="action" value="delete" />
<input type="hidden" name="tab" value="settings" />

<table class="form-table">
	<tbody>
		<tr>
		<td class="text-right"><span class="description"><?php \esc_html_e('WARNING: Delete all settings related to the Robots.txt Manager plugin.', 'robotstxt-manager'); ?></span> <input type="radio" name="confirm" value="delete" /></td>
		</tr>
	</tbody>
</table>

<p class="textright"><input type="submit" name="submit" value=" <?php esc_html_e('delete settings', 'robotstxt-manager'); ?> " /></p>
</form>