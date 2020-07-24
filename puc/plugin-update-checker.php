<?php
/**
 * Plugin Update Checker Library 4.9
 * http://w-shadow.com/
 *
 * Copyright 2017 Janis Elsts
 * Released under the MIT license. See license.txt for details.
 *
 * @package Puc
 */

require dirname( __FILE__ ) . '/v4p9/Autoloader.php';
new Puc_v4p9_Autoloader();

require dirname( __FILE__ ) . '/v4p9/Factory.php';
require dirname( __FILE__ ) . '/v4/Factory.php';

foreach (
	array(
		'Plugin_UpdateChecker'    => 'Puc_v4p9_Plugin_UpdateChecker',
		'Theme_UpdateChecker'     => 'Puc_v4p9_Theme_UpdateChecker',
		'Vcs_PluginUpdateChecker' => 'Puc_v4p9_Vcs_PluginUpdateChecker',
		'Vcs_ThemeUpdateChecker'  => 'Puc_v4p9_Vcs_ThemeUpdateChecker',
		'GitHubApi'               => 'Puc_v4p9_Vcs_GitHubApi',
		'BitBucketApi'            => 'Puc_v4p9_Vcs_BitBucketApi',
		'GitLabApi'               => 'Puc_v4p9_Vcs_GitLabApi',
	)
	as $puc_general_class => $puc_versioned_class
) {
	Puc_v4_Factory::addVersion( $puc_general_class, $puc_versioned_class, '4.9' );
	Puc_v4p9_Factory::addVersion( $puc_general_class, $puc_versioned_class, '4.9' );
}
