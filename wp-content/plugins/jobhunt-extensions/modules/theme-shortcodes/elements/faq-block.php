<?php

if ( ! function_exists( 'jobhunt_faq_block_element' ) ) {

    function jobhunt_faq_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'shortcode'         => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'shortcode'         => $shortcode,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_faq_block' ) ) {
            ob_start();
            jobhunt_faq_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_faq_block' , 'jobhunt_faq_block_element' );