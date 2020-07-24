<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package jobhunt
 */

global $post;

$header_version = jobhunt_get_header_version();
$footer_version = jobhunt_get_footer_version();

$clean_page_meta_values = get_post_meta( $post->ID, '_jobhunt_page_metabox', true );
$page_meta_values = maybe_unserialize( $clean_page_meta_values );

if ( isset( $page_meta_values['site_header_style'] ) && ! empty( $page_meta_values['site_header_style'] ) ) {
	$header_version = $page_meta_values['site_header_style'];
}

if ( isset( $page_meta_values['site_footer_style'] ) && ! empty( $page_meta_values['site_footer_style'] ) ) {
	$footer_version = $page_meta_values['site_footer_style'];
}

get_header( $header_version ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'jobhunt_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to jobhunt_page_after action
				 *
				 * @hooked jobhunt_display_comments - 10
				 */
				do_action( 'jobhunt_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer( $footer_version );