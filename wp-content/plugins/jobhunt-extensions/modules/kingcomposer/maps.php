<?php

if( ! defined('KC_FILE' ) ) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$kc = KingComposer::globe();

$shortcode_params = array();

$shortcode_params['jobhunt_about_content'] = array(
    'name' => esc_html__( 'About Content Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'About Content Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'About Content Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Enter Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'about_content',
            'label'         => esc_html__('Enter About Content', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter about content', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Image', 'jobhunt-extensions' ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_app_promo_block'] = array(
    'name' => esc_html__( 'App Promo Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'App Promo Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'App Promo Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Image', 'jobhunt-extensions' ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'app_title_1',
            'label'         => esc_html__('App 1 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter app 1 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'app_desc_1',
            'label'         => esc_html__('App 1 Description', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter app 1 description', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'icon_1',
            'label'         => esc_html__('App Store 1 Icon', 'jobhunt-extensions'),
            'type'          => 'icon_picker',
            'description'   => esc_html__('Enter app store 1 icon.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'link_1',
            'label'         => esc_html__('App Store 1 Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter app store 1 link.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'app_title_2',
            'label'         => esc_html__('App 2 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter app 2 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'app_desc_2',
            'label'         => esc_html__('App 2 Description', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter app 2 description', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'icon_2',
            'label'         => esc_html__('App Store 2 Icon', 'jobhunt-extensions'),
            'type'          => 'icon_picker',
            'description'   => esc_html__('Enter app store 2 icon.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'link_2',
            'label'         => esc_html__('App Store 2 Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter app store 2 link.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_banner_with_image_block'] = array(
    'name' => esc_html__( 'Banner With Image Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Banner With Image Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Banner With Image Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'title',
            'label'         => esc_html__('Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Image', 'jobhunt-extensions' ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_banner'] = array(
    'name' => esc_html__( 'Banner', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Banner', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Banner Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'action_text',
            'label'         => esc_html__('Action Text', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter action text', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_link',
            'label'         => esc_html__('Action Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter action link', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'is_enable_action',
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Enable Action', 'jobhunt-extensions' ),
            'description'   => esc_html__( 'Check to enable action.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_candidate_info_block'] = array(
    'name' => esc_html__( 'Candidate Info Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Candidate Info Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Candidate Info Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Featured ?', 'jobhunt-extensions' ),
            'name'          => 'is_featured',
            'description'   => esc_html__( 'Check to show featured.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of candidates to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'title',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'ASC',
            'admin_label'   => true
        ),
        array(
            'name'          => 'ca_slidestoshow',
            'label'         => esc_html__('slidesToShow', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
            'value'         => 4,
            'admin_label'   => true
        ),
        array(
            'name'          => 'ca_slidestoscroll',
            'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
            'value'         => 4,
            'admin_label'   => true
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Dots ?', 'jobhunt-extensions' ),
            'name'          => 'ca_dots',
            'description'   => esc_html__( 'Check to show Dots.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Infinite?', 'jobhunt-extensions' ),
            'name'          => 'ca_infinite',
            'description'   => esc_html__( 'Check to show Infinite Carousel.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'type'          => 'group',
            'label'         => esc_html__( 'Responsive', 'jobhunt-extensions' ),
            'name'          => 'ca_responsive',
            'description'   => '',
            'options'       => array(
                'add_text'          => esc_html__( 'Add new breakpoint', 'jobhunt-extensions' )
            ),
            'params' => array(
                array(
                    'name'          => 'ca_res_breakpoint',
                    'label'         => esc_html__('Breakpoint', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter breakpoint.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'ca_res_slidestoshow',
                    'label'         => esc_html__('slidesToShow', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'ca_res_slidestoscroll',
                    'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
                    'admin_label'   => true
                )
            )
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_company_info_carousel'] = array(
    'name' => esc_html__( 'Company Info Carousel', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Company Info Carousel', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Company Info Carousel Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions'),
            ),
            'admin_label'   => true
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Featured ?', 'jobhunt-extensions' ),
            'name'          => 'is_featured',
            'description'   => esc_html__( 'Check to show featured.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of candidates to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'title',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'ASC',
            'admin_label'   => true
        ),
        array(
            'name'          => 'ca_slidestoshow',
            'label'         => esc_html__('slidesToShow', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
            'value'         => 4,
            'admin_label'   => true
        ),
        array(
            'name'          => 'ca_slidestoscroll',
            'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
            'value'         => 4,
            'admin_label'   => true
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Arrows ?', 'jobhunt-extensions' ),
            'name'          => 'ca_arrows',
            'description'   => esc_html__( 'Check to show Arrows.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Infinite?', 'jobhunt-extensions' ),
            'name'          => 'ca_infinite',
            'description'   => esc_html__( 'Check to show Infinite Carousel.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'type'          => 'group',
            'label'         => esc_html__( 'Responsive', 'jobhunt-extensions' ),
            'name'          => 'ca_responsive',
            'description'   => '',
            'options'       => array(
                'add_text'          => esc_html__( 'Add new breakpoint', 'jobhunt-extensions' )
            ),
            'params' => array(
                array(
                    'name'          => 'ca_res_breakpoint',
                    'label'         => esc_html__('Breakpoint', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter breakpoint.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'ca_res_slidestoshow',
                    'label'         => esc_html__('slidesToShow', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'ca_res_slidestoscroll',
                    'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
                    'admin_label'   => true
                )
            )
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_counters_block'] = array(
    'name' => esc_html__( 'Counter Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Counter Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Counter Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'counter_title_1',
            'label'         => esc_html__('Counter 1 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-1 title', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'count_value_1',
            'label'         => esc_html__('Counter 1 Value', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-1 value.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'counter_title_2',
            'label'         => esc_html__('Counter 2 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-2 title', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'count_value_2',
            'label'         => esc_html__('Counter 2 Value', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-2 value.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'counter_title_3',
            'label'         => esc_html__('Counter 3 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-3 title', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'count_value_3',
            'label'         => esc_html__('Counter 3 Value', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-3 value.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'counter_title_4',
            'label'         => esc_html__('Counter 4 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-4 title', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'count_value_4',
            'label'         => esc_html__('Counter 4 Value', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter counter-4 value.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_dual_banner_block'] = array(
    'name' => esc_html__( 'Dual Banner Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Dual Banner Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Dual Banner Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'title_1',
            'label'         => esc_html__('Banner 1 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 1 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title_1',
            'label'         => esc_html__('Banner 1 Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter banner 1 subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_text_1',
            'label'         => esc_html__('Banner 1 Button Text', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 1 button text.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_link_1',
            'label'         => esc_html__('Banner 1 Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 1 link.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'title_2',
            'label'         => esc_html__('Banner 2 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 2 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title_2',
            'label'         => esc_html__('Banner 2 Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter banner 2 subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_text_2',
            'label'         => esc_html__('Banner 2 Button Text', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 2 button text.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_link_2',
            'label'         => esc_html__('Banner 2 Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter banner 2 link.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_faq_block'] = array(
    'name' => esc_html__( 'Faq Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Faq Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Faq Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Enter Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode',
            'label'         => esc_html__('Enter Faq Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter faq shortcode', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_faq_with_testimonial_block'] = array(
    'name' => esc_html__( 'Faq With Testimonial Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Faq With Testimonial Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Faq With Testimonial Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title_1',
            'label'         => esc_html__('Enter Faq Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter faq title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode',
            'label'         => esc_html__('Enter Faq Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter faq shortcode', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'section_title_2',
            'label'         => esc_html__('Enter Testimonial Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter testimonial title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Testimonials Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of testimonials to display.', 'jobhunt-extensions'),
            'value'         => 8,
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Testimonials Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'title',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Testimonials Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'ASC',
            'admin_label'   => true
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Infinite?', 'jobhunt-extensions' ),
            'name'          => 'ca_infinite',
            'description'   => esc_html__( 'Check to show Infinite Carousel.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_features_list_block'] = array(
    'name' => esc_html__( 'Fetures Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Fetures Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Fetures Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'type'          => 'group',
            'label'         => esc_html__( 'Features', 'jobhunt-extensions' ),
            'name'          => 'features',
            'description'   => '',
            'options'       => array(
                'add_text'          => esc_html__( 'Add new tab', 'jobhunt-extensions' )
            ),
            'params' => array(
                array(
                    'name'          => 'icon',
                    'label'         => esc_html__('Icon', 'jobhunt-extensions'),
                    'type'          => 'icon_picker',
                    'description'   => esc_html__('Enter icon class.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'feature_title',
                    'label'         => esc_html__('Feature Title', 'jobhunt-extensions'),
                    'type'          => 'text',
                    'description'   => esc_html__('Enter feature title.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
                array(
                    'name'          => 'feature_desc',
                    'label'         => esc_html__('Feature Description', 'jobhunt-extensions'),
                    'type'          => 'textarea',
                    'description'   => esc_html__('Enter feature description.', 'jobhunt-extensions'),
                    'admin_label'   => true
                ),
            )
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_how_it_works_block'] = array(
    'name' => esc_html__( 'How It Works Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'How It Works Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'How It Works Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions'),
                'v3'         => esc_html__( 'v3','jobhunt-extensions'),
                'v4'         => esc_html__( 'v4','jobhunt-extensions'),
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'icon_1',
            'label'         => esc_html__('Step 1 Icon', 'jobhunt-extensions'),
            'type'          => 'icon_picker',
            'description'   => esc_html__('Enter step 1 icon class.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_title_1',
            'label'         => esc_html__('Step 1 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter step 1 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_desc_1',
            'label'         => esc_html__('Step 1 Description', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter step 1 description.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'icon_2',
            'label'         => esc_html__('Step 2 Icon', 'jobhunt-extensions'),
            'type'          => 'icon_picker',
            'description'   => esc_html__('Enter step 2 icon class.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_title_2',
            'label'         => esc_html__('Step 2 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter step 2 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_desc_2',
            'label'         => esc_html__('Step 2 Description', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter step 2 description.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'icon_3',
            'label'         => esc_html__('Step 3 Icon', 'jobhunt-extensions'),
            'type'          => 'icon_picker',
            'description'   => esc_html__('Enter step 3 icon class.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_title_3',
            'label'         => esc_html__('Step 3 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter step 3 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'step_desc_3',
            'label'         => esc_html__('Step 3 Description', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter step 3 description.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);
$shortcode_params['jobhunt_job_categories_block'] = array(
    'name' => esc_html__( 'Job Categories Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Job Categories Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Job Categories Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions'),
                'v3'         => esc_html__( 'v3','jobhunt-extensions'),
                'v4'         => esc_html__( 'v4','jobhunt-extensions'),
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_text',
            'label'         => esc_html__('Action Text', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter action text', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'action_link',
            'label'         => esc_html__('Action Link', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter action link', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of products to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'title',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'ASC',
            'admin_label'   => true
        ),
        array(
            'name'          => 'slug',
            'label'         => esc_html__('Slug', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter slug spearate by comma(,)', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Hide Empty ?', 'jobhunt-extensions' ),
            'name'          => 'hide_empty',
            'description'   => esc_html__( 'Check to hide empty categories.', 'jobhunt-extensions' ),
            'options'       => array( 'true' => esc_html__( 'Enable', 'jobhunt-extensions' ) ),
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_job_list_block'] = array(
    'name' => esc_html__( 'Job List Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Job List Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Job List Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Enter Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode',
            'label'         => esc_html__('Enter Job Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter job shortcode', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_job_list_tabs'] = array(
    'name' => esc_html__( 'Job List Tabs', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Job List Tabs', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Job List Tabs Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'title_1',
            'label'         => esc_html__('Enter Tab 1 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter tab 1 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode_1',
            'label'         => esc_html__('Enter Tab 1 Job Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter job shortcode for tab 1', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'title_2',
            'label'         => esc_html__('Enter Tab 2 Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter tab 2 title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode_2',
            'label'         => esc_html__('Enter Tab 2 Job Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter job shortcode for tab 2', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_job_list_with_summary'] = array(
    'name' => esc_html__( 'Job List With Summary Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Job List With Summary Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Job List With Summary Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'title_1',
            'label'         => esc_html__('Enter Job Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter job title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode_1',
            'label'         => esc_html__('Enter Job Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter job shortcode', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'title_2',
            'label'         => esc_html__('Enter Summary Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter summary title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode_2',
            'label'         => esc_html__('Enter Summary Shortcode', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter summary shortcode', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra Class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_job_pricing'] = array(
    'name' => esc_html__( 'Job Pricing Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Job Pricing Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Job Pricing Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Enter Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'shortcode_tag',
            'label'         => esc_html__( 'Shortcode', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'featured_products'     => esc_html__( 'Featured Products','jobhunt-extensions'),
                'sale_products'         => esc_html__( 'On Sale Products','jobhunt-extensions'),
                'top_rated_products'    => esc_html__( 'Top Rated Products','jobhunt-extensions'),
                'recent_products'       => esc_html__( 'Recent Products','jobhunt-extensions'),
                'best_selling_products' => esc_html__( 'Best Selling Products','jobhunt-extensions'),
                'product_category'      => esc_html__( 'Product Category','jobhunt-extensions'),
                'products'              => esc_html__( 'Products','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'product_id',
            'label'         => esc_html__('Product IDs', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'shortcode_tag',
               'show_when'      => 'products'
            )
        ),
        array(
            'name'          => 'category',
            'label'         => esc_html__('Category', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'shortcode_tag',
               'show_when'      => 'product_category'
            )
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of products to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'date',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'desc',
            'admin_label'   => true
        ),
        array(
            'name'          => 'columns',
            'label'         => esc_html__('Columns', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the columns of products to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        ),
    ),
);

$shortcode_params['jobhunt_recent_posts'] = array(
    'name' => esc_html__( 'Recent Posts', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Recent Posts', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Recent Posts Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions'),
                'v3'         => esc_html__( 'v3','jobhunt-extensions'),
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'post_choice',
            'label'         => esc_html__( 'Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'recent'        => esc_html__('Recent', 'jobhunt-extensions'),
                'random'        => esc_html__('Random', 'jobhunt-extensions'),
                'specific'      => esc_html__('Specific', 'jobhunt-extensions'),
                'category'      => esc_html__('Category', 'jobhunt-extensions'),
            ),
            'description'   => esc_html__( 'Select choice for posts.', 'jobhunt-extensions' ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'post_ids',
            'label'         => esc_html__('IDs', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter id spearate by comma(,) Note: Only works with specific choice.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'post_choice',
               'show_when'      => 'specific'
            )
        ),
        array(
            'name'          => 'category__in',
            'label'         => esc_html__('Category IDs', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter category ids spearate by comma(,) Note: Only works with category choice.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'post_choice',
               'show_when'      => 'category'
            )
        ),
        array(
            'name'          => 'limit',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of posts to display.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'columns',
            'label'         => esc_html__('Columns', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of columns.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params['jobhunt_testimonial_block'] = array(
    'name' => esc_html__( 'Testimonial Block', 'jobhunt-extensions' ),
    'description' => esc_html__( 'Testimonial Block', 'jobhunt-extensions' ),
    'category' => esc_html__( 'Jobhunt Elements', 'jobhunt-extensions' ),
    'icon' => 'jobhunt-element-icon',
    'title' => esc_html__( 'Testimonial Block Settings', 'jobhunt-extensions' ),
    'is_container' => true,
    'params' => array(
        array(
            'name'          => 'section_title',
            'label'         => esc_html__('Section Title', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter section title.', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
        array(
            'name'          => 'sub_title',
            'label'         => esc_html__('Enter Subtitle', 'jobhunt-extensions'),
            'type'          => 'textarea',
            'description'   => esc_html__('Enter subtitle', 'jobhunt-extensions'),
            'admin_label'   => true
        ),
         array(
            'name'          => 'type',
            'label'         => esc_html__( 'Select Version', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'v1'         => esc_html__( 'v1','jobhunt-extensions'),
                'v2'         => esc_html__( 'v2','jobhunt-extensions'),
                'v3'         => esc_html__( 'v3','jobhunt-extensions'),
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_choice',
            'label'         => esc_html__( 'Background Choice', 'jobhunt-extensions' ),
            'type'          => 'select',
            'options'       => array(
                'image'         => esc_html__( 'Image','jobhunt-extensions'),
                'color'         => esc_html__( 'Color','jobhunt-extensions')
            ),
            'admin_label'   => true
        ),
        array(
            'name'          => 'bg_color',
            'label'         => esc_html__('Background Color', 'jobhunt-extensions'),
            'type'          => 'color_picker',
            'description'   => esc_html__('Enter background color.', 'jobhunt-extensions'),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'color'
            )
        ),
        array(
            'name'          => 'bg_image',
            'type'          => 'attach_image',
            'label'         => esc_html__( 'Background Image', 'jobhunt-extensions' ),
            'admin_label'   => true,
            'relation'      => array(
               'parent'         => 'bg_choice',
               'show_when'      => 'image'
            )
        ),
        array(
            'name'          => 'per_page',
            'label'         => esc_html__('Limit', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter the number of testimonials to display.', 'jobhunt-extensions'),
            'value'         => 8,
            'admin_label'   => true
        ),
        array(
            'name'          => 'orderby',
            'label'         => esc_html__('Orderby', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter orderby.', 'jobhunt-extensions'),
            'value'         => 'title',
            'admin_label'   => true
        ),
        array(
            'name'          => 'order',
            'label'         => esc_html__('Order', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('Enter order.', 'jobhunt-extensions'),
            'value'         => 'ASC',
            'admin_label'   => true
        ),
        array(
            'name'          => 'el_class',
            'label'         => esc_html__('Extra class name', 'jobhunt-extensions'),
            'type'          => 'text',
            'description'   => esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobhunt-extensions')
        )
    ),
);

$shortcode_params = apply_filters( 'jobhunt_kc_map_shortcode_params', $shortcode_params );

$kc->add_map( $shortcode_params );