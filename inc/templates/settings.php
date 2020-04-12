<?php
/**
 * Plugin Admin Template
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace RobotstxtManager;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Retrieve the translation of $text and escapes it for safe use in HTML output.
 * https://developer.wordpress.org/reference/functions/esc_html__/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 *
 * Echoes a submit button, with provided text and appropriate class( es ).
 * https://developer.wordpress.org/reference/functions/submit_button/
 */
?>
<form enctype="multipart/form-data" method="post" action="">
<?php
/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 */
wp_nonce_field(
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'action',
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'nonce'
);

// Get Saved Robots.txt File.
$robotstxt_manager_robotstxt_file = $this->get_setting( 'robotstxt' );
?>
<input type="hidden" name="action" value="update" />

<table class="form-table">
	<tbody>
		<tr>
		<td>
			<div class="text-dark font-weight-bold p-0 m-0 h5"><?php esc_html_e( 'Saved Robots.txt File', 'robotstxt-manager' ); ?></div>
			<p class="description">&bull; <a href="<?php esc_url( get_bloginfo( 'url' ) ); ?>/robots.txt" target="_blank"><?php esc_html_e( 'View robots.txt file', 'robotstxt-manager' ); ?></p>
		</td>
		</tr>
		<tr>
		<td>
			<textarea name="robotstxt" cols="65" rows="20" class="w-100"><?php echo esc_html( $this->get_setting( 'robotstxt' ) ); ?></textarea><br />
			<span class="description small"><?php esc_html_e( 'Saving an empty robots.txt file will restore the default WordPress robots.txt file.', 'robotstxt-manager' ); ?></span>
		</td>
		</tr>
	</tbody>
</table>

<?php submit_button( esc_html__( 'update robots.txt file', 'robotstxt-manager' ) ); ?>

</form>

<table class="form-table">
	<tbody>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 m-0 h6"><?php esc_html_e( 'Manual Rule Suggestions', 'robotstxt-manager' ); ?></div>
			<p class="description"><?php esc_html_e( 'The rules below will need to be manually added to the end of the robots.txt file.', 'robotstxt-manager' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Upload Path', 'robotstxt-manager' ); ?></label></th>
		<td><input type="text" name="upload_path" value="<?php echo esc_html( $this->uploadpath ); ?>" class="regular-text" onclick="select()" /></td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Theme Path', 'robotstxt-manager' ); ?></label></th>
		<td><input type="text" name="theme_path" value="<?php echo esc_html( $this->themepath ); ?>" class="regular-text" onclick="select()" /></td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Sitemap URL', 'robotstxt-manager' ); ?></label></th>
		<td><input type="text" name="sitemap_url" value="<?php echo esc_html( $this->sitemapurl ); ?>" class="regular-text" onclick="select()" /></td>
		</tr>
	</tbody>
</table>

<hr />

<form enctype="multipart/form-data" method="post" action="">
<?php
/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 */
wp_nonce_field(
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'action',
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'nonce'
);
?>
<input type="hidden" name="action" value="presets" />

<table class="form-table">
	<tbody>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 m-0 h5"><?php esc_html_e( 'Robots.txt File Presets', 'robotstxt-manager' ); ?></div>
			<p class="description"><?php esc_html_e( 'Select a preset robots.txt file to load and use.', 'robotstxt-manager' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row"><label for="default"><?php esc_html_e( 'Default Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="default-robotstxt" id="default" /> <span class="description"><?php esc_html_e( 'The plugins default installed robots.txt file.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/default-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="default-alt"><?php esc_html_e( 'Alternative Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="defaultalt-robotstxt" id="default-alt" /> <span class="description"><?php esc_html_e( 'Similar to the plugins default robots.txt file, with more disallows.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/defaultalt-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="wordpress"><?php esc_html_e( 'WordPress Limited Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="wordpress-robotstxt" id="wordpress" /> <span class="description"><?php esc_html_e( 'Only disallows wp-includes and wp-admin.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/wordpress-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="open"><?php esc_html_e( 'Open Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="open-robotstxt" id="open" /> <span class="description"><?php esc_html_e( 'Fully open robots.txt file, no disallows.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/open-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="blogger"><?php esc_html_e( 'A Bloggers Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="blogger-robotstxt" id="blogger" /> <span class="description"><?php esc_html_e( 'Optimized for blog focused WordPress websites.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blogger-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="google"><?php esc_html_e( 'Google Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="google-robotstxt" id="google" /> <span class="description"><?php esc_html_e( 'A Google friendly robots.txt file.', 'robotstxt-manager' ); ?></span> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/google-robots.txt" target="_blank">view</a>]</span></td>
		</tr>
		<tr>
		<th scope="row"><label for="block"><?php esc_html_e( 'Lockdown Robots.txt File', 'robotstxt-manager' ); ?></label></th>
		<td><input type="radio" name="preset" value="block-robotstxt" id="block" /> <span class="description"><?php esc_html_e( 'Disallow everything, prevent spiders from indexing the website.', 'robotstxt-manager' ); ?> <span class="small">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blocked-robots.txt" target="_blank">view</a>]</span></span></td>
		</tr>
	</tbody>
</table>

<?php submit_button( esc_html__( 'change robots.txt file', 'robotstxt-manager' ) ); ?>

</form>

<br /><br /><hr />

<form enctype="multipart/form-data" method="post" action="">
<?php
/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 */
wp_nonce_field(
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'action',
	ROBOTSTXT_MANAGER_SETTING_PREFIX . 'nonce'
);
?>
<table class="form-table">
	<tbody>
		<tr>
		<td class="text-right"><span class="description"><?php esc_html_e( 'WARNING: Delete all settings related to the Robots.txt Manager plugin.', 'robotstxt-manager' ); ?></span> <input type="radio" name="action" value="delete" /></td>
		</tr>
	</tbody>
</table>

<p class="textright"><input type="submit" name="submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>
