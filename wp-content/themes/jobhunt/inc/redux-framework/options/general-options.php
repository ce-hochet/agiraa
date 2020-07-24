<?php
/**
 * General Theme Options
 * 
 */

$general_options    = apply_filters( 'jobhunt_general_options_args', array(
    'title'     => esc_html__( 'General', 'jobhunt' ),
    'icon'      => 'far fa-dot-circle',
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Logo SVG', 'jobhunt'),
            'subtitle'  => esc_html__( 'Enable to display svg logo instead of site title.', 'jobhunt' ),
            'desc'      => esc_html__( 'This will not work when you use site logo in customizer.', 'jobhunt' ),
            'id'        => 'logo_svg',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'jobhunt' ),
            'off'       => esc_html__( 'Disabled', 'jobhunt' ),
            'default'   => 1,
        ),
        array(
            'title'     => esc_html__( 'Scroll To Top', 'jobhunt' ),
            'id'        => 'scrollup',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 1,
        ),
        array(
            'id'        => 'register_login_page_id',
            'title'     => esc_html__( 'Register/Login Page', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Choose a page that will be the register/login page.', 'jobhunt' ),
            'type'      => 'select',
            'data'      => 'pages',
        ),
        array(
            'title'     => esc_html__( 'Register Image Size', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Enable and regenerate thumbnails to enable theme registered image sizes.', 'jobhunt' ),
            'id'        => 'reg_image_size',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 0,
        ),
        array(
            'title'     => esc_html__( 'Enable Live Search', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Enable/Disable Live Search.', 'jobhunt' ),
            'id'        => 'enable_live_search',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 0,
        ),
        array(
            'title'     => esc_html__( 'Enable Location Geocomplete', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Geocomplete will work only with a valid google maps api key.', 'jobhunt' ),
            'id'        => 'enable_location_geocomplete',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 0,
        ),
        array(
            'id'        => 'gmaps_api_key',
            'type'      => 'text',
            'title'     => esc_html__( 'Google Maps API Key', 'jobhunt' ),
            'default'   => '',
        )
    )
) );
