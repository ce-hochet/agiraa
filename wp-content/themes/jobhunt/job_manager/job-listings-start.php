<?php
/**
 * Content shown before job listings in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-listings-start.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @version     1.15.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$job_listing_view = jobhunt_get_wpjm_style();

if ( isset( $atts['view'] ) ) {
    $job_listing_view = $atts['view'] === 'grid' ? 'grid' : 'list';
}

?>
<ul class="job_listings <?php echo esc_attr( $job_listing_view ); ?>">