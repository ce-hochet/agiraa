<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package jobhunt
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to jobhunt_page add_action
	 *
	 * @hooked jobhunt_page_content         - 20
	 */
   do_action( 'jobhunt_page' );
	?>
</article><!-- #post-## -->
