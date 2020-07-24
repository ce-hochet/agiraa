<?php
/**
 * Options available for 404 Page of Theme Options
 * 
 */
$error_page_options   = apply_filters( 'jobhunt_error_page_args', array(
    'title'     => esc_html__( '404 Page', 'jobhunt' ),
    'icon'      => 'fas fa-exclamation-circle',
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Background Image', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Upload your 404 page background image.', 'jobhunt' ),
            'id'        => '404_page_bg_image',
            'type'      => 'media',
        ),

        array(
            'title'     => esc_html__( 'Image', 'jobhunt' ),
            'subtitle'  => esc_html__( 'Upload your 404 page image.', 'jobhunt' ),
            'id'        => '404_page_image',
            'type'      => 'media',
        ),

        array(
            'title'     => esc_html__( 'Page Title', 'jobhunt' ),
            'id'        => '404_page_page_title',
            'type'      => 'text',
            'default'   => esc_html__( 'We Are Sorry, Page Not Found', 'jobhunt' ),
        ),

        array(
            'title'     => esc_html__( 'Sub Title', 'jobhunt' ),
            'id'        => '404_page_sub_title',
            'type'      => 'textarea',
            'default'   => esc_html__( 'Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist. Check the Url you entered for any mistakes and try again.', 'jobhunt' ),
        ),

        array(
            'title'     => esc_html__( 'Button Text', 'jobhunt' ),
            'id'        => '404_page_button_text',
            'type'      => 'text',
            'default'   => esc_html__( 'Back to Homepage', 'jobhunt'),
        ),

        array(
            'title'     => esc_html__( 'Button Link', 'jobhunt' ),
            'id'        => '404_page_button_link',
            'type'      => 'text',
            'default'   => home_url( '/' ),
        ),
    )
) );