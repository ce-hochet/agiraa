<?php
/**
 * Template tags for Home v2
 */

function jobhunt_get_default_home_v2_options() {
    $home_v2 = array(
        'hsb'  => array(
            'section_title'             => esc_html__( 'The Easiest Way to Get Your New Job', 'jobhunt' ),
            'sub_title'                 => esc_html__( 'Find Jobs, Employment & Career Opportunities', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Keywords', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'All Regions', 'jobhunt' ),
            'show_category_select'      => 'yes',
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'search_button_icon'        => 'la la-search',
            'search_button_text'        => esc_html__( 'Search', 'jobhunt' ),
        ),
        'jcb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => 'v2',
            'columns'           => 4,
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Browse All Categories', 'jobhunt' ),
            'category_args'     => array(
                'number'            => 4,
                'orderby'           => 'date',
                'order'             => 'DESC',
                'hide_empty'        => false,
                'slugs'             => '',
            ),
        ),
        'jlb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'section_title'     => esc_html__( 'Recent Jobs', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Leading Employers already using job and talent.', 'jobhunt' ),
            'type'              => 'grid',
            'shortcode'         => ''
        ),
        'hiw'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'type'              => 'v1',
            'section_title'     => esc_html__( 'How It Works', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Each month, more than 7 million Jobhunt turn to website in their search for work, making over 160,000 applications every day.', 'jobhunt' ),
            'steps'             => array(
                array(
                    'icon'          => 'la la-user',
                    'step_title'    => esc_html__( 'Register an account', 'jobhunt' ),
                    'step_desc'     => esc_html__( 'Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.', 'jobhunt' ),
                ),
                array(
                    'icon'          => 'la la-file-archive-o',
                    'step_title'    => esc_html__( 'Specify & search your job', 'jobhunt' ),
                    'step_desc'     => esc_html__( 'Browse profiles, reviews, and proposals then interview top candidates.', 'jobhunt' ),
                ),
                array(
                    'icon'          => 'la la-list',
                    'step_title'    => esc_html__( 'Apply for job', 'jobhunt' ),
                    'step_desc'     => esc_html__( 'Use the Upwork platform to chat, share files, and collaborate from your desktop or on the go.', 'jobhunt' ),
                ),
            )
        ),
        'cic'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Top Company Registered', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Some of the companies we\'ve helped recruit excellent applicants over the years.', 'jobhunt' ),
            'columns'           => 4,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => 'v2',
            'is_featured'       => false,
            'query_args'        => array(
                'per_page'          => '8',
                'orderby'           => 'title',
                'order'             => 'ASC',
                'size'              => '',
            ),
            'carousel_args'     => array(
                'slidesToShow'      => 4,
                'slidesToScroll'    => 4,
                'dots'              => false,
                'arrows'            => true,
                'autoplay'          => false,
            )
        ),
        'cb'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Projob Site Stats', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Here we list our site stats and how many people we’ve helped find a job and companies have found recruits. It\'s a pretty awesome stats area!', 'jobhunt' ),
            'type'              => 'v1',
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'counters'          => array(
                array(
                    'counter_title'     => esc_html__( 'Jobs Posted', 'jobhunt' ),
                    'count_value'       => esc_html__( '18', 'jobhunt' ),
                ),
                array(
                    'counter_title'     => esc_html__( 'Jobs Filled', 'jobhunt' ),
                    'count_value'       => esc_html__( '38', 'jobhunt' ),
                ),
                array(
                    'counter_title'     => esc_html__( 'Companies', 'jobhunt' ),
                    'count_value'       => esc_html__( '67', 'jobhunt' ),
                ),
                array(
                    'counter_title'     => esc_html__( 'Members', 'jobhunt' ),
                    'count_value'       => esc_html__( '92', 'jobhunt' ),
                ),
            )
        ),
        'ts'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'What our clients say about us', 'jobhunt' ),
            'sub_title'         => esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
            'columns'           => 2,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => 'v2',
            'query_args'        => array(
                'limit'             => 8,
                'orderby'           => 'title',
                'order'             => 'ASC',
                'size'              => '',
            ),
            'carousel_args'     => array(
                'slidesToShow'      => 1,
                'slidesToScroll'    => 1,
                'dots'              => true,
                'arrows'            => false,
                'autoplay'          => false,
            )
        ),
        'rp'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'type'              => 'v2',
            'section_title'     => esc_html__( 'Quick Career Tips', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Found by employers communicate directly with hiring managers and recruiters.', 'jobhunt' ),
            'limit'             => 3,
            'columns'           => 3,
            'post_choice'       => '',
            'post_ids'          => '',
            'category__in'      => '',
        ),
        'jp'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => esc_html__( 'Buy Our Plans And Packeges', 'jobhunt' ),
            'sub_title'         => esc_html__( 'One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.', 'jobhunt' ),
            'shortcode_content' => array(
                'shortcode'         => 'products',
                'shortcode_atts'    => array(
                    'columns'       => '3',
                    'per_page'      => '3'
                )
            ),
        ),
    );

    return apply_filters( 'jobhunt_home_v2_default_options', $home_v2 );
}

