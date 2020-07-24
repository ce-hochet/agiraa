<?php

if ( ! function_exists( 'jobhunt_banner_with_image_block_element' ) ) {

    function jobhunt_banner_with_image_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'title'             => '',
            'sub_title'         => '',
            'image'             => '',
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'bg_image'          => '',
            'el_class'          => '',
        ), $atts));

        $args = array(
            'title'             => $title,
            'sub_title'         => $sub_title,
            'image'             => isset( $image ) && intval( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : array( '//placehold.it/450x474', '450', '474' ),
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_banner_with_image_block' ) ) {
            ob_start();
            jobhunt_banner_with_image_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_banner_with_image_block' , 'jobhunt_banner_with_image_block_element' );