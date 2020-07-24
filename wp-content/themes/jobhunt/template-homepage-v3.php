<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v3
 *
 * @package jobhunt
 */

if( function_exists('jobhunt_is_wp_job_manager_activated') && jobhunt_is_wp_job_manager_activated() ) {
    remove_action( 'jobhunt_before_content', 'jobhunt_site_content_header', 10 );
    add_action( 'jobhunt_before_content', 'jobhunt_home_v3_search_block', 10 );
    add_action( 'jobhunt_home_page_header_after', 'jobhunt_home_scroll_button', 15 );
}

do_action( 'jobhunt_before_homepage_v3' );

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             * Functions hooked in to homepage action
             *
             * @hooked jobhunt_homepage_content                 - 10
             * @hooked jobhunt_home_v3_job_categories_block     - 20
             * @hooked jobhunt_home_v3_banner                   - 30
             * @hooked jobhunt_home_v3_job_list_block           - 40
             * @hooked jobhunt_home_v3_how_it_works_block       - 50
             * @hooked jobhunt_home_v3_brands_carousel          - 60
             * @hooked jobhunt_home_v3_testimonial_block        - 70
             * @hooked jobhunt_home_v3_banner_v3                - 80
             * @hooked jobhunt_home_v3_banner_v3                - 90
             * @hooked jobhunt_home_v3_job_pricing              - 100
             */
            do_action( 'jobhunt_homepage_v3' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
