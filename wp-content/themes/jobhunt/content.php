<?php
/**
 * Template used to display post content.
 *
 * @package jobhunt
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to jobhunt_loop_post action.
	 *
	 * @hooked jobhunt_post_header          - 10
	 * @hooked jobhunt_post_meta            - 20
	 * @hooked jobhunt_post_content         - 30
	 */
	do_action( 'jobhunt_loop_post' );
	?>

</article><!-- #post-## -->
