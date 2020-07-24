<?php
/**
 * Filter functions for Header Section of Theme Options
 */

if ( ! function_exists ( 'redux_toggle_top_bar' ) ) {
    function redux_toggle_top_bar( $enable ) {
        global $jobhunt_options;

        if ( ! isset( $jobhunt_options['header_top_bar_show'] ) ) {
            $jobhunt_options['header_top_bar_show'] = true;
        }

        if ( $jobhunt_options['header_top_bar_show'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_header_style' ) ) {
    function redux_apply_header_style( $header_style ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['header_style'] ) ) {
            $header_style = $jobhunt_options['header_style'];
        }

        return $header_style;
    }
}

if( ! function_exists( 'redux_toggle_header_post_a_job_button' ) ) {
    function redux_toggle_header_post_a_job_button( $enable ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['header_enable_post_a_job'] ) && $jobhunt_options['header_enable_post_a_job'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_header_post_a_job_button_icon' ) ) {
    function redux_apply_header_post_a_job_button_icon( $icon ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['header_post_a_job_icon'] ) ) {
            $icon = $jobhunt_options['header_post_a_job_icon'];
        }

        return $icon;
    }
}

if ( ! function_exists( 'redux_apply_header_post_a_job_button_text' ) ) {
    function redux_apply_header_post_a_job_button_text( $title ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['header_post_a_job_title'] ) ) {
            $title = $jobhunt_options['header_post_a_job_title'];
        }

        return $title;
    }
}

if( ! function_exists( 'redux_toggle_header_secondary_nav_menu' ) ) {
    function redux_toggle_header_secondary_nav_menu( $enable ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['header_enable_secondary_nav'] ) && $jobhunt_options['header_enable_secondary_nav'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_header_secondary_nav_menu_titles' ) ) {
    function redux_apply_header_secondary_nav_menu_titles( $menu_titles ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['header_secondary_nav_register_title'] ) ) {
            $menu_titles['register_text'] = $jobhunt_options['header_secondary_nav_register_title'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_register_icon'] ) ) {
            $menu_titles['register_icon'] = $jobhunt_options['header_secondary_nav_register_icon'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_login_title'] ) ) {
            $menu_titles['login_text'] = $jobhunt_options['header_secondary_nav_login_title'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_login_icon'] ) ) {
            $menu_titles['login_icon'] = $jobhunt_options['header_secondary_nav_login_icon'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_user_page_title'] ) ) {
            $menu_titles['user_page_text'] = $jobhunt_options['header_secondary_nav_user_page_title'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_user_page_icon'] ) ) {
            $menu_titles['user_page_icon'] = $jobhunt_options['header_secondary_nav_user_page_icon'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_logout_title'] ) ) {
            $menu_titles['logout_text'] = $jobhunt_options['header_secondary_nav_logout_title'];
        }

        if ( isset( $jobhunt_options['header_secondary_nav_logout_icon'] ) ) {
            $menu_titles['logout_icon'] = $jobhunt_options['header_secondary_nav_logout_icon'];
        }

        return $menu_titles;
    }
}

if( ! function_exists( 'redux_toggle_sticky_header' ) ) {
    function redux_toggle_sticky_header( $enable ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['sticky_header'] ) && $jobhunt_options['sticky_header'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_sticky_header_custom_color' ) ) {
    function redux_apply_sticky_header_custom_color() {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['sticky_header_default_color'] ) && $jobhunt_options['sticky_header_default_color'] ) {
            return;
        }

        $bg_color        = isset( $jobhunt_options['sticky_header_bg_color'] ) ? $jobhunt_options['sticky_header_bg_color'] : '#202020';
        $text_color      = isset( $jobhunt_options['sticky_header_text_color'] ) ? $jobhunt_options['sticky_header_text_color'] : '#fff';

        $styles             = '
        .site-header .jobhunt-stick-this.stuck,
        .site-header.header-v5 .jobhunt-stick-this.stuck {
            background-color: ' . $bg_color . ';
        }

        .site-header.header-bg-default .stuck .header-menu > li > a,
        .site-header .stuck .header-menu > li > a {
            color: ' . $text_color . ';
        }

        .site-header.header-v5 .stuck .post-a-job a:hover {
            color: ' . $bg_color  . ';
        }

        .site-header.header-v5 .stuck .post-a-job a,
        .site-header.header-v5 .stuck .post-a-job a:hover {
            border-color: ' . $text_color . ';
        }

        .site-header.header-v5 .stuck .post-a-job a:hover {
            background-color: ' . $text_color . ';
        }

        .site-header.header-bg-default .stuck .site-branding svg path,
        .site-header .stuck .site-branding svg path {
            fill: ' . $text_color . ';
        }
        ';

        $css_handle = wp_style_is( 'jobhunt-color', 'enqueued' ) ? 'jobhunt-color' : 'jobhunt-style';
        wp_add_inline_style( $css_handle, $styles );
    }
}
