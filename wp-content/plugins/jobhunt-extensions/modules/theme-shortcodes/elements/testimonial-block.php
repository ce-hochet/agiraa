<?php

if ( ! function_exists( 'jobhunt_testimonial_block_element' ) ) {

    function jobhunt_testimonial_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => '',
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'bg_image'          => '',
            'per_page'          => 8,
            'orderby'           => 'title',
            'order'             => 'ASC',
            'ca_infinite'       => true,
            'ca_rows'           => 1,
            'ca_slidesperrow'   => 1,
            'ca_slidestoshow'   => 1,
            'ca_slidestoscroll' => 1,
            'ca_dots'           => true,
            'ca_arrows'         => false,
            'ca_autoplay'       => false,
            'ca_responsive'     => array(),
            'el_class'          => '',
        ), $atts));

        if( ! empty( $type ) && $type === 'v1' ) {
            $ca_slidestoshow = 2;
            $ca_slidestoscroll = 2;
        } else {
            $ca_slidestoshow = 1;
            $ca_slidestoscroll = 1;
        }

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'color',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'query_args'        => array(
                'limit'         => $per_page,
                'orderby'       => $orderby,
                'order'         => $order,
                'size'          => '',
            ),
            'carousel_args'     => array(
                'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
                'rows'              => intval( $ca_rows ),
                'slidesPerRow'      => intval( $ca_slidesperrow ),
                'slidesToShow'      => intval( $ca_slidestoshow ),
                'slidesToScroll'    => intval( $ca_slidestoscroll ),
                'dots'              => filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ),
                'arrows'            => filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ),
                'autoplay'          => filter_var( $ca_autoplay, FILTER_VALIDATE_BOOLEAN ),
                'responsive'        => array(
                    array(
                        'breakpoint'    => 0,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 576,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 768,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 992,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 1200,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    )
                )
            ),
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_testimonial_block' ) ) {
            ob_start();
            jobhunt_testimonial_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_testimonial_block' , 'jobhunt_testimonial_block_element' );