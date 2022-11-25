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
<h2><?php \esc_html_e('Plugin settings', 'robotstxt-manager'); ?></h2>
<hr />

<section>
<form enctype="multipart/form-data" method="post" action="<?php echo \admin_url('options-general.php?page=robotstxt-manager&tab=settings#notice'); ?>">
<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
<input type="hidden" name="action" value="update" />
	<h3><?php \esc_html_e('Saved robots.txt file', 'robotstxt-manager'); ?></h3>
	<p class="description"><?php \esc_html_e('Displaying the currently saved robots.txt file. Saving an empty file will restore the default WordPress robots.txt file.', 'robotstxt-manager'); ?></p>
	<p class="description pb-4"><a href="<?php \esc_url(\get_bloginfo('url')); ?>/robots.txt" target="_blank"><?php \esc_html_e('View this websites current robots.txt file', 'robotstxt-manager'); ?></a></p>
	<textarea name="robotstxt" cols="65" rows="20" class="form-control" aria-label="<?php echo (true === empty($this->getSetting('robotstxt'))) ? \esc_html__('No robots.txt file is currently saved.', 'robotstxt-manager') : \esc_html__('Displaying the currently saved robots.txt file.', 'robotstxt-manager'); ?>"><?php echo \esc_html($this->getSetting('robotstxt')); ?></textarea>
	<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php \esc_html_e('save robots.txt file changes', 'robotstxt-manager'); ?>"></p>
</form>
</section>

<section>
	<h3 class="pl-0">
		<?php \esc_html_e('Recommended robots.txt file rules', 'robotstxt-manager'); ?>
	</h3>

	<p class="description"><?php \esc_html_e('To help ensure the entire website is indexed by search engines; Copy and paste the rules below into the above robots.txt file.', 'robotstxt-manager'); ?></p>

	<div class="my-3">
		<label class="form-label fw-bold" for="uploadPath"><?php \esc_html_e('Media upload path', 'robotstxt-manager'); ?></label>
		<input type="text" name="upload_path" value="<?php echo \esc_html($this->uploadPath); ?>" id="uploadPath" class="form-control" onclick="select()" />
	</div>
	<div class="mb-3">
		<label class="form-label fw-bold" for="themePath"><?php \esc_html_e('Current themes path', 'robotstxt-manager'); ?></label>
		<input type="text" name="theme_path" value="<?php echo \esc_html($this->themePath); ?>" id="themePath" class="form-control" onclick="select()" />
	</div>
	<div class="mb-3">
		<label class="form-label fw-bold" for="sitemapUrl"><?php \esc_html_e('Sitemap URL', 'robotstxt-manager'); ?></label>
		<input type="text" name="sitemap_url" value="<?php echo \esc_html($this->sitemapUrl); ?>" id="sitemapUrl" class="form-control" onclick="select()" />
	</div>
</section>

<section class="mt-4">
<form enctype="multipart/form-data" method="post" action="<?php echo \admin_url('options-general.php?page=robotstxt-manager&tab=settings#notice'); ?>">
	<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
<input type="hidden" name="action" value="presets" />
	<h3>
		<?php \esc_html_e('Robots.txt file presets', 'robotstxt-manager'); ?>
	</h3>

	<p class="description" id="presets"><?php \esc_html_e('Select a predefined robots.txt file to load and use.', 'robotstxt-manager'); ?></p>

	<ul class="list-group p-0">
	<li class="list-group-item my-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="default-robotstxt" id="default">
		<label class="form-check-label fw-bold" for="default">
			<?php \esc_html_e('Default Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/default-robots.txt" target="_blank"><?php \esc_html_e('View the default robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="defaultalt-robotstxt" id="alternative">
		<label class="form-check-label fw-bold" for="alternative">
			<?php \esc_html_e('Alternative Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/defaultalt-robots.txt" target="_blank"><?php \esc_html_e('View the alternative robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="wordpress-robotstxt" id="wordpress">
		<label class="form-check-label fw-bold" for="wordpress">
			<?php \esc_html_e('WordPress Limited Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/wordpress-robots.txt" target="_blank"><?php \esc_html_e('View the WordPress robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="open-robotstxt" id="open">
		<label class="form-check-label fw-bold" for="open">
			<?php \esc_html_e('Open Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/open-robots.txt" target="_blank"><?php \esc_html_e('View the fully open robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="" id="blogger">
		<label class="form-check-label fw-bold" for="blogger">
			<?php \esc_html_e('A Bloggers Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blogger-robots.txt" target="_blank"><?php \esc_html_e('View the bloggers robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="google-robotstxt" id="google">
		<label class="form-check-label fw-bold" for="google">
			<?php \esc_html_e('Google Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/google-robots.txt" target="_blank"><?php \esc_html_e('View the Google friendly robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="block-robotstxt" id="block">
		<label class="form-check-label fw-bold" for="block">
			<?php \esc_html_e('Locked Down Robots.txt File', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="../wp-content/plugins/robotstxt-manager/assets/examples/blocked-robots.txt" target="_blank"><?php \esc_html_e('View the locked down robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>
	</ul>
	<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php \esc_html_e('update saved robots.txt file', 'robotstxt-manager'); ?>"></p>
</form>
</section>

<section class="mt-5 pt-5 border-top">
<form enctype="multipart/form-data" method="post" action="">
	<?php
\wp_nonce_field(
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'action',
    ROBOTSTXT_MANAGER_SETTING_PREFIX.'nonce'
);
?>
	<h2><?php \esc_html_e('Delete all plugin settings', 'robotstxt-manager'); ?></h2>

	<div class="form-check mb-3">
		<input class="form-check-input my-0" name="action" type="checkbox" value="delete" id="delete">
		<label class="form-check-label fw-bold" for="delete">
			<?php \esc_html_e('WARNING: This action cannot be undone.', 'robotstxt-manager'); ?></span>
		</label>
	</div>

	<p><input type="submit" name="submit" value=" submit " class="btn btn-secondary" onclick="return confirm('Are You Sure?');" aria-label="<?php \esc_html_e('Delete all plugin settings.', 'robotstxt-manager'); ?>" /></p>
</form>
</section>
