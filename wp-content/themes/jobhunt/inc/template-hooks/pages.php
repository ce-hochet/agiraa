<?php

/**
 * Pages
 *
 * @see  jobhunt_page_content()
 * @see  jobhunt_display_comments()
 */
add_action( 'jobhunt_page',       'jobhunt_page_content',         20 );
add_action( 'jobhunt_page_after', 'jobhunt_display_comments',     10 );

add_filter( 'jobhunt_show_site_content_header', 'jobhunt_toggle_page_site_content_header', 10 );