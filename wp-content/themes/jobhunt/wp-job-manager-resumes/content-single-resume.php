<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( resume_manager_user_can_view_resume( $post->ID ) ) :
    
    do_action( 'single_resume_before' ); ?>
    
    <div class="single-resume-inner">
        <?php do_action( 'single_resume_head_before' ); ?>
        <?php do_action( 'single_resume_head' ); ?>
        <?php do_action( 'single_resume_head_after' ); ?>
        <div class="single-resume-content">
            <?php do_action( 'single_resume_content_navbar_before' ); ?>
            <?php do_action( 'single_resume_content_navbar' ); ?>
            <?php do_action( 'single_resume_content_navbar_after' ); ?>
            <div class="single-resume-content_inner">
                <?php do_action( 'single_resume_content_before' ); ?>
                <?php do_action( 'single_resume_content' ); ?>
                <?php do_action( 'single_resume_content_after' ); ?>
                <?php do_action( 'single_resume_sidebar_before' ); ?>
                <?php do_action( 'single_resume_sidebar' ); ?>
                <?php do_action( 'single_resume_sidebar_after' ); ?>
            </div>
        </div>
    </div>

    <?php do_action( 'single_resume_after' );
    
    else : ?>

    <?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>
