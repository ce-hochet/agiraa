<?php
/**
 * Filter functions for Footer Section of Theme Options
 */

if ( ! function_exists( 'redux_apply_footer_style' ) ) {
    function redux_apply_footer_style( $footer_style ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['footer_style'] ) ) {
            $footer_style = $jobhunt_options['footer_style'];
        }

        return $footer_style;
    }
}
        
if ( ! function_exists( 'redux_toggle_footer_widgets' ) ) {
    function redux_toggle_footer_widgets( $enable ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['show_footer_widgets'] ) && $jobhunt_options['show_footer_widgets'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_newsletter_form' ) ) {
    function redux_apply_newsletter_form( $form ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['newsletter_signup_form'] ) && $jobhunt_options['newsletter_signup_form'] != '' ) {
            $form = apply_filters( 'the_content', $jobhunt_options['newsletter_signup_form'] );
        }

        return $form;
    }
}

if ( ! function_exists( 'redux_toggle_footer_copyright_info' ) ) {
    function redux_toggle_footer_copyright_info( $enable ) {
        global $jobhunt_options;

        $jobhunt_options['footer_copyright_info_enable'] = isset( $jobhunt_options['footer_copyright_info_enable'] ) ? $jobhunt_options['footer_copyright_info_enable'] : true;

        if( $jobhunt_options['footer_copyright_info_enable'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_footer_copyright_text' ) ) {
    function redux_apply_footer_copyright_text( $text ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['footer_copyright_info'] ) ) {
            $text = $jobhunt_options['footer_copyright_info'];
        }

        return $text;
    }
}