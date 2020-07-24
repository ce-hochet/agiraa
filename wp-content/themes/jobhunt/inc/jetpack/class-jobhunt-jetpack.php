<?php
/**
 * Jobhunt Jetpack Class
 *
 * @package  jobhunt
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Jobhunt_Jetpack' ) ) :

    /**
     * The Jobhunt Jetpack integration class
     */
    class Jobhunt_Jetpack {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {
            add_action( 'init',          array( $this, 'jetpack_setup' ) );
            add_action( 'jobhunt_share', array( $this, 'jetpack_share' ) ) ;

            if ( jobhunt_is_woocommerce_activated() ) {
                add_action( 'init', array( $this, 'jetpack_infinite_scroll_wrapper_columns' ) );
            }
        }

        /**
         * Add theme support for Infinite Scroll.
         * See: http://jetpack.me/support/infinite-scroll/
         */
        public function jetpack_setup() {
            add_theme_support( 'infinite-scroll', apply_filters( 'jobhunt_jetpack_infinite_scroll_args', array(
                'container'      => 'main',
                'footer'         => 'page',
                'render'         => array( $this, 'jetpack_infinite_scroll_loop' ),
                'footer_widgets' => array(
                    'footer-1',
                    'footer-2',
                    'footer-3',
                    'footer-4',
                ),
            ) ) );
        }

        /**
         * A loop used to display content appended using Jetpack infinite scroll
         * @return void
         */
        public function jetpack_infinite_scroll_loop() {
            do_action( 'jobhunt_jetpack_infinite_scroll_before' );

            if ( jobhunt_is_product_archive() ) {
                do_action( 'jobhunt_jetpack_product_infinite_scroll_before' );
                woocommerce_product_loop_start();
            }

            while ( have_posts() ) : the_post();
                if ( jobhunt_is_product_archive() ) {
                    wc_get_template_part( 'content', 'product' );
                } else {
                    get_template_part( 'content', get_post_format() );
                }
            endwhile; // end of the loop.

            if ( jobhunt_is_product_archive() ) {
                woocommerce_product_loop_end();
                do_action( 'jobhunt_jetpack_product_infinite_scroll_after' );
            }

            do_action( 'jobhunt_jetpack_infinite_scroll_after' );
        }

        /**
         * Adds columns wrapper to content appended by Jetpack infinite scroll
         * @return void
         */
        public function jetpack_infinite_scroll_wrapper_columns() {
            add_action( 'jobhunt_jetpack_product_infinite_scroll_before', 'jobhunt_product_columns_wrapper' );
            add_action( 'jobhunt_jetpack_product_infinite_scroll_after', 'jobhunt_product_columns_wrapper_close' );
        }

        public function jetpack_share() {
            if ( function_exists( 'sharing_display' ) ) {
                sharing_display( '', true );
            }
             
            if ( class_exists( 'Jetpack_Likes' ) ) {
                $custom_likes = new Jetpack_Likes;
                echo wp_kses_post( $custom_likes->post_likes( '' ) );
            }
        }
    }

endif;

return new Jobhunt_Jetpack();
