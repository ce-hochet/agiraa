<?php

if ( ! function_exists( 'jobhunt_features_list_block_element' ) ) {

    function jobhunt_features_list_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'features'          => '',
            'el_class'          => '',
        ), $atts));

        $features_arr = array();

        if( is_object( $features ) || is_array( $features ) ) {
            $features = json_decode( json_encode( $features ), true );
        } else {
            $features = json_decode( urldecode( $features ), true );
        }

        if( is_array( $features ) ) {
            foreach ( $features as $key => $feature ) {

                extract(shortcode_atts(array(
                    'icon'              => '',
                    'feature_title'     => '',
                    'feature_desc'      => '',
                ), $feature));
                
                $features_arr[] = array(
                    'icon'              => $icon,
                    'feature_title'     => $feature_title,
                    'feature_desc'      => $feature_desc,
                );
            }
        }

        $args = array(
            'section_title'     => $section_title,
            'features'          => $features_arr,
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_features_list_block' ) ) {
            ob_start();
            jobhunt_features_list_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_features_list_block' , 'jobhunt_features_list_block_element' );