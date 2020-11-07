<?php

add_filter( 'posts_where', 'jobhunt_company_posts_first_character_where_filter', 10, 2 );
add_action( 'template_redirect', 'jh_wpjmc_template_redirect' );

add_action( 'jobhunt_before_company_loop', 'jobhunt_handheld_sidebar_switcher', 15 );
add_action( 'jobhunt_before_company_loop', 'jobhunt_company_listing_control_bar', 10 );
add_action( 'jobhunt_after_company_loop', 'jobhunt_wpjmc_pagination', 999 );

add_filter( 'jobhunt_site_content_page_title', 'jobhunt_wpjmc_page_title' );
add_filter( 'jobhunt_site_content_page_subtitle', 'jobhunt_wpjmc_page_subtitle' );

add_action( 'get_jobhunt_company_listing_control_bar', 'jobhunt_company_listing_control_bar_start', 10 );
add_action( 'get_jobhunt_company_listing_control_bar', 'jobhunt_company_listing_count', 20 );
add_action( 'get_jobhunt_company_listing_control_bar', 'jobhunt_company_catalog_ordering', 30 );
add_action( 'get_jobhunt_company_listing_control_bar', 'jobhunt_company_catalog_letter_filters', 35 );
add_action( 'get_jobhunt_company_listing_control_bar', 'jobhunt_company_listing_control_bar_end', 40 );

add_action( 'jobhunt_before_company_title', 'jobhunt_template_company_logo', 10 );
add_action( 'jobhunt_before_company_title', 'jobhunt_template_company_detail_start', 20 );
add_action( 'jobhunt_company_title', 'jobhunt_template_company_title_position_start', 10 );
add_action( 'jobhunt_company_title', 'jobhunt_template_company_title', 20 );
add_action( 'jobhunt_company_title', 'jobhunt_template_company_open_postions', 30 );
add_action( 'jobhunt_company_title', 'jobhunt_template_company_title_position_end', 40 );
add_action( 'jobhunt_after_company_title', 'jobhunt_template_company_meta', 10 );
add_action( 'jobhunt_after_company_title', 'jobhunt_template_company_desc', 20 );
add_action( 'jobhunt_after_company_title', 'jobhunt_template_company_detail_end', 30 );

add_action( 'jobhunt_no_companies_found', 'jobhunt_no_companies_found_info', 10 );

add_action( 'jobhunt_company_sidebar', 'jobhunt_get_company_sidebar', 10 );

add_action( 'single_company_head', 'jobhunt_company_details_head_start', 5 );
add_action( 'single_company_head', 'jobhunt_company_details_head_left_start', 10 );
add_action( 'single_company_head', 'jobhunt_company_info', 20 );
add_action( 'single_company_head', 'jobhunt_company_details_head_left_end', 30 );
add_action( 'single_company_head', 'jobhunt_company_details_head_right_start', 40 );
add_action( 'single_company_head', 'jobhunt_company_socail_network', 50 );
add_action( 'single_company_head', 'jobhunt_company_location_link', 60 );
add_action( 'single_company_head', 'jobhunt_company_details_head_right_end', 70 );
add_action( 'single_company_head', 'jobhunt_company_details_head_end', 999 );

add_action( 'single_company', 'jobhunt_company_description', 10 );
add_action( 'single_company', 'jobhunt_company_video', 20 );
add_action( 'single_company', 'jobhunt_company_job_listing', 30 );

add_action( 'single_company_sidebar', 'jobhunt_company_overview', 10 );
add_action( 'single_company_sidebar', 'jobhunt_company_contact_form', 20 );

add_action( 'jobhunt_get_company_overview', 'jobhunt_company_posted_jobs', 10 );
add_action( 'jobhunt_get_company_overview', 'jobhunt_company_location', 20 );
add_action( 'jobhunt_get_company_overview', 'jobhunt_company_category', 30 );
add_action( 'jobhunt_get_company_overview', 'jobhunt_company_since', 40 );
add_action( 'jobhunt_get_company_overview', 'jobhunt_company_teamsize', 50 );

add_action( 'jobhunt_before_company_loop', 'jh_wpjmc_setup_loop' );
add_action( 'jobhunt_after_company_loop', 'jh_wpjmc_reset_loop', 999 );