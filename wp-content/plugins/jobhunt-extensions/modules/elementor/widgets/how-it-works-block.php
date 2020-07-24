<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor How It Works Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_How_It_Works_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve How It Works Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_how_it_works_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve How It Works Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'How It Works Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve How It Works Block widget icon.
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
     * Retrieve the list of categories the How It Works Block widget belongs to.
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
     * Register How It Works Block widget controls.
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
            'icon_1',
            [
                'label'         => esc_html__( 'Step 1 Icon', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 1 icon class.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_title_1',
            [
                'label'         => esc_html__( 'Step 1 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 1 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_desc_1',
            [
                'label'         => esc_html__( 'Step 1 Description', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 1 description.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'icon_2',
            [
                'label'         => esc_html__( 'Step 2 Icon', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 2 icon class.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_title_2',
            [
                'label'         => esc_html__( 'Step 2 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 2 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_desc_2',
            [
                'label'         => esc_html__( 'Step 2 Description', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 2 description.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'icon_3',
            [
                'label'         => esc_html__( 'Step 3 Icon', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 3 icon class.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_title_3',
            [
                'label'         => esc_html__( 'Step 3 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 3 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'step_desc_3',
            [
                'label'         => esc_html__( 'Step 3 Description', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter step 3 description.', 'jobhunt-extensions' ),
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

         $steps_arr = array();

        $steps_arr[0] = array(
            'icon'              => $icon_1,
            'step_title'        => $step_title_1,
            'step_desc'         => $step_desc_1,
        );

        $steps_arr[1] = array(
            'icon'              => $icon_2,
            'step_title'        => $step_title_2,
            'step_desc'         => $step_desc_2,
        );

        $steps_arr[2] = array(
            'icon'              => $icon_3,
            'step_title'        => $step_title_3,
            'step_desc'         => $step_desc_3,
        );

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'type'              => $type,
            'steps'             => $steps_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_how_it_works_block' ) ) {
            jobhunt_how_it_works_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_How_It_Works_Block );