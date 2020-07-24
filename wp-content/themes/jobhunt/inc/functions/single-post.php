<?php

if ( ! function_exists( 'jobhunt_post_nav' ) ) {
    /**
     * Display navigation to next/previous post when applicable.
     */
    function jobhunt_post_nav() {
        ob_start();
        $next_arrow = is_rtl() ? '<i class="la la-long-arrow-left"></i>' : '<i class="la la-long-arrow-right"></i>';
        ?>
        <div class="jobhunt-post-nav">
            <div class="jobhunt-post-title next">
                <span class="post-direction"><?php echo apply_filters( 'jobhunt_post_nav_next_text', esc_html__( 'Next Post', 'jobhunt' ) ); ?></span>
                <span class="post-title">%title</span>
            </div>
            <div class="post-nav-icon icon-next">
                <span class="nav-icon"><?php echo wp_kses_post( $next_arrow ); ?></span>
            </div>
        </div>
        <?php
        $next = ob_get_clean();
        ob_start();
        $prev_arrow = is_rtl() ? '<i class="la la-long-arrow-right"></i>' : '<i class="la la-long-arrow-left"></i>';
        ?>
        <div class="jobhunt-post-nav">
            <div class="post-nav-icon icon-prev">
                <span class="nav-icon"><?php echo wp_kses_post( $prev_arrow ); ?></span>
            </div>
            <div class="jobhunt-post-title prev">
                <span class="post-direction"><?php echo apply_filters( 'jobhunt_post_nav_prev_text', esc_html__( 'Prev Post', 'jobhunt' ) ); ?></span>
                <span class="post-title">%title</span>
            </div>
        </div>
        <?php
        $prev = ob_get_clean();
        $args = array(
            'next_text' => $next,
            'prev_text' => $prev,
        );
        the_post_navigation( $args );
    }
}

if ( ! function_exists( 'jobhunt_display_comments' ) ) {
    /**
     * Techmarket display comments
     *
     * @since  1.0.0
     */
    function jobhunt_display_comments() {
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
        endif;
    }
}
