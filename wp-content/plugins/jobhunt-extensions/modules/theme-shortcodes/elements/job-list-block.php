<?php

if ( ! function_exists( 'jobhunt_job_list_block_element' ) ) {

    function jobhunt_job_list_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'shortcode'         => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'shortcode'         => $shortcode,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_job_list_block' ) ) {
            ob_start();
            jobhunt_job_list_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_job_list_block' , 'jobhunt_job_list_block_element' );