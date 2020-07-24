<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Testimonial Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Testimonial_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Testimonial Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_testimonial_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Testimonial Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Testimonial Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Testimonial Block widget icon.
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
     * Retrieve the list of categories the Testimonial Block widget belongs to.
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
     * Register Testimonial Block widget controls.
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
                'placeholder'   => esc_html__( 'Enter section title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'         => esc_html__( 'Enter Subtitle', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter subtitle.', 'jobhunt-extensions' ),
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
                    'v3'        => esc_html__( 'v3','jobhunt-extensions'),
                ],
                'default' =>'v1'
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label'         => esc_html__('Background Image', 'jobhunt-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '8',
                'placeholder'   => esc_html__( 'Enter the number of testimonials to display.', 'jobhunt-extensions' ),
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
                'default'       => '1',
                'placeholder'   => esc_html__('Enter the number of items to display.', 'jobhunt-extensions'),
            ]
        );

        $this->add_control(
            'ca_slidestoscroll',
            [
                'label'         => esc_html__('slidesToScroll', 'jobhunt-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '1',
                'placeholder'   => esc_html__('Enter the number of items to scroll.', 'jobhunt-extensions'),
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

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_image'          => isset( $bg_image ) ? $bg_image : '',
            'query_args'        => array(
                'limit'         => $per_page,
                'orderby'       => $orderby,
                'order'         => $order,
                'size'          => '',
            ),
            'carousel_args'     => array(
                'infinite'          => true,
                'rows'              => 1,
                'slidesPerRow'      => 1,
                'slidesToShow'      => intval( $ca_slidestoshow ),
                'slidesToScroll'    => intval( $ca_slidestoscroll ),
                'dots'              => true,
                'arrows'            => false,
                'autoplay'          => false,
                'responsive'        => array(
                    array(
                        'breakpoint'    => 0,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 576,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 768,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 992,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 1200,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    )
                )
            ),
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_testimonial_block' ) ) {
            jobhunt_testimonial_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Testimonial_Block );