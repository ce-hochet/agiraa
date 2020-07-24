<?php

function jobhunt_add_to_products_shortcode( $out, $pairs, $atts, $shortcode ) {

    if ( array_key_exists( 'template', $atts ) ) {
        $out['template'] = $atts['template'];
    }

    return $out;
}

function jobhunt_set_template_prop_in_wc_loop( $atts ) {
    if ( array_key_exists( 'template', $atts ) ) {
        wc_set_loop_prop( 'template', $atts['template'] );
    }
}