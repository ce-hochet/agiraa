<?php

if ( ! function_exists( 'jobhunt_recent_posts_element' ) ) {

    function jobhunt_recent_posts_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => '',
            'limit'             => 3,
            'columns'           => 3,
            'post_choice'       => 'recent',
            'post_ids'          => '',
            'category__in'      => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'post_choice'       => $post_choice,
            'post_ids'          => $post_ids,
            'category__in'      => $category__in,
            'limit'             => $limit,
            'columns'           => $columns,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_recent_posts' ) ) {
            ob_start();
            jobhunt_recent_posts( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_recent_posts' , 'jobhunt_recent_posts_element' );