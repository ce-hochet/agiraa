<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Features Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Features_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Features Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_features_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Features Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Features Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Features Block widget icon.
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
     * Retrieve the list of categories the Features Block widget belongs to.
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
     * Register Features Block widget controls.
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
            'features',
            [
                'label'  => esc_html__( 'Features', 'jobhunt-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter icon class.', 'jobhunt-extensions'),
                    ],
                    [
                        'name'  => 'feature_title',
                        'label' => esc_html__( 'Feature Title', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter feature title.', 'jobhunt-extensions'),
                    ],
                    [
                        'name'  => 'feature_desc',
                        'label' => esc_html__( 'Feature Description', 'jobhunt-extensions' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'description'   => esc_html__('Enter feature description.', 'jobhunt-extensions'),
                    ],
                ],
                'default' => [],
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

        $features_arr = array();

        if( is_object( $features ) || is_array( $features ) ) {
            $features = json_decode( json_encode( $features ), true );
        } else {
            $features = json_decode( urldecode( $features ), true );
        }

        if( is_array( $features ) ) {
            foreach ( $features as $key => $feature ) {

                extract(shortcode_atts(array(
                    'icon'              => '',
                    'feature_title'     => '',
                    'feature_desc'      => '',
                ), $feature));
                
                $features_arr[] = array(
                    'icon'              => $icon,
                    'feature_title'     => $feature_title,
                    'feature_desc'      => $feature_desc,
                );
            }
        }

        $args = array(
            'section_title'     => $section_title,
            'features'          => $features_arr,
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_features_list_block' ) ) {
            jobhunt_features_list_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Features_Block );