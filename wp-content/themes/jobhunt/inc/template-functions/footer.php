<?php
/**
 * Template functions used in footer
 */

if ( ! function_exists( 'jobhunt_footer_widgets' ) ) {
    /**
     * Display the footer widget regions.
     *
     * @since  1.0.0
     * @return void
     */
    function jobhunt_footer_widgets() {
        if( apply_filters( 'jobhunt_footer_widgets', true  ) ) {
            $rows    = intval( apply_filters( 'jobhunt_footer_widget_rows', 1 ) );
            $regions = intval( apply_filters( 'jobhunt_footer_widget_columns', 4 ) );
            for ( $row = 1; $row <= $rows; $row++ ) :
                // Defines the number of active columns in this footer row.
                for ( $region = $regions; 0 < $region; $region-- ) {
                    if ( is_active_sidebar( 'footer-' . strval( $region + $regions * ( $row - 1 ) ) ) ) {
                        $columns = $region;
                        break;
                    }
                }
                if ( isset( $columns ) ) : ?>
                    <div class="footer-widgets">
                        <div class="container">
                            <div class=<?php echo '"footer-widgets-inner columns-' . strval( $columns ) . '"'; ?>><?php

                                for ( $column = 1; $column <= $columns; $column++ ) :
                                    $footer_n = $column + $regions * ( $row - 1 );
                                    if ( is_active_sidebar( 'footer-' . strval( $footer_n ) ) ) : ?>

                                        <div class="footer-widget footer-widget-<?php echo strval( $column ); ?>">
                                            <?php dynamic_sidebar( 'footer-' . strval( $footer_n ) ); ?>
                                        </div><?php
                                    endif;
                                endfor; ?>

                            </div><!-- .footer-widgets-inner -->
                        </div>
                    </div><?php
                    unset( $columns );
                endif;
            endfor;
        }
    }
}

if ( ! function_exists( 'jobhunt_footer_bottom_bar' ) ) {
    function jobhunt_footer_bottom_bar() {
        $copyright_info = apply_filters( 'jobhunt_footer_copyright_info', wp_kses_post( sprintf( __( '&copy; %s  <a href="%s">%s</a>. All rights reserved. Design by <a href="https://madrasthemes.com/">Madras Themes</a>', 'jobhunt' ), date('Y'), esc_url( home_url('/') ), get_bloginfo( 'name' ) ) ) );
        if( apply_filters( 'jobhunt_footer_enable_copyright_info', true ) && ! empty( $copyright_info ) ) {
            ?><div class="footer-copyright-bar">
                <div class="container">
                    <div class="footer-copyright-bar-inner">
                        <div class="copyright-info"><?php echo wp_kses_post( $copyright_info ); ?></div>
                    </div>
                </div>
            </div><?php
        }
    }
}
