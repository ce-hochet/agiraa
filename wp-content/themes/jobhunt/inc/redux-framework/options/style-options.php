<?php
/**
 * Options available for Styling sub menu of Theme Options
 *
 */

$custom_css_page_link = '<a href="' . esc_url( add_query_arg( array( 'page' => 'custom-primary-color-css-page' ) ), admin_url( 'themes.php' ) ) . '">' . esc_html__( 'Custom Primary CSS', 'jobhunt' ) . '</a>';

$style_options  = apply_filters( 'jobhunt_style_options_args', array(
    'title'     => esc_html__( 'Styling', 'jobhunt' ),
    'icon'      => 'fas fa-edit',
    'fields'    => array(
        array(
            'id'        => 'styling_general_info_start',
            'type'      => 'section',
            'title'     => esc_html__( 'General', 'jobhunt' ),
            'subtitle'  => esc_html__( 'General Theme Style Settings', 'jobhunt' ),
            'indent'    => TRUE,
        ),

        array(
            'title'     => esc_html__( 'Use a predefined color scheme', 'jobhunt' ),
            'on'        => esc_html__('Yes', 'jobhunt'),
            'off'       => esc_html__('No', 'jobhunt'),
            'type'      => 'switch',
            'default'   => 1,
            'id'        => 'use_predefined_color'
        ),

        array(
            'title'     => esc_html__( 'Main Theme Color', 'jobhunt' ),
            'subtitle'  => esc_html__( 'The main color of the site.', 'jobhunt' ),
            'id'        => 'main_color',
            'type'      => 'select',
            'options'   => array(
                'blue-pink'     => esc_html__( 'Blue Pink', 'jobhunt' ),
                'pink-purple'   => esc_html__( 'Pink Purple', 'jobhunt' ),
                'purple-blue'   => esc_html__( 'Purple Blue', 'jobhunt' ),
            ),
            'default'   => 'pink-purple',
            'required'  => array( 'use_predefined_color', 'equals', 1 ),
        ),

        array(
            'id'          => 'custom_primary_color_1',
            'title'       => esc_html__( 'Custom Primary Color 1', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#fb236a',
            'required'    => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'          => 'custom_primary_color_2',
            'title'       => esc_html__( 'Custom Primary Color 2', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#8b91dd',
            'required'    => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'          => 'custom_secondary_bg_color',
            'title'       => esc_html__( 'Custom Secondary BG Color', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#555',
            'required'    => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'          => 'custom_primary_text_color',
            'title'       => esc_html__( 'Custom Primary Text Color', 'jobhunt' ),
            'type'        => 'color',
            'transparent' => false,
            'default'     => '#fff',
            'required'    => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'          => 'include_custom_color',
            'title'       => esc_html__( 'How to include custom color ?', 'jobhunt' ),
            'type'        => 'radio',
            'options'     => array(
                '1'  => esc_html__( 'Inline', 'jobhunt' ),
                '2'  => esc_html__( 'External File', 'jobhunt' )
            ),
            'default'     => '1',
            'required'    => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'        => 'external_file_css',
            'type'      => 'raw',
            'title'     => esc_html__( 'Custom Primary Color CSS', 'jobhunt' ),
            'content'   => esc_html__( 'If you choose "External File", then please "Save Changes" and then click on ths link to get the custom color primary CSS: ', 'jobhunt' ) . $custom_css_page_link,
            'required'  => array( 'use_predefined_color', 'equals', 0 ),
        ),

        array(
            'id'        => 'styling_general_info_end',
            'type'      => 'section',
            'indent'    => FALSE,
        ),
    )
) );
