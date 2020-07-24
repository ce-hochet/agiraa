<?php
/**
 * Jobhunt engine room
 *
 * @package jobhunt
 */

/**
 * Assign the Jobhunt version to a var
 */
$theme              = wp_get_theme( 'jobhunt' );
$jobhunt_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$jobhunt = (object) array(
	'version' => $jobhunt_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require get_template_directory() . '/inc/class-jobhunt.php',
);

require get_template_directory() . '/inc/jobhunt-functions.php';
require get_template_directory() . '/inc/jobhunt-template-hooks.php';
require get_template_directory() . '/inc/jobhunt-template-functions.php';


if ( class_exists( 'Jetpack' ) ) {
	$jobhunt->jetpack = require get_template_directory() . '/inc/jetpack/class-jobhunt-jetpack.php';
}

if ( jobhunt_is_redux_activated() ) {
    require get_template_directory() . '/inc/redux-framework/jobhunt-options.php';
    require get_template_directory() . '/inc/redux-framework/hooks.php';
    require get_template_directory() . '/inc/redux-framework/functions.php';
}

if ( jobhunt_is_woocommerce_activated() ) {
	$jobhunt->woocommerce = require get_template_directory() . '/inc/woocommerce/class-jobhunt-woocommerce.php';

	require get_template_directory() . '/inc/woocommerce/jobhunt-woocommerce-functions.php';
	require get_template_directory() . '/inc/woocommerce/jobhunt-woocommerce-template-hooks.php';
	require get_template_directory() . '/inc/woocommerce/jobhunt-woocommerce-template-functions.php';
}

if ( jobhunt_is_wp_job_manager_activated() ) {
	$jobhunt->wpjm = require get_template_directory() . '/inc/wp-job-manager/class-jobhunt-wpjm.php';
	
	require get_template_directory() . '/inc/wp-job-manager/jobhunt-wpjm-functions.php';
	require get_template_directory() . '/inc/wp-job-manager/jobhunt-wpjm-template-hooks.php';
	require get_template_directory() . '/inc/wp-job-manager/jobhunt-wpjm-template-functions.php';
	require get_template_directory() . '/inc/wp-job-manager/jobhunt-wpjm-integrations.php';
}

if ( jobhunt_is_wp_job_manager_activated() && jobhunt_is_wp_resume_manager_activated() ) {
	$jobhunt->wpjmr = require get_template_directory() . '/inc/wp-job-manager-resumes/class-jobhunt-wpjmr.php';

	require get_template_directory() . '/inc/wp-job-manager-resumes/jobhunt-wpjmr-functions.php';
	require get_template_directory() . '/inc/wp-job-manager-resumes/jobhunt-wpjmr-template-hooks.php';
	require get_template_directory() . '/inc/wp-job-manager-resumes/jobhunt-wpjmr-template-functions.php';
}

if ( jobhunt_is_wp_job_manager_activated() && jobhunt_is_wp_company_manager_activated() ) {
	$jobhunt->wpjmc = require get_template_directory() . '/inc/wp-job-manager-companies/class-jobhunt-wpjmc.php';

	require get_template_directory() . '/inc/wp-job-manager-companies/jobhunt-wpjmc-functions.php';
	require get_template_directory() . '/inc/wp-job-manager-companies/jobhunt-wpjmc-template-hooks.php';
	require get_template_directory() . '/inc/wp-job-manager-companies/jobhunt-wpjmc-template-functions.php';
}

if ( is_admin() ) {
	$jobhunt->admin = require get_template_directory() . '/inc/admin/class-jobhunt-admin.php';
	// require get_template_directory() . '/inc/admin/class-jobhunt-admin.php';
}

if ( jobhunt_is_ocdi_activated() ) {
    require get_template_directory() . '/inc/ocdi/hooks.php';
    require get_template_directory() . '/inc/ocdi/functions.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

// For Testing
// add_action( 'init','flush_rewrite_rules' );