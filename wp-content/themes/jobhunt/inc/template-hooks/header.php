<?php
/**
 * Header v1
 */
add_action( 'jobhunt_header_v1', 'jobhunt_site_branding',   10 );
add_action( 'jobhunt_header_v1', 'jobhunt_primary_nav',     20 );
add_action( 'jobhunt_header_v1', 'jobhunt_post_a_job',      30 );
add_action( 'jobhunt_header_v1', 'jobhunt_secondary_nav',   40 );

/**
 * Header v2
 */
add_action( 'jobhunt_header_v2', 'jobhunt_site_branding',   10 );
add_action( 'jobhunt_header_v2', 'jobhunt_primary_nav',     20 );
add_action( 'jobhunt_header_v2', 'jobhunt_post_a_job',      30 );
add_action( 'jobhunt_header_v2', 'jobhunt_secondary_nav',   40 );

/**
 * Header v3
 */
add_action( 'jobhunt_header_v3', 'jobhunt_site_branding',   10 );
add_action( 'jobhunt_header_v3', 'jobhunt_primary_nav',     20 );
add_action( 'jobhunt_header_v3', 'jobhunt_post_a_job',      30 );
add_action( 'jobhunt_header_v3', 'jobhunt_secondary_nav',   40 );

/**
 * Header v4
 */
add_action( 'jobhunt_header_v4', 'jobhunt_site_branding',   10 );
add_action( 'jobhunt_header_v4', 'jobhunt_primary_nav',     20 );
add_action( 'jobhunt_header_v4', 'jobhunt_secondary_nav',   30 );

/**
 * Header v5
 */
add_action( 'jobhunt_header_v5', 'jobhunt_primary_nav',     10 );
add_action( 'jobhunt_header_v5', 'jobhunt_site_branding',   20 );
add_action( 'jobhunt_header_v5', 'jobhunt_post_a_job',      30 );
add_action( 'jobhunt_header_v5', 'jobhunt_secondary_nav',   40 );

/**
 * Top Bar hooks
 */
add_action( 'jobhunt_top_bar', 'jobhunt_top_bar',     10 );

/**
 * HandHeld Header
 */
add_action( 'jobhunt_after_header',    'jobhunt_header_handheld',   10 );

add_action( 'jobhunt_header_handheld', 'jobhunt_off_canvas_nav',    10 );
add_action( 'jobhunt_header_handheld', 'jobhunt_site_branding',     20 );
add_action( 'jobhunt_header_handheld', 'jobhunt_secondary_nav',     30 );

add_action( 'wp_footer', 'jobhunt_header_register_login_modal_form' );