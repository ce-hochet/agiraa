<?php
/**
 * Template tags for Home v1
 */

function jobhunt_get_default_home_v1_options() {
    $home_v1 = array(
        'hsb'  => array(
            'section_title'             => esc_html__( 'The Easiest Way to Get Your New Job', 'jobhunt' ),
            'sub_title'                 => esc_html__( 'Find Jobs, Employment & Career Opportunities', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'show_category_select'      => 'no',
            'search_button_icon'        => 'la la-search',
            'show_browse_button'        => true,
            'browse_button_label'       => esc_html__( 'Or browse job offers by', 'jobhunt' ),
            'browse_button_text'        => esc_html__( 'Category', 'jobhunt' ),
            'browse_button_link'        => '#'
        ),
        'jcb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Categories', 'jobhunt' ),
            'sub_title'         => esc_html__( '37 jobs live - 0 added today.', 'jobhunt' ),
            'type'              => 'v1',
            'columns'           => 4,
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Browse All Categories', 'jobhunt' ),
            'category_args'     => array(
                'number'            => 8,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => false,
                'slugs'             => '',
            ),
        ),
        'br1'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'section_class'     => '',
            'animation'         => '',
            'section_title'     => esc_html__( 'Make a Difference with Your Online Resume!', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Your resume in minutes with Jobhunt resume assistant is ready!', 'jobhunt' ),
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Create an Account', 'jobhunt' ),
            'is_enable_action'  => true
        ),
        'jlb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Featured Jobs', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Leading Employers already using job and talent.', 'jobhunt' ),
            'shortcode'         => ''
        ),
        'ts'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Kind Words From Happy Candidates', 'jobhunt' ),
            'sub_title'         => esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
            'columns'           => 2,
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'type'              => 'v1',
            'query_args'        => array(
                'limit'             => 8,
                'orderby'           => 'title',
                'order'             => 'ASC',
                'size'              => '',
            ),
            'carousel_args'     => array(
                'slidesToShow'      => 2,
                'slidesToScroll'    => 2,
                'dots'              => true,
                'arrows'            => false,
                'autoplay'          => false,
            )
        ),
        'cic'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Companies We\'ve Helped', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Some of the companies we\'ve helped recruit excellent applicants over the years.', 'jobhunt' ),
            'columns'           => 4,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => 'v1',
            'is_featured'       => false,
            'query_args'        => array(
                'per_page'          => '8',
                'orderby'           => 'title',
                'order'             => 'ASC',
                'size'              => '',
            ),
            'carousel_args'     => array(
                'slidesToShow'      => 5,
                'slidesToScroll'    => 5,
                'dots'              => false,
                'arrows'            => false,
                'autoplay'          => false,
            )
        ),
        'rp'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'type'              => 'v1',
            'section_title'     => esc_html__( 'Quick Career Tips', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Found by employers communicate directly with hiring managers and recruiters.', 'jobhunt' ),
            'limit'             => 3,
            'columns'           => 3,
            'post_choice'       => '',
            'post_ids'          => '',
            'category__in'      => '',
        ),
        'br2'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Gat a question?', 'jobhunt' ),
            'sub_title'         => esc_html__( 'We\'re here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555', 'jobhunt' ),
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Create an Account', 'jobhunt' ),
            'is_enable_action'  => false
        ),
    );

    return apply_filters( 'jobhunt_home_v1_default_options', $home_v1 );
}

function jobhunt_get_home_v1_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v1_options = get_post_meta( $post->ID, '_home_v1_options', true );
        $home_v1_options = maybe_unserialize( $clean_home_v1_options );

        if( ! is_array( $home_v1_options ) ) {
            $home_v1_options = json_decode( $clean_home_v1_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_home_v1_options();
            $home_v1 = wp_parse_args( $home_v1_options, $default_options );
        } else {
            $home_v1 = $home_v1_options;
        }

        return apply_filters( 'jobhunt_home_v1_meta', $home_v1, $post );
    }
}

