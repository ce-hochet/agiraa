<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php

            if( have_posts() ) {

                if ( ! resume_manager_user_can_browse_resumes() ) {
                    get_job_manager_template_part( 'access-denied', 'browse-resumes', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );
                } else {
                    do_action( 'jobhunt_before_resume_loop' );
                    
                    get_job_manager_template( 'resumes-start.php' , array() , 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );
                    
                    while ( have_posts() ) : the_post();

                        get_job_manager_template_part( 'content', 'resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );

                    endwhile; // End of the loop. 

                    get_job_manager_template( 'resumes-end.php' , array() , 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );

                    do_action( 'jobhunt_after_resume_loop' );
                }

            } else {
                do_action( 'jobhunt_no_resumes_found' );
            }

            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

$layout = jobhunt_get_wpjmr_sidebar_style();
if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
    do_action( 'jobhunt_resume_sidebar' );
}

get_footer();