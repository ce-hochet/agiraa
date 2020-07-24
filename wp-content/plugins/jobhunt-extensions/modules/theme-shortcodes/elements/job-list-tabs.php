<?php

if ( ! function_exists( 'jobhunt_job_list_tabs_element' ) ) {

    function jobhunt_job_list_tabs_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'title_1'           => '',
            'shortcode_1'       => '',
            'title_2'           => '',
            'shortcode_2'       => '',
            'el_class'          => ''
        ), $atts));

        $tabs_arr = array();

        $tabs_arr[0] = array (
            'title'             => $title_1,
            'shortcode'         => $shortcode_1,
        );

        $tabs_arr[1] = array (
            'title'             => $title_2,
            'shortcode'         => $shortcode_2,
        );

        $args = array(
            'tabs'              => $tabs_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_job_list_tabs' ) ) {
            ob_start();
            jobhunt_job_list_tabs( $args );
            $html = ob_get_clean();
        }

        return $html;
    }
}

add_shortcode( 'jobhunt_job_list_tabs' , 'jobhunt_job_list_tabs_element' );