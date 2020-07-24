<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v2
 *
 * @package jobhunt
 */

if( function_exists('jobhunt_is_wp_job_manager_activated') && jobhunt_is_wp_job_manager_activated() ) {
    remove_action( 'jobhunt_before_content', 'jobhunt_site_content_header', 10 );
    add_action( 'jobhunt_before_content', 'jobhunt_home_v2_search_block', 10 );
    add_action( 'jobhunt_job_header_search_block_after', 'jobhunt_home_v2_job_categories_block', 10 );
}

do_action( 'jobhunt_before_homepage_v2' );

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             * Functions hooked in to homepage action
             *
             * @hooked jobhunt_homepage_content                 - 10
             * @hooked jobhunt_home_v2_job_categories_block     - 20
             * @hooked jobhunt_home_v2_banner_v1                - 30
             * @hooked jobhunt_home_v2_job_list_block           - 40
             * @hooked jobhunt_home_v2_testimonial_block        - 50
             * @hooked jobhunt_home_v2_brands_carousel          - 60
             * @hooked jobhunt_home_v2_recent_posts             - 70
             * @hooked jobhunt_home_v2_banner_v2                - 80
             */
            do_action( 'jobhunt_homepage_v2' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
