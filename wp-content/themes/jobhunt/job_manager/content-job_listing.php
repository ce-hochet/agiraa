<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<?php
	do_action( 'jobhunt_before_job_listing' );

	do_action( 'jobhunt_before_job_listing_title' );

	do_action( 'jobhunt_job_listing_title' );

	do_action( 'jobhunt_after_job_listing_title' );

	do_action( 'jobhunt_after_job_listing' ); 
	?>
</li>