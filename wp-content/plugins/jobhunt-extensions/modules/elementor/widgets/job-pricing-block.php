<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Job Pricing Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Jobhunt_Elementor_Jobhunt_Job_Pricing_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Job Pricing Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jobhunt_elementor_jobhunt_job_pricing_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Job Pricing Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Job Pricing Block', 'jobhunt-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Job Pricing Block widget icon.
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
     * Retrieve the list of categories the Job Pricing Block widget belongs to.
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
     * Register Job Pricing Block widget controls.
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
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter subtitle.', 'jobhunt-extensions' ),
            ]
        );

        $this->add_control(  
            'shortcode_tag',
            [
                'label' => esc_html__( 'Shortcode', 'jobhunt-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'featured_products'     => esc_html__( 'Featured Products','jobhunt-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','jobhunt-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','jobhunt-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','jobhunt-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','jobhunt-extensions'),
                    'product_category'      => esc_html__( 'Product Category','jobhunt-extensions'),
                    'products'              => esc_html__( 'Products','jobhunt-extensions'),
                ],
                'default' =>'recent_products'
            ]
        );

        $this->add_control(
            'product_id',
            [
                'label'         => esc_html__( 'Product IDs', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'jobhunt-extensions' ),
                'condition' => [
                    'shortcode_tag' => 'products',
                ],
            ]
        );

        $this->add_control(
            'category',
            [
                'label'         => esc_html__( 'Category', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'jobhunt-extensions' ),
                'condition' => [
                    'shortcode_tag' => 'product_category',
                ],
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of products to display.', 'jobhunt-extensions' ),
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
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'jobhunt-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'date',
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

        $shortcode_atts = function_exists( 'jobhunt_get_atts_for_shortcode' ) ? jobhunt_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
            'section_title'     => $section_title,
            'sub_title'         => $sub_title,
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $per_page ) ),
            'section_class'     => $el_class
        );

        if( function_exists( 'jobhunt_job_pricing' ) ) {
            jobhunt_job_pricing( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Jobhunt_Elementor_Jobhunt_Job_Pricing_Block );