function jobhunt_get_home_v2_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v2_options = get_post_meta( $post->ID, '_home_v2_options', true );
        $home_v2_options = maybe_unserialize( $clean_home_v2_options );

        if( ! is_array( $home_v2_options ) ) {
            $home_v2_options = json_decode( $clean_home_v2_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_home_v2_options();
            $home_v2 = wp_parse_args( $home_v2_options, $default_options );
        } else {
            $home_v2 = $home_v2_options;
        }

        return apply_filters( 'jobhunt_home_v2_meta', $home_v2, $post );
    }
}

if ( ! function_exists( 'jobhunt_home_v2_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_v2_search_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v2        = jobhunt_get_home_v2_meta();
            $hsb_options    = $home_v2['hsb'];

            $args =  apply_filters( 'jobhunt_home_v2_search_block_args', array(
                'section_class'             => isset( $hsb_options['section_class'] ) ? $hsb_options['section_class'] : '',
                'section_title'             => isset( $hsb_options['section_title'] ) ? $hsb_options['section_title'] : esc_html__( 'The Easiest Way to Get Your New Job', 'jobhunt' ),
                'sub_title'                 => isset( $hsb_options['sub_title'] ) ? $hsb_options['sub_title'] : esc_html__( 'Find Jobs, Employment & Career Opportunities', 'jobhunt' ),
                'search_placeholder_text'   => isset( $hsb_options['search_placeholder_text'] ) ? $hsb_options['search_placeholder_text'] : esc_html__( 'Keywords', 'jobhunt' ),
                'location_placeholder_text' => isset( $hsb_options['location_placeholder_text'] ) ? $hsb_options['location_placeholder_text'] : esc_html__( 'All Regions', 'jobhunt' ),
                'show_category_select'      => isset( $hsb_options['show_category_select'] ) ? filter_var( $hsb_options['show_category_select'], FILTER_VALIDATE_BOOLEAN ) : false,
                'category_select_text'      => isset( $hsb_options['category_select_text'] ) ? $hsb_options['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                'search_button_icon'        => isset( $hsb_options['search_button_icon'] ) ? $hsb_options['search_button_icon'] : 'la la-search',
                'search_button_text'        => isset( $hsb_options['search_button_text'] ) ? $hsb_options['search_button_text'] : esc_html__( 'Search', 'jobhunt' ),
            ) );

            jobhunt_home_search_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v2_job_categories_block' ) ) {
    /**
     * Dispaly Job Categories Block in Home v2
     */
    function jobhunt_home_v2_job_categories_block() {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $home_v2        = jobhunt_get_home_v2_meta();
            $jcb_options    = $home_v2['jcb'];

            $is_enabled = isset( $jcb_options['is_enabled'] ) ? filter_var( $jcb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jcb_options['animation'] ) ? $jcb_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v2_job_categories_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jcb_options['section_class'] ) ? $jcb_options['section_class'] : '',
                'section_title'         => isset( $jcb_options['section_title'] ) ? $jcb_options['section_title'] : '',
                'sub_title'             => isset( $jcb_options['sub_title'] ) ? $jcb_options['sub_title'] :'',
                'type'                  => isset( $jcb_options['type'] ) ? $jcb_options['type'] :'v2',
                'columns'               => isset( $jcb_options['columns'] ) ? $jcb_options['columns'] : 4,
                'action_text'           => isset( $jcb_options['action_text'] ) ? $jcb_options['action_text'] : esc_html__( 'Browse All Categories', 'jobhunt' ),
                'action_link'           => isset( $jcb_options['action_link'] ) ? $jcb_options['action_link'] : '#',
                'category_args'         => array(
                    'orderby'               => isset( $jcb_options['category_args']['orderby'] ) ? $jcb_options['category_args']['orderby'] : 'date',
                    'order'                 => isset( $jcb_options['category_args']['order'] ) ? $jcb_options['category_args']['order'] : 'DESC',
                    'number'                => isset( $jcb_options['category_args']['number'] ) ? $jcb_options['category_args']['number'] : 4,
                    'hide_empty'            => isset( $jcb_options['category_args']['hide_empty'] ) ? filter_var( $jcb_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'slugs'                 => isset( $jcb_options['category_args']['slug'] ) ? $jcb_options['category_args']['slug'] : '',
                ),
            ) );

            jobhunt_job_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v2_job_list_block' ) ) {
    /**
     * Dispaly Job list Block in Home v2
     */
    function jobhunt_home_v2_job_list_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v2        = jobhunt_get_home_v2_meta();
            $jlb_options    = $home_v2['jlb'];

            $is_enabled = isset( $jlb_options['is_enabled'] ) ? filter_var( $jlb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jlb_options['animation'] ) ? $jlb_options['animation'] : '';
            $shortcode  = !empty( $jlb_options['shortcode'] ) ? $jlb_options['shortcode'] : '[jobs view="grid" per_page="6" show_filters="false" orderby="date" order="DESC"] ';

            $args = apply_filters( 'jobhunt_home_v2_job_list_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jlb_options['section_class'] ) ? $jlb_options['section_class'] : '',
                'section_title'         => isset( $jlb_options['section_title'] ) ? $jlb_options['section_title'] : esc_html__( 'Recent Jobs', 'jobhunt' ),
                'sub_title'             => isset( $jlb_options['sub_title'] ) ? $jlb_options['sub_title'] : esc_html__( 'Leading Employers already using job and talent.', 'jobhunt' ),
                'shortcode'             => $shortcode
            ) );

            jobhunt_job_list_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v2_how_it_works_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v2_how_it_works_block() {
        $home_v2    = jobhunt_get_home_v2_meta();
        $hiw_options = $home_v2['hiw'];

        $is_enabled = isset( $hiw_options['is_enabled'] ) ? filter_var( $hiw_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $hiw_options['animation'] ) ? $hiw_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v2_how_it_works_block_args', array(
            'section_class'     => isset( $hiw_options['section_class'] ) ? $hiw_options['section_class'] : '',
            'animation'         => $animation,
            'type'              => isset( $hiw_options['type'] ) ? $hiw_options['type'] :'v1',
            'section_title'     => isset( $hiw_options['section_title'] ) ? $hiw_options['section_title'] : esc_html__( 'How It Works', 'jobhunt' ),
            'sub_title'         => isset( $hiw_options['sub_title'] ) ? $hiw_options['sub_title'] : esc_html__( 'Each month, more than 7 million Jobhunt turn to website in their search for work, making over 160,000 applications every day.', 'jobhunt' ),
            'steps'             => array()
        ) );

        foreach ( $hiw_options['steps'] as $key => $step ) {
            if( isset( $step['icon'] ) && isset( $step['step_title'] ) && isset( $step['step_desc'] )  ) {
                $args['steps'][] = array(

                    'icon'          => $step['icon'],
                    'step_title'    => $step['step_title'],
                    'step_desc'     => $step['step_desc'],
                );
            }
        }

        jobhunt_how_it_works_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v2_company_info_carousel' ) ) {
    /**
     * Dispaly Company Info Carousel in Home v2
     */
    function jobhunt_home_v2_company_info_carousel() {

        $home_v2        = jobhunt_get_home_v2_meta();
        $cic_options     = $home_v2['cic'];

        $is_enabled = isset( $cic_options['is_enabled'] ) ? filter_var( $cic_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $cic_options['animation'] ) ? $cic_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v2_company_info_carousel_args', array(
            'animation'             => $animation,
            'section_class'         => isset( $cic_options['section_class'] ) ? $cic_options['section_class'] : '',
            'section_title'         => isset( $cic_options['section_title'] ) ? $cic_options['section_title'] : esc_html__( 'Top Company Registered', 'jobhunt' ),
            'sub_title'             => isset( $cic_options['sub_title'] ) ? $cic_options['sub_title'] : esc_html__( 'Some of the companies we\'ve helped recruit excellent applicants over the years.', 'jobhunt' ),
            'columns'               => isset( $cic_options['columns'] ) ? $cic_options['columns'] : 4,
            'bg_choice'             => isset( $cic_options['bg_choice'] ) ? $cic_options['bg_choice'] : 'color',
            'bg_color'              => isset( $cic_options['bg_color'] ) ? $cic_options['bg_color'] : '',
            'bg_image'              => isset( $cic_options['bg_image'] ) && intval( $cic_options['bg_image'] ) ? wp_get_attachment_image_src( $cic_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'type'                  => isset( $cic_options['type'] ) ? $cic_options['type'] : 'v2',
            'is_featured'           => isset( $cic_options['is_featured'] ) ? filter_var( $cic_options['is_featured'], FILTER_VALIDATE_BOOLEAN ) : '',
            'query_args'            => array(
                'posts_per_page'    => isset( $cic_options['query_args']['per_page'] ) ? $cic_options['query_args']['per_page'] : 8,
                'orderby'           => isset( $cic_options['query_args']['orderby'] ) ? $cic_options['query_args']['orderby'] : 'title',
                'order'             => isset( $cic_options['query_args']['order'] ) ? $cic_options['query_args']['order'] : 'ASC',
                'size'              => isset( $cic_options['query_args']['size'] ) ? $cic_options['query_args']['size'] : '',
            ),
            'carousel_args'         => array(
                'slidesToShow'      => isset( $cic_options['carousel_args']['slidesToShow'] ) ? intval( $cic_options['carousel_args']['slidesToShow'] ) : 4,
                'slidesToScroll'    => isset( $cic_options['carousel_args']['slidesToScroll'] ) ? intval( $cic_options['carousel_args']['slidesToScroll'] ) : 4,
                'dots'              => isset( $cic_options['carousel_args']['dots'] ) ? filter_var( $cic_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                'arrows'            => isset( $cic_options['carousel_args']['arrows'] ) ? filter_var( $cic_options['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : true,
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
                            'slidesToShow'      => 2,
                            'slidesToScroll'    => 2
                        )
                    ),
                    array(
                        'breakpoint'    => 1200,
                        'settings'      => array(
                            'slidesToShow'      => 3,
                            'slidesToScroll'    => 3
                        )
                    )
                )
            )
        ) );

        jobhunt_company_info_carousel( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v2_counters_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v2_counters_block() {
        $home_v2    = jobhunt_get_home_v2_meta();
        $cb_options = $home_v2['cb'];

        $is_enabled = isset( $cb_options['is_enabled'] ) ? filter_var( $cb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $cb_options['animation'] ) ? $cb_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v2_counters_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $cb_options['section_class'] ) ? $cb_options['section_class'] : '',
            'section_title'     => isset( $cb_options['section_title'] ) ? $cb_options['section_title'] : esc_html__( 'Projob Site Stats', 'jobhunt' ),
            'sub_title'         => isset( $cb_options['sub_title'] ) ? $cb_options['sub_title'] : esc_html__( 'Here we list our site stats and how many people we’ve helped find a job and companies have found recruits. It\'s a pretty awesome stats area!', 'jobhunt' ),
            'type'              => isset( $cb_options['type'] ) ? $cb_options['type'] : 'v1',
            'bg_choice'         => isset( $cb_options['bg_choice'] ) ? $cb_options['bg_choice'] : 'image',
            'bg_color'          => isset( $cb_options['bg_color'] ) ? $cb_options['bg_color'] : '',
            'bg_image'          => isset( $cb_options['bg_image'] ) && intval( $cb_options['bg_image'] ) ? wp_get_attachment_image_src( $cb_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'counters'          => array()
        ) );

        foreach ( $cb_options['counters'] as $key => $counter ) {
            if( isset( $counter['counter_title'] ) && isset( $counter['count_value'] )  ) {
                $args['counters'][] = array(
                    'counter_title'     => $counter['counter_title'],
                    'count_value'       => $counter['count_value'],
                );
            }
        }

        jobhunt_counters_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v2_testimonial_block' ) ) {
    /**
     * Dispaly Job Testimonial Block in Home v2
     */
    function jobhunt_home_v2_testimonial_block() {

        if ( is_testimonials_activated() ) {
            $home_v2        = jobhunt_get_home_v2_meta();
            $ts_options     = $home_v2['ts'];

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

            $args = apply_filters( 'jobhunt_home_v2_testimonial_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $ts_options['section_class'] ) ? $ts_options['section_class'] : '',
                'section_title'         => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : esc_html__( 'What our clients say about us', 'jobhunt' ),
                'sub_title'             => isset( $ts_options['sub_title'] ) ? $ts_options['sub_title'] : esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
                'columns'               => isset( $ts_options['columns'] ) ? $ts_options['columns'] : 2,
                'bg_choice'             => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'color',
                'bg_color'              => isset( $ts_options['bg_color'] ) ? $ts_options['bg_color'] : '',
                'bg_image'              => isset( $ts_options['bg_image'] ) && intval( $ts_options['bg_image'] ) ? wp_get_attachment_image_src( $ts_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ts_options['type'] ) ? $ts_options['type'] : 'v2',
                'query_args'            => array(
                    'limit'             => isset( $ts_options['query_args']['limit'] ) ? $ts_options['query_args']['limit'] : 8,
                    'orderby'           => isset( $ts_options['query_args']['orderby'] ) ? $ts_options['query_args']['orderby'] : 'title',
                    'order'             => isset( $ts_options['query_args']['order'] ) ? $ts_options['query_args']['order'] : 'ASC',
                    'size'              => isset( $ts_options['query_args']['size'] ) ? $ts_options['query_args']['size'] : '',
                ),
                'carousel_args'         => array(
                    'slidesToShow'      => isset( $ts_options['carousel_args']['slidesToShow'] ) ? intval( $ts_options['carousel_args']['slidesToShow'] ) : 1,
                    'slidesToScroll'    => isset( $ts_options['carousel_args']['slidesToScroll'] ) ? intval( $ts_options['carousel_args']['slidesToScroll'] ) : 1,
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
                                'slidesToShow'      => 1,
                                'slidesToScroll'    => 1
                            )
                        )
                    )
                )
            ) );

            jobhunt_testimonial_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v2_recent_posts' ) ) {
    /**
     * Display Posts
     */
    function jobhunt_home_v2_recent_posts() {

        $home_v2    = jobhunt_get_home_v2_meta();
        $rp_options = $home_v2['rp'];

        $is_enabled = isset( $rp_options['is_enabled'] ) ? filter_var( $rp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $rp_options['animation'] ) ? $rp_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v2_recent_posts_args', array(
            'section_class'     => isset( $rp_options['section_class'] ) ? $rp_options['section_class'] : '',
            'animation'         => $animation,
            'type'              => isset( $rp_options['type'] ) ? $rp_options['type'] : 'v2',
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

if ( ! function_exists( 'jobhunt_home_v2_job_pricing' ) ) {
    /**
     * Displays Job Pricing
     */
    function jobhunt_home_v2_job_pricing() {
        if ( jobhunt_is_woocommerce_activated() ) {

            $home_v2    = jobhunt_get_home_v2_meta();
            $jp_options = $home_v2['jp'];

            $is_enabled = isset( $jp_options['is_enabled'] ) ? filter_var( $jp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation = isset( $jp_options['animation'] ) ? $jp_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v2_job_pricing_args', array(
                'section_class'     => isset( $jp_options['section_class'] ) ? $jp_options['section_class'] : '',
                'animation'         => $animation,
                'section_title'     => isset( $jp_options['section_title'] ) ? $jp_options['section_title'] : esc_html__( 'Buy Our Plans And Packeges', 'jobhunt' ),
                'sub_title'         => isset( $jp_options['sub_title'] ) ? $jp_options['sub_title'] : esc_html__( 'One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.', 'jobhunt' ),
                'shortcode_atts'    => isset( $jp_options['shortcode_content'] ) ? jobhunt_get_atts_for_shortcode( $jp_options['shortcode_content'] ) : array( 'columns' => '3', 'limit' => '3' ),
            ) );

            jobhunt_job_pricing( $args );
        }
    }
}

