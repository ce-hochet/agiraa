<?php
/**
 * The template for displaying all single posts.
 *
 * @package jobhunt
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

        <?php while ( have_posts() ) : the_post();

            do_action( 'jobhunt_single_company_before' );

            if( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() ) {
                get_job_manager_template( 'content-single-company.php', array(), 'mas-wp-job-manager-company', mas_wpjmc()->plugin_dir . 'templates/' );
            } else {
                get_job_manager_template( 'content-single-company.php' , array() , 'wp-job-manager-companies' );
            }

            do_action( 'jobhunt_single_company_after' );

        endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();