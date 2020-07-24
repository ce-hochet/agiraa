<?php

if ( ! function_exists( 'jobhunt_banner_element' ) ) {

    function jobhunt_banner_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'bg_image'          => '',
            'action_link'       => '#',
            'action_text'       => 'Create an Account',
            'is_enable_action'  => '',
            'el_class'          => '',
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : '',
            'action_link'       => $action_link,
            'action_text'       => $action_text,
            'is_enable_action'  => filter_var( $is_enable_action, FILTER_VALIDATE_BOOLEAN ),
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_banner' ) ) {
            ob_start();
            jobhunt_banner( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_banner' , 'jobhunt_banner_element' );