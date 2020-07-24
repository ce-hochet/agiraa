<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Job Categories Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Job_Categories_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Job Categories Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_job_categories_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Job Categories Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Job Categories Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Job Categories Block widget icon.
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
     * Retrieve the list of categories the Job Categories Block widget belongs to.
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
     * Register Job Categories Block widget controls.
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
                    'v4'        => esc_html__( 'v4','jobhunt-extensions'),
                ],
                'default' =>'v1'
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label'         => esc_html__( 'Action Text', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter action text', 'jobhunt-extensions' ),
            ]
        );


        $this->add_control(
            'action_link',
            [
                'label'         => esc_html__( 'Action Link', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter action link', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter the number of categories to display.', 'jobhunt-extensions' ),
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
            'slug',
            [
                'label'         => esc_html__( 'Slug', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter category slug spearate by comma(,)', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'hide_empty',
            [
                'label'     => esc_html__( 'Hide Empty ?', 'jobhunt-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Show', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Enable to hide empty categories.', 'jobhunt-extensions' ),
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

        $args = apply_filters( 'jobhunt_job_categories_block_element_args', array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'action_link'       => $action_link,
            'action_text'       => $action_text,
            'category_args'     => array(
                'number'            => $per_page,
                'orderby'           => $orderby,
                'order'             => $order,
                'slugs'             => $slug,                
                'hide_empty'        => filter_var( $hide_empty, FILTER_VALIDATE_BOOLEAN ),
            ),
            'section_class'     => $el_class
        ) );

        if( function_exists( 'jobhunt_job_categories_block' ) ) {
            jobhunt_job_categories_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Job_Categories_Block );