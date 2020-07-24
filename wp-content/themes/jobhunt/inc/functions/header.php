<?php

if ( ! function_exists( 'jobhunt_header_additional_classes' ) ) {
    /**
     * Additional Header Classes
     */
    function jobhunt_header_additional_classes() {
        $header_version = jobhunt_get_header_version();
        $classes = '';
        if( in_array( $header_version, array( 'v1', 'v2', 'v3' ) ) ) {
            if ( jobhunt_is_wp_job_manager_activated() && ( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) || is_singular( 'job_listing' ) || is_job_listing_taxonomy() ) ) {
                $classes = ' header-transparent header-bg-default';
            } elseif ( jobhunt_is_wp_company_manager_activated() && ( is_post_type_archive( 'company' ) || is_singular( 'company' ) || is_company_taxonomy() ) ) {
                $classes = ' header-transparent header-bg-default';
            } elseif ( jobhunt_is_wp_resume_manager_activated() && ( is_post_type_archive( 'resume' ) || is_singular( 'resume' ) || is_resume_taxonomy() ) ) {
                $classes = ' header-transparent header-bg-default';
            } elseif ( is_page_template( array( 'template-homepage-v1.php', 'template-homepage-v2.php', 'template-homepage-v3.php', 'template-homepage-v4.php', 'template-homepage-v5.php' ) ) ) {
                $classes = ' header-transparent header-bg-default';
            } elseif ( is_page() && has_post_thumbnail() ) {
                $classes = ' header-transparent header-bg-default';
            } else {
                if ( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() || is_single() ) ) ) {
                    $bg_url = jobhunt_get_post_header_bg_img();
                    if ( ! empty ( $bg_url ) ) {
                        $classes = ' header-transparent header-bg-default';
                    }
                }
            }
        }

        return apply_filters( 'jobhunt_header_additional_classes', $classes, $header_version );
    }
}

if ( ! function_exists( 'jobhunt_is_header_register_login_modal_form' ) ) {
    function jobhunt_is_header_register_login_modal_form() {
        return apply_filters( 'jobhunt_is_header_register_login_modal_form', false );
    }
}