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

            do_action( 'jobhunt_single_job_listing_before' );

            get_job_manager_template( 'content-single-job_listing.php' );

            do_action( 'jobhunt_single_job_listing_after' );

        endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();