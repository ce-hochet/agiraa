<?php

if ( ! function_exists( 'jobhunt_job_pricing_element' ) ) {

    function jobhunt_job_pricing_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'sub_title'         => '',
            'shortcode_tag'     => 'products',
            'per_page'          => 3,
            'columns'           => 3,
            'orderby'           => 'date',
            'order'             => 'desc',
            'product_id'        => '',
            'category'          => '',
            'el_class'          => ''
        ), $atts));

        $shortcode_atts = function_exists( 'jobhunt_get_atts_for_shortcode' ) ? jobhunt_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $per_page ) ),
            'section_class'     => $el_class
        );

        $html = '';
        if( function_exists( 'jobhunt_job_pricing' ) ) {
            ob_start();
            jobhunt_job_pricing( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'jobhunt_job_pricing' , 'jobhunt_job_pricing_element' );