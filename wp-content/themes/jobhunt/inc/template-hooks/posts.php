<?php
/**
 * Jobhunt post hooks
 *
 * @package jobhunt
 */
add_action( 'jobhunt_loop_post',           'jobhunt_post_inner',            10 );
add_action( 'jobhunt_loop_post',           'jobhunt_post_media_attachment', 15 );
add_action( 'jobhunt_loop_post',		   'jobhunt_post_body_wrap_start',  20 );
add_action( 'jobhunt_loop_post',           'jobhunt_post_header',           30 );
add_action( 'jobhunt_loop_post',           'jobhunt_post_loop_content',     40 );
add_action( 'jobhunt_loop_post',		   'jobhunt_post_body_wrap_end',	45 );
add_action( 'jobhunt_loop_post',           'jobhunt_post_inner_end',        50 );
add_action( 'jobhunt_loop_after',          'jobhunt_paging_nav',            10 );

add_filter( 'excerpt_length',              'jobhunt_custom_excerpt_length', 100 );