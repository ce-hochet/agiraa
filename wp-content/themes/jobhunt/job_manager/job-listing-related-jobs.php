<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

if( get_post_status( $post ) === 'preview' ) return;

$taxonomy = apply_filters( 'jobhunt_single_job_listing_related_jobs_taxonomy', 'job_listing_category' );
$category_slugs = '';

if ( taxonomy_exists( $taxonomy ) ) {
    $slugs = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'slugs' ) );
    if ( ! empty( $slugs ) && is_array( $slugs ) ) {
        $category_slugs = implode( ',', $slugs );
    }
}

$args = apply_filters( 'jobhunt_single_job_listing_related_jobs_args', array(
    'show_filters' => false,
    'per_page' => 4,
    'show_more' => false,
    'categories' => $category_slugs,
) );

?>
<section class="related-jobs">
    <header>
        <h3 class="related-jobs__title"><?php echo apply_filters( 'jobhunt_single_job_listing_related_jobs_title', esc_html__( 'Related Jobs', 'jobhunt' ) ); ?></h3>
    </header>
    <?php echo jobhunt_do_shortcode( 'jobs', $args ); ?>
</section>