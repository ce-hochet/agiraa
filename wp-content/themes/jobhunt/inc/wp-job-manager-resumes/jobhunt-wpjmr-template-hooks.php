<?php

add_filter( 'jobhunt_site_content_page_title', 'jobhunt_wpjmr_page_title' );
add_filter( 'jobhunt_site_content_page_subtitle', 'jobhunt_wpjmr_page_subtitle' );

add_action( 'jobhunt_after_resume_loop', 'jobhunt_wpjmr_pagination', 999 );

add_action( 'jobhunt_resume_sidebar', 'jobhunt_get_resume_sidebar' );

add_action( 'jobhunt_before_resume_title', 'jobhunt_template_candidate_image', 10 );
add_action( 'jobhunt_before_resume_title', 'jobhunt_template_candidate_detail_start', 20 );
add_action( 'jobhunt_resume_title', 'jobhunt_template_candidate_info', 30 );
add_action( 'jobhunt_after_resume_title', 'jobhunt_template_candidate_detail_end', 40 );
add_action( 'jobhunt_after_resume_title', 'jobhunt_template_candidate_view', 50 );

add_action( 'jobhunt_no_resumes_found', 'jobhunt_no_resumes_found_info', 10 );

add_action( 'single_resume_before', 'jh_wpjmr_single_modify_head_hook', 10 );

add_action( 'single_resume_head', 'single_resume_head_start', 5 );
add_action( 'single_resume_head', 'single_resume_head_left_start', 10 );
add_action( 'single_resume_head', 'jobhunt_resume_category', 20 );
add_action( 'single_resume_head', 'jobhunt_candidate_socail_network', 30 );
add_action( 'single_resume_head', 'single_resume_head_left_end', 40 );
add_action( 'single_resume_head', 'single_resume_head_center_start', 50 );
add_action( 'single_resume_head', 'jobhunt_candidate_info', 60 );
add_action( 'single_resume_head', 'single_resume_head_center_end', 70 );
add_action( 'single_resume_head', 'single_resume_head_right_start', 80 );
add_action( 'single_resume_head', 'jobhunt_candidate_location_published_start', 90 );
add_action( 'single_resume_head', 'jobhunt_candidate_location', 100 );
add_action( 'single_resume_head', 'jobhunt_candidate_profle_published', 110 );
add_action( 'single_resume_head', 'jobhunt_candidate_location_published_end', 120 );
add_action( 'single_resume_head', 'jobhunt_the_resume_file', 130 );
add_action( 'single_resume_head', 'single_resume_head_right_end', 140 );
add_action( 'single_resume_head', 'single_resume_head_end', 999 );

add_action( 'single_resume_content_navbar', 'jobhunt_single_candidate_content_navbar_start', 10 );
add_action( 'single_resume_content_navbar', 'jobhunt_single_candidate_content_navbar_links', 20 );
add_action( 'single_resume_content_navbar', 'jobhunt_single_candidate_content_navbar_end', 30 );

add_action( 'single_resume_content', 'jobhunt_single_candidate_content_area_start', 10 );
add_action( 'single_resume_content', 'jobhunt_candidate_description', 20 );
add_action( 'single_resume_content', 'jobhunt_candidate_qualification', 30 );
add_action( 'single_resume_content', 'jobhunt_candidate_experience', 40 );
add_action( 'single_resume_content', 'jobhunt_candidate_skill', 50 );
add_action( 'single_resume_content', 'jobhunt_candidate_awards', 60 );
add_action( 'single_resume_content', 'jobhunt_candidate_video', 70 );
add_action( 'single_resume_content', 'jobhunt_single_candidate_content_area_end', 80 );

add_action( 'single_resume_sidebar', 'jobhunt_single_candidate_sidebar_area_start', 10 );
add_action( 'single_resume_sidebar', 'jobhunt_single_candidate_overview', 20 );
add_action( 'single_resume_sidebar', 'jobhunt_single_candidate_contact_form', 30 );
add_action( 'single_resume_sidebar', 'jobhunt_single_candidate_sidebar_area_end', 999 );

add_action( 'preview_resume_form_start', 'jobhunt_form_preview_resume_remove_contact_form' );

add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_twitter_page', 10 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_facebook_page', 20 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_googleplus_page', 30 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_linkedin_page', 40 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_instagram_page', 50 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_youtube_page', 60 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_behance_page', 70 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_pinterest_page', 80 );
add_action( 'get_jobhunt_candidate_socail_network', 'the_candidate_github_page', 90 );

add_action( 'jobhunt_before_resume_loop', 'jobhunt_handheld_sidebar_switcher', 15 );
add_action( 'jobhunt_before_resume_loop', 'jh_wpjmr_setup_loop' );
add_action( 'jobhunt_after_resume_loop', 'jh_wpjmr_reset_loop', 999 );