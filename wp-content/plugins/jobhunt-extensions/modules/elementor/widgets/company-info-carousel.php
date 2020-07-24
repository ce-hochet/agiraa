<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Company Info Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Company_Info_Carousel_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Company Info Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_company_info_carousel_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Company Info Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Company Info Carousel', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Company Info Carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-plug';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Company Info Carousel widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'jobhunt-elements' ];
    }

    /**
     * Register Company Info Carousel widget controls.
     *
     * ads different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label'     => esc_html__( 'Content', 'jobhunt-extensions' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'         => esc_html__( 'Enter Section Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'         => esc_html__( 'Enter Subtitle', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter sub title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(  
            'type',
            [
                'label' => esc_html__( 'Select Version', 'jobhunt-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'v1'        => esc_html__( 'v1','jobhunt-extensions'),
                    'v2'        => esc_html__( 'v2','jobhunt-extensions'),
                ],
                'default' =>'v1'
            ]
        );

        $this->add_control(
            'is_featured',
            [
                'label'     => esc_html__( 'Featured ?', 'jobhunt-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Show', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Enable to show featured.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter the number of candidates to display.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'title',
                'placeholder'   => esc_html__( 'Enter orderby.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'ASC',
                'placeholder'   => esc_html__( 'Enter order.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'ca_slidestoshow',
            [
                'label'         => esc_html__('slidesToShow', 'jobhunt-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '5',
                'placeholder'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
            ]
        );

        $this->add_control(
            'ca_slidestoscroll',
            [
                'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '5',
                'placeholder'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
            ]
        );

        $this->add_control(
            'ca_arrows',
            [
                'label'         => esc_html__( 'Arrows ?', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => true,
            ]
        );

        $this->add_control(
            'ca_infinite',
            [
                'label'         => esc_html__( 'Infinite?', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => false,
            ]
        );

        $this->add_control(
            'ca_responsive',
            [
                'label'  => esc_html__( 'Responsive', 'jobhunt-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'ca_res_breakpoint',
                        'label' => esc_html__( 'Breakpoint', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter breakpoint.', 'jobhunt-extensions'),
                    ],
                    [
                        'name'  => 'ca_res_slidestoshow',
                        'label' => esc_html__( 'SlidesToShow', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
                    ],
                    [
                        'name'  => 'ca_res_slidestoscroll',
                        'label' => esc_html__( 'SlidesToScroll', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
                    ],
                ],
                'default' => [],
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter extra class name', 'jobhunt-extensions' ),
            ]
        );

    $this->end_controls_section();

    }

    /**
     * Render Banner output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'is_featured'       => filter_var( $is_featured, FILTER_VALIDATE_BOOLEAN ),
            'query_args'        => array(
                'posts_per_page'    => $per_page,
                'orderby'           => $orderby,
                'order'             => $order,
            ),
            'carousel_args'     => array(
                'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
                'slidesToShow'      => intval( $ca_slidestoshow ),
                'slidesToScroll'    => intval( $ca_slidestoscroll ),
                'arrows'            => filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ),
            ),
            'section_class'     => $el_class
        );

        if( is_object( $ca_responsive ) || is_array( $ca_responsive ) ) {
            $ca_responsive = json_decode( json_encode( $ca_responsive ), true );
        } else {
            $ca_responsive = json_decode( urldecode( $ca_responsive ), true );
        }

        if( ! empty( $ca_responsive ) ) {
            $responsive_args = array();
            
            foreach ( $ca_responsive as $key => $responsive ) {

                extract(shortcode_atts(array(
                    'ca_res_breakpoint'         => 767,
                    'ca_res_slidesperrow'       => 1,
                    'ca_res_slidestoshow'       => 1,
                    'ca_res_slidestoscroll'     => 1,
                ), $responsive));

                $responsive_args[] = array(
                    'breakpoint'    => $ca_res_breakpoint,
                    'settings'      => array(
                        'slidesPerRow'      => intval( $ca_res_slidesperrow ) > 0 ? intval( $ca_res_slidesperrow ) : 1,
                        'slidesToShow'      => intval( $ca_res_slidestoshow ) > 0 ? intval( $ca_res_slidestoshow ) : 1,
                        'slidesToScroll'    => intval( $ca_res_slidestoscroll ) > 0 ? intval( $ca_res_slidestoscroll ) : 1,
                    ),
                );
            }

            $args['carousel_args']['responsive'] = $responsive_args;
        }

        if( function_exists( 'jobhunt_company_info_carousel' ) ) {
            jobhunt_company_info_carousel( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Company_Info_Carousel_Block );