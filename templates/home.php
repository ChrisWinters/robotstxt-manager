<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

// Get Plugin Status
if ( parent::status() == true ) {?>
    <h3><span class="active"><?php _e( 'The Robots.txt Manager plugin is Active!', 'robotstxt-manager' );?></span></h3>
    <p><?php _e( 'The robots.txt file below is currently being displayed on this website.', 'robotstxt-manager' );?> <?php printf( __( '<a href="%s/robots.txt" target="_blank">Click here</a> to view the customized robots.txt file.', 'robotstxt-manager' ), $this->base_url );?></p>
<?php } else {?>
    <h3><span class="inactive"><?php _e( 'The Robots.txt Manager plugin is Disabled!', 'robotstxt-manager' );?></span></h3>
    <p><?php _e( 'The default WordPress robots.txt file is currently being displayed on this website.', 'robotstxt-manager' );?> <?php printf( __( '<a href="%s/robots.txt" target="_blank">Click here</a> to view the default robots.txt file.', 'robotstxt-manager' ), $this->base_url );?></p>
<?php }?>

<form enctype="multipart/form-data" method="post" action="">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
<input type="hidden" name="type" value="update" />

    <table class="form-table">
        <tr>
            <td class="textcenter"><textarea name="robotstxt_file" cols="65" rows="15"><?php echo parent::getRobotstxt();?></textarea></td>
        </tr>
    </table>

    <div class="textcenter"><?php submit_button( __( 'update robots.txt file', 'robotstxt-manager' ) );?></div>
    
</form>

    <table class="form-table">
        <tr>
            <td class="textcenter" colspan="2"><b>.:: <?php _e( 'Rule Suggestions', 'robotstxt-manager' );?> ::.</b></td>
        </tr>
        <tr>
            <td class="td30 textright"><label><?php _e( 'Upload Path', 'robotstxt-manager' );?>:</label></td>
            <td><input type="text" name="upload_path" value="<?php echo parent::getUploadPath();?>" class="regular-text" onclick="select()"></td>
        </tr>
        <tr>
            <td class="td30 textright"><label><?php _e( 'Theme Path', 'robotstxt-manager' );?>:</label></td>
            <td><input type="text" name="theme_path" value="<?php echo parent::getThemePath();?>" class="regular-text" onclick="select()"></td>
        </tr>
        <?php if ( parent::getSitemapUrl() ) {?>
        <tr>
            <td class="td30 textright"><label><?php _e( 'Sitemap URL', 'robotstxt-manager' );?>:</label></td>
            <td><input type="text" name="sitemap_url" value="<?php echo parent::getSitemapUrl();?>" class="regular-text" onclick="select()"></td>
        </tr>
        <?php }?>
    </table>

<br /><hr /><br />

<h3><?php _e( 'Robots.txt File Presets', 'robotstxt-manager' );?></h3>
<p><?php _e( 'Select a preset robots.txt file to load and use.', 'robotstxt-manager' );?></p>

<form enctype="multipart/form-data" method="post" action="">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
<input type="hidden" name="type" value="presets" />

    <table class="form-table">
    <tr>
        <td>
            <p><input type="radio" name="preset" value="default" id="default" /> <label for="default"><?php _e( 'Default Robots.txt File: The plugins default installed robots.txt file.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="default-alt" id="default-alt" /> <label for="default-alt"><?php _e( 'Alternative Robots.txt File: Similar to the plugins default robots.txt file, with more disallows.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="wordpress" id="wordpress" /> <label for="wordpress"><?php _e( 'WordPress Limited Robots.txt File: Only disallows wp-includes and wp-admin.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="open" id="open" /> <label for="open"><?php _e( 'Open Robots.txt File: Fully open robots.txt file, no disallows.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="blogger" id="blogger" /> <label for="blogger"><?php _e( 'A Bloggers Robots.txt File: Optimized for blog focused WordPress websites.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="google" id="google" /> <label for="google"><?php _e( 'Google Robots.txt File: A Google friendly robots.txt file.', 'robotstxt-manager' );?></label></p>
            <p><input type="radio" name="preset" value="block" id="block" /> <label for="block"><?php _e( 'Lockdown Robots.txt File: Disallow everything, prevent spiders from indexing the website.', 'robotstxt-manager' );?></label></p>
        </td>
    </tr>
    </table>

    <div class="textcenter"><?php submit_button( __( 'update settings', 'robotstxt-manager' ) );?></div>

</form>

<br /><hr /><br />

<form enctype="multipart/form-data" method="post" action="">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
<input type="hidden" name="type" value="status" />

    <table class="form-table">
    <tr>
        <td>
            <p class="textright"><label><?php _e( 'Disable the Robots.txt Manager on this website, restoring the default WordPress robots.txt file.', 'robotstxt-manager' );?></label> <input type="radio" name="disable" value="website" /></p>
            <p class="textright"><label><?php _e( 'WARNING: Delete all settings related to the Robots.txt Manager plugin.', 'robotstxt-manager' );?></label> <input type="radio" name="disable" value="delete" /></p>
        </td>
    </tr>
    </table>

    <p class="textright"><input type="submit" name="submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>

</form>
