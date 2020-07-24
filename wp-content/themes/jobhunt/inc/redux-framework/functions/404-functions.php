<?php
/**
 * Filter functions for 404 Page of Theme Options
 */

if ( ! function_exists( 'redux_apply_404_page_args' ) ) {
    function redux_apply_404_page_args( $args ) {
        global $jobhunt_options;

        if ( ! empty( $jobhunt_options['404_page_bg_image']['url'] ) ) {
            $args['bg_img'] = $jobhunt_options['404_page_bg_image']['url'];
        }

        if ( ! empty( $jobhunt_options['404_page_image']['url'] ) ) {
            $args['img_src'] = $jobhunt_options['404_page_image']['url'];
        }

        if( isset( $jobhunt_options['404_page_page_title'] ) ) {
            $args['page_title'] = $jobhunt_options['404_page_page_title'];
        }

        if( isset( $jobhunt_options['404_page_sub_title'] ) ) {
            $args['sub_title'] = $jobhunt_options['404_page_sub_title'];
        }

        if( isset( $jobhunt_options['404_page_button_text'] ) ) {
            $args['button_text'] = $jobhunt_options['404_page_button_text'];
        }

        if( isset( $jobhunt_options['404_page_button_link'] ) ) {
            $args['button_link'] = $jobhunt_options['404_page_button_link'];
        }

        return $args;
    }
}