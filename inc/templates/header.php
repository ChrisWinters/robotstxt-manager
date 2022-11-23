<?php
/**
 * Plugin Admin Template.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap">
<h2><span class="dashicons dashicons-admin-site-alt3 mt-1 pt-1"></span> <?php \esc_html_e('Robots.txt Manager', 'robotstxt-manager'); ?> &#8594; <small><?php \esc_html_e('A Simple Robots.txt Manager Plugin For WordPress.', 'robotstxt-manager'); ?></small></h2>


<?php
echo \wp_kses_post($this->tabs());
?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2"><div id="post-body-content">
<div class="postbox"><div class="inside">
