<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Job List Tabs Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Job_List_Tabs extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Job List Tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_job_list_tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve Job List Tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Job List Tabs', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Job List Tabs widget icon.
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
     * Retrieve the list of categories the Job List Tabs widget belongs to.
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
     * Register Job List Tabs widget controls.
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
            'title_1',
            [
                'label'         => esc_html__( 'Enter Tab 1 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter tab 1 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode_1',
            [
                'label'         => esc_html__( 'Enter Tab 1 Job Shortcode', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter job shortcode for tab 1', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'title_2',
            [
                'label'         => esc_html__( 'Enter Tab 2 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter tab 2 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode_2',
            [
                'label'         => esc_html__( 'Enter Tab 2 Job Shortcode', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter job shortcode for tab 2', 'jobhunt-extensions' ),
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

        $tabs_arr = array();

        $tabs_arr[0] = array (
            'title'             => $title_1,
            'shortcode'         => $shortcode_1,
        );

        $tabs_arr[1] = array (
            'title'             => $title_2,
            'shortcode'         => $shortcode_2,
        );

        $args = array(
            'tabs'              => $tabs_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_job_list_tabs' ) ) {
            jobhunt_job_list_tabs( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Job_List_Tabs );