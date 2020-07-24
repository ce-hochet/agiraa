<?php
/**
 * Template tags for Home v3
 */

function jobhunt_get_default_home_v3_options() {
    $home_v3 = array(
        'hsb'  => array(
            'search_type'               => 'resume',
            'section_title'             => esc_html__( 'Find Candidate', 'jobhunt' ),
            'sub_title'                 => esc_html__( 'We have 2.567 resumes in our database', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Search freelancer services (e.g. logo design)', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'show_category_select'      => 'no',
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'search_button_icon'        => 'la la-search',
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
        'br'  => array(
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
        'hiw'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'type'              => 'v2',
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
            'priority'          => 60,
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
        'ts'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'What our clients say about us', 'jobhunt' ),
            'sub_title'         => esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
            'columns'           => 2,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => 'v3',
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
        'ap'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Download & Enjoy', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.', 'jobhunt' ),
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'apps'             => array(
                array(
                    'link'          => '#',
                    'icon'          => 'fab fa-apple',
                    'app_title'    => esc_html__( 'App Store', 'jobhunt' ),
                    'app_desc'     => esc_html__( 'Available now on the', 'jobhunt' ),
                ),
                array(
                    'link'          => '#',
                    'icon'          => 'fab fa-google-play',
                    'app_title'    => esc_html__( 'Google Play', 'jobhunt' ),
                    'app_desc'     => esc_html__( 'Get in on', 'jobhunt' ),
                ),
            )
        ),
        'ci'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => esc_html__( 'Featured Candidates', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Every single one of our jobs has some kind of flexibility option', 'jobhunt' ),
            'columns'           => 4,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => '',
            'is_featured'       => true,
            'query_args'        => array(
                'per_page'          => '8',
                'orderby'           => 'title',
                'order'             => 'ASC',
                'size'              => '',
            ),
            'carousel_args'     => array(
                'slidesToShow'      => 4,
                'slidesToScroll'    => 4,
                'dots'              => true,
                'arrows'            => false,
                'autoplay'          => false,
            )
        ),
        'jp'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Buy Our Plans And Packeges', 'jobhunt' ),
            'sub_title'         => esc_html__( 'One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.', 'jobhunt' ),
            'shortcode_content' => array(
                'shortcode'         => 'products',
                'shortcode_atts'    => array(
                    'columns'       => '4',
                    'per_page'      => '4'
                )
            ),
        ),
    );

    return apply_filters( 'jobhunt_home_v3_default_options', $home_v3 );
}

function jobhunt_get_home_v3_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v3_options = get_post_meta( $post->ID, '_home_v3_options', true );
        $home_v3_options = maybe_unserialize( $clean_home_v3_options );

        if( ! is_array( $home_v3_options ) ) {
            $home_v3_options = json_decode( $clean_home_v3_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_home_v3_options();
            $home_v3 = wp_parse_args( $home_v3_options, $default_options );
        } else {
            $home_v3 = $home_v3_options;
        }

        return apply_filters( 'jobhunt_home_v3_meta', $home_v3, $post );
    }
}

