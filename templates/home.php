<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * Plugin Admin Home
 */
?>

<div class="postbox"><div class="inside">
<div class="inside-box"><div class="inside-pad para">

<?php echo $this->statusMessages();?>

<br />

<?php $this->echoForm( 'website', false );?>

<table class="table">
    <tr>
        <td class="textcenter" colspan="2"><?php $this->echoTextarea( $get_website_robotstxt, 65, 15, false );?></td>
    </tr>
    <tr>
        <td class="textcenter" colspan="2"><?php echo $this->echoSubmit( __( 'update website', 'robotstxt-manager' ) );?></td>
    </tr>
    <tr>
        <td class="textcenter" colspan="2"><b>.:: <?php _e( 'Rule Suggestions', 'robotstxt-manager' );?> ::.</b></td>
    </tr>

    <?php if ( ! empty( $get_upload_path ) ) {?>
    <tr>
        <td class="textright"><b><?php _e( 'Allow Upload Path', 'robotstxt-manager' );?>:</b></td>
        <td class="textcenter"><input type="text" name="upload_path" value="<?php echo $get_upload_path;?>" style="width:98%" onclick="select()" /></td>
    </tr>
    <?php }?>

    <?php if ( ! empty( $get_theme_path ) ) {?>
    <tr>
        <td class="textright"><b><?php _e( 'Allow Theme Path', 'robotstxt-manager' );?>:</b></td>
        <td class="textcenter"><input type="text" name="theme_path" value="<?php echo $get_theme_path;?>" style="width:98%" onclick="select()" /></td>
    </tr>
    <?php }?>

    <?php if ( ! empty( $get_sitemap_url ) ) {?>
        <tr>
            <td class="textright"><b><?php _e( 'Add Sitemap URL', 'robotstxt-manager' );?>:</b></td>
            <td class="textcenter"><input type="text" name="sitemap_url" value="<?php echo $get_sitemap_url;?>" style="width:98%" onclick="select()" /></td>
        </tr>
    <?php }?>
</table>

<?php $this->echoForm( false, true );?>

<?php $this->echoForm( 'settings', false ); $this->echoSettings();?>

<br /><hr /><br />

<?php $this->echoForm( 'presets', false ); $this->echoPresets();?>

<br /><hr /><br />

<?php $this->echoForm( 'status', false, true ); $this->echoRemoves();?>

</div></div><!-- end inside-box and inside-pad -->
</div></div><!-- end inside and postbox -->