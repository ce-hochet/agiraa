<?php

add_action( 'jobhunt_before_job_listing', 'jobhunt_template_job_listing_link_open', 10 );
add_action( 'jobhunt_before_job_listing_title', 'jobhunt_template_job_listing_company_logo', 20 );
add_action( 'jobhunt_before_job_listing_title', 'jobhunt_template_job_listing_detail_open', 30 );
add_action( 'jobhunt_before_job_listing_title', 'jobhunt_template_job_listing_detail_inner_open', 40 );
add_action( 'jobhunt_job_listing_title', 'jobhunt_template_job_listing_title', 50 );
add_action( 'jobhunt_job_listing_title', 'jobhunt_template_job_listing_company_details', 60 );
add_action( 'jobhunt_job_listing_title', 'jobhunt_template_job_listing_location', 70 );
add_action( 'jobhunt_after_job_listing_title', 'jobhunt_template_job_listing_detail_inner_close', 80 );
add_action( 'jobhunt_after_job_listing_title', 'jobhunt_template_job_listing_loop_job_meta', 90 );
add_action( 'jobhunt_after_job_listing', 'jobhunt_template_job_listing_detail_close', 100 );
add_action( 'jobhunt_after_job_listing', 'jobhunt_template_job_listing_link_close', 110 );

add_action( 'jobhunt_job_listing_meta', 'jobhunt_template_job_listing_location', 10 );
add_action( 'jobhunt_job_listing_meta', 'jobhunt_job_listing_job_type', 20 );
add_action( 'jobhunt_job_listing_meta', 'jobhunt_job_publishd_date', 30 );

add_action( 'jobhunt_no_jobs_found', 'jobhunt_no_jobs_found_info', 10 );

add_filter( 'job_manager_output_jobs_defaults', 'jobhunt_modify_output_jobs_defaults' );
add_filter( 'job_manager_get_listings_result', 'jobhunt_add_showing_to_listings_result', 10, 2 );

add_action( 'jobhunt_jobs_sidebar', 'jobhunt_get_jobs_sidebar' );
add_filter( 'jobhunt_site_content_page_title', 'jobhunt_wpjm_page_title' );
add_filter( 'jobhunt_site_content_page_subtitle', 'jobhunt_wpjm_page_subtitle' );

add_action( 'single_job_listing_inner_before', 'jobhunt_modify_single_job_listing_hooks' );

add_action( 'single_job_listing', 'jobhunt_single_job_listing_description', 10 );
add_action( 'single_job_listing', 'the_company_video', 20 );
add_action( 'single_job_listing', 'jobhunt_single_job_listing_share', 30 );
add_action( 'single_job_listing', 'jobhunt_single_job_listing_related_jobs', 40 );
add_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_application', 10 );
add_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_overview', 20 );
add_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_location_map', 30 );

add_action( 'preview_job_form_start', 'jobhunt_form_preview_job_remove_comment' );

// Jobs Active Filters
add_action( 'jobhunt_no_jobs_found', 'jobhunt_wpjm_get_all_active_filters_bar', 5 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_get_all_active_filters_bar', 5 );

add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_job_listing_control_bar_start', 10 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_result_count', 20 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_job_sorting_open', 30 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_job_catalog_ordering', 40 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_job_per_page', 50 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_wpjm_job_sorting_close', 60 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_handheld_sidebar_switcher', 65 );
add_action( 'jobhunt_before_job_listing_loop', 'jobhunt_job_listing_control_bar_end', 70 );

add_action( 'jobhunt_after_job_listing_loop', 'jobhunt_wpjm_pagination' );

add_action( 'jobhunt_before_job_listing_loop', 'jh_wpjm_setup_loop' );
add_action( 'jobhunt_after_job_listing_loop', 'jh_wpjm_reset_loop', 999 );

add_action( 'jh_wpjm_before_shortcode_job_listings_start', 'jh_wpjm_shortcode_result_count', 10, 2 );