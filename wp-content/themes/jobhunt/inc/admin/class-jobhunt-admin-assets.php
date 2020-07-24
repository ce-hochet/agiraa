<?php
/**
 * Load assets
 *
 * @author      CheThemes
 * @category    Admin
 * @package     Jobhunt/Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Jobhunt_Admin_Assets' ) ) :

/**
 * Jobhunt_Admin_Assets Class.
 */
class Jobhunt_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		global $jobhunt_version;

		// Register admin styles
		wp_register_style( 'jobhunt_admin_styles', get_template_directory_uri() . '/assets/css/admin/admin.css', array(), $jobhunt_version );
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/vendors/fontawesome/css/all.min.css', array(), '5.12.0' );
		
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'jobhunt_admin_styles' );
	}

	/**
	 * Enqueue scripts.
	 */
	public function admin_scripts() {
		global $jobhunt_version;

		$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'jobhunt-admin-meta-boxes', get_template_directory_uri() . '/assets/js/admin/meta-boxes' . $suffix . '.js', array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable'), $jobhunt_version );

		wp_enqueue_script( 'jobhunt-admin-meta-boxes' );
	}
}
endif;

return new Jobhunt_Admin_Assets();