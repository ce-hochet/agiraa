<?php
/**
 * Redux Framworks hooks
 *
 * @package Jobhunt/ReduxFramework
 */
add_action( 'init',                                           'jobhunt_remove_demo_mode_link' );
add_action( 'redux/loaded',                                   'jobhunt_redux_disable_dev_mode_and_remove_admin_notices' );
add_action( 'redux/page/jobhunt_options/enqueue',             'redux_queue_font_awesome' );

//General Filters
add_filter( 'jobhunt_site_logo_svg',                          'redux_toggle_logo_svg',                        10 );
add_filter( 'jobhunt_enable_scrollup',                        'redux_toggle_scrollup',                        10 );
add_filter( 'jobhunt_register_login_form_page_id',            'redux_apply_register_login_page_id',           10 );
add_filter( 'jobhunt_register_image_sizes',                   'redux_toggle_register_image_size',             10 );
add_filter( 'jobhunt_enable_live_search',                     'redux_toggle_live_search',                     10 );
add_filter( 'jobhunt_enable_location_geocomplete',            'redux_toggle_location_geocomplete',            10 );
add_filter( 'jobhunt_gmaps_browser_api',                      'redux_apply_gmaps_browser_api',                10 );

// Header Filters
add_filter( 'jobhunt_enable_top_bar',                         'redux_toggle_top_bar',                         10 );
add_filter( 'jobhunt_header_version',                         'redux_apply_header_style',                     10 );
add_filter( 'jobhunt_has_sticky_header',                      'redux_toggle_sticky_header',                   10 );
add_filter( 'jobhunt_header_post_a_job_button',               'redux_toggle_header_post_a_job_button',        10 );
add_filter( 'jobhunt_header_post_a_job_button_icon',          'redux_apply_header_post_a_job_button_icon',    10 );
add_filter( 'jobhunt_header_post_a_job_button_text',          'redux_apply_header_post_a_job_button_text',    10 );
add_filter( 'jobhunt_secondary_nav_menu',                     'redux_toggle_header_secondary_nav_menu',       10 );
add_filter( 'jobhunt_secondary_nav_menu_titles',              'redux_apply_header_secondary_nav_menu_titles', 10 );
add_action( 'wp_enqueue_scripts',                             'redux_apply_sticky_header_custom_color',       20 );

// Footer Filters
add_filter( 'jobhunt_footer_version',                         'redux_apply_footer_style',                     10 );
add_filter( 'jobhunt_footer_widgets',                         'redux_toggle_footer_widgets',                  10 );
add_filter( 'jobhunt_newsletter_form',                        'redux_apply_newsletter_form',                  10 );
add_filter( 'jobhunt_footer_enable_copyright_info',           'redux_toggle_footer_copyright_info',           10 );
add_filter( 'jobhunt_footer_copyright_info',                  'redux_apply_footer_copyright_text',            10 );

// Blog Filters
add_filter( 'jobhunt_blog_style',                             'redux_apply_blog_page_view',                   10 );
add_filter( 'jobhunt_blog_layout',                            'redux_apply_blog_page_layout',                 10 );
add_filter( 'jobhunt_single_post_layout',                     'redux_apply_single_post_layout',               10 );
add_filter( 'jobhunt_post_placeholder_icon',                  'redux_toggle_post_placeholder_icon',           10 );
add_filter( 'jobhunt_show_author_info',                       'redux_toggle_author_info',                     10 );
add_filter( 'jobhunt_site_content_blog_page_title',           'redux_apply_blog_page_title',                  10 );
add_filter( 'jobhunt_site_content_blog_page_subtitle',        'redux_apply_blog_page_subtitle',               10 );

// 404 Page Filters
add_filter( 'jobhunt_404_page_args',                          'redux_apply_404_page_args',                    10 );

// Style Filters
add_filter( 'jobhunt_use_predefined_colors',                  'redux_toggle_use_predefined_colors',           10 );
add_action( 'jobhunt_primary_color',                          'redux_apply_primary_color',                    10 );
add_action( 'wp_enqueue_scripts',                             'redux_apply_custom_color_css',                 20 );
add_filter( 'jobhunt_should_add_custom_css_page',             'redux_toggle_custom_css_page',                 10 );

// Typography Filters
add_filter( 'jobhunt_load_default_fonts',                     'redux_has_google_fonts',                       10 );
add_action( 'wp_enqueue_scripts',                             'redux_apply_custom_fonts',                     20 );