<?php
/**
 * Options available for Footer sub menu in Theme Options
 */

$footer_options = apply_filters( 'jobhunt_footer_options_args', array(
    'title'     => esc_html__( 'Footer', 'jobhunt' ),
    'desc'      => esc_html__( 'Options related to the footer section. The Footer has : Brands Slider, Footer Widgets, Footer Newsletter Section, Footer Contact Block, Footer Bottom Wigets', 'jobhunt' ),
    'icon'      => 'far fa-arrow-alt-circle-down',
    'fields'    => array(

        array(
            'id'        => 'footer_style_start',
            'type'      => 'section',
            'indent'    => true,
            'title'     => esc_html__( 'Footer Style Block', 'jobhunt' ),
        ),

        array(
            'title'     => esc_html__('Footer Style', 'jobhunt'),
            'subtitle'  => esc_html__('Select the footer style.', 'jobhunt'),
            'id'        => 'footer_style',
            'type'      => 'select',
            'options'   => array(
                'v1'        => esc_html__( 'Footer v1', 'jobhunt' ),
                'v2'        => esc_html__( 'Footer v2', 'jobhunt' ),
                'v3'        => esc_html__( 'Footer v3', 'jobhunt' ),
                'v4'        => esc_html__( 'Footer v4', 'jobhunt' ),
                'v5'        => esc_html__( 'Footer v5', 'jobhunt' ),
            ),
            'default'   => 'v1',
        ),

        array(
            'id'        => 'footer_style_end',
            'type'      => 'section',
            'indent'    => false,
        ),

        array(
            'id'        => 'footer_widgets_start',
            'type'      => 'section',
            'title'     => esc_html__( 'Footer Widgets', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Options related to Footer Widgets. Please add widgets in Appearance > Widgets > Footer Column widget area.', 'jobhunt' ),
            'indent'    => true,
        ),

        array(
            'title'     => esc_html__( 'Show Footer Widgets ?', 'jobhunt' ),
            'id'        => 'show_footer_widgets',
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'title'     => esc_html__( 'Newsletter signup form', 'jobhunt' ),
            'id'        => 'newsletter_signup_form',
            'type'      => 'textarea',
            'subtitle'  => esc_html__( 'Paste your newsletter signup form or shortcode', 'jobhunt' ),
        ),

        array(
            'id'        => 'footer_widgets_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'id'        => 'footer_bottom_bar_start',
            'type'      => 'section',
            'indent'    => true,
            'title'     => esc_html__( 'Footer Bottom Bar', 'jobhunt' ),
            'subtitle'  => esc_html__( 'The Footer Bottom Bar is available bottom of Footer.', 'jobhunt' ),
        ),

        array(
            'id'        => 'footer_copyright_info_enable',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Footer Copyright', 'jobhunt' ),
            'default'   => 1,
        ),

        array(
            'id'        => 'footer_copyright_info',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Footer Copyright Text', 'jobhunt' ),
            'default'   => wp_kses_post( sprintf( __( '&copy; %s  <a href="%s">%s</a>. All rights reserved. Design by <a href="https://madrasthemes.com/">Madras Themes</a>', 'jobhunt' ), date('Y'), esc_url( home_url('/') ), get_bloginfo( 'name' ) ) ),
            'required'  => array( 'footer_copyright_info_enable', 'equals', 1 ),
        ),

        array(
            'id'        => 'footer_bottom_bar_end',
            'type'      => 'section',
            'indent'    => false
        ),

    )
) );
