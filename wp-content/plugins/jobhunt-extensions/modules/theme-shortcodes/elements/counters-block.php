<?php

if ( ! function_exists( 'jobhunt_counters_block_element' ) ) {

    function jobhunt_counters_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'bg_image'          => '',
            'type'              => '',
            'counter_title_1'   => '',
            'count_value_1'     => '',
            'counter_title_2'   => '',
            'count_value_2'     => '',
            'counter_title_3'   => '',
            'count_value_3'     => '',
            'counter_title_4'   => '',
            'count_value_4'     => '',
            'el_class'          => '',
        ), $atts));

        $counter_arr = array();

        $counter_arr[0] = array (
            'counter_title'     => $counter_title_1,
            'count_value'       => $count_value_1,
        );

        $counter_arr[1] = array (
            'counter_title'     => $counter_title_2,
            'count_value'       => $count_value_2,
        );
        
        $counter_arr[2] = array (
            'counter_title'     => $counter_title_3,
            'count_value'       => $count_value_3,
        );
        
        $counter_arr[3] = array (
            'counter_title'     => $counter_title_4,
            'count_value'       => $count_value_4,
        );

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'color',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'type'              => $type,
            'counters'          => $counter_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_counters_block' ) ) {
            ob_start();
            jobhunt_counters_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_counters_block' , 'jobhunt_counters_block_element' );