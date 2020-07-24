<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Faq With Testimonial Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Faq_With_Testimonial_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Faq With Testimonial Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_faq_with_testimonial_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Faq With Testimonial Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Faq With Testimonial Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Faq With Testimonial Block widget icon.
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
     * Retrieve the list of categories the Faq With Testimonial Block widget belongs to.
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
     * Register Faq With Testimonial Block widget controls.
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
            'section_title_1',
            [
                'label'         => esc_html__( 'Enter Faq Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter faq title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode',
            [
                'label'         => esc_html__( 'Enter Faq Shortcode', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter faq shortcode.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'section_title_2',
            [
                'label'         => esc_html__( 'Enter Testimonial Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter testimonial title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Testimonials Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '8',
                'placeholder'   => esc_html__( 'Enter the number of testimonials to display.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Testimonials Orderby', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'title',
                'placeholder'   => esc_html__( 'Enter orderby.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Testimonials Order', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'ASC',
                'placeholder'   => esc_html__( 'Enter order.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'ca_infinite',
            [
                'label'     => esc_html__( 'Infinite?', 'jobhunt-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Show', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Enable to show Infinite Carousel.', 'jobhunt-extensions' ),
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

        $faq_args = array(
            'section_title'     => $section_title_1,
            'shortcode'         => $shortcode,
            'section_class'     => $el_class
        );

        $ts_args = array(
            'section_title'     => $section_title_2,
            'type'              => 'v3',
            'query_args'        => array(
                'limit'         => $per_page,
                'orderby'       => $orderby,
                'order'         => $order,
                'size'          => '',
            ),
            'carousel_args'     => array(
                'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
                'rows'              => 1,
                'slidesPerRow'      => 1,
                'slidesToShow'      => 1,
                'slidesToScroll'    => 1,
                'dots'              => true,
                'arrows'            => false,
                'autoplay'          => false
            ),
            'section_class'     => $el_class
        );

        $args = array(
            'faq_args'          => $faq_args,
            'ts_args'           => $ts_args,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_faq_with_testimonial_block' ) ) {
            jobhunt_faq_with_testimonial_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Faq_With_Testimonial_Block );