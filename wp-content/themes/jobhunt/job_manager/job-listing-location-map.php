<?php
/**
 * Job Location Map
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;
$location = get_the_job_location( $post );

if ( $location ) :
?>
<div class="single-job-listing__widget">
    <h5 class="single-job-listing__widget--title"><?php echo esc_html__( 'Job Location', 'jobhunt' ); ?></h5>
    <div class="single-job-listing__widget--content no-padding single-job-listing--location"><iframe height="380" src="https://maps.google.com/maps?q=<?php echo urlencode( strip_tags( $location ) ); ?>&amp;zoom=14&amp;height=350&amp;maptype=roadmap&amp;iwloc=B&amp;output=embed" frameborder="0"  allowfullscreen></iframe></div>
</div>

<?php endif;
