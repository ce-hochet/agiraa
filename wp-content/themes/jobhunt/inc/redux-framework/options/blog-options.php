<?php
/**
 * Options available for Blog sub menu of Theme Options
 * 
 */

$blog_options   = apply_filters( 'jobhunt_blog_options_args', array(
    'title'     => esc_html__( 'Blog', 'jobhunt' ),
    'icon'      => 'far fa-list-alt',
    'fields'    => array(
    
        array(
            'title'     => esc_html__('Blog Page View', 'jobhunt'),
            'subtitle'  => esc_html__('Select the view for the Blog Listing.', 'jobhunt'),
            'id'        => 'blog_view',
            'type'      => 'select',
            'options'   => array(
                'blog-default'  => esc_html__( 'Default', 'jobhunt' ),
                'blog-grid'     => esc_html__( 'Grid', 'jobhunt' ),
                'blog-list'     => esc_html__( 'List', 'jobhunt' )
            ),
            'default'   => 'blog-default',
        ),

        array(
            'title'     => esc_html__('Blog Page Layout', 'jobhunt'),
            'subtitle'  => esc_html__('Select the layout for the Blog Listing.', 'jobhunt'),
            'id'        => 'blog_layout',
            'type'      => 'select',
            'options'   => array(
                'full-width'          => esc_html__( 'Full Width', 'jobhunt' ),
                'left-sidebar'        => esc_html__( 'Left Sidebar', 'jobhunt' ),
                'right-sidebar'       => esc_html__( 'Right Sidebar', 'jobhunt' ),
            ),
            'default'   => 'right-sidebar',
        ),

        array(
            'title'     => esc_html__('Single Post Layout', 'jobhunt'),
            'subtitle'  => esc_html__('Select the layout for the Single Post.', 'jobhunt'),
            'id'        => 'single_post_layout',
            'type'      => 'select',
            'options'   => array(
                'full-width'          => esc_html__( 'Full Width', 'jobhunt' ),
                'left-sidebar'        => esc_html__( 'Left Sidebar', 'jobhunt' ),
                'right-sidebar'       => esc_html__( 'Right Sidebar', 'jobhunt' ),
            ),
            'default'   => 'right-sidebar',
        ),

        array(
            'title'     => esc_html__( 'Blog Post Placeholder Icon', 'jobhunt' ),
            'id'        => 'enable_post_placeholder_icon',
            'on'        => esc_html__('Show', 'jobhunt'),
            'off'       => esc_html__('Hide', 'jobhunt'),
            'type'      => 'switch',
            'default'   => false,
        ),

        array(
            'title'     => esc_html__( 'Blog Post Author Info', 'jobhunt' ),
            'id'        => 'show_blog_post_author_info',
            'on'        => esc_html__('Show', 'jobhunt'),
            'off'       => esc_html__('Hide', 'jobhunt'),
            'type'      => 'switch',
            'default'   => false,
        ),

        array(
            'title'     => esc_html__( 'Blog Page Title', 'jobhunt' ),
            'id'        => 'blog_page_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Blog', 'jobhunt' ),
        ),

        array(
            'title'     => esc_html__( 'Blog Page Subtitle', 'jobhunt' ),
            'id'        => 'blog_page_subtitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Keep up to date with the latest news', 'jobhunt' ),
        ),
    )
) );