<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Recent Posts Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Recent_Posts extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Recent Posts widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_recent_posts';
    }

    /**
     * Get widget title.
     *
     * Retrieve Recent Posts widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Recent Posts', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Recent Posts widget icon.
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
     * Retrieve the list of categories the Recent Posts widget belongs to.
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
     * Register Recent Posts widget controls.
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
            'post_choice',
            [
                'label' => esc_html__( 'Choice', 'jobhunt-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'recent'        => esc_html__( 'Recent','jobhunt-extensions'),
                    'random'        => esc_html__( 'Random','jobhunt-extensions'),
                    'specific'      => esc_html__( 'Specific','jobhunt-extensions'),
                    'category'      => esc_html__( 'Category','jobhunt-extensions'),
                ],
                'default' =>'recent'
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'         => esc_html__( 'IDs', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter id spearate by comma(,) Note: Only works with specific choice.', 'jobhunt-extensions' ),
                'condition' => [
                    'post_choice' => 'specific',
                ],
            ]
        );

        $this->add_control(
            'category__in',
            [
                'label'         => esc_html__( 'Category IDs', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter category id spearate by comma(,) Note: Only works with category choice.', 'jobhunt-extensions' ),
                'condition' => [
                    'post_choice' => 'category',
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of posts to display.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'         => esc_html__( 'Columns', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the columns of products to display.', 'jobhunt-extensions' ),
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
            'post_choice'       => $post_choice,
            'post_ids'          => $post_ids,
            'category__in'      => $category__in,
            'limit'             => $limit,
            'columns'           => $columns,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_recent_posts' ) ) {
            jobhunt_recent_posts( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Recent_Posts );