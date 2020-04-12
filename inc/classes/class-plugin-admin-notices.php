<?php
/**
 * Manager Class
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
 * Plugin Admin Area Notices
 */
final class Plugin_Admin_Notices {
	/**
	 * Plugin Admin Notices.
	 *
	 * @var array
	 */
	public $message = array();


	/**
	 * Set Class Params
	 *
	 * @return void
	 */
	public function __construct() {
		$this->message = array(
			'update_success'       => __(
				'Settings Updated.',
				'includes'
			),
			'update_error'         => __(
				'Settings Update Failed.',
				'includes'
			),
			'input_error'          => __(
				'A Selection Is Required.',
				'includes'
			),
			'delete_success'       => __(
				'Settings Deleted.',
				'includes'
			),
			'delete_fail'          => __(
				'Settings Delete Failed.',
				'includes'
			),
			'preset_success'       => __(
				'Robots.txt file updated with selected preset.',
				'includes'
			),
			'preset_error'         => __(
				'The robots.txt file was not updated.',
				'includes'
			),
			'checkdata_notice'     => __(
				'Old robots.txt file data found! Click the "remove old data" button to remove the old data.',
				'includes'
			),
			'checkdata_done'       => __(
				'No old robots.txt file data found.',
				'includes'
			),
			'checkphysical_notice' => __(
				'A real robots.txt file was found within the websites root directory. Click the "delete physical file" to delete the robots.txt file.',
				'includes'
			),
			'checkphysical_done'   => __(
				'A physical robots.txt file was not found.',
				'includes'
			),
			'checkphysical_error'  => __(
				'The plugin was unable to delete the robots.txt file due to file permissions. Manual deletion required.',
				'includes'
			),
			'checkrewrite_notice'  => __(
				'This website is missing the robots.txt Rewrite Rule. Click the "correct missing rules" button to add the missing rule.',
				'includes'
			),
			'checkrewrite_done'    => __(
				'Proper Rewrite Rule found.',
				'includes'
			),
		);
	}//end __construct()


	/**
	 * Update Success Notice
	 */
	public function update_success() {
		echo wp_kses_post( $this->success_message( $this->message['update_success'] ) );
	}//end update_success()


	/**
	 * Update Error Notice
	 */
	public function update_error() {
		echo wp_kses_post( $this->error_message( $this->message['update_error'] ) );
	}//end update_error()


	/**
	 * Invalid Input Error Notice
	 */
	public function input_error() {
		echo wp_kses_post( $this->error_message( $this->message['input_error'] ) );
	}//end input_error()


	/**
	 * Delete Success Notice
	 */
	public function delete_success() {
		echo wp_kses_post( $this->success_message( $this->message['delete_success'] ) );
	}//end delete_success()


	/**
	 * Delete Error Notice
	 */
	public function delete_error() {
		echo wp_kses_post( $this->error_message( $this->message['delete_error'] ) );
	}//end delete_error()


	/**
	 * Preset Update Success Notice
	 */
	public function preset_success() {
		echo wp_kses_post( $this->success_message( $this->message['preset_success'] ) );
	}//end preset_success()


	/**
	 * Preset Update Error Notice
	 */
	public function preset_error() {
		echo wp_kses_post( $this->error_message( $this->message['preset_error'] ) );
	}//end preset_error()


	/**
	 * Cleaner Check Data Notice
	 */
	public function checkdata_notice() {
		echo wp_kses_post( $this->success_message( $this->message['checkdata_notice'] ) );
	}//end checkdata_notice()


	/**
	 * Cleaner Check Data Done
	 */
	public function checkdata_done() {
		echo wp_kses_post( $this->success_message( $this->message['checkdata_done'] ) );
	}//end checkdata_done()


	/**
	 * Cleaner Check Physical Robots.txt Notice
	 */
	public function checkphysical_notice() {
		echo wp_kses_post( $this->success_message( $this->message['checkphysical_notice'] ) );
	}//end checkphysical_notice()


	/**
	 * Cleaner Check Physical Robots.txt Done
	 */
	public function checkphysical_done() {
		echo wp_kses_post( $this->success_message( $this->message['checkphysical_done'] ) );
	}//end checkphysical_done()


	/**
	 * Cleaner Check Physical Robots.txt Permission Error
	 */
	public function checkphysical_error() {
		echo wp_kses_post( $this->error_message( $this->message['checkphysical_error'] ) );
	}//end checkphysical_error()


	/**
	 * Cleaner Check Rewrite Rules Notice
	 */
	public function checkrewrite_notice() {
		echo wp_kses_post( $this->success_message( $this->message['checkrewrite_notice'] ) );
	}//end checkrewrite_notice()


	/**
	 * Cleaner Check Rewrite Rules Done
	 */
	public function checkrewrite_done() {
		echo wp_kses_post( $this->success_message( $this->message['checkrewrite_done'] ) );
	}//end checkrewrite_done()


	/**
	 * Success Message HTML
	 *
	 * @param string $message The Notice To Display.
	 *
	 * @return html
	 */
	public function success_message( $message ) {
		return '<div class="notice notice-success is-dismissible"><p>' . $message . '</p></div>';
	}//end success_message()


	/**
	 * Error Message HTML
	 *
	 * @param string $message The Notice To Display.
	 *
	 * @return html
	 */
	public function error_message( $message ) {
		return '<div class="notice notice-error is-dismissible"><p>' . $message . '</p></div>';
	}//end error_message()

}//end class
