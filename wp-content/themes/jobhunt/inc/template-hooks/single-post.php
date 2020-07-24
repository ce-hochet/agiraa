<?php

add_action( 'jobhunt_single_post',           'jobhunt_post_media_attachment',     10 );
add_action( 'jobhunt_single_post',           'jobhunt_post_header',               20 );
add_action( 'jobhunt_single_post',           'jobhunt_post_content',              30 );
// add_action( 'jobhunt_single_post_after',     'jobhunt_author_info',               10 );
add_action( 'jobhunt_single_post_after',     'jobhunt_post_tag_and_sharing',      20 );
add_action( 'jobhunt_single_post_after',     'jobhunt_post_nav',                  30 );
add_action( 'jobhunt_single_post_after',     'jobhunt_display_comments',          40 );
