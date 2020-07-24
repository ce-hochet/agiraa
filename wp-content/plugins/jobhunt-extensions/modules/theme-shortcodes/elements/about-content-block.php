<?php

if ( ! function_exists( 'jobhunt_about_content_element' ) ) {

    function jobhunt_about_content_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'about_content'     => '',
            'image'             => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'about_content'     => $about_content,
            'image'             => isset( $image ) && intval( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : '',
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_about_content' ) ) {
            ob_start();
            jobhunt_about_content( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_about_content' , 'jobhunt_about_content_element' );