<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Banner Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Banner_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Banner Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_banner_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Banner Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Banner Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Banner Block widget icon.
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
     * Retrieve the list of categories the Banner Block widget belongs to.
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
     * Register Banner Block widget controls.
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
            'is_enable_action',
            [
                'label'     => esc_html__( 'Enable Action', 'jobhunt-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'jobhunt-extensions' ),
                'label_off'     => esc_html__( 'Show', 'jobhunt-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Show enable action.', 'jobhunt-extensions' ),
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
            'bg_choice'         => isset( $bg_choice ) ? $bg_choice : 'image',
            'bg_image'          => isset( $bg_image ) ? $bg_image : '',
            'action_link'       => $action_link,
            'action_text'       => $action_text,
            'is_enable_action'  => filter_var( $is_enable_action, FILTER_VALIDATE_BOOLEAN ),
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_banner' ) ) {
            jobhunt_banner( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Banner_Block );