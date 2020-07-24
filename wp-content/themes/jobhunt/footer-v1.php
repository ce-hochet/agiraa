<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package jobhunt
 */

?>

            </div><!-- .site-content-inner -->
        </div><!-- .container -->
    </div><!-- #content -->

    <?php do_action( 'jobhunt_before_footer' ); ?>

    <footer id="colophon" class="site-footer footer-v1"><?php
        
        /**
         * Functions hooked in to jobhunt_footer action
         *
         * @hooked jobhunt_footer_widgets       - 10
         * @hooked jobhunt_footer_bottom_bar    - 20
         */
        do_action( 'jobhunt_footer_v1' ); ?>

    </footer><!-- #colophon -->

    <?php do_action( 'jobhunt_after_footer' ); ?>

</div><!-- #page -->
</div>

<?php wp_footer(); ?>

</body>
</html>
