<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: About Us
 *
 * @package jobhunt
 */

do_action( 'jobhunt_before_aboutpage' );

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             * Functions hooked in to homepage action
             *
             * @hooked jobhunt_about_about_content              - 20
             * @hooked jobhunt_about_features_list_block        - 30
             * @hooked jobhunt_about_testimonial_block          - 40
             * @hooked jobhunt_about_counters_block             - 50
             * @hooked jobhunt_about_recent_posts               - 60
             */
            do_action( 'jobhunt_aboutpage' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php

get_footer();
