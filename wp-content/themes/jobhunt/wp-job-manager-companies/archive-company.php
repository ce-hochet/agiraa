<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php

            if( have_posts() ) {

                do_action( 'jobhunt_before_company_loop' );

                echo '<ul class="jh-companies">';

                while ( have_posts() ) : the_post();

                    get_job_manager_template_part( 'content', 'company', 'wp-job-manager-companies' );

                endwhile; // End of the loop. 

                echo '</ul>';

                do_action( 'jobhunt_after_company_loop' );

            } else {
                do_action( 'jobhunt_no_companies_found' );
            }

            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

$layout = jobhunt_get_wpjmc_sidebar_style();
if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
    do_action( 'jobhunt_company_sidebar' );
}

get_footer();