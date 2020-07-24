<?php

if ( ! function_exists( 'jobhunt_dual_banner_block_element' ) ) {

    function jobhunt_dual_banner_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'bg_image'          => '',
            'title_1'           => '',
            'sub_title_1'       => '',
            'action_text_1'     => '',
            'action_link_1'     => '#',
            'title_2'           => '',
            'sub_title_2'       => '',
            'action_text_2'     => '',
            'action_link_2'     => '#',
            'el_class'          => '',
        ), $atts));

        $banner_arr = array();

        $banner_arr[0] = array (
            'title'             => $title_1,
            'sub_title'         => $sub_title_1,
            'action_text'       => $action_text_1,
            'action_link'       => $action_link_1,
        );

        $banner_arr[1] = array (
            'title'             => $title_2,
            'sub_title'         => $sub_title_2,
            'action_text'       => $action_text_2,
            'action_link'       => $action_link_2,
        );

        $args = array(
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'banners'           => $banner_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_dual_banner_block' ) ) {
            ob_start();
            jobhunt_dual_banner_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_dual_banner_block' , 'jobhunt_dual_banner_block_element' );