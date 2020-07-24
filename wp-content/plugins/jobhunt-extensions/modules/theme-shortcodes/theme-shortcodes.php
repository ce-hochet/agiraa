<?php

/**
 * Module Name          : Theme Shortcodes
 * Module Description   : Provides additional shortcodes for the Jobhunt theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Jobhunt_Shortcodes' ) ) {
    class Jobhunt_Shortcodes {

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'init', array( $this, 'includes' ),         10 );
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
            if ( ! defined( 'JOBHUNT_EXTENSIONS_SHORTCODE_DIR' ) ) {
                define( 'JOBHUNT_EXTENSIONS_SHORTCODE_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'JOBHUNT_EXTENSIONS_SHORTCODE_URL' ) ) {
                define( 'JOBHUNT_EXTENSIONS_SHORTCODE_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'JOBHUNT_EXTENSIONS_SHORTCODE_FILE' ) ) {
                define( 'JOBHUNT_EXTENSIONS_SHORTCODE_FILE', __FILE__ );
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

            #-----------------------------------------------------------------
            # Shortcodes
            #-----------------------------------------------------------------
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/mas-faq-shortcode.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/about-content-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/app-promo-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/banner-with-image-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/banner.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/candidate-info-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/company-info-carousel.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/counters-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/dual-banner-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/faq-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/faq-with-testimonial-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/features-list.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/how-it-works-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/job-categories-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/job-list-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/job-list-tabs.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/job-list-with-summary-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/job-pricing-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/recent-posts.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/testimonial-block.php';
            require_once JOBHUNT_EXTENSIONS_SHORTCODE_DIR . '/elements/my-account.php';
        }
    }
}

// Finally initialize code
new Jobhunt_Shortcodes();