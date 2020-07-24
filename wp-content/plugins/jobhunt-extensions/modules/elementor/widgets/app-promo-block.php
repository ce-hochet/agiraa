<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor App Promo Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_About_Promo_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve App Promo Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_about_promo_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve App Promo Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'App Promo Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve App Promo Block widget icon.
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
     * Retrieve the list of categories the App Promo Block widget belongs to.
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
     * Register App Promo Block widget controls.
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
            'section_title',
            [
                'label'         => esc_html__( 'Enter Section Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter Section title', 'jobhunt-extensions' ),
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
            'image',
            [
                'label'         => esc_html__('Image', 'jobhunt-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'app_title_1',
            [
                'label'         => esc_html__( 'App 1 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app 1 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'app_desc_1',
            [
                'label'         => esc_html__( 'App 1 Description', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app 1 description', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'icon_1',
            [
                'label'         => esc_html__( 'App Store 1 Icon', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app store 1 icon.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'link_1',
            [
                'label'         => esc_html__( 'App Store 1 Link', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app store 1 link.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'app_title_2',
            [
                'label'         => esc_html__( 'App 2 Title', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app 2 title.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'app_desc_2',
            [
                'label'         => esc_html__( 'App 2 Description', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app 2 description', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'icon_2',
            [
                'label'         => esc_html__( 'App Store 2 Icon', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app store 2 icon.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(
            'link_2',
            [
                'label'         => esc_html__( 'App Store 2 Link', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter app store 2 link.', 'jobhunt-extensions' ),
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

        $apps_arr = array();

        $apps_arr[0] = array (
            'app_title'       => $app_title_1,
            'app_desc'        => $app_desc_1,
            'icon'            => $icon_1,
            'link'            => $link_1,
        );

        $apps_arr[1] = array (
            'app_title'       => $app_title_2,
            'app_desc'        => $app_desc_2,
            'icon'            => $icon_2,
            'link'            => $link_2,
        );

        $image = isset( $image['id'] ) ? wp_get_attachment_image_src ($image['id'], 'full' ) : '';

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'image'             => isset( $image ) ? $image : '',
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_image'          => isset( $bg_image ) ? $bg_image : '',
            'apps'              => $apps_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_app_promo_block' ) ) {
            jobhunt_app_promo_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_About_Promo_Block );