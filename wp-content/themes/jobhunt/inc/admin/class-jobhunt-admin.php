<?php
/**
 * Jobhunt Admin Class
 *
 * @author   WooThemes
 * @package  jobhunt
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Jobhunt_Admin' ) ) :
	/**
	 * The Jobhunt admin class
	 */
	class Jobhunt_Admin {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );
			add_action( 'admin_menu', array( $this, 'add_custom_css_page' ) );
		}

		/**
		 * Include any classes we need within admin
		 */
		public function includes() {
			include_once get_template_directory() . '/inc/admin/jobhunt-admin-functions.php';
			include_once get_template_directory() . '/inc/admin/jobhunt-meta-box-functions.php';
			include_once get_template_directory() . '/inc/admin/class-jobhunt-admin-meta-boxes.php';
			include_once get_template_directory() . '/inc/admin/class-jobhunt-admin-assets.php';

			$this->load_meta_boxes();
		}

		public function load_meta_boxes() {
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-page.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-home-v1.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-home-v2.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-home-v3.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-home-v4.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-home-v5.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-jobhunt-meta-box-about.php';
		}

		public function add_custom_css_page() {
			if ( apply_filters( 'jobhunt_should_add_custom_css_page', false ) ) {
				add_theme_page( 'Custom Color CSS', 'Custom Color CSS', 'manage_options', 'custom-primary-color-css-page', 'jobhunt_custom_primary_color_page' );
			}
		}
	}

endif;

return new Jobhunt_Admin();
