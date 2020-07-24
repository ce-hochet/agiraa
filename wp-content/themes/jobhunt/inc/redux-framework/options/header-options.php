<?php
/**
 * Options available for Header sub menu of Theme Options
 * 
 */

$header_options     = apply_filters( 'jobhunt_header_options_args', array(
    'title'     => esc_html__( 'Header', 'jobhunt' ),
    'icon'      => 'far fa-arrow-alt-circle-up',
    'desc'      => esc_html__( 'Options related to the header section. The header has 2 different styles including top bar, masthead, etc.', 'jobhunt' ),
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Top Bar', 'jobhunt' ),
            'id'        => 'top_bar_start',
            'type'      => 'section',
            'indent'    => true,
        ),

        array(
            'id'        => 'header_top_bar_show',
            'title'     => esc_html__( 'Show Top Bar', 'jobhunt' ),
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'id'        => 'top_bar_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Masthead', 'jobhunt' ),
            'id'        => 'masthead_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__('Header Style', 'jobhunt'),
            'subtitle'  => esc_html__('Select the header style.', 'jobhunt'),
            'id'        => 'header_style',
            'type'      => 'select',
            'options'   => array(
                'v1'        => esc_html__( 'Header v1', 'jobhunt' ),
                'v2'        => esc_html__( 'Header v2', 'jobhunt' ),
                'v3'        => esc_html__( 'Header v3', 'jobhunt' ),
                'v4'        => esc_html__( 'Header v4', 'jobhunt' ),
                'v5'        => esc_html__( 'Header v5', 'jobhunt' ),
            ),
            'default'   => 'v1',
        ),

        array(
            'title'     => esc_html__( 'Post A Job', 'jobhunt' ),
            'id'        => 'header_enable_post_a_job',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 1,
        ),

        array(
            'id'        => 'header_post_a_job_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Post A Job Icon', 'jobhunt' ),
            'default'   => 'la la-plus',
        ),

        array(
            'id'        => 'header_post_a_job_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Post A Job Title', 'jobhunt' ),
            'default'   => esc_html__( 'Post A Job', 'jobhunt' ),
        ),

        array(
            'title'     => esc_html__( 'Secondary Nav', 'jobhunt' ),
            'id'        => 'header_enable_secondary_nav',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 1,
        ),

        array(
            'id'        => 'header_secondary_nav_register_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Register Title', 'jobhunt' ),
            'default'   => esc_html__( 'Register', 'jobhunt' ),
        ),

        array(
            'id'        => 'header_secondary_nav_register_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Register Icon', 'jobhunt' ),
            'default'   => 'la la-key',
        ),

        array(
            'id'        => 'header_secondary_nav_login_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Login Title', 'jobhunt' ),
            'default'   => esc_html__( 'Login', 'jobhunt' ),
        ),

        array(
            'id'        => 'header_secondary_nav_login_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Login Icon', 'jobhunt' ),
            'default'   => 'la la-sign-in',
        ),

        array(
            'id'        => 'header_secondary_nav_user_page_title',
            'type'      => 'text',
            'title'     => esc_html__( 'User Page Title', 'jobhunt' ),
            'default'   => esc_html__( 'User Page', 'jobhunt' ),
        ),

        array(
            'id'        => 'header_secondary_nav_user_page_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'User Page Icon', 'jobhunt' ),
            'default'   => 'la la-user',
        ),

        array(
            'id'        => 'header_secondary_nav_logout_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Log Out Title', 'jobhunt' ),
            'default'   => esc_html__( 'Log Out', 'jobhunt' ),
        ),

        array(
            'id'        => 'header_secondary_nav_logout_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Log Out Icon', 'jobhunt' ),
            'default'   => 'la la-sign-out',
        ),

        array(
            'id'        => 'masthead_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Sticky Header', 'jobhunt' ),
            'id'        => 'sticky_header_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Sticky Header', 'jobhunt' ),
            'id'        => 'sticky_header',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'jobhunt'),
            'off'       => esc_html__('Disabled', 'jobhunt'),
            'default'   => 0,
        ),

        array(
            'title'     => esc_html__( 'Use default color', 'jobhunt' ),
            'on'        => esc_html__('Yes', 'jobhunt'),
            'off'       => esc_html__('No', 'jobhunt'),
            'type'      => 'switch',
            'id'        => 'sticky_header_default_color',
            'default'   => 1,
            'required'  => array( 'sticky_header', 'equals', 1 ),
        ),

        array(
            'id'          => 'sticky_header_bg_color',
            'title'       => esc_html__( 'Background Color', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#202020',
            'required'    => array( 'sticky_header_default_color', 'equals', 0 ),
        ),

        array(
            'id'          => 'sticky_header_text_color',
            'title'       => esc_html__( 'Text Color', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#fff',
            'required'    => array( 'sticky_header_default_color', 'equals', 0 ),
        ),

        array(
            'id'        => 'sticky_header_end',
            'type'      => 'section',
            'indent'    => false
        )
    )
) );