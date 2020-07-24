<?php
/**
 * The template for displaying search results pages.
 *
 * @package jobhunt
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'loop' );

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
$layout = jobhunt_get_blog_layout();
if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
    do_action( 'jobhunt_sidebar' );
}
get_footer();
