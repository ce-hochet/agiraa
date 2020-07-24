<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php

            do_action( 'jobhunt_before_job_listing_loop_content' );

            if( have_posts() ) {

                do_action( 'jobhunt_before_job_listing_loop' );
                
                get_job_manager_template( 'job-listings-start.php' );
                
                do_action( 'jobhunt_job_listing_loop_start' );

                while ( have_posts() ) : the_post();

                    do_action( 'job_listing_loop' );

                    get_job_manager_template_part( 'content', 'job_listing' );

                endwhile; // End of the loop. 

                do_action( 'jobhunt_job_listing_loop_end' );

                get_job_manager_template( 'job-listings-end.php' );

                do_action( 'jobhunt_after_job_listing_loop' );

            } else {
                do_action( 'jobhunt_no_jobs_found' );
            }

            do_action( 'jobhunt_after_job_listing_loop_content' );

            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

$layout = jobhunt_get_wpjm_sidebar_style();
if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
    do_action( 'jobhunt_jobs_sidebar' );
}

get_footer();