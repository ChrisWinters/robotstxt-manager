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

use RobotstxtManager\Trait_Option_Manager as TraitOptionManager;
use RobotstxtManager\Trait_Query_String as TraitQueryString;
use RobotstxtManager\Plugin_Admin_Notices as PluginAdminNotices;

/**
 * Save/Update Plugin Settings
 */
final class Plugin_Admin_Save {
	use TraitOptionManager;
	use TraitQueryString;

	/**
	 * Plugin Admin Post Object.
	 *
	 * @var array
	 */
	public $post_object = array();

	/**
	 * Plugin_Admin_Notices
	 *
	 * @var object
	 */
	public $action_post;

	/**
	 * Plugin_Admin_Notices
	 *
	 * @var object
	 */
	public $notices;


	/**
	 * Setup Class
	 */
	public function __construct() {
		if ( $this->query_string( 'page' ) !== ROBOTSTXT_MANAGER_PLUGIN_NAME ) {
			return;
		}

		$this->action_post = filter_input( INPUT_POST, 'action' );

		if ( true === empty( $this->action_post ) ) {
			return;
		}

		$post_object_array = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
		$this->post_object = $this->unset_post_items( $post_object_array );

		$this->notices = new PluginAdminNotices();
	}//end __construct()


	/**
	 * Init Admin Update
	 */
	public function init() {
		if ( $this->query_string( 'page' ) !== ROBOTSTXT_MANAGER_PLUGIN_NAME ) {
			return;
		}

		if ( true === empty( $this->action_post ) ) {
			return;
		}

		/*
		 * Fires as an admin screen or script is being initialized.
		 * https://developer.wordpress.org/reference/hooks/admin_init/
		 */
		add_action(
			'admin_init',
			array(
				$this,
				'update',
			)
		);
	}//end init()


	/**
	 * Update Plugin Settings
	 */
	public function update() {
		$this->security_check();

		/*
		 * Sanitizes title, replacing whitespace with dashes.
		 * Limits the output to alphanumeric characters,
		 * underscore ( _ ) and dash ( - ). Whitespace becomes a dash.
		 * https://developer.wordpress.org/reference/functions/sanitize_title_with_dashes/
		 */
		$action = sanitize_title_with_dashes( $this->action_post );

		if ( 'update' === $action ) {
			$this->update_action();
		}

		if ( 'delete' === $action ) {
			$this->delete_action();
		}

		if ( 'presets' === $action ) {
			$presets = new Plugin_Admin_Presets( $this->post_object, $this->notices );
			$presets->set_preset_robotstxt();
		}

		if ( 'cleaner' === $action ) {
			$cleaner = new Plugin_Admin_Cleaner( $this->post_object, $this->notices );
			$cleaner->cleaner_action();
		}
	}//end update()


	/**
	 * Unset Post Objects
	 *
	 * @param array $post Form Post Object.
	 *
	 * @return array|void
	 */
	public function unset_post_items( $post ) {
		unset( $post['action'] );
		unset( $post['submit'] );
		unset( $post[ ROBOTSTXT_MANAGER_SETTING_PREFIX . 'nonce' ] );
		unset( $post['_wp_http_referer'] );

		if ( true !== empty( $post ) ) {
			unset( $post['section'] );

			return $post;
		} elseif ( true === isset( $post['section'] ) && 'update' !== $post['section'] ) {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'input_error',
				)
			);
		}
	}//end unset_post_items()


	/**
	 * Update Plugin Setting
	 */
	private function update_action() {
		$message = false;

		$count = 0;

		if ( true !== empty( $this->post_object ) ) {
			$this->update_option( $this->post_object );
			$message = true;
		}

		if ( true === empty( $this->post_object ) ) {
			$this->del_option();
			$message = true;
		}

		if ( true === $message ) {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'update_success',
				)
			);
		} else {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'update_error',
				)
			);
		}
	}//end update_action()


	/**
	 * Delete Plugin Setting
	 */
	private function delete_action() {
		$this->del_option();

		if ( true === empty( $this->get_option() ) ) {
			/*
				* Prints admin screen notices.
				* https://developer.wordpress.org/reference/hooks/admin_notices/
			*/
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'delete_success',
				)
			);
		} else {
			/*
			 * Prints admin screen notices.
			 * https://developer.wordpress.org/reference/hooks/admin_notices/
			 */
			add_action(
				'admin_notices',
				array(
					$this->notices,
					'delete_error',
				)
			);
		}
	}//end delete_action()


	/**
	 * Form Validation
	 */
	private function security_check() {
		$message = __( 'You are not authorized to perform this action.', 'robotstxt-manager' );

		if ( filter_input( INPUT_GET, 'page' ) !== ROBOTSTXT_MANAGER_PLUGIN_NAME ) {
			/*
			 * Kill WordPress execution with message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 */
			wp_die( esc_html( $message ) );
		}

		/*
		 * Whether the current user has a specific capability.
		 * https://developer.wordpress.org/reference/functions/current_user_can/
		 */
		if ( false === current_user_can( 'manage_options' ) ) {
			/*
			 * Kill WordPress execution and display message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 */
			wp_die( esc_html( $message ) );
		}

		/*
		 * Makes sure that a user was referred from another admin page.
		 * https://developer.wordpress.org/reference/functions/check_admin_referer/
		 */
		if ( false === check_admin_referer(
			ROBOTSTXT_MANAGER_SETTING_PREFIX . 'action',
			ROBOTSTXT_MANAGER_SETTING_PREFIX . 'nonce'
		)
		) {
			/*
			 * Kill WordPress execution and display message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			*/
			wp_die( esc_html( $message ) );
		}
	}//end security_check()
}//end class
