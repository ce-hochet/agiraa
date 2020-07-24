<?php
/**
 * Notice when job has been submitted.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submitted.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_post_types;

 /**** AJOUT DU MENU WOOCOMMERCE ****/ 

$submission_limit           = get_option( 'resume_manager_submission_limit' );
$submit_resume_form_page_id = get_option( 'resume_manager_submit_resume_form_page_id' );
?>
<div id="resume-manager-candidate-dashboard">
	<?php if ( jobhunt_is_woocommerce_activated() ) {
		do_action( 'woocommerce_account_navigation' );
	}
wp_enqueue_script( 'wp-resume-manager-resume-submission' );


switch ( $job->post_status ) :
	case 'publish' :
		echo '<div class="job-manager-message">' . wp_kses_post(
			sprintf(
				// translators: %1$s is the job listing post type name, %2$s is the job listing URL.
				/**** MODIFICATION DU TEXTE ****/
				__( 'Mission publiée. Pour la voir <a href="%2$s">cliquer ici</a>.', 'wp-job-manager' ),
				esc_html( $wp_post_types['job_listing']->labels->singular_name ),
				get_permalink( $job->ID )
			)
		) . '</div>';
	break;
	case 'pending' :
		echo '<div class="job-manager-message">' . wp_kses_post(
			sprintf(
				// translators: Placeholder %s is the job listing post type name.
				esc_html__( '%s submitted successfully. Your listing will be visible once approved.', 'wp-job-manager' ),
				esc_html( $wp_post_types['job_listing']->labels->singular_name )
			)
		) . '</div>';
	break;
	default :
		do_action( 'job_manager_job_submitted_content_' . str_replace( '-', '_', sanitize_title( $job->post_status ) ), $job );
	break;
endswitch;

do_action( 'job_manager_job_submitted_content_after', sanitize_title( $job->post_status ), $job ); ?>
</div>
