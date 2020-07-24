<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Dual Banner Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Dual_Banner_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Dual Banner Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_dual_banner_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Dual Banner Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Dual Banner Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Dual Banner Block widget icon.
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
     * Retrieve the list of categories the Dual Banner Block widget belongs to.
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
     * Register Dual Banner Block widget controls.
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
            'bg_image',
            [
                'label'         => esc_html__('Background Image', 'jobhunt-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'title_1',
            [
                'label'         => esc_html__( 'Banner 1 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 1 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'sub_title_1',
            [
                'label'         => esc_html__( 'Banner 1 Subtitle', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 1 subtitle', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'action_text_1',
            [
                'label'         => esc_html__( 'Banner 1 Button Text', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 1 button text.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'action_link_1',
            [
                'label'         => esc_html__( 'Banner 1 Link', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 1 link.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'title_2',
            [
                'label'         => esc_html__( 'Banner 2 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 2 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'sub_title_2',
            [
                'label'         => esc_html__( 'Banner 2 Subtitle', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 2 subtitle', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'action_text_2',
            [
                'label'         => esc_html__( 'Banner 2 Button Text', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 2 button text.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'action_link_2',
            [
                'label'         => esc_html__( 'Banner 2 Link', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter banner 2 link.', 'jobhunt-extensions' ),
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

        $banner_arr = array();

        $banner_arr[0] = array (
            'title'             => $title_1,
            'sub_title'         => $sub_title_1,
            'action_text'       => $action_text_1,
            'action_link'       => $action_link_1,
        );

        $banner_arr[1] = array (
            'title'             => $title_2,
            'sub_title'         => $sub_title_2,
            'action_text'       => $action_text_2,
            'action_link'       => $action_link_2,
        );

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_image'          => isset( $bg_image ) ? $bg_image : '',
            'banners'           => $banner_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_dual_banner_block' ) ) {
            jobhunt_dual_banner_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Dual_Banner_Block );