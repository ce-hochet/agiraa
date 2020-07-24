<?php

function jobhunt_add_metaboxes( $post_type, $post ) {
    do_action( 'jobhunt_add_metaboxes', $post_type, $post );
}

add_action( 'add_meta_boxes', 'jobhunt_add_metaboxes', 10, 2 );

function jobhunt_add_metabox( $id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null ) {
    add_meta_box( $id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null );
}

// Redux Framework
function jobhunt_ext_remove_demo_mode_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
}

add_action( 'init', 'jobhunt_ext_remove_demo_mode_link' );

// Jetpack
function jobhunt_jetpack_remove_share() {

    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jobhunt_jetpack_remove_share' );

function jobhunt_get_server_query_string() {
    return isset( $_SERVER['QUERY_STRING'] ) ? $_SERVER['QUERY_STRING'] : '';
}