if ( ! function_exists( 'jobhunt_home_v3_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_v3_search_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v3        = jobhunt_get_home_v3_meta();
            $hsb_options    = $home_v3['hsb'];

            $args =  apply_filters( 'jobhunt_home_v3_search_block_args', array(
                'section_class'             => isset( $hsb_options['section_class'] ) ? $hsb_options['section_class'] : '',
                'search_type'               => isset( $hsb_options['search_type'] ) ? $hsb_options['search_type'] : 'resume',
                'section_title'             => isset( $hsb_options['section_title'] ) ? $hsb_options['section_title'] : esc_html__( 'Find Candidate', 'jobhunt' ),
                'sub_title'                 => isset( $hsb_options['sub_title'] ) ? $hsb_options['sub_title'] : esc_html__( 'We have 2.567 resumes in our database', 'jobhunt' ),
                'search_placeholder_text'   => isset( $hsb_options['search_placeholder_text'] ) ? $hsb_options['search_placeholder_text'] : esc_html__( 'Search freelancer services (e.g. logo design)', 'jobhunt' ),
                'location_placeholder_text' => isset( $hsb_options['location_placeholder_text'] ) ? $hsb_options['location_placeholder_text'] : esc_html__( 'City, province or region', 'jobhunt' ),
                'show_category_select'      => isset( $hsb_options['show_category_select'] ) ? filter_var( $hsb_options['show_category_select'], FILTER_VALIDATE_BOOLEAN ) : false,
                'category_select_text'      => isset( $hsb_options['category_select_text'] ) ? $hsb_options['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                'search_button_icon'        => isset( $hsb_options['search_button_icon'] ) ? $hsb_options['search_button_icon'] : 'la la-search',
            ) );

            jobhunt_home_search_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v3_job_categories_block' ) ) {
    /**
     * Dispaly Job Categories Block in Home v3
     */
    function jobhunt_home_v3_job_categories_block() {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $home_v3        = jobhunt_get_home_v3_meta();
            $jcb_options    = $home_v3['jcb'];

            $is_enabled = isset( $jcb_options['is_enabled'] ) ? filter_var( $jcb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jcb_options['animation'] ) ? $jcb_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v3_job_categories_block_args', array(
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
                    'hide_empty'            => isset( $jcb_options['category_args']['hide_empty'] ) ? filter_var( $jcb_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'slugs'                 => isset( $jcb_options['category_args']['slug'] ) ? $jcb_options['category_args']['slug'] : '',
                ),
            ) );

            jobhunt_job_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v3_banner' ) ) {
    /**
     * Dispaly Job Banner v1 in Home v3
     */
    function jobhunt_home_v3_banner() {

        $home_v3        = jobhunt_get_home_v3_meta();
        $br_options    = $home_v3['br'];

        $is_enabled = isset( $br_options['is_enabled'] ) ? filter_var( $br_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $br_options['animation'] ) ? $br_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v3_banner_v1_args', array(
            'animation'             => $animation,
            'section_class'         => isset( $br_options['section_class'] ) ? $br_options['section_class'] : '',
            'section_title'         => isset( $br_options['section_title'] ) ? $br_options['section_title'] : esc_html__( 'Make a Difference with Your Online Resume!', 'jobhunt' ),
            'sub_title'             => isset( $br_options['sub_title'] ) ? $br_options['sub_title'] : esc_html__( 'Your resume in minutes with Jobhunt resume assistant is ready!', 'jobhunt' ),
            'bg_choice'             => isset( $br_options['bg_choice'] ) ? $br_options['bg_choice'] : 'image',
            'bg_color'              => isset( $br_options['bg_color'] ) ? $br_options['bg_color'] : '',
            'bg_image'              => isset( $br_options['bg_image'] ) && intval( $br_options['bg_image'] ) ? wp_get_attachment_image_src( $br_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'action_text'           => isset( $br_options['action_text'] ) ? $br_options['action_text'] : esc_html__( 'Create an Account', 'jobhunt' ),
            'action_link'           => isset( $br_options['action_link'] ) ? $br_options['action_link'] : '#',
            'is_enable_action'      => isset( $br_options['is_enable_action'] ) ? filter_var( $br_options['is_enable_action'], FILTER_VALIDATE_BOOLEAN ) : true,
        ) );

        jobhunt_banner( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v3_job_list_block' ) ) {
    /**
     * Dispaly Job list Block in Home v3
     */
    function jobhunt_home_v3_job_list_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v3        = jobhunt_get_home_v3_meta();
            $jlb_options    = $home_v3['jlb'];

            $is_enabled = isset( $jlb_options['is_enabled'] ) ? filter_var( $jlb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jlb_options['animation'] ) ? $jlb_options['animation'] : '';
            $shortcode  = !empty( $jlb_options['shortcode'] ) ? $jlb_options['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]';

            $args = apply_filters( 'jobhunt_home_v3_job_list_block_args', array(
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

if ( ! function_exists( 'jobhunt_home_v3_how_it_works_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v3_how_it_works_block() {
        $home_v3        = jobhunt_get_home_v3_meta();
        $hiw_options    = $home_v3['hiw'];

        $is_enabled = isset( $hiw_options['is_enabled'] ) ? filter_var( $hiw_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $hiw_options['animation'] ) ? $hiw_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v3_how_it_works_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $hiw_options['section_class'] ) ? $hiw_options['section_class'] : '',
            'type'              => isset( $hiw_options['type'] ) ? $hiw_options['type'] : 'v2',
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

if ( ! function_exists( 'jobhunt_home_v3_company_info_carousel' ) ) {
    /**
     * Dispaly Company Info Carousel in Home v3
     */
    function jobhunt_home_v3_company_info_carousel() {

        $home_v3        = jobhunt_get_home_v3_meta();
        $cic_options     = $home_v3['cic'];

        $is_enabled = isset( $cic_options['is_enabled'] ) ? filter_var( $cic_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $cic_options['animation'] ) ? $cic_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v3_company_info_carousel_args', array(
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

if ( ! function_exists( 'jobhunt_home_v3_testimonial_block' ) ) {
    /**
     * Dispaly Job Testimonial Block in Home v3
     */
    function jobhunt_home_v3_testimonial_block() {

        if ( is_testimonials_activated() ) {
            $home_v3        = jobhunt_get_home_v3_meta();
            $ts_options     = $home_v3['ts'];

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

            $args = apply_filters( 'jobhunt_home_v3_testimonial_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $ts_options['section_class'] ) ? $ts_options['section_class'] : '',
                'section_title'         => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : esc_html__( 'What our clients say about us', 'jobhunt' ),
                'sub_title'             => isset( $ts_options['sub_title'] ) ? $ts_options['sub_title'] : esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
                'columns'               => isset( $ts_options['columns'] ) ? $ts_options['columns'] : 2,
                'bg_choice'             => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'color',
                'bg_color'              => isset( $ts_options['bg_color'] ) ? $ts_options['bg_color'] : '',
                'bg_image'              => isset( $ts_options['bg_image'] ) && intval( $ts_options['bg_image'] ) ? wp_get_attachment_image_src( $ts_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ts_options['type'] ) ? $ts_options['type'] : 'v3',
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

if ( ! function_exists( 'jobhunt_home_v3_app_promo_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v3_app_promo_block() {
        $home_v3    = jobhunt_get_home_v3_meta();
        $ap_options = $home_v3['ap'];

        $is_enabled = isset( $ap_options['is_enabled'] ) ? filter_var( $ap_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $ap_options['animation'] ) ? $ap_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v3_app_promo_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $ap_options['section_class'] ) ? $ap_options['section_class'] : '',
            'type'              => isset( $ap_options['type'] ) ? $ap_options['type'] : '',
            'section_title'     => isset( $ap_options['section_title'] ) ? $ap_options['section_title'] : esc_html__( 'Download & Enjoy', 'jobhunt' ),
            'sub_title'         => isset( $ap_options['sub_title'] ) ? $ap_options['sub_title'] : esc_html__( 'Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.', 'jobhunt' ),
            'image'             => isset( $ap_options['image'] ) && intval( $ap_options['image'] ) ? wp_get_attachment_image_src( $ap_options['image'], array( '450', '474' ) ) : array( '//placehold.it/450x474', '450', '474' ),
            'bg_choice'         => isset( $ap_options['bg_choice'] ) ? $ap_options['bg_choice'] : 'image',
            'bg_color'          => isset( $ap_options['bg_color'] ) ? $ap_options['bg_color'] : '',
            'bg_image'          => isset( $ap_options['bg_image'] ) && intval( $ap_options['bg_image'] ) ? wp_get_attachment_image_src( $ap_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'apps'              => array()
        ) );

        foreach ( $ap_options['apps'] as $key => $app ) {
            if( isset( $app['link'] ) && isset( $app['icon'] ) && isset( $app['app_title'] ) && isset( $app['app_desc'] )  ) {
                $args['apps'][] = array(
                    'link'          => $app['link'],
                    'icon'          => $app['icon'],
                    'app_title'     => $app['app_title'],
                    'app_desc'      => $app['app_desc'],
                );
            }
        }

        jobhunt_app_promo_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v3_candidate_info_block' ) ) {
    /**
     * Dispaly Candidate Info Block in Home v3
     */
    function jobhunt_home_v3_candidate_info_block() {

        if ( jobhunt_is_wp_resume_manager_activated() ) {
            $home_v3        = jobhunt_get_home_v3_meta();
            $ci_options     = $home_v3['ci'];

            $is_enabled = isset( $ci_options['is_enabled'] ) ? filter_var( $ci_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $ci_options['animation'] ) ? $ci_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v3_candidate_info_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $ci_options['section_class'] ) ? $ci_options['section_class'] : '',
                'section_title'         => isset( $ci_options['section_title'] ) ? $ci_options['section_title'] : esc_html__( 'Featured Candidates', 'jobhunt' ),
                'sub_title'             => isset( $ci_options['sub_title'] ) ? $ci_options['sub_title'] : esc_html__( 'Every single one of our jobs has some kind of flexibility option', 'jobhunt' ),
                'columns'               => isset( $ci_options['columns'] ) ? $ci_options['columns'] : 4,
                'bg_choice'             => isset( $ci_options['bg_choice'] ) ? $ci_options['bg_choice'] : 'color',
                'bg_color'              => isset( $ci_options['bg_color'] ) ? $ci_options['bg_color'] : '',
                'bg_image'              => isset( $ci_options['bg_image'] ) && intval( $ci_options['bg_image'] ) ? wp_get_attachment_image_src( $ci_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ci_options['type'] ) ? $ci_options['type'] : '',
                'is_featured'           => isset( $ci_options['is_featured'] ) ? filter_var( $ci_options['is_featured'], FILTER_VALIDATE_BOOLEAN ) : '',
                'query_args'            => array(
                    'posts_per_page'    => isset( $ci_options['query_args']['per_page'] ) ? $ci_options['query_args']['per_page'] : 8,
                    'orderby'           => isset( $ci_options['query_args']['orderby'] ) ? $ci_options['query_args']['orderby'] : 'title',
                    'order'             => isset( $ci_options['query_args']['order'] ) ? $ci_options['query_args']['order'] : 'ASC',
                    'size'              => isset( $ci_options['query_args']['size'] ) ? $ci_options['query_args']['size'] : '',
                ),
                'carousel_args'         => array(
                    'slidesToShow'      => isset( $ci_options['carousel_args']['slidesToShow'] ) ? intval( $ci_options['carousel_args']['slidesToShow'] ) : 4,
                    'slidesToScroll'    => isset( $ci_options['carousel_args']['slidesToScroll'] ) ? intval( $ci_options['carousel_args']['slidesToScroll'] ) : 4,
                    'dots'              => isset( $ci_options['carousel_args']['dots'] ) ? filter_var( $ci_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'arrows'            => isset( $ci_options['carousel_args']['arrows'] ) ? filter_var( $ci_options['carousel_args']['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'          => isset( $ci_options['carousel_args']['autoplay'] ) ? filter_var( $ci_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

            jobhunt_candidate_info_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v3_job_pricing' ) ) {
    /**
     * Displays Job Pricing
     */
    function jobhunt_home_v3_job_pricing() {
        if ( jobhunt_is_woocommerce_activated() ) {

            $home_v3    = jobhunt_get_home_v3_meta();
            $jp_options = $home_v3['jp'];

            $is_enabled = isset( $jp_options['is_enabled'] ) ? filter_var( $jp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation = isset( $jp_options['animation'] ) ? $jp_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v3_job_pricing_args', array(
                'animation'         => $animation,
                'section_class'     => isset( $jp_options['section_class'] ) ? $jp_options['section_class'] : '',
                'section_title'     => isset( $jp_options['section_title'] ) ? $jp_options['section_title'] : esc_html__( 'Buy Our Plans And Packeges', 'jobhunt' ),
                'sub_title'         => isset( $jp_options['sub_title'] ) ? $jp_options['sub_title'] : esc_html__( 'One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.', 'jobhunt' ),
                'shortcode_atts'    => isset( $jp_options['shortcode_content'] ) ? jobhunt_get_atts_for_shortcode( $jp_options['shortcode_content'] ) : array( 'columns' => '4', 'limit' => '4' ),
            ) );

            jobhunt_job_pricing( $args );
        }
    }
}

if( ! function_exists( 'jobhunt_home_v3_hook_control' ) ) {
    function jobhunt_home_v3_hook_control() {
        if( is_page_template( array( 'template-homepage-v3.php' ) ) ) {
            remove_all_actions( 'jobhunt_homepage_v3' );

            $home_v3 = jobhunt_get_home_v3_meta();

            $is_enabled = isset( $home_v3['hpc']['is_enabled'] ) ? filter_var( $home_v3['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_homepage_v3',  'jobhunt_homepage_content',                 isset( $home_v3['hpc']['priority'] ) ? intval( $home_v3['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_job_categories_block',          isset( $home_v3['jcb']['priority'] ) ? intval( $home_v3['jcb']['priority'] ) : 20 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_banner',                        isset( $home_v3['br']['priority'] ) ? intval( $home_v3['br']['priority'] ) : 30 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_job_list_block',                isset( $home_v3['jlb']['priority'] ) ? intval( $home_v3['jlb']['priority'] ) : 40 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_how_it_works_block',            isset( $home_v3['hiw']['priority'] ) ? intval( $home_v3['hiw']['priority'] ) : 50 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_company_info_carousel',         isset( $home_v3['cic']['priority'] ) ? intval( $home_v3['cic']['priority'] ) : 60 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_testimonial_block',             isset( $home_v3['ts']['priority'] ) ? intval( $home_v3['ts']['priority'] ) : 70 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_app_promo_block',               isset( $home_v3['ap']['priority'] ) ? intval( $home_v3['ap']['priority'] ) : 80 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_candidate_info_block',          isset( $home_v3['ci']['priority'] ) ? intval( $home_v3['ci']['priority'] ) : 90 );
            add_action( 'jobhunt_homepage_v3', 'jobhunt_home_v3_job_pricing',                   isset( $home_v3['jp']['priority'] ) ? intval( $home_v3['jp']['priority'] ) : 100 );
        }
    }
}
