<?php
/**
 * Template tags for Home v4
 */

function jobhunt_get_default_home_v5_options() {
    $home_v5 = array(
        'hsb'  => array(
            'section_title'     => esc_html__( 'Great Job', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Greater Talent', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Search Keywords', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'Locations', 'jobhunt' ),
            'show_category_select'      => 'no',
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'search_button_icon'        => 'la la-search',
        ),
        'jcb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Categories', 'jobhunt' ),
            'sub_title'         => '',
            'type'              => 'v4',
            'columns'           => 4,
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Browse All Categories', 'jobhunt' ),
            'category_args'     => array(
                'number'            => 4,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => false,
                'slugs'             => '',
            ),
        ),
        'jws'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'jobs'              => array(
                array(
                    'section_title' => esc_html__( 'Featured Jobs', 'jobhunt' ),
                    'shortcode'     => '[jobs featured="true" per_page="6" show_filters="false"]',
                ),
                array(
                    'section_title' => esc_html__( 'Recent Jobs', 'jobhunt' ),
                    'shortcode'     => '[job_summary]',
                ),
            ),
        ),
        'db'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'bg_choice'         => 'image',
            'bg_color'          => '',
            'banners'           => array(
                array(
                    'title'             => esc_html__( 'I AM RECRUITER!', 'jobhunt' ),
                    'sub_title'         => esc_html__( 'One of our One of our jobs has some kind of flexibility jobs has some kind of flexibility option such as telecommuting, a part-time schedule or a flexible or flextime.', 'jobhunt' ),
                    'action_text'       => esc_html__( 'Post new job', 'jobhunt' ),
                    'action_link'       => '#',
                    'caption_align'     => ''
                ),
                array(
                    'title'             => esc_html__( 'I AM JOBSEEKER!', 'jobhunt' ),
                    'sub_title'         => esc_html__( 'One of our One of our jobs has some kind of flexibility jobs has some kind of flexibility option such as telecommuting, a part-time schedule or a flexible or flextime.', 'jobhunt' ),
                    'action_text'       => esc_html__( 'Browse Jobs', 'jobhunt' ),
                    'action_link'       => '#',
                    'caption_align'     => 'align-end'
                ),
            )
        ),
        'hiw'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'type'              => 'v4',
            'section_title'     => esc_html__( 'How It Works', 'jobhunt' ),
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
        'cb'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Jobhunt Site Stats', 'jobhunt' ),
            'type'              => 'v2',
            'bg_choice'         => 'color',
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
        'fwt'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'faq'               => array(
                'is_enabled'            => 'yes',
                'section_title'         => esc_html__( 'Frequently Asked Questions?', 'jobhunt' ),
                'shortcode'             => '[mas_faq]'
            ),
            'ts'                => array(
                'is_enabled'            => 'yes',
                'section_title'         => esc_html__( 'What People Say', 'jobhunt' ),
                'bg_choice'             => 'color',
                'bg_color'              => '',
                'type'                  => 'v3',
                'query_args'            => array(
                    'limit'                 => 8,
                    'orderby'               => 'title',
                    'order'                 => 'ASC',
                    'size'                  => '',
                ),
                'carousel_args'         => array(
                    'slidesToShow'          => 1,
                    'slidesToScroll'        => 1,
                    'dots'                  => true,
                    'arrows'                => false,
                    'autoplay'              => false,
                )
            ),
        ),
        'bwi'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'title'             => esc_html__( 'Are You Hiring?', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Find everything you need to post a job and receive the best candidates by visiting our Employer website. We offer small business and enterprise options.', 'jobhunt' ),
            'bg_choice'         => 'image',
            'bg_color'          => '',
        ),
    );

    return apply_filters( 'jobhunt_home_v5_default_options', $home_v5 );
}

function jobhunt_get_home_v5_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v5_options = get_post_meta( $post->ID, '_home_v5_options', true );
        $home_v5_options = maybe_unserialize( $clean_home_v5_options );

        if( ! is_array( $home_v5_options ) ) {
            $home_v5_options = json_decode( $clean_home_v5_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_home_v5_options();
            $home_v5 = wp_parse_args( $home_v5_options, $default_options );
        } else {
            $home_v5 = $home_v5_options;
        }

        return apply_filters( 'jobhunt_home_v5_meta', $home_v5, $post );
    }
}

