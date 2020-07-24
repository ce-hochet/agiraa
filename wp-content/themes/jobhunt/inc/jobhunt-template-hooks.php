<?php
/**
 * Jobhunt hooks
 *
 * @package jobhunt
 */


/**
 * General
 *
 * @see  jobhunt_get_sidebar()
 */
add_action( 'after_setup_theme',        'jobhunt_template_debug_mode',    10 );
add_action( 'jobhunt_sidebar',          'jobhunt_get_sidebar',            10 );
add_action( 'jobhunt_before_content',   'jobhunt_site_content_header',    10 );

/**
 * Homepage v1
 */
add_action( 'jobhunt_before_homepage_v1',       'jobhunt_home_v1_hook_control',             10 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_job_categories_block',     20 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_banner_v1',                30 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_job_list_block',           40 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_testimonial_block',        50 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_company_info_carousel',    60 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_recent_posts',             70 );
add_action( 'jobhunt_homepage_v1',              'jobhunt_home_v1_banner_v2',                80 );

/**
 * Homepage v2
 */
add_action( 'jobhunt_before_homepage_v2',       'jobhunt_home_v2_hook_control',             10 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_job_list_block',           30 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_how_it_works_block',       40 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_company_info_carousel',    50 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_counters_block',           60 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_testimonial_block',        70 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_recent_posts',             80 );
add_action( 'jobhunt_homepage_v2',              'jobhunt_home_v2_job_pricing',              90 );

/**
 * Homepage v3
 */
add_action( 'jobhunt_before_homepage_v3',       'jobhunt_home_v3_hook_control',             10 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_job_categories_block',     20 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_banner',                   30 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_job_list_block',           40 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_how_it_works_block',       50 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_company_info_carousel',    60 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_testimonial_block',        70 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_app_promo_block',          80 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_candidate_info_block',     90 );
add_action( 'jobhunt_homepage_v3',              'jobhunt_home_v3_job_pricing',              100 );

/**
 * Homepage v4
 */
add_action( 'jobhunt_before_homepage_v4',       'jobhunt_home_v4_hook_control',             10 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_job_categories_block',     20 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_job_list_tabs',            30 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_app_promo_block',          40 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_candidate_info_block',     50 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_company_info_carousel',    60 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_recent_posts',             70 );
add_action( 'jobhunt_homepage_v4',              'jobhunt_home_v4_how_it_works_block',       80 );

/**
 * Homepage v5
 */
add_action( 'jobhunt_before_homepage_v5',       'jobhunt_home_v5_hook_control',                 10 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_job_categories_block',         20 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_job_list_with_summary',        30 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_dual_banner_block',            40 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_how_it_works_block',           50 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_counters_block',               60 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_faq_with_testimonial_block',   70 );
add_action( 'jobhunt_homepage_v5',              'jobhunt_home_v5_banner_with_image_block',      80 );

/**
 * Aboutpage
 */
add_action( 'jobhunt_before_aboutpage',         'jobhunt_about_hook_control',                   10 );
add_action( 'jobhunt_aboutpage',                'jobhunt_about_about_content',                  20 );
add_action( 'jobhunt_aboutpage',                'jobhunt_about_features_list_block',            30 );
add_action( 'jobhunt_aboutpage',                'jobhunt_about_testimonial_block',              40 );
add_action( 'jobhunt_aboutpage',                'jobhunt_about_counters_block',                 50 );
add_action( 'jobhunt_aboutpage',                'jobhunt_about_recent_posts',                   60 );

require_once get_template_directory() . '/inc/template-hooks/posts.php';
require_once get_template_directory() . '/inc/template-hooks/single-post.php';
require_once get_template_directory() . '/inc/template-hooks/pages.php';
require_once get_template_directory() . '/inc/template-hooks/widgets.php';
require_once get_template_directory() . '/inc/template-hooks/header.php';
require_once get_template_directory() . '/inc/template-hooks/footer.php';