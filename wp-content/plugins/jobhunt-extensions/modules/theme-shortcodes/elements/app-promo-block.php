<?php

if ( ! function_exists( 'jobhunt_app_promo_block_element' ) ) {

    function jobhunt_app_promo_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'image'             => '',
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'bg_image'          => '',
            'app_title_1'       => '',
            'app_desc_1'        => '',
            'icon_1'            => '',
            'link_1'            => '#',
            'app_title_2'       => '',
            'app_desc_2'        => '',
            'icon_2'            => '',
            'link_2'            => '#',
            'el_class'          => '',
        ), $atts));

        $apps_arr = array();

        $apps_arr[0] = array (
            'app_title'       => $app_title_1,
            'app_desc'        => $app_desc_1,
            'icon'            => $icon_1,
            'link'            => $link_1,
        );

        $apps_arr[1] = array (
            'app_title'       => $app_title_2,
            'app_desc'        => $app_desc_2,
            'icon'            => $icon_2,
            'link'            => $link_2,
        );

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'image'             => isset( $image ) && intval( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : '',
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'apps'              => $apps_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_app_promo_block' ) ) {
            ob_start();
            jobhunt_app_promo_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_app_promo_block' , 'jobhunt_app_promo_block_element' );