if ( ! function_exists( 'jobhunt_home_v1_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_v1_search_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v1        = jobhunt_get_home_v1_meta();
            $hsb_options    = $home_v1['hsb'];

            $args =  apply_filters( 'jobhunt_home_v1_search_block_args', array(
                'section_class'             => isset( $hsb_options['section_class'] ) ? $hsb_options['section_class'] : '',
                'section_title'             => isset( $hsb_options['section_title'] ) ? $hsb_options['section_title'] : esc_html__( 'The Easiest Way to Get Your New Job', 'jobhunt' ),
                'sub_title'                 => isset( $hsb_options['sub_title'] ) ? $hsb_options['sub_title'] : esc_html__( 'Find Jobs, Employment & Career Opportunities', 'jobhunt' ),
                'search_placeholder_text'   => isset( $hsb_options['search_placeholder_text'] ) ? $hsb_options['search_placeholder_text'] : esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
                'location_placeholder_text' => isset( $hsb_options['location_placeholder_text'] ) ? $hsb_options['location_placeholder_text'] : esc_html__( 'City, province or region', 'jobhunt' ),
                'show_category_select'      => isset( $hsb_options['show_category_select'] ) ? filter_var( $hsb_options['show_category_select'], FILTER_VALIDATE_BOOLEAN ) : false,
                'category_select_text'      => isset( $hsb_options['category_select_text'] ) ? $hsb_options['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                'search_button_icon'        => isset( $hsb_options['search_button_icon'] ) ? $hsb_options['search_button_icon'] : 'la la-search',
                'show_browse_button'        => isset( $hsb_options['show_browse_button'] ) ? filter_var( $hsb_options['show_browse_button'], FILTER_VALIDATE_BOOLEAN ) : false,
                'browse_button_label'       => isset( $hsb_options['browse_button_label'] ) ? $hsb_options['browse_button_label'] : esc_html__( 'Or browse job offers by', 'jobhunt' ),
                'browse_button_text'        => isset( $hsb_options['browse_button_text'] ) ? $hsb_options['browse_button_text'] : esc_html__( 'Category', 'jobhunt' ),
                'browse_button_link'        => isset( $hsb_options['browse_button_link'] ) ? $hsb_options['browse_button_link'] : '#'
            ) );

            jobhunt_home_search_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v1_job_categories_block' ) ) {
    /**
     * Dispaly Job Categories Block in Home v1
     */
    function jobhunt_home_v1_job_categories_block() {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $home_v1        = jobhunt_get_home_v1_meta();
            $jcb_options    = $home_v1['jcb'];

            $is_enabled = isset( $jcb_options['is_enabled'] ) ? filter_var( $jcb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jcb_options['animation'] ) ? $jcb_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v1_job_categories_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jcb_options['section_class'] ) ? $jcb_options['section_class'] : '',
                'section_title'         => isset( $jcb_options['section_title'] ) ? $jcb_options['section_title'] : esc_html__( 'Popular Categories', 'jobhunt' ),
                'sub_title'             => isset( $jcb_options['sub_title'] ) ? $jcb_options['sub_title'] : esc_html__( '37 jobs live - 0 added today.', 'jobhunt' ),
                'type'                  => isset( $jcb_options['type'] ) ? $jcb_options['type'] : 'v1',
                'columns'               => isset( $jcb_options['columns'] ) ? $jcb_options['columns'] : 4,
                'action_text'           => isset( $jcb_options['action_text'] ) ? $jcb_options['action_text'] : esc_html__( 'Browse All Categories', 'jobhunt' ),
                'action_link'           => isset( $jcb_options['action_link'] ) ? $jcb_options['action_link'] : '#',
                'category_args'         => array(
                    'orderby'               => isset( $jcb_options['category_args']['orderby'] ) ? $jcb_options['category_args']['orderby'] : 'name',
                    'order'                 => isset( $jcb_options['category_args']['order'] ) ? $jcb_options['category_args']['order'] : 'ASC',
                    'number'                => isset( $jcb_options['category_args']['number'] ) ? $jcb_options['category_args']['number'] : 8,
                    'hide_empty'            => isset( $jcb_options['category_args']['hide_empty'] ) ? filter_var( $jcb_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : '',
                    'slugs'                 => isset( $jcb_options['category_args']['slug'] ) ? $jcb_options['category_args']['slug'] : '',
                ),
            ) );

            jobhunt_job_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v1_banner_v1' ) ) {
    /**
     * Dispaly Job Banner v1 in Home v1
     */
    function jobhunt_home_v1_banner_v1() {

        $home_v1        = jobhunt_get_home_v1_meta();
        $br1_options    = $home_v1['br1'];

        $is_enabled = isset( $br1_options['is_enabled'] ) ? filter_var( $br1_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $br1_options['animation'] ) ? $br1_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v1_banner_v1_args', array(
            'animation'             => $animation,
            'section_class'         => isset( $br1_options['section_class'] ) ? $br1_options['section_class'] : '',
            'section_title'         => isset( $br1_options['section_title'] ) ? $br1_options['section_title'] : esc_html__( 'Make a Difference with Your Online Resume!', 'jobhunt' ),
            'sub_title'             => isset( $br1_options['sub_title'] ) ? $br1_options['sub_title'] : esc_html__( 'Your resume in minutes with Jobhunt resume assistant is ready!', 'jobhunt' ),
            'bg_choice'             => isset( $br1_options['bg_choice'] ) ? $br1_options['bg_choice'] : 'image',
            'bg_color'              => isset( $br1_options['bg_color'] ) ? $br1_options['bg_color'] : '',
            'bg_image'              => isset( $br1_options['bg_image'] ) && intval( $br1_options['bg_image'] ) ? wp_get_attachment_image_src( $br1_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'action_text'           => isset( $br1_options['action_text'] ) ? $br1_options['action_text'] : esc_html__( 'Create an Account', 'jobhunt' ),
            'action_link'           => isset( $br1_options['action_link'] ) ? $br1_options['action_link'] : '#',
            'is_enable_action'      => isset( $br1_options['is_enable_action'] ) ? filter_var( $br1_options['is_enable_action'], FILTER_VALIDATE_BOOLEAN ) : '',
        ) );

        jobhunt_banner( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v1_job_list_block' ) ) {
    /**
     * Dispaly Job list Block in Home v1
     */
    function jobhunt_home_v1_job_list_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v1        = jobhunt_get_home_v1_meta();
            $jlb_options    = $home_v1['jlb'];

            $is_enabled = isset( $jlb_options['is_enabled'] ) ? filter_var( $jlb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jlb_options['animation'] ) ? $jlb_options['animation'] : '';
            $shortcode  = !empty( $jlb_options['shortcode'] ) ? $jlb_options['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]';

            $args = apply_filters( 'jobhunt_home_v1_job_list_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jlb_options['section_class'] ) ? $jlb_options['section_class'] : '',
                'section_title'         => isset( $jlb_options['section_title'] ) ? $jlb_options['section_title'] : esc_html__( 'Featured Jobs', 'jobhunt' ),
                'sub_title'             => isset( $jlb_options['sub_title'] ) ? $jlb_options['sub_title'] : esc_html__( 'Leading Employers already using job and talent.', 'jobhunt' ),

                'shortcode'             => $shortcode
            ) );

            jobhunt_job_list_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v1_testimonial_block' ) ) {
    /**
     * Dispaly Job Testimonial Block in Home v1
     */
    function jobhunt_home_v1_testimonial_block() {

        if ( is_testimonials_activated() ) {
            $home_v1        = jobhunt_get_home_v1_meta();
            $ts_options     = $home_v1['ts'];

            $is_enabled = isset( $ts_options['is_enabled'] ) ? filter_var( $ts_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            if( ! empty( $ts_options['type'] ) && $ts_options['type'] === 'v1' ) {
                $ts_options['carousel_args']['slidesToShow'] = 2;
                $ts_options['carousel_args']['slidesToScroll'] = 2;
            } else {
                $ts_options['carousel_args']['slidesToShow'] = 1;
                $ts_options['carousel_args']['slidesToScroll'] = 1;
            }

            $animation  = isset( $ts_options['animation'] ) ? $ts_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v1_testimonial_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $ts_options['section_class'] ) ? $ts_options['section_class'] : '',
                'section_title'         => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : esc_html__( 'Kind Words From Happy Candidates', 'jobhunt' ),
                'sub_title'             => isset( $ts_options['sub_title'] ) ? $ts_options['sub_title'] : esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
                'columns'               => isset( $ts_options['columns'] ) ? $ts_options['columns'] : 2,
                'bg_choice'             => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'image',
                'bg_color'              => isset( $ts_options['bg_color'] ) ? $ts_options['bg_color'] : '',
                'bg_image'              => isset( $ts_options['bg_image'] ) && intval( $ts_options['bg_image'] ) ? wp_get_attachment_image_src( $ts_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ts_options['type'] ) ? $ts_options['type'] : 'v1',
                'query_args'            => array(
                    'limit'             => isset( $ts_options['query_args']['limit'] ) ? $ts_options['query_args']['limit'] : 8,
                    'orderby'           => isset( $ts_options['query_args']['orderby'] ) ? $ts_options['query_args']['orderby'] : 'title',
                    'order'             => isset( $ts_options['query_args']['order'] ) ? $ts_options['query_args']['order'] : 'ASC',
                    'size'              => isset( $ts_options['query_args']['size'] ) ? $ts_options['query_args']['size'] : '',
                ),
                'carousel_args'         => array(
                    'slidesToShow'      => isset( $ts_options['carousel_args']['slidesToShow'] ) ? intval( $ts_options['carousel_args']['slidesToShow'] ) : 2,
                    'slidesToScroll'    => isset( $ts_options['carousel_args']['slidesToScroll'] ) ? intval( $ts_options['carousel_args']['slidesToScroll'] ) : 2,
                    'dots'              => isset( $ts_options['carousel_args']['dots'] ) ? filter_var( $ts_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'arrows'            => isset( $ts_options['carousel_args']['arrows'] ) ? filter_var( $ts_options['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'          => isset( $ts_options['carousel_args']['autoplay'] ) ? filter_var( $ts_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        array(
                            'breakpoint'    => 0,
                            'settings'      => array(
                                'slidesToShow'      => 1,
                                'slidesToScroll'    => 1
                            )
                        ),
                        array(
                            'breakpoint'    => 576,
                            'settings'      => array(
                                'slidesToShow'      => 1,
                                'slidesToScroll'    => 1
                            )
                        ),
                        array(
                            'breakpoint'    => 768,
                            'settings'      => array(
                                'slidesToShow'      => 1,
                                'slidesToScroll'    => 1
                            )
                        ),
                        array(
                            'breakpoint'    => 992,
                            'settings'      => array(
                                'slidesToShow'      => 1,
                                'slidesToScroll'    => 1
                            )
                        ),
                        array(
                            'breakpoint'    => 1200,
                            'settings'      => array(
                                'slidesToShow'      => 2,
                                'slidesToScroll'    => 2
                            )
                        )
                    )
                )
            ) );

            jobhunt_testimonial_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v1_company_info_carousel' ) ) {
    /**
     * Dispaly Company Info Carousel in Home v1
     */
    function jobhunt_home_v1_company_info_carousel() {

        $home_v1        = jobhunt_get_home_v1_meta();
        $cic_options     = $home_v1['cic'];

        $is_enabled = isset( $cic_options['is_enabled'] ) ? filter_var( $cic_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $cic_options['animation'] ) ? $cic_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v1_company_info_carousel_args', array(
            'animation'             => $animation,
            'section_class'         => isset( $cic_options['section_class'] ) ? $cic_options['section_class'] : '',
            'section_title'         => isset( $cic_options['section_title'] ) ? $cic_options['section_title'] : esc_html__( 'Companies We\'ve Helped', 'jobhunt' ),
            'sub_title'             => isset( $cic_options['sub_title'] ) ? $cic_options['sub_title'] : esc_html__( 'Some of the companies we\'ve helped recruit excellent applicants over the years.', 'jobhunt' ),
            'columns'               => isset( $cic_options['columns'] ) ? $cic_options['columns'] : 4,
            'bg_choice'             => isset( $cic_options['bg_choice'] ) ? $cic_options['bg_choice'] : 'color',
            'bg_color'              => isset( $cic_options['bg_color'] ) ? $cic_options['bg_color'] : '',
            'bg_image'              => isset( $cic_options['bg_image'] ) && intval( $cic_options['bg_image'] ) ? wp_get_attachment_image_src( $cic_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'type'                  => isset( $cic_options['type'] ) ? $cic_options['type'] : 'v1',
            'is_featured'           => isset( $cic_options['is_featured'] ) ? filter_var( $cic_options['is_featured'], FILTER_VALIDATE_BOOLEAN ) : '',
            'query_args'            => array(
                'posts_per_page'    => isset( $cic_options['query_args']['per_page'] ) ? $cic_options['query_args']['per_page'] : 8,
                'orderby'           => isset( $cic_options['query_args']['orderby'] ) ? $cic_options['query_args']['orderby'] : 'title',
                'order'             => isset( $cic_options['query_args']['order'] ) ? $cic_options['query_args']['order'] : 'ASC',
                'size'              => isset( $cic_options['query_args']['size'] ) ? $cic_options['query_args']['size'] : '',
            ),
            'carousel_args'         => array(
                'slidesToShow'      => isset( $cic_options['carousel_args']['slidesToShow'] ) ? intval( $cic_options['carousel_args']['slidesToShow'] ) : 5,
                'slidesToScroll'    => isset( $cic_options['carousel_args']['slidesToScroll'] ) ? intval( $cic_options['carousel_args']['slidesToScroll'] ) : 5,
                'dots'              => isset( $cic_options['carousel_args']['dots'] ) ? filter_var( $cic_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                'arrows'            => isset( $cic_options['carousel_args']['arrows'] ) ? filter_var( $cic_options['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
                'autoplay'          => isset( $cic_options['carousel_args']['autoplay'] ) ? filter_var( $cic_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'responsive'        => array(
                    array(
                        'breakpoint'    => 0,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 576,
                        'settings'      => array(
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 768,
                        'settings'      => array(
                            'slidesToShow'      => 2,
                            'slidesToScroll'    => 2
                        )
                    ),
                    array(
                        'breakpoint'    => 992,
                        'settings'      => array(
                            'slidesToShow'      => 4,
                            'slidesToScroll'    => 4
                        )
                    ),
                    array(
                        'breakpoint'    => 1200,
                        'settings'      => array(
                            'slidesToShow'      => 5,
                            'slidesToScroll'    => 5
                        )
                    )
                )
            )
        ) );

        jobhunt_company_info_carousel( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v1_recent_posts' ) ) {
    /**
     * Display Posts
     */
    function jobhunt_home_v1_recent_posts() {

        $home_v1    = jobhunt_get_home_v1_meta();
        $rp_options = $home_v1['rp'];

        $is_enabled = isset( $rp_options['is_enabled'] ) ? filter_var( $rp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $rp_options['animation'] ) ? $rp_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v1_recent_posts_args', array(
            'section_class'     => isset( $rp_options['section_class'] ) ? $rp_options['section_class'] : '',
            'animation'         => $animation,
            'type'              => isset( $rp_options['type'] ) ? $rp_options['type'] : 'v1',
            'section_title'     => isset( $rp_options['section_title'] ) ? $rp_options['section_title'] : esc_html__( 'Quick Career Tips', 'jobhunt' ),
            'sub_title'         => isset( $rp_options['sub_title'] ) ? $rp_options['sub_title'] : esc_html__( 'Found by employers communicate directly with hiring managers and recruiters.', 'jobhunt' ),
            'limit'             => isset( $rp_options['limit'] ) ? $rp_options['limit'] : 3,
            'columns'           => isset( $rp_options['columns'] ) ? $rp_options['columns'] : 3,
            'post_choice'       => isset( $rp_options['post_choice'] ) ? $rp_options['post_choice'] : 'recent',
            'post_ids'          => isset( $rp_options['post_ids'] ) ? $rp_options['post_ids'] : '',
            'category__in'      => isset( $rp_options['category__in'] ) ? $rp_options['category__in'] : '',
        ) );

        jobhunt_recent_posts( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v1_banner_v2' ) ) {
    /**
     * Dispaly Job Banner v2 in Home v1
     */
    function jobhunt_home_v1_banner_v2() {

        $home_v1        = jobhunt_get_home_v1_meta();
        $br2_options    = $home_v1['br2'];

        $is_enabled = isset( $br2_options['is_enabled'] ) ? filter_var( $br2_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $br2_options['animation'] ) ? $br2_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v1_banner_v2_args', array(
            'animation'             => $animation,
            'section_class'         => isset( $br2_options['section_class'] ) ? $br2_options['section_class'] : '',
            'section_title'         => isset( $br2_options['section_title'] ) ? $br2_options['section_title'] : esc_html__( 'Gat a question?', 'jobhunt' ),
            'sub_title'             => isset( $br2_options['sub_title'] ) ? $br2_options['sub_title'] : esc_html__( 'We\'re here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555', 'jobhunt' ),
            'bg_choice'             => isset( $br2_options['bg_choice'] ) ? $br2_options['bg_choice'] : 'color',
            'bg_color'              => isset( $br2_options['bg_color'] ) ? $br2_options['bg_color'] : '',
            'bg_image'              => isset( $br2_options['bg_image'] ) && intval( $br2_options['bg_image'] ) ? wp_get_attachment_image_src( $br2_options['bg_image'], array( '2230', '1370' ) ) : '',
            'action_text'           => isset( $br2_options['action_text'] ) ? $br2_options['action_text'] : esc_html__( 'Create an Account', 'jobhunt' ),
            'action_link'           => isset( $br2_options['action_link'] ) ? $br2_options['action_link'] : '#',
            'is_enable_action'      => isset( $br2_options['is_enable_action'] ) ? filter_var( $br2_options['is_enable_action'], FILTER_VALIDATE_BOOLEAN ) : '',
        ) );

        jobhunt_banner( $args );
    }
}

if( ! function_exists( 'jobhunt_home_v1_hook_control' ) ) {
    function jobhunt_home_v1_hook_control() {
        if( is_page_template( array( 'template-homepage-v1.php' ) ) ) {
            remove_all_actions( 'jobhunt_homepage_v1' );

            $home_v1 = jobhunt_get_home_v1_meta();

            $is_enabled = isset( $home_v1['hpc']['is_enabled'] ) ? filter_var( $home_v1['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_homepage_v1',  'jobhunt_homepage_content',                 isset( $home_v1['hpc']['priority'] ) ? intval( $home_v1['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_job_categories_block',          isset( $home_v1['jcb']['priority'] ) ? intval( $home_v1['jcb']['priority'] ) : 20 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_banner_v1',                     isset( $home_v1['br1']['priority'] ) ? intval( $home_v1['br1']['priority'] ) : 30 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_job_list_block',                isset( $home_v1['jlb']['priority'] ) ? intval( $home_v1['jlb']['priority'] ) : 40 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_testimonial_block',             isset( $home_v1['ts']['priority'] ) ? intval( $home_v1['ts']['priority'] ) : 50 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_company_info_carousel',         isset( $home_v1['cic']['priority'] ) ? intval( $home_v1['cic']['priority'] ) : 60 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_recent_posts',                  isset( $home_v1['rp']['priority'] ) ? intval( $home_v1['rp']['priority'] ) : 70 );
            add_action( 'jobhunt_homepage_v1', 'jobhunt_home_v1_banner_v2',                     isset( $home_v1['br2']['priority'] ) ? intval( $home_v1['br2']['priority'] ) : 80 );
        }
    }
}
