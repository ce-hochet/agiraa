<?php
/**
 * Filter functions for General Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_logo_svg' ) ) {
    function redux_toggle_logo_svg() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['logo_svg'] ) && $jobhunt_options['logo_svg'] == '1' ) {
            $logo_svg = true;
        } else {
            $logo_svg = false;
        }

        return $logo_svg;
    }
}

if( ! function_exists( 'redux_toggle_scrollup' ) ) {
    function redux_toggle_scrollup() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['scrollup'] ) && $jobhunt_options['scrollup'] == '1' ) {
            $scrollup = true;
        } else {
            $scrollup = false;
        }

        return $scrollup;
    }
}

if( ! function_exists( 'redux_apply_register_login_page_id' ) ) {
    function redux_apply_register_login_page_id( $register_login_page_id ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['register_login_page_id'] ) ) {
            $register_login_page_id = $jobhunt_options['register_login_page_id'];
        }

        return $register_login_page_id;
    }
}

if( ! function_exists( 'redux_toggle_register_image_size' ) ) {
    function redux_toggle_register_image_size() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['reg_image_size'] ) && $jobhunt_options['reg_image_size'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if( ! function_exists( 'redux_toggle_live_search' ) ) {
    function redux_toggle_live_search() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['enable_live_search'] ) && $jobhunt_options['enable_live_search'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if( ! function_exists( 'redux_toggle_location_geocomplete' ) ) {
    function redux_toggle_location_geocomplete() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['enable_location_geocomplete'] ) && $jobhunt_options['enable_location_geocomplete'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_gmaps_browser_api' ) ) {
    function redux_apply_gmaps_browser_api( $key ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['gmaps_api_key'] ) ) {
            $key = $jobhunt_options['gmaps_api_key'];
        }

        return $key;
    }
}
