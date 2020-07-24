<?php
/**
 * Filter functions for Blog Section of Theme Options
 */

if ( ! function_exists( 'redux_apply_blog_page_view' ) ) {
    function redux_apply_blog_page_view( $blog_view ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['blog_view'] ) ) {
            $blog_view = $jobhunt_options['blog_view'];
        }

        return $blog_view;
    }
}

if ( ! function_exists( 'redux_apply_blog_page_layout' ) ) {
    function redux_apply_blog_page_layout( $blog_layout ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['blog_layout'] ) ) {
            $blog_layout = $jobhunt_options['blog_layout'];
        }

        return $blog_layout;
    }
}

if ( ! function_exists( 'redux_apply_single_post_layout' ) ) {
    function redux_apply_single_post_layout( $single_post_layout ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['single_post_layout'] ) ) {
            $single_post_layout = $jobhunt_options['single_post_layout'];
        }

        return $single_post_layout;
    }
}

if ( ! function_exists( 'redux_toggle_post_placeholder_icon' ) ) {
    function redux_toggle_post_placeholder_icon( $enable ) {
        global $jobhunt_options;

        if ( ! isset( $jobhunt_options['enable_post_placeholder_icon'] ) ) {
            $jobhunt_options['enable_post_placeholder_icon'] = true;
        }

        if ( $jobhunt_options['enable_post_placeholder_icon'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_toggle_author_info' ) ) {
    function redux_toggle_author_info( $enable ) {
        global $jobhunt_options;

        if ( ! isset( $jobhunt_options['show_blog_post_author_info'] ) ) {
            $jobhunt_options['show_blog_post_author_info'] = true;
        }

        if ( $jobhunt_options['show_blog_post_author_info'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_blog_page_title' ) ) {
    function redux_apply_blog_page_title( $title ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['blog_page_title'] ) ) {
            $title = $jobhunt_options['blog_page_title'];
        }

        return $title;
    }
}

if ( ! function_exists( 'redux_apply_blog_page_subtitle' ) ) {
    function redux_apply_blog_page_subtitle( $title ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['blog_page_subtitle'] ) ) {
            $title = $jobhunt_options['blog_page_subtitle'];
        }

        return $title;
    }
}
