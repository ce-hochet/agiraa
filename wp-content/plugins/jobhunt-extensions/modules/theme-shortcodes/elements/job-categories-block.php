<?php

if ( ! function_exists( 'jobhunt_job_categories_block_element' ) ) {

    function jobhunt_job_categories_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => '',
            'per_page'          => 8,
            'action_link'       => '#',
            'action_text'       => 'Browse All Categories',
            'orderby'           => 'title',
            'order'             => 'ASC',
            'slug'              => '',
            'hide_empty'        => true,
            'el_class'          => '',
        ), $atts));

        $args = apply_filters( 'jobhunt_job_categories_block_element_args', array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'action_link'       => $action_link,
            'action_text'       => $action_text,
            'category_args'     => array(
                'number'            => $per_page,
                'orderby'           => $orderby,
                'order'             => $order,
                'slugs'             => $slug,                
                'hide_empty'        => filter_var( $hide_empty, FILTER_VALIDATE_BOOLEAN ),
            ),
            'section_class'     => $el_class
        ) );

        $html = '';
        if( function_exists( 'jobhunt_job_categories_block' ) ) {
            ob_start();
            jobhunt_job_categories_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_job_categories_block' , 'jobhunt_job_categories_block_element' );