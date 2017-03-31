<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }?>

<?php if ( ! get_option( $this->option_name . 'cleaner_old_data' ) ) {?>
    <h3><?php _e( 'Check For Old Robots.txt File Settings', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'If you are having problems with a websites robots.txt file to displaying properly, it is possible that old robots.txt file data left over from other plugins is conflicting. Click the "scan for old data" button below to scan the network for left over data. If any is found, a notice will display with a new button to automatically clean out the left over data.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="check-data" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><p class="submit"><input type="submit" name="submit" id="submit" class="button" value="scan for old data"></p></div>

    </form>
<?php }

if ( get_option( $this->option_name . 'cleaner_old_data' ) ) {?>
    <h3><?php _e( 'Old Robots.txt File Settings Found', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'Click the "remove old data" button below to purge the old settings.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="clean-data" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><?php submit_button( __( 'remove old data', 'robotstxt-manager' ) );?></div>

    </form>
<?php }?>
    
    <br /><hr /><br />

<?php if ( ! get_option( $this->option_name . 'cleaner_physical' ) ) {?>
    <h3><?php _e( 'Check For Real (physical) Robots.txt File', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'If network/website changes do not appear to override the robots.txt file or if the file is blank, it is possible that a plugin created a physical (hard) robots.txt file. Click the "scan for physical file" button below to check the website for a real robots.txt file. If one is found, a notice will display with a new button allowing you to delete the file.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="check-physical" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><p class="submit"><input type="submit" name="submit" id="submit" class="button" value="scan for physical file"></p></div>

    </form>
<?php }

if ( get_option( $this->option_name . 'cleaner_physical' ) ) {?>
    <h3><?php _e( 'A Real Robots.txt File Was Found', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'Click the "delete physical file" button below to delete the real robots.txt file.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="clean-physical" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><?php submit_button( __( 'delete physical file', 'robotstxt-manager' ) );?></div>

    </form>
<?php }?>
    
    <br /><hr /><br />

<?php if ( ! get_option( $this->option_name . 'cleaner_rewrite' ) ) {?>
    <h3><?php _e( 'Check That All Websites Have The Proper Rewrite Rule', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'If your robots.txt files are blank, it is possible the website is missing the rewrite rule index.php?robots=1. Click the "scan for missing rules" button below to scan the network for the missing rule. If a website is missing the rule, a notice will display with a new button to automatically add the rule for you.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="check-rewrite" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><p class="submit"><input type="submit" name="submit" id="submit" class="button" value="scan for missing rules"></p></div>

    </form>
<?php }

if ( get_option( $this->option_name . 'cleaner_rewrite' ) ) {?>
    <h3><?php _e( 'At Least One Website Is Missing The Rewrite Rule', 'robotstxt-manager' );?></h3>
    <p><?php _e( 'Click the "add missing rule" button below to add the missing rule.', 'robotstxt-manager' );?></p>

    <form enctype="multipart/form-data" method="post" action="">
    <?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>
    <input type="hidden" name="cleaner" value="add-rewrite" />
    <input type="hidden" name="type" value="cleaner" />

        <div class="textcenter"><?php submit_button( __( 'correct missing rules', 'robotstxt-manager' ) );?></div>

    </form>
<?php }
