<?php
/**
 * Class Trait
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

/**
 * Get and Set Plugin Options
 */
trait Trait_Option_Manager {
	/**
	 * Get Option Data
	 *
	 * @return array
	 */
	public function get_option() {
		/*
		 * Retrieves an option value based on an option name.
		 * https://developer.wordpress.org/reference/functions/get_option/
		 */
		$get_option = get_option( ROBOTSTXT_MANAGER_PLUGIN_NAME );

		if ( true !== empty( $get_option ) ) {
			return $get_option;
		}

		return [];
	}//end get_option()


	/**
	 * Get Option Setting
	 *
	 * @param mixed $setting_name Name Of Option To Get.
	 *
	 * @return string
	 */
	public function get_setting( $setting_name ) {
		$get_option = $this->get_option();

		if ( true === isset( $get_option[ $setting_name ] ) ) {
			return $get_option[ $setting_name ];
		}

		return false;
	}//end get_setting()


	/**
	 * Update Option Array
	 *
	 * @param mixed $option_array Prepared Option Array.
	 *
	 * @return void
	 */
	public function update_option( $option_array ) {
		if ( false === $this->validate_update() ) {
			return;
		}

		/*
		 * Update the value of an option that was already added.
		 * https://developer.wordpress.org/reference/functions/update_option/
		 */
		update_option(
			ROBOTSTXT_MANAGER_PLUGIN_NAME,
			$option_array
		);
	}//end update_option()


	/**
	 * Update Setting Within Option
	 *
	 * @param mixed $setting_name  Name Of Option To Save.
	 * @param mixed $setting_value The Value To Save.
	 */
	public function update_setting( $setting_name, $setting_value ) {
		if ( false === $this->validate_update() ) {
			return;
		}

		$get_option = $this->get_option();

		if ( true !== empty( $get_option[ $setting_name ] ) ) {
			unset( $get_option[ $setting_name ] );
		}

		$get_option[ $setting_name ] = $setting_value;

		$this->update_option( $get_option );
	}//end update_setting()


	/**
	 * Delete Option
	 *
	 * @return void
	 */
	public function del_option() {
		if ( false === $this->validate_update() ) {
			return;
		}

		$get_option = $this->get_option();

		if ( true === isset( $get_option ) ) {
			delete_option( ROBOTSTXT_MANAGER_PLUGIN_NAME );
		}
	}//end del_option()


	/**
	 * Delete Option Setting
	 *
	 * @param mixed $setting_name Name Of Option To Delete.
	 *
	 * @return void
	 */
	public function del_setting( $setting_name ) {
		if ( false === $this->validate_update() ) {
			return;
		}

		$get_option = $this->get_option();

		if ( true === isset( $get_option[ $setting_name ] ) ) {
			unset( $get_option[ $setting_name ] );
		}

		if ( true !== empty( $get_option ) ) {
			/*
			 * Update the value of an option that was already added.
			 * https://developer.wordpress.org/reference/functions/update_option/
			 */
			update_option(
				ROBOTSTXT_MANAGER_PLUGIN_NAME,
				$get_option
			);
		}

		if ( true === empty( $get_option ) ) {
			$this->del_option();
		}
	}//end del_setting()


	/**
	 * Get All Saved Plugin Options
	 *
	 * @return array
	 */
	public function all_options() {
		$options = [];

		$get_option = $this->get_option();

		if ( true !== empty( $get_option ) ) {
			$options = $get_option;
		}

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			/*
			 * Loads and caches all autoloaded options, if available or all options.
			 * https://developer.wordpress.org/reference/functions/wp_load_all_options/
			 */
			$loaded_options = wp_load_alloptions();

			foreach ( $loaded_options as $name => $value ) {
				if ( false !== stristr( $name, ROBOTSTXT_MANAGER_SETTING_PREFIX ) ) {
					$options[ $name ] = $value;
				}

				if ( false !== stristr( $name, 'Fs_' ) ) {
					$options[ $name ] = $value;
				}
			}
		}

		return $options;
	}//end all_options()


	/**
	 * Admin Area / Admin Level User Only
	 *
	 * @return array
	 */
	private function validate_update() {
		$status = true;

		/*
		 * Determines whether the current request is for an administrative interface page.
		 * https://developer.wordpress.org/reference/functions/is_admin/
		 *
		 * Whether the current user has a specific capability.
		 * https://developer.wordpress.org/reference/functions/current_user_can/
		 */
		if ( false === is_admin() || false === current_user_can( 'manage_options' ) ) {
			$status = false;
		}

		return $status;
	}
}//end class