if( ! function_exists( 'jobhunt_home_v2_hook_control' ) ) {
    function jobhunt_home_v2_hook_control() {
        if( is_page_template( array( 'template-homepage-v2.php' ) ) ) {
            remove_all_actions( 'jobhunt_homepage_v2' );

            $home_v2 = jobhunt_get_home_v2_meta();

            $is_enabled = isset( $home_v2['hpc']['is_enabled'] ) ? filter_var( $home_v2['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_homepage_v2',  'jobhunt_homepage_content',                 isset( $home_v2['hpc']['priority'] ) ? intval( $home_v2['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_job_list_block',                isset( $home_v2['jlb']['priority'] ) ? intval( $home_v2['jlb']['priority'] ) : 30 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_how_it_works_block',            isset( $home_v2['hiw']['priority'] ) ? intval( $home_v2['hiw']['priority'] ) : 40 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_company_info_carousel',         isset( $home_v2['cic']['priority'] ) ? intval( $home_v2['cic']['priority'] ) : 50 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_counters_block',                isset( $home_v2['cb']['priority'] ) ? intval( $home_v2['cb']['priority'] ) : 60 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_testimonial_block',             isset( $home_v2['ts']['priority'] ) ? intval( $home_v2['ts']['priority'] ) : 70 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_recent_posts',                  isset( $home_v2['rp']['priority'] ) ? intval( $home_v2['rp']['priority'] ) : 80 );
            add_action( 'jobhunt_homepage_v2', 'jobhunt_home_v2_job_pricing',                   isset( $home_v2['jp']['priority'] ) ? intval( $home_v2['jp']['priority'] ) : 90 );
        }
    }
}
