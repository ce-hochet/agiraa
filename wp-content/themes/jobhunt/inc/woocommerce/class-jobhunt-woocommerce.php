<?php
/**
 * Jobhunt WooCommerce Class
 *
 * @package  jobhunt
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Jobhunt_WooCommerce' ) ) :

	/**
	 * The Jobhunt WooCommerce Integration class
	 */
	class Jobhunt_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'body_class',                               array( $this, 'woocommerce_body_class' ) );
			add_action( 'wp_enqueue_scripts',                       array( $this, 'woocommerce_scripts' ),	20 );
			add_filter( 'woocommerce_enqueue_styles',               '__return_empty_array' );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_product_thumbnails_columns',   array( $this, 'thumbnail_columns' ) );
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this, 'change_breadcrumb_delimiter' ) );
			add_action( 'jobhunt_sidebar_args',						array( $this, 'sidebar_register' ) );
		}

		/**
		 * Assign styles to individual theme mod.
		 *
		 * @deprecated 2.3.1
		 * @since 2.1.0
		 * @return void
		 */
		public function set_jobhunt_style_theme_mods() {
			if ( function_exists( 'wc_deprecated_function' ) ) {
				wc_deprecated_function( __FUNCTION__, '2.3.1' );
			} else {
				_deprecated_function( __FUNCTION__, '2.3.1' );
			}
		}

		/**
		 * Add 'woocommerce-active' class to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			if ( jobhunt_is_woocommerce_activated() ) {
				$classes[] = 'woocommerce-active';
			}

			return $classes;
		}

		/**
		 * WooCommerce specific scripts & stylesheets
		 *
		 * @since 1.0.0
		 */
		public function woocommerce_scripts() {
			global $jobhunt_version;

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'jobhunt-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', array(), $jobhunt_version );
			wp_style_add_data( 'jobhunt-woocommerce-style', 'rtl', 'replace' );

			wp_register_script( 'jobhunt-header-cart', get_template_directory_uri() . '/assets/js/woocommerce/header-cart' . $suffix . '.js', array(), $jobhunt_version, true );
			wp_enqueue_script( 'jobhunt-header-cart' );

			if ( ! class_exists( 'Jobhunt_Sticky_Add_to_Cart' ) && is_product() ) {
				wp_register_script( 'jobhunt-sticky-add-to-cart', get_template_directory_uri() . '/assets/js/sticky-add-to-cart' . $suffix . '.js', array(), $jobhunt_version, true );
			}
		}

		/**
		 * Related Products Args
		 *
		 * @param  array $args related products args.
		 * @since 1.0.0
		 * @return  array $args related products args
		 */
		public function related_products_args( $args ) {
			$args = apply_filters( 'jobhunt_related_products_args', array(
				'posts_per_page' => 3,
				'columns'        => 3,
			) );

			return $args;
		}

		/**
		 * Product gallery thumbnail columns
		 *
		 * @return integer number of columns
		 * @since  1.0.0
		 */
		public function thumbnail_columns() {
			$columns = 4;

			if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$columns = 5;
			}

			return intval( apply_filters( 'jobhunt_product_thumbnail_columns', $columns ) );
		}

		/**
		 * Query WooCommerce Extension Activation.
		 *
		 * @param string $extension Extension class name.
		 * @return boolean
		 */
		public function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
			return class_exists( $extension ) ? true : false;
		}

		/**
		 * Remove the breadcrumb delimiter
		 * @param  array $defaults The breadcrumb defaults
		 * @return array           The breadcrumb defaults
		 * @since 2.2.0
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter']   = '<span class="breadcrumb-separator"> / </span>';
			$defaults['wrap_before'] = '<div class="jobhunt-breadcrumb"><div class="col-full"><nav class="woocommerce-breadcrumb">';
			$defaults['wrap_after']  = '</nav></div></div>';
			return $defaults;
		}

		public function sidebar_register( $sidebar_args ) {
             $sidebar_args['sidebar_shop'] = array(
                'name'        => esc_html__( 'Shop Sidebar', 'jobhunt' ),
                'id'          => 'sidebar-shop',
                'description' => esc_html__( 'Widgets added to this region will appear in the shop page.', 'jobhunt' ),
            );
             return $sidebar_args;
        }
	}

endif;

return new Jobhunt_WooCommerce();
