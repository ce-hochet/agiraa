<?php
/**
 * Plugin Name:    	Jobhunt Extensions
 * Plugin URI:     	https://themeforest.net/item/jobhunt-job-board-wordpress-theme-for-wp-job-manager/22563674
 * Description:    	This selection of extensions compliment our lean and mean theme for WP Job Manager, jobhunt. Please note: they don’t work with any WordPress theme, just jobhunt.
 * Author:         	MadrasThemes
 * Author URI:     	https://madrasthemes.com/
 * Version:        	1.2.4
 * Text Domain: 	jobhunt-extensions
 * Domain Path: 	/languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Jobhunt_Extensions' ) ) {
	/**
	 * Main Jobhunt_Extensions Class
	 *
	 * @class Jobhunt_Extensions
	 * @version	1.0.0
	 * @since 1.0.0
	 * @package	Jobhunt
	 * @author MadrasThemes
	 */
	final class Jobhunt_Extensions {
		/**
		 * Jobhunt_Extensions The single instance of Jobhunt_Extensions.
		 * @var 	object
		 * @access  private
		 * @since 	1.0.0
		 */
		private static $_instance = null;

		/**
		 * The token.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $token;

		/**
		 * The version number.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $version;

		/**
		 * Constructor function.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function __construct () {

			$this->token 	= 'jobhunt-extensions';
			$this->version 	= '1.0.0';

			add_action( 'plugins_loaded', array( $this, 'setup_constants' ),		10 );
			add_action( 'plugins_loaded', array( $this, 'includes' ),				20 );
			// add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ),	30 );
		}

		/**
		 * Main Jobhunt_Extensions Instance
		 *
		 * Ensures only one instance of Jobhunt_Extensions is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see Jobhunt_Extensions()
		 * @return Main Jobhunt instance
		 */
		public static function instance () {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function setup_constants() {

			// Plugin Folder Path
			if ( ! defined( 'JOBHUNT_EXTENSIONS_DIR' ) ) {
				define( 'JOBHUNT_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'JOBHUNT_EXTENSIONS_URL' ) ) {
				define( 'JOBHUNT_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'JOBHUNT_EXTENSIONS_FILE' ) ) {
				define( 'JOBHUNT_EXTENSIONS_FILE', __FILE__ );
			}

			// Modules File
			if ( ! defined( 'JOBHUNT_MODULES_DIR' ) ) {
				define( 'JOBHUNT_MODULES_DIR', JOBHUNT_EXTENSIONS_DIR . '/modules' );
			}
		}

		/**
		 * Include required files
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function includes() {
			require JOBHUNT_EXTENSIONS_DIR . '/includes/functions.php';

			#-----------------------------------------------------------------
			# Post Formats
			#-----------------------------------------------------------------
			// require_once JOBHUNT_MODULES_DIR . '/post-formats/post-formats.php';

			#-----------------------------------------------------------------
			# Static Block Post Type
			#-----------------------------------------------------------------
			require_once JOBHUNT_MODULES_DIR . '/post-types/static-block/static-block.php';

			require_once JOBHUNT_MODULES_DIR . '/wp-job-manager/class-jh-wpjm-job-manager.php';

			#-----------------------------------------------------------------
			# Mas Faq Post Type
			#-----------------------------------------------------------------

			require_once JOBHUNT_MODULES_DIR . '/post-types/mas-faq/mas-faq.php';

			#-----------------------------------------------------------------
			# Theme Shortcodes
			#-----------------------------------------------------------------
			require_once JOBHUNT_MODULES_DIR . '/theme-shortcodes/theme-shortcodes.php';
			#-----------------------------------------------------------------
			# King Composer Extensions
			#-----------------------------------------------------------------
			require_once JOBHUNT_MODULES_DIR . '/kingcomposer/kingcomposer.php';

			#-----------------------------------------------------------------
			# Elementor Extensions
			#-----------------------------------------------------------------
			require_once JOBHUNT_MODULES_DIR . '/elementor/elementor.php';

		}

		/**
		 * Cloning is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __clone () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'jobhunt-extensions' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __wakeup () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'jobhunt-extensions' ), '1.0.0' );
		}
	}
}

/**
 * Returns the main instance of Jobhunt_Extensions to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Jobhunt_Extensions
 */
function Jobhunt_Extensions() {
	return Jobhunt_Extensions::instance();
}

/**
 * Initialise the plugin
 */
Jobhunt_Extensions();
