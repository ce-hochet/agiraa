<?php
/**
 * Options available for Typography sub menu of Theme Options
 *
 */

$typography_options     = apply_filters( 'jobhunt_typography_options_args', array(
    'title'     => esc_html__( 'Typography', 'jobhunt' ),
    'icon'      => 'fas fa-font',
    'fields'    => array(
        array(
            'title'         => esc_html__( 'Use default font scheme ?', 'jobhunt' ),
            'on'            => esc_html__('Yes', 'jobhunt'),
            'off'           => esc_html__('No', 'jobhunt'),
            'type'          => 'switch',
            'default'       => true,
            'id'            => 'use_predefined_font',
        ),

        array(
            'title'         => esc_html__( 'Title Font Family', 'jobhunt' ),
            'type'          => 'typography',
            'id'            => 'jobhunt_title_font',
            'text-align'    => false,
            'font-style'    => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'default'       => array(
                'font-family'   => 'Oswald',
                'subsets'       => 'latin',
                'style'         => '300',
            ),
            'required'      => array( 'use_predefined_font', 'equals', false ),
        ),

        array(
            'title'         => esc_html__( 'Content Font Family', 'jobhunt' ),
            'type'          => 'typography',
            'id'            => 'jobhunt_content_font',
            'text-align'    => false,
            'font-style'    => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'default'       => array(
                'font-family'   => 'Open Sans',
                'subsets'       => 'latin',
                'style'         => '400',
            ),
            'required'      => array( 'use_predefined_font', 'equals', false ),
        ),
    )
) );