if ( ! function_exists( 'jobhunt_home_v5_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_v5_search_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v5        = jobhunt_get_home_v5_meta();
            $hsb_options    = $home_v5['hsb'];

            $args =  apply_filters( 'jobhunt_home_v5_search_block_args', array(
                'section_class'             => isset( $hsb_options['section_class'] ) ? $hsb_options['section_class'] : '',
                'section_title'             => isset( $hsb_options['section_title'] ) ? $hsb_options['section_title'] : esc_html__( 'Great Job', 'jobhunt' ),
                'sub_title'                 => isset( $hsb_options['sub_title'] ) ? $hsb_options['sub_title'] : esc_html__( 'Greater Talent', 'jobhunt' ),
                'search_placeholder_text'   => isset( $hsb_options['search_placeholder_text'] ) ? $hsb_options['search_placeholder_text'] : esc_html__( 'Search Keywords', 'jobhunt' ),
                'location_placeholder_text' => isset( $hsb_options['location_placeholder_text'] ) ? $hsb_options['location_placeholder_text'] : esc_html__( 'Locations', 'jobhunt' ),
                'show_category_select'      => isset( $hsb_options['show_category_select'] ) ? filter_var( $hsb_options['show_category_select'], FILTER_VALIDATE_BOOLEAN ) : false,
                'category_select_text'      => isset( $hsb_options['category_select_text'] ) ? $hsb_options['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                'search_button_icon'        => isset( $hsb_options['search_button_icon'] ) ? $hsb_options['search_button_icon'] : 'la la-search',
            ) );

            jobhunt_home_search_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v5_job_categories_block' ) ) {
    /**
     * Dispaly Job Categories Block in Home v4
     */
    function jobhunt_home_v5_job_categories_block() {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $home_v5        = jobhunt_get_home_v5_meta();
            $jcb_options    = $home_v5['jcb'];

            $is_enabled = isset( $jcb_options['is_enabled'] ) ? filter_var( $jcb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jcb_options['animation'] ) ? $jcb_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v5_job_categories_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jcb_options['section_class'] ) ? $jcb_options['section_class'] : '',
                'section_title'         => isset( $jcb_options['section_title'] ) ? $jcb_options['section_title'] : esc_html__( 'Popular Categories', 'jobhunt' ),
                'sub_title'             => isset( $jcb_options['sub_title'] ) ? $jcb_options['sub_title'] : '',
                'type'                  => isset( $jcb_options['type'] ) ? $jcb_options['type'] : 'v4',
                'columns'               => isset( $jcb_options['columns'] ) ? $jcb_options['columns'] : 4,
                'action_text'           => isset( $jcb_options['action_text'] ) ? $jcb_options['action_text'] : esc_html__( 'Browse All Categories', 'jobhunt' ),
                'action_link'           => isset( $jcb_options['action_link'] ) ? $jcb_options['action_link'] : '#',
                'category_args'         => array(
                    'orderby'               => isset( $jcb_options['category_args']['orderby'] ) ? $jcb_options['category_args']['orderby'] : 'name',
                    'order'                 => isset( $jcb_options['category_args']['order'] ) ? $jcb_options['category_args']['order'] : 'ASC',
                    'number'                => isset( $jcb_options['category_args']['number'] ) ? $jcb_options['category_args']['number'] : 4,
                    'hide_empty'            => isset( $jcb_options['category_args']['hide_empty'] ) ? filter_var( $jcb_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'slugs'                 => isset( $jcb_options['category_args']['slug'] ) ? $jcb_options['category_args']['slug'] : '',
                ),
            ) );

            jobhunt_job_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v5_job_list_with_summary' ) ) {
    /**
     * Dispaly Job list With Summary Block in Home v5
     */
    function jobhunt_home_v5_job_list_with_summary() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v5        = jobhunt_get_home_v5_meta();
            $jws_options    = $home_v5['jws'];

            $is_enabled = isset( $jws_options['is_enabled'] ) ? filter_var( $jws_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jws_options['animation'] ) ? $jws_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v5_job_list_with_summary_args', array(
                'animation'     => $animation,
                'section_class' => isset( $jws_options['section_class'] ) ? $jws_options['section_class'] : '',
                'jobs'          => array(
                    array(
                        'section_title'     => isset( $jws_options['jobs'][0]['section_title'] ) ? $jws_options['jobs'][0]['section_title'] : esc_html__( 'Featured Jobs', 'jobhunt' ),
                        'shortcode' => isset( $jws_options['jobs'][0]['shortcode'] ) ? $jws_options['jobs'][0]['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]',
                    ),
                    array(
                        'section_title'     => isset( $jws_options['jobs'][1]['section_title'] ) ? $jws_options['jobs'][1]['section_title'] : esc_html__( 'Recent Jobs', 'jobhunt' ),
                        'shortcode' => isset( $jws_options['jobs'][1]['shortcode'] ) ? $jws_options['jobs'][1]['shortcode'] : '[job_summary][job_summary]',
                    ),
                )
            ) );

            jobhunt_job_list_with_summary( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v5_dual_banner_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v5_dual_banner_block() {
        $home_v5    = jobhunt_get_home_v5_meta();
        $db_options = $home_v5['db'];

        $is_enabled = isset( $db_options['is_enabled'] ) ? filter_var( $db_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $db_options['animation'] ) ? $db_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v5_dual_banner_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $db_options['section_class'] ) ? $db_options['section_class'] : '',
            'type'              => isset( $db_options['type'] ) ? $db_options['type'] : '',
            'bg_choice'         => isset( $db_options['bg_choice'] ) ? $db_options['bg_choice'] : '',
            'bg_color'          => isset( $db_options['bg_color'] ) ? $db_options['bg_color'] : '',
            'bg_image'          => isset( $db_options['bg_image'] ) && intval( $db_options['bg_image'] ) ? wp_get_attachment_image_src( $db_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
            'banners'           => array()
        ) );

        foreach ( $db_options['banners'] as $key => $banner ) {
            $args['banners'][] = array(
                'title'             => isset( $banner['title'] ) ? $banner['title'] : '',
                'sub_title'         => isset( $banner['sub_title'] ) ? $banner['sub_title'] : '',
                'action_text'       => isset( $banner['action_text'] ) ? $banner['action_text'] : '',
                'action_link'       => isset( $banner['action_link'] ) ? $banner['action_link'] : '#',
            );
        }

        jobhunt_dual_banner_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v5_how_it_works_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v5_how_it_works_block() {
        $home_v5    = jobhunt_get_home_v5_meta();
        $hiw_options = $home_v5['hiw'];

        $is_enabled = isset( $hiw_options['is_enabled'] ) ? filter_var( $hiw_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $hiw_options['animation'] ) ? $hiw_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v5_how_it_works_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $hiw_options['section_class'] ) ? $hiw_options['section_class'] : '',
            'type'              => isset( $hiw_options['type'] ) ? $hiw_options['type'] : 'v4',
            'section_title'     => isset( $hiw_options['section_title'] ) ? $hiw_options['section_title'] : esc_html__( 'How It Works', 'jobhunt' ),
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

if ( ! function_exists( 'jobhunt_home_v5_counters_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v5_counters_block() {
        $home_v5    = jobhunt_get_home_v5_meta();
        $cb_options = $home_v5['cb'];

        $is_enabled = isset( $cb_options['is_enabled'] ) ? filter_var( $cb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $cb_options['animation'] ) ? $cb_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v5_counters_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $cb_options['section_class'] ) ? $cb_options['section_class'] : '',
            'section_title'     => isset( $cb_options['section_title'] ) ? $cb_options['section_title'] : esc_html__( 'Jobhunt Site Stats', 'jobhunt' ),
            'type'              => isset( $cb_options['type'] ) ? $cb_options['type'] : 'v2',
            'bg_choice'         => isset( $cb_options['bg_choice'] ) ? $cb_options['bg_choice'] : 'color',
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

if ( ! function_exists( 'jobhunt_home_v5_faq_with_testimonial_block' ) ) {
    /**
     * Dispaly Faq With Testimonial Block in Home v5
     */
    function jobhunt_home_v5_faq_with_testimonial_block() {

        $home_v5        = jobhunt_get_home_v5_meta();
        $fwt_options    = $home_v5['fwt'];
        $faq_options    = $fwt_options['faq'];
        $ts_options     = $fwt_options['ts'];

        $is_enabled = isset( $fwt_options['is_enabled'] ) ? filter_var( $fwt_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $fwt_options['animation'] ) ? $fwt_options['animation'] : '';
        $shortcode  = !empty( $faq_options['shortcode'] ) ? $faq_options['shortcode'] : '[mas_faq]';

        $faq_args = array(
            'section_title'     => isset( $faq_options['section_title'] ) ? $faq_options['section_title'] : esc_html__( 'Frequently Asked Questions?', 'jobhunt' ),
            'shortcode'         => $shortcode
        );

        if ( is_testimonials_activated() ) {
            $ts_args = array(
                'section_title'         => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : esc_html__( 'What People Say', 'jobhunt' ),
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
            );
        }

        $args = apply_filters( 'jobhunt_home_v5_faq_with_testimonial_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $fwt_options['section_class'] ) ? $fwt_options['section_class'] : '',
            'ts_args'           => isset( $ts_args ) ? $ts_args : array(),
            'faq_args'          => $faq_args,
        ) );


        jobhunt_faq_with_testimonial_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_home_v5_banner_with_image_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v5_banner_with_image_block() {
        $home_v5    = jobhunt_get_home_v5_meta();
        $bwi_options = $home_v5['bwi'];

        $is_enabled = isset( $bwi_options['is_enabled'] ) ? filter_var( $bwi_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $bwi_options['animation'] ) ? $bwi_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v5_banner_with_image_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $bwi_options['section_class'] ) ? $bwi_options['section_class'] : '',
            'type'              => isset( $bwi_options['type'] ) ? $bwi_options['type'] : '',
            'title'             => isset( $bwi_options['title'] ) ? $bwi_options['title'] : esc_html__( 'Are You Hiring?', 'jobhunt' ),
            'sub_title'         => isset( $bwi_options['sub_title'] ) ? $bwi_options['sub_title'] : esc_html__( 'Find everything you need to post a job and receive the best candidates by visiting our Empl oyer website. We offer small business and enterprise options.', 'jobhunt' ),
            'image'             => isset( $bwi_options['image'] ) && intval( $bwi_options['image'] ) ? wp_get_attachment_image_src( $bwi_options['image'], array( '450', '474' ) ) : array( '//placehold.it/450x474', '450', '474' ),
            'bg_choice'         => isset( $bwi_options['bg_choice'] ) ? $bwi_options['bg_choice'] : 'image',
            'bg_color'          => isset( $bwi_options['bg_color'] ) ? $bwi_options['bg_color'] : '',
            'bg_image'          => isset( $bwi_options['bg_image'] ) && intval( $bwi_options['bg_image'] ) ? wp_get_attachment_image_src( $bwi_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
        ) );

        jobhunt_banner_with_image_block( $args );
    }
}

