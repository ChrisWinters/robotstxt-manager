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
<h2><?php \esc_html_e('Plugin settings', 'robotstxt-manager'); ?></h2>
<hr />

<section>
<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);
?>
<input type="hidden" name="action" value="robotstxt" />
<input type="hidden" name="tab" value="settings" />
	<h3><?php \esc_html_e('Saved robots.txt file', 'robotstxt-manager'); ?></h3>
	<p class="description"><?php \esc_html_e('Displaying the currently saved robots.txt file. Saving an empty file will restore the default WordPress robots.txt file.', 'robotstxt-manager'); ?></p>
	<p class="description pb-4"><a href="<?php \esc_url(\get_bloginfo('url')); ?>/robots.txt"><?php \esc_html_e('View this websites current robots.txt file', 'robotstxt-manager'); ?></a></p>
	<textarea name="robotstxt" cols="65" rows="20" class="form-control" aria-label="<?php echo (true === empty(\RobotstxtManager\option\setting('robotstxt'))) ? \esc_html__('No robots.txt file is currently saved.', 'robotstxt-manager') : \esc_html__('Displaying the currently saved robots.txt file.', 'robotstxt-manager'); ?>"><?php echo \esc_html(\RobotstxtManager\option\setting('robotstxt')); ?></textarea>
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
		<input type="text" name="upload_path" value="<?php echo \esc_html(\RobotstxtManager\PluginAdmin\View\getUploadPath()); ?>" id="uploadPath" class="form-control" onclick="select()" />
	</div>
	<div class="mb-3">
		<label class="form-label fw-bold" for="themePath"><?php \esc_html_e('Current themes path', 'robotstxt-manager'); ?></label>
		<input type="text" name="theme_path" value="<?php echo \esc_html(\RobotstxtManager\PluginAdmin\View\getThemePath()); ?>" id="themePath" class="form-control" onclick="select()" />
	</div>
	<div class="mb-3">
		<label class="form-label fw-bold" for="sitemapUrl"><?php \esc_html_e('Sitemap URL', 'robotstxt-manager'); ?></label>
		<input type="text" name="sitemap_url" value="<?php echo \esc_html(\RobotstxtManager\PluginAdmin\View\getSitemapUrl()); ?>" id="sitemapUrl" class="form-control" onclick="select()" />
	</div>
</section>

<section class="mt-4">
<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
	<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);
?>
<input type="hidden" name="action" value="preset" />
<input type="hidden" name="tab" value="settings" />
	<h3>
		<?php \esc_html_e('Robots.txt file presets', 'robotstxt-manager'); ?>
	</h3>

	<p class="description" id="presets"><?php \esc_html_e('Select a predefined robots.txt file to load and use.', 'robotstxt-manager'); ?></p>

	<ul class="list-group p-0">
	<li class="list-group-item my-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="simplified" id="simplified">
		<label class="form-check-label fw-bold" for="simplified">
			<?php \esc_html_e('Simplified robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'simplified'); ?>"><?php \esc_html_e('View the simplified robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="alternative" id="alternative">
		<label class="form-check-label fw-bold" for="alternative">
			<?php \esc_html_e('Alternative robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'alternative'); ?>"><?php \esc_html_e('View the alternative robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>
	<tr>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="wordpress" id="wordpress">
		<label class="form-check-label fw-bold" for="wordpress">
			<?php \esc_html_e('WordPress robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'wordpress'); ?>"><?php \esc_html_e('View the WordPress robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="open" id="open">
		<label class="form-check-label fw-bold" for="open">
			<?php \esc_html_e('Open robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'open'); ?>"><?php \esc_html_e('View the fully open robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="blogger" id="blogger">
		<label class="form-check-label fw-bold" for="blogger">
			<?php \esc_html_e('Blogger friendly robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'blogger'); ?>"><?php \esc_html_e('View the bloggers robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="google" id="google">
		<label class="form-check-label fw-bold" for="google">
			<?php \esc_html_e('Google friendly robots.txt file', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'google'); ?>"><?php \esc_html_e('View the Google friendly robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>

	<li class="list-group-item mb-3">
		<input class="form-check-input me-1" name="preset" type="radio" value="blocked" id="blocked">
		<label class="form-check-label fw-bold" for="blocked">
			<?php \esc_html_e('Disallow entire website', 'robotstxt-manager'); ?> <span class="d-block d-sm-inline-block fw-normal">[<a href="<?php echo site_url(\RobotstxtManager\settings('preset_viewer').'blocked'); ?>"><?php \esc_html_e('View the locked down robots.txt file', 'robotstxt-manager'); ?></a>]</span></span>
		</label>
	</li>
	</ul>
	<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php \esc_html_e('update saved robots.txt file', 'robotstxt-manager'); ?>"></p>
</form>
</section>

<section class="mt-5 pt-5 border-top">
<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
	<?php
\wp_nonce_field(
    'robotstxt_manager_action',
    'robotstxt_manager_nonce'
);
?>
<input type="hidden" name="action" value="delete" />
<input type="hidden" name="tab" value="settings" />

	<h2><?php \esc_html_e('Delete all plugin settings', 'robotstxt-manager'); ?></h2>

	<div class="form-check mb-3">
		<input class="form-check-input my-0" type="checkbox" name="confirm" value="delete" id="confirm">
		<label class="form-check-label fw-bold" for="confirm">
			<?php \esc_html_e('WARNING: This action cannot be undone.', 'robotstxt-manager'); ?></span>
		</label>
	</div>

	<p><input type="submit" name="submit" value=" submit " class="btn btn-secondary" aria-label="<?php \esc_html_e('Delete all plugin settings.', 'robotstxt-manager'); ?>" /></p>
</form>
</section>