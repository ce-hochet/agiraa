<?php

if ( ! function_exists( 'jobhunt_candidate_info_block_element' ) ) {

    function jobhunt_candidate_info_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'bg_image'          => '',
            'is_featured'       => true,
            'per_page'          => 8,
            'orderby'           => 'title',
            'order'             => 'ASC',
            'ca_infinite'       => true,
            'ca_rows'           => 1,
            'ca_slidesperrow'   => 1,
            'ca_slidestoshow'   => 4,
            'ca_slidestoscroll' => 4,
            'ca_dots'           => true,
            'ca_arrows'         => false,
            'ca_autoplay'       => false,
            'ca_responsive'     => array(),
            'el_class'          => '',
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'color',
            'bg_color'          => $bg_color,
            'bg_image'          => isset( $bg_image ) && intval( $bg_image ) ? wp_get_attachment_image_src( $bg_image, 'full' ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'is_featured'       => filter_var( $is_featured, FILTER_VALIDATE_BOOLEAN ),
            'query_args'        => array(
                'posts_per_page'=> $per_page,
                'orderby'       => $orderby,
                'order'         => $order,
            ),
            'carousel_args'     => array(
                'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
                'rows'              => intval( $ca_rows ),
                'slidesPerRow'      => intval( $ca_slidesperrow ),
                'slidesToShow'      => intval( $ca_slidestoshow ),
                'slidesToScroll'    => intval( $ca_slidestoscroll ),
                'dots'              => filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ),
                'arrows'            => filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ),
                'autoplay'          => filter_var( $ca_autoplay, FILTER_VALIDATE_BOOLEAN )
            ),
            'section_class'     => $el_class
        );

        if( is_object( $ca_responsive ) || is_array( $ca_responsive ) ) {
            $ca_responsive = json_decode( json_encode( $ca_responsive ), true );
        } else {
            $ca_responsive = json_decode( urldecode( $ca_responsive ), true );
        }

        if( ! empty( $ca_responsive ) ) {
            $responsive_args = array();
            
            foreach ( $ca_responsive as $key => $responsive ) {

                extract(shortcode_atts(array(
                    'ca_res_breakpoint'         => 767,
                    'ca_res_slidesperrow'       => 1,
                    'ca_res_slidestoshow'       => 1,
                    'ca_res_slidestoscroll'     => 1,
                ), $responsive));

                $responsive_args[] = array(
                    'breakpoint'    => $ca_res_breakpoint,
                    'settings'      => array(
                        'slidesPerRow'      => intval( $ca_res_slidesperrow ) > 0 ? intval( $ca_res_slidesperrow ) : 1,
                        'slidesToShow'      => intval( $ca_res_slidestoshow ) > 0 ? intval( $ca_res_slidestoshow ) : 1,
                        'slidesToScroll'    => intval( $ca_res_slidestoscroll ) > 0 ? intval( $ca_res_slidestoscroll ) : 1,
                    ),
                );
            }

            $args['carousel_args']['responsive'] = $responsive_args;
        }

        $html = '';
        if( function_exists( 'jobhunt_candidate_info_block' ) ) {
            ob_start();
            jobhunt_candidate_info_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_candidate_info_block' , 'jobhunt_candidate_info_block_element' );