if( ! function_exists( 'jobhunt_home_v5_hook_control' ) ) {
    function jobhunt_home_v5_hook_control() {
        if( is_page_template( array( 'template-homepage-v5.php' ) ) ) {
            remove_all_actions( 'jobhunt_homepage_v5' );

            $home_v5 = jobhunt_get_home_v5_meta();

            $is_enabled = isset( $home_v5['hpc']['is_enabled'] ) ? filter_var( $home_v5['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_homepage_v5',  'jobhunt_homepage_content',                 isset( $home_v5['hpc']['priority'] ) ? intval( $home_v5['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_job_categories_block',          isset( $home_v5['jcb']['priority'] ) ? intval( $home_v5['jcb']['priority'] ) : 20 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_job_list_with_summary',         isset( $home_v5['jws']['priority'] ) ? intval( $home_v5['jws']['priority'] ) : 30 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_dual_banner_block',             isset( $home_v5['db']['priority'] ) ? intval( $home_v5['db']['priority'] ) : 40 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_how_it_works_block',            isset( $home_v5['hiw']['priority'] ) ? intval( $home_v5['hiw']['priority'] ) : 50 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_counters_block',                isset( $home_v5['cb']['priority'] ) ? intval( $home_v5['cb']['priority'] ) : 60 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_faq_with_testimonial_block',    isset( $home_v5['fwt']['priority'] ) ? intval( $home_v5['fwt']['priority'] ) : 70 );
            add_action( 'jobhunt_homepage_v5', 'jobhunt_home_v5_banner_with_image_block',       isset( $home_v5['bwi']['priority'] ) ? intval( $home_v5['bwi']['priority'] ) : 80 );
        }
    }
}
