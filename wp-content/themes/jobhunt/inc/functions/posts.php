<?php
/**
 * Functions related to posts
 */

if ( ! function_exists( 'jobhunt_get_blog_layout' ) ) {
    function jobhunt_get_blog_layout() {
        if ( is_single() && 'post' == get_post_type() ) {
            return jobhunt_get_single_post_layout();
        } elseif( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() ) ) ) {
            return apply_filters( 'jobhunt_blog_layout', 'right-sidebar' );
        } else {
            return apply_filters( 'jobhunt_default_layout', 'right-sidebar' );
        }
    }
}

if ( ! function_exists( 'jobhunt_get_single_post_layout' ) ) {
    function jobhunt_get_single_post_layout() {
        if ( is_single() && 'post' == get_post_type() ) {
            return apply_filters( 'jobhunt_single_post_layout', 'right-sidebar' );
        } else {
            return apply_filters( 'jobhunt_default_layout', 'right-sidebar' );
        }
    }
}

if ( ! function_exists( 'jobhunt_get_blog_post_columns' ) ) {
    function jobhunt_get_blog_post_columns() {
        if( 'post' == get_post_type() && jobhunt_get_blog_style() == 'blog-grid' ) {
            $columns = 2;
            if( jobhunt_get_blog_layout() == 'full-width' ) {
                $columns = 3;
            }
        } else {
            $columns = 1;
        }

        return apply_filters( 'jobhunt_blog_post_columns', $columns );
    }
}

if ( ! function_exists( 'jobhunt_get_blog_style' ) ) {
    function jobhunt_get_blog_style() {
        return apply_filters( 'jobhunt_blog_style', '' );
    }
}

if ( ! function_exists( 'jobhunt_get_post_header_bg_img' ) ) {
    function jobhunt_get_post_header_bg_img() {
        $bg_url = '';
        if( get_option( 'show_on_front' ) == 'page' ) {
            $blog_page_id = get_option( 'page_for_posts' );
            if( ! empty( $blog_page_id ) && has_post_thumbnail( $blog_page_id ) ) {
                $bg_url = get_the_post_thumbnail_url( $blog_page_id, 'full' );
            }
        }

        return apply_filters( 'jobhunt_get_post_header_bg_img', $bg_url );
    }
}

if ( ! function_exists( 'jobhunt_paging_nav' ) ) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function jobhunt_paging_nav() {
        global $wp_query;
        $args = array(
            'type'      => 'list',
            'next_text' => esc_html_x( 'Next', 'Next post', 'jobhunt' ) . '&nbsp;<span class="meta-nav">&rarr;</span>',
            'prev_text' => '<span class="meta-nav">&larr;</span>&nbsp' . esc_html_x( 'Prev', 'Previous post', 'jobhunt' ),
            );
        the_posts_pagination( $args );
    }
}

if( ! function_exists( 'jobhunt_get_post_icon' ) ) {
    /**
     * Display Post Icon based on post format
     * @since 1.0.0
     */
    function jobhunt_get_post_icon( $post_format = '' ) {

        $post_format = ( empty( $post_format ) ? get_post_format() : $post_format );

        switch( $post_format ) {
            case 'aside':
                $post_icon = 'fas fa-hand-point-left';
            break;
            case 'gallery':
                $post_icon = 'far fa-images';
            break;
            case 'link':
                $post_icon = 'fas fa-link';
            break;
            case 'image':
                $post_icon = 'far fa-image';
            break;
            case 'quote':
                $post_icon = 'fas fa-quote-right';
            break;
            case 'status':
                $post_icon = 'far fa-comment-alt';
            break;
            case 'video':
                $post_icon = 'fas fa-video';
            break;
            case 'audio':
                $post_icon = 'fas fa-volume-up';
            break;
            case 'chat':
                $post_icon = 'far fa-comments';
            break;
            default:
                $post_icon = 'fab fa-wordpress';
        }

        return apply_filters( 'jobhunt_post_icon', $post_icon, $post_format );
    }
}

if ( ! function_exists( 'jobhunt_custom_excerpt_length' ) ) {
    function jobhunt_custom_excerpt_length( $length ) {
        $blog_style = jobhunt_get_blog_style();

        if( $blog_style == 'blog-grid' ) {
            $length = 15;
        } elseif( $blog_style == 'blog-list' ) {
            $length = 40;
        } else {
            $length = 50;
        }

        return apply_filters( 'jobhunt_excerpt_length', $length );
    }
}
