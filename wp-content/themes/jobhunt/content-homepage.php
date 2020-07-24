<?php
/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package jobhunt
 */

$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php jobhunt_homepage_content_styles(); ?>" data-featured-image="<?php echo esc_attr( $featured_image ); ?>">
	<div class="col-full">
		<?php
		/**
		 * Functions hooked in to jobhunt_page add_action
		 *
		 * @hooked jobhunt_homepage_header      - 10
		 * @hooked jobhunt_page_content         - 20
		 */
		do_action( 'jobhunt_homepage' );
		?>
	</div>
</div><!-- #post-## -->
