<?php

if ( ! function_exists( 'jobhunt_site_content_header' ) ) {
    function jobhunt_site_content_header() {
        if( apply_filters( 'jobhunt_show_site_content_header', true ) ) {
            ?><header class="site-content-page-header" <?php echo jobhunt_site_content_bg_image(); ?>>
                <div class="site-content-page-header-inner">
                    <div class="page-title-area">
                        <?php jobhunt_site_content_page_title(); ?>
                        <div class="page-header-aside"><?php do_action( 'jobhunt_page_header_aside' ); ?></div>
                    </div>
                </div>
            </header><?php
        }
    }
}

if ( ! function_exists( 'jobhunt_site_content_page_title' ) ) {
    function jobhunt_site_content_page_title() {
        $site_content_page_title    = '';
        $site_content_page_subtitle = '';

        if ( is_home() || ( is_single() && 'post' == get_post_type() ) ) {
            $site_content_page_title    = apply_filters( 'jobhunt_site_content_blog_page_title', esc_html__( 'Blog', 'jobhunt' ) );
            $site_content_page_subtitle = apply_filters( 'jobhunt_site_content_blog_page_subtitle', esc_html__( 'Keep up to date with the latest news', 'jobhunt' ) );
        } elseif ( is_front_page() ) {
            $site_content_page_title    = get_the_title();
        } elseif( is_archive() ) {
            $site_content_page_title    = get_the_archive_title();
            $site_content_page_subtitle = get_the_archive_description();
        } elseif( is_page() ) {
            global $post;
            $clean_page_meta_values = get_post_meta( $post->ID, '_jobhunt_page_metabox', true );
            $page_meta_values = maybe_unserialize( $clean_page_meta_values );
            $site_content_page_title = isset( $page_meta_values['page_title'] ) && ! empty( $page_meta_values['page_title'] ) ? $page_meta_values['page_title'] : get_the_title();
            $site_content_page_subtitle = isset( $page_meta_values['page_subtitle'] ) && ! empty( $page_meta_values['page_subtitle'] ) ? $page_meta_values['page_subtitle'] : '';
        } elseif ( is_search() ) {
            $site_content_page_title    = apply_filters( 'jobhunt_site_content_search_results_page_title', sprintf( esc_html__( 'Search results for &ldquo;%s&rdquo;', 'jobhunt' ), get_search_query() ) );
        } else {
            $site_content_page_title    = get_the_title();
        }

        $site_content_page_title    = apply_filters( 'jobhunt_site_content_page_title', $site_content_page_title );
        $site_content_page_subtitle = apply_filters( 'jobhunt_site_content_page_subtitle', $site_content_page_subtitle );

        ?><div class="page-title-area-inner">
            <h1 class="site-content-page-title"><?php echo wp_kses_post( $site_content_page_title ); ?></h1>
            <?php if ( ! empty( $site_content_page_subtitle ) ) : ?>
            <div class="site-content-page-subtitle"><?php echo wp_kses_post( $site_content_page_subtitle ); ?></div>
            <?php endif; ?>
        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_page_content' ) ) {
    /**
     * Display the post content
     *
     * @since 1.0.0
     */
    function jobhunt_page_content() {
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobhunt' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if ( ! function_exists( 'jobhunt_handheld_sidebar_switcher' ) ) {
    function jobhunt_handheld_sidebar_switcher() {
        
        if ( apply_filters( 'jobhunt_handheld_sidebar_switcher', true ) ) {
            $handheld_sidebar_title = apply_filters( 'jobhunt_handheld_sidebar_switcher_title', esc_html__( 'Filters', 'jobhunt' ) );
            $handheld_sidebar_icon  = apply_filters( 'jobhunt_handheld_sidebar_switcher_icon', 'fas fa-sliders-h' );
            ?><div class="handheld-sidebar-toggle"><button class="btn sidebar-toggler" type="button"><i class="<?php echo esc_attr( $handheld_sidebar_icon ); ?>"></i><span><?php echo esc_html( $handheld_sidebar_title ); ?></span></button></div><?php
        }
    }
}
