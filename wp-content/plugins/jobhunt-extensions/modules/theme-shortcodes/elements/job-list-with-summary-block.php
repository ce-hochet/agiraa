<?php

if ( ! function_exists( 'jobhunt_job_list_with_summary_element' ) ) {

    function jobhunt_job_list_with_summary_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'title_1'           => '',
            'shortcode_1'       => '',
            'title_2'           => '',
            'shortcode_2'       => '',
            'el_class'          => ''
        ), $atts));

        $jobs_arr = array();

        $jobs_arr[0] = array (
            'section_title'     => $title_1,
            'shortcode'         => $shortcode_1,
        );

        $jobs_arr[1] = array (
            'section_title'     => $title_2,
            'shortcode'         => $shortcode_2,
        );

        $args = array(
            'jobs'              => $jobs_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_job_list_with_summary' ) ) {
            ob_start();
            jobhunt_job_list_with_summary( $args );
            $html = ob_get_clean();
        }

        return $html;
    }
}

add_shortcode( 'jobhunt_job_list_with_summary' , 'jobhunt_job_list_with_summary_element' );