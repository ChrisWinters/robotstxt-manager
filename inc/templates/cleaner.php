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

</form>
