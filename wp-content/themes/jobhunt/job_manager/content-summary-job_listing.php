<?php
/**
 * Job listing summary
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-summary-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @version     1.31.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $job_manager;
?>
<a href="<?php the_permalink(); ?>">
    <?php if ( $logo = get_the_company_logo() ) : ?>
        <img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_the_company_name() ); ?>" title="<?php echo esc_attr( get_the_company_name() ); ?>" />
    <?php endif; ?>

    <div class="job_summary_content">

        <h2 class="job_summary_title"><?php wpjm_the_job_title(); ?></h2>
        <?php 
        the_company_name( '<strong>', '</strong> ' );
        jobhunt_template_job_listing_location();
        ?>
        <div class="job-description">
            <?php echo wp_trim_words( wpjm_get_the_job_description() , 12, '....' ); ?>
        </div>
    </div>
    <div class="job_summary_footer">
    <?php jobhunt_job_listing_job_type(); ?>
    </div>
</a>