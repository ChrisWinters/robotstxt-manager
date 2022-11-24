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
<input type="hidden" name="action" value="update" />
	<h2 class="text-dark font-weight-bold pl-0"><?php \esc_html_e('Saved Robots.txt File', 'robotstxt-manager'); ?></h2>
	<p class="description"><?php \esc_html_e('Saving an empty robots.txt file will restore the default WordPress robots.txt file.', 'robotstxt-manager'); ?></p>
	<p class="description pb-4"><a href="<?php \esc_url(\get_bloginfo('url')); ?>/robots.txt" target="_blank"><?php \esc_html_e('View the websites robots.txt file in a new tab or window.', 'robotstxt-manager'); ?></a></p>
	<textarea name="robotstxt" cols="65" rows="20" class="w-100"><?php echo \esc_html($this->getSetting('robotstxt')); ?></textarea>
	<?php \submit_button(\esc_html__('update robots.txt file', 'robotstxt-manager')); ?>
</form>

<h2 class="text-dark font-weight-bold pl-0" id="manualRulesTitle">
	<?php \esc_html_e('Recommended Robots.txt File Rules', 'robotstxt-manager'); ?>
</h2>

<p class="description" id="manualRulesDesc"><?php \esc_html_e('To help ensure the entire website is indexed by search engines; Copy and paste the rules below into the above robots.txt file.', 'robotstxt-manager'); ?></p>

<table class="form-table" aria-describedby="manualRulesTitle,manualRules">
	<tbody>
		<tr>
		<th scope="row">
			<label for="uploadPath"><?php \esc_html_e('Upload Path', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="text" name="upload_path" value="<?php echo \esc_html($this->uploadPath); ?>" id="uploadPath" class="regular-text" onclick="select()" />
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="themePath"><?php \esc_html_e('Theme Path', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="text" name="theme_path" value="<?php echo \esc_html($this->themePath); ?>" id="themePath" class="regular-text" onclick="select()" />
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="sitemapUrl"><?php \esc_html_e('Sitemap URL', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="text" name="sitemap_url" value="<?php echo \esc_html($this->sitemapUrl); ?>" id="sitemapUrl" class="regular-text" onclick="select()" />
		</td>
		</tr>
	</tbody>
</table>

<hr />

<form enctype="multipart/form-data" method="post" action="">
	<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
<input type="hidden" name="action" value="presets" />

<h2 class="text-dark font-weight-bold pl-0">
	<?php \esc_html_e('Robots.txt File Presets', 'robotstxt-manager'); ?>
</h2>

<p class="description"><?php \esc_html_e('Select a preset robots.txt file to load and use. Click the view button to inspect the preset robots.txt file in a new tab or window.', 'robotstxt-manager'); ?></p>

<table class="form-table">
	<tbody>
		<tr>
		<th scope="row">
			<label for="default"><?php \esc_html_e('Default Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="default-robotstxt" id="default" /> <label for="default" class="description" for="default"><?php \esc_html_e('The plugins default installed robots.txt file.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/default-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View the Default Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="default-alt"><?php \esc_html_e('Alternative Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="defaultalt-robotstxt" id="default-alt" /> <label for="default-alt" class="description"><?php \esc_html_e('Similar to the plugins default robots.txt file, with more disallows.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/defaultalt-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View the Alternative Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="wordpress"><?php \esc_html_e('WordPress Limited Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="wordpress-robotstxt" id="wordpress" /> <label for="wordpress" class="description"><?php \esc_html_e('Only disallows wp-includes and wp-admin.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/wordpress-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View the WordPress Limited Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="open"><?php \esc_html_e('Open Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="open-robotstxt" id="open" /> <label for="open" class="description"><?php \esc_html_e('Fully open robots.txt file, no disallows.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/open-robots.txt" target="_blank" aria-label="View <?php \esc_html_e('View an example Open Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="blogger"><?php \esc_html_e('A Bloggers Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="blogger-robotstxt" id="blogger" /> <label for="blogger" class="description"><?php \esc_html_e('Optimized for blog focused WordPress websites.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blogger-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View an example Bloggers Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="google"><?php \esc_html_e('Google Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="google-robotstxt" id="google" /> <label for="google" class="description"><?php \esc_html_e('A Google friendly robots.txt file.', 'robotstxt-manager'); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/google-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View an example Google Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="block"><?php \esc_html_e('Locked Down Robots.txt File', 'robotstxt-manager'); ?></label>
		</th>
		<td>
			<input type="radio" name="preset" value="block-robotstxt" id="block" /> <label for="block" class="description"><?php \esc_html_e('Disallow everything, prevent spiders from indexing the website.', 'robotstxt-manager'); ?> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blocked-robots.txt" target="_blank" aria-label="<?php \esc_html_e('View the Locked Down Robots.txt File', 'robotstxt-manager'); ?>">view</a>]</label></span>
		</td>
		</tr>
	</tbody>
</table>

	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php \esc_html_e('change robots.txt file', 'robotstxt-manager'); ?>"></p>
</form>

<br /><br /><hr />

<form enctype="multipart/form-data" method="post" action="">
	<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
	<h2 class="text-right text-dark font-weight-bold pb-0"><?php \esc_html_e('Delete all settings', 'robotstxt-manager'); ?></h2>
	<p class="text-right"><label class="description" for="deleteSettings"><?php \esc_html_e('WARNING: This action will delete all plugin settings.', 'robotstxt-manager'); ?></span> <input type="radio" name="action" value="delete" id="deleteSettings" /></p>
	<p class="text-right"><input type="submit" name="submit" value=" submit " onclick="return confirm('Are You Sure?');" aria-label="<?php \esc_html_e('Delete all plugin settings.', 'robotstxt-manager'); ?>" /></p>
</form>
