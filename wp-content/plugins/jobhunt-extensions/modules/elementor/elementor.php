<?php

/**
 * Module Name          : Elementor Addons
 * Module Description   : Provides additional Elementor Elements for the jobhunt theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Jobhunt_Elementor_Extensions' ) ) {
    final class Jobhunt_Elementor_Extensions {

        /**
         * Jobhunt_Extensions The single instance of Jobhunt_Extensions.
         * @var     object
         * @access  private
         * @since   1.0.0
         */
        private static $_instance = null;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  20 );
            add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );
        }

        /**
         * Jobhunt_Elementor_Extensions Instance
         *
         * Ensures only one instance of Jobhunt_Elementor_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @return Jobhunt_Elementor_Extensions instance
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
            if ( ! defined( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR' ) ) {
                define( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_URL' ) ) {
                define( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_FILE' ) ) {
                define( 'JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_FILE', __FILE__ );
            }
        }

        /**
         * Widget Category Register
         *
         * @since  1.0.0
         * @access public
         */
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'jobhunt-elements',
                [
                    'title' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }

        /**
         * Widgets
         *
         * @since  1.0.0
         * @access public
         */
        public function elementor_widgets() {
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/about-content-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/app-promo-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/banner-with-image-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/banner.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/candidate-info-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/company-info-carousel.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/counters-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/dual-banner-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/faq-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/faq-with-testimonial-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/features-list.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/how-it-works-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/job-categories-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/job-list-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/job-list-tabs.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/job-list-with-summary-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/job-pricing-block.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/recent-posts.php';
            require_once JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/testimonial-block.php';
        }

        /**
         * Elementor Frontend Editor Scripts
         *
         * @since  1.0.0
         * @access public
         */
        public function widget_scripts() {
            if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                wp_enqueue_script( 'jobhunt-elementor', JOBHUNT_ELEMENTOR_PLUGIN_EXTENSIONS_URL . '/js/jobhunt-elementor-script.js', array( 'jquery', 'slick' ), '1.8.0', true );
            }
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Jobhunt_Elementor_Extensions::instance();
}