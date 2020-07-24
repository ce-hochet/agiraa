<?php
/**
 * Template used to display post content on single pages.
 *
 * @package jobhunt
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	do_action( 'jobhunt_single_post_top' );

	/**
	 * Functions hooked into jobhunt_single_post add_action
	 *
	 * @hooked jobhunt_post_header          - 10
	 * @hooked jobhunt_post_meta            - 20
	 * @hooked jobhunt_post_content         - 30
	 */
	do_action( 'jobhunt_single_post' );

	/**
	 * Functions hooked in to jobhunt_single_post_bottom action
	 *
	 * @hooked jobhunt_post_nav         - 10
	 * @hooked jobhunt_display_comments - 20
	 */
	do_action( 'jobhunt_single_post_bottom' );
	?>

</article><!-- #post-## -->
