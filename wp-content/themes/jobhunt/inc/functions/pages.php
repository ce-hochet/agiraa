<?php

if ( ! function_exists( 'jobhunt_toggle_page_site_content_header' ) ) {
    function jobhunt_toggle_page_site_content_header( $show ) {
        if( is_page() ) {
            global $post;
            $clean_page_meta_values = get_post_meta( $post->ID, '_jobhunt_page_metabox', true );
            $page_meta_values = maybe_unserialize( $clean_page_meta_values );
            if ( isset( $page_meta_values['hide_page_header'] ) && $page_meta_values['hide_page_header'] == '1' ) {
                $show = false;
            }
        }

        return $show;
    }
}

if ( ! function_exists( 'jobhunt_get_page_extra_class' ) ) {
    function jobhunt_get_page_extra_class() {
        $classes = '';

        if( is_page() ) {
            global $post;
            $clean_page_meta_values = get_post_meta( $post->ID, '_jobhunt_page_metabox', true );
            $page_meta_values = maybe_unserialize( $clean_page_meta_values );
            if( isset( $page_meta_values['body_classes'] ) ) {
                $classes = $page_meta_values['body_classes'];
            }
        }

        return $classes;
    }
}

if ( ! function_exists( 'jobhunt_site_content_bg_image' ) ) {
    function jobhunt_site_content_bg_image() {
        $bg_img = '';
        if ( jobhunt_is_wp_job_manager_activated() && ( is_post_type_archive( 'job_listing' ) || is_wpjm_job_listing() || is_job_listing_taxonomy() ) ) {
            $bg_url = jobhunt_get_wpjm_header_bg_img();
            if ( ! empty ( $bg_url ) ) {
                $bg_img = 'background-image: url(' . esc_url( $bg_url ) . ');';
                $bg_img = 'style="' . esc_attr( $bg_img ) . '"';
            }
        } elseif ( jobhunt_is_wp_company_manager_activated() && ( is_post_type_archive( 'company' ) || is_singular( 'company' ) || is_company_taxonomy() ) ) {
            $bg_url = jobhunt_get_wpjmc_header_bg_img();
            if ( ! empty ( $bg_url ) ) {
                $bg_img = 'background-image: url(' . esc_url( $bg_url ) . ');';
                $bg_img = 'style="' . esc_attr( $bg_img ) . '"';
            }
        } elseif( jobhunt_is_wp_resume_manager_activated() && ( is_post_type_archive( 'resume' ) || is_resume_taxonomy() ) ) {
            $bg_url = jobhunt_get_wpjmr_header_bg_img();
            if ( ! empty ( $bg_url ) ) {
                $bg_img = 'background-image: url(' . esc_url( $bg_url ) . ');';
                $bg_img = 'style="' . esc_attr( $bg_img ) . '"';
            }
        } elseif( is_page() && has_post_thumbnail() ) {
            $bg_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            if ( ! empty ( $bg_url ) ) {
                $bg_img = 'background-image: url(' . esc_url( $bg_url ) . ');';
                $bg_img = 'style="' . esc_attr( $bg_img ) . '"';
            }
        } elseif ( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() || is_single() ) ) ) {
            $bg_url = jobhunt_get_post_header_bg_img();
            if ( ! empty ( $bg_url ) ) {
                $bg_img = 'background-image: url(' . esc_url( $bg_url ) . ');';
                $bg_img = 'style="' . esc_attr( $bg_img ) . '"';
            }
        }

        return $bg_img;
    }
}
