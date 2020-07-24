<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Counter Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Counter_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Counter Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_counter_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Counter Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Counter Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Counter Block widget icon.
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
     * Retrieve the list of categories the Counter Block widget belongs to.
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
     * Register Counter Block widget controls.
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
            'bg_image',
            [
                'label'         => esc_html__('Background Image', 'jobhunt-extensions'),
                'type'          => Controls_Manager::MEDIA,
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
            'counter_title_1',
            [
                'label'         => esc_html__( 'Counter 1 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-1 title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'count_value_1',
            [
                'label'         => esc_html__( 'Counter 1 Value', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-1 value.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'counter_title_2',
            [
                'label'         => esc_html__( 'Counter 2 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-2 title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'count_value_2',
            [
                'label'         => esc_html__( 'Counter 2 Value', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-2 value.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'counter_title_3',
            [
                'label'         => esc_html__( 'Counter 3 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-3 title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'count_value_3',
            [
                'label'         => esc_html__( 'Counter 3 Value', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-3 value.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'counter_title_4',
            [
                'label'         => esc_html__( 'Counter 4 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-4 title', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'count_value_4',
            [
                'label'         => esc_html__( 'Counter 4 Value', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter counter-4 value.', 'jobhunt-extensions' ),
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

        $counter_arr = array();

        $counter_arr[0] = array (
            'counter_title'     => $counter_title_1,
            'count_value'       => $count_value_1,
        );

        $counter_arr[1] = array (
            'counter_title'     => $counter_title_2,
            'count_value'       => $count_value_2,
        );
        
        $counter_arr[2] = array (
            'counter_title'     => $counter_title_3,
            'count_value'       => $count_value_3,
        );
        
        $counter_arr[3] = array (
            'counter_title'     => $counter_title_4,
            'count_value'       => $count_value_4,
        );

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_image'          => isset( $bg_image ) ? $bg_image : '',
            'type'              => $type,
            'counters'          => $counter_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_counters_block' ) ) {
            jobhunt_counters_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Counter_Block );