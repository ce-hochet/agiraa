<?php
/**
 * Template tags for Home v4
 */

function jobhunt_get_default_home_v4_options() {
    $home_v4 = array(
        'hsb'  => array(
            'section_title'     => esc_html__( 'Find the career you deserve', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Your job search starts and ends with us.', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Search Keywords', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'show_category_select'      => 'yes',
            'category_select_text'      => esc_html__( 'All specialisms', 'jobhunt' ),
            'search_button_icon'        => 'la la-search',
            'search_button_text'        => esc_html__( 'Search', 'jobhunt' ),
        ),
        'jcb'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Categories', 'jobhunt' ),
            'sub_title'         => esc_html__( '37 jobs live - 0 added today.', 'jobhunt' ),
            'type'              => 'v3',
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
        'jlt'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'tabs'              => array(
                array(
                    'title'         => esc_html__( 'Featured Jobs', 'jobhunt' ),
                    'shortcode'     => '[jobs featured="true" per_page="6" show_filters="false"]',
                ),
                array(
                    'title'         => esc_html__( 'Recent Jobs', 'jobhunt' ),
                    'shortcode'     => '[jobs orderby="date" order="desc" per_page="6" show_filters="false"]',
                ),
            ),
        ),
        'ap'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
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
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Featured Candidates', 'jobhunt' ),
            'sub_title'         => esc_html__( 'Every single one of our jobs has some kind of flexibility option', 'jobhunt' ),
            'columns'           => 4,
            'bg_choice'         => 'color',
            'bg_color'          => '',
            'type'              => '',
            'is_featured'       => true,
            'query_args'        => array(
                'per_page'          => 8,
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
        'hiw'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'type'              => 'v3',
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
    );

    return apply_filters( 'jobhunt_home_v4_default_options', $home_v4 );
}

function jobhunt_get_home_v4_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v4_options = get_post_meta( $post->ID, '_home_v4_options', true );
        $home_v4_options = maybe_unserialize( $clean_home_v4_options );

        if( ! is_array( $home_v4_options ) ) {
            $home_v4_options = json_decode( $clean_home_v4_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_home_v4_options();
            $home_v4 = wp_parse_args( $home_v4_options, $default_options );
        } else {
            $home_v4 = $home_v4_options;
        }

        return apply_filters( 'jobhunt_home_v4_meta', $home_v4, $post );
    }
}

if ( ! function_exists( 'jobhunt_home_v4_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_v4_search_block() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v4        = jobhunt_get_home_v4_meta();
            $hsb_options    = $home_v4['hsb'];

            $args =  apply_filters( 'jobhunt_home_v4_search_block_args', array(
                'section_class'             => isset( $hsb_options['section_class'] ) ? $hsb_options['section_class'] : '',
                'section_title'             => isset( $hsb_options['section_title'] ) ? $hsb_options['section_title'] : esc_html__( 'Find the career you deserve', 'jobhunt' ),
                'sub_title'                 => isset( $hsb_options['sub_title'] ) ? $hsb_options['sub_title'] : esc_html__( 'Your job search starts and ends with us.', 'jobhunt' ),
                'search_placeholder_text'   => isset( $hsb_options['search_placeholder_text'] ) ? $hsb_options['search_placeholder_text'] : esc_html__( 'Search Keywords', 'jobhunt' ),
                'location_placeholder_text' => isset( $hsb_options['location_placeholder_text'] ) ? $hsb_options['location_placeholder_text'] : esc_html__( 'City, province or region', 'jobhunt' ),
                'show_category_select'      => isset( $hsb_options['show_category_select'] ) ? filter_var( $hsb_options['show_category_select'], FILTER_VALIDATE_BOOLEAN ) : false,
                'category_select_text'      => isset( $hsb_options['category_select_text'] ) ? $hsb_options['category_select_text'] : esc_html__( 'All specialisms', 'jobhunt' ),
                'search_button_icon'        => isset( $hsb_options['search_button_icon'] ) ? $hsb_options['search_button_icon'] : 'la la-search',
                'search_button_text'        => isset( $hsb_options['search_button_text'] ) ? $hsb_options['search_button_text'] : esc_html__( 'Search', 'jobhunt' ),
            ) );

            jobhunt_home_search_block( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v4_job_categories_block' ) ) {
    /**
     * Dispaly Job Categories Block in Home v4
     */
    function jobhunt_home_v4_job_categories_block() {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $home_v4        = jobhunt_get_home_v4_meta();
            $jcb_options    = $home_v4['jcb'];

            $is_enabled = isset( $jcb_options['is_enabled'] ) ? filter_var( $jcb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jcb_options['animation'] ) ? $jcb_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v4_job_categories_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $jcb_options['section_class'] ) ? $jcb_options['section_class'] : '',
                'section_title'         => isset( $jcb_options['section_title'] ) ? $jcb_options['section_title'] : esc_html__( 'Popular Categories', 'jobhunt' ),
                'sub_title'             => isset( $jcb_options['sub_title'] ) ? $jcb_options['sub_title'] : esc_html__( '37 jobs live - 0 added today.', 'jobhunt' ),
                'type'                  => isset( $jcb_options['type'] ) ? $jcb_options['type'] : 'v3',
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

if ( ! function_exists( 'jobhunt_home_v4_job_list_tabs' ) ) {
    /**
     * Dispaly Job list Block in Home v4
     */
    function jobhunt_home_v4_job_list_tabs() {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $home_v4        = jobhunt_get_home_v4_meta();
            $jlt_options    = $home_v4['jlt'];

            $is_enabled = isset( $jlt_options['is_enabled'] ) ? filter_var( $jlt_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $jlt_options['animation'] ) ? $jlt_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v4_job_list_tabs_args', array(
                'animation'     => $animation,
                'section_class' => isset( $jlt_options['section_class'] ) ? $jlt_options['section_class'] : '',
                'tabs'          => array(
                    array(
                        'id'            => 'tab-jobs-1',
                        'title'         => isset( $jlt_options['tabs'][0]['title'] ) ? $jlt_options['tabs'][0]['title'] : esc_html__( 'Featured Jobs', 'jobhunt' ),
                        'shortcode' => isset( $jlt_options['tabs'][0]['shortcode'] ) ? $jlt_options['tabs'][0]['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]',
                    ),
                    array(
                        'id'            => 'tab-jobs-2',
                        'title'         => isset( $jlt_options['tabs'][1]['title'] ) ? $jlt_options['tabs'][1]['title'] : esc_html__( 'Recent Jobs', 'jobhunt' ),
                        'shortcode' => isset( $jlt_options['tabs'][1]['shortcode'] ) ? $jlt_options['tabs'][1]['shortcode'] : '[jobs ordeerby="date" order="desc" per_page="6" show_filters="false"]',
                    ),
                )
            ) );

            jobhunt_job_list_tabs( $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_home_v4_app_promo_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v4_app_promo_block() {
        $home_v4    = jobhunt_get_home_v4_meta();
        $ap_options = $home_v4['ap'];

        $is_enabled = isset( $ap_options['is_enabled'] ) ? filter_var( $ap_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $ap_options['animation'] ) ? $ap_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v4_app_promo_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $ap_options['section_class'] ) ? $ap_options['section_class'] : '',
            'type'              => isset( $ap_options['type'] ) ? $ap_options['type'] : '',
            'section_title'     => isset( $ap_options['section_title'] ) ? $ap_options['section_title'] : esc_html__( 'Download & Enjoy', 'jobhunt' ),
            'sub_title'         => isset( $ap_options['sub_title'] ) ? $ap_options['sub_title'] : esc_html__( 'Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.', 'jobhunt' ),
            'image'             => isset( $ap_options['image'] ) && intval( $ap_options['image'] ) ? wp_get_attachment_image_src( $ap_options['image'], array( '450', '474' ) ) : array( '//placehold.it/450x474', '450', '474' ),
            'bg_choice'             => isset( $ap_options['bg_choice'] ) ? $ap_options['bg_choice'] : 'image',
            'bg_color'              => isset( $ap_options['bg_color'] ) ? $ap_options['bg_color'] : '',
            'bg_image'              => isset( $ap_options['bg_image'] ) && intval( $ap_options['bg_image'] ) ? wp_get_attachment_image_src( $ap_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
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

if ( ! function_exists( 'jobhunt_home_v4_candidate_info_block' ) ) {
    /**
     * Dispaly Candidate Info Block in Home v4
     */
    function jobhunt_home_v4_candidate_info_block() {

        if ( jobhunt_is_wp_resume_manager_activated() ) {
            $home_v4        = jobhunt_get_home_v4_meta();
            $ci_options     = $home_v4['ci'];

            $is_enabled = isset( $ci_options['is_enabled'] ) ? filter_var( $ci_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation  = isset( $ci_options['animation'] ) ? $ci_options['animation'] : '';

            $args = apply_filters( 'jobhunt_home_v4_candidate_info_block_args', array(
                'animation'             => $animation,
                'section_class'         => isset( $ci_options['section_class'] ) ? $ci_options['section_class'] : '',
                'section_title'         => isset( $ci_options['section_title'] ) ? $ci_options['section_title'] : esc_html__( 'Featured Candidates', 'jobhunt' ),
                'sub_title'             => isset( $ci_options['sub_title'] ) ? $ci_options['sub_title'] : esc_html__( 'Every single one of our jobs has some kind of flexibility option', 'jobhunt' ),
                'columns'               => isset( $ci_options['columns'] ) ? $ci_options['columns'] : 4,
                'bg_choice'             => isset( $ci_options['bg_choice'] ) ? $ci_options['bg_choice'] : 'color',
                'bg_color'              => isset( $ci_options['bg_color'] ) ? $ci_options['bg_color'] : '',
                'bg_image'              => isset( $ci_options['bg_image'] ) && intval( $ci_options['bg_image'] ) ? wp_get_attachment_image_src( $ci_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ci_options['type'] ) ? $ci_options['type'] :'',
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

if ( ! function_exists( 'jobhunt_home_v4_company_info_carousel' ) ) {
    /**
     * Dispaly Company Info Carousel in Home v4
     */
    function jobhunt_home_v4_company_info_carousel() {

        $home_v4        = jobhunt_get_home_v4_meta();
        $cic_options     = $home_v4['cic'];

        $is_enabled = isset( $cic_options['is_enabled'] ) ? filter_var( $cic_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation  = isset( $cic_options['animation'] ) ? $cic_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v4_company_info_carousel_args', array(
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

if ( ! function_exists( 'jobhunt_home_v4_recent_posts' ) ) {
    /**
     * Display Posts
     */
    function jobhunt_home_v4_recent_posts() {

        $home_v4    = jobhunt_get_home_v4_meta();
        $rp_options = $home_v4['rp'];

        $is_enabled = isset( $rp_options['is_enabled'] ) ? filter_var( $rp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $rp_options['animation'] ) ? $rp_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v4_recent_posts_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $rp_options['section_class'] ) ? $rp_options['section_class'] : '',
            'type'              => isset( $rp_options['type'] ) ? $rp_options['type'] :'v1',
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

if ( ! function_exists( 'jobhunt_home_v4_how_it_works_block' ) ) {
    /**
     *
     */
    function jobhunt_home_v4_how_it_works_block() {
        $home_v4        = jobhunt_get_home_v4_meta();
        $hiw_options    = $home_v4['hiw'];

        $is_enabled = isset( $hiw_options['is_enabled'] ) ? filter_var( $hiw_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $hiw_options['animation'] ) ? $hiw_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v4_how_it_works_block_args', array(
            'animation'         => $animation,
            'section_class'     => isset( $hiw_options['section_class'] ) ? $hiw_options['section_class'] : '',
            'type'              => isset( $hiw_options['type'] ) ? $hiw_options['type'] :'v3',
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

if( ! function_exists( 'jobhunt_home_v4_hook_control' ) ) {
    function jobhunt_home_v4_hook_control() {
        if( is_page_template( array( 'template-homepage-v4.php' ) ) ) {
            remove_all_actions( 'jobhunt_homepage_v4' );

            $home_v4 = jobhunt_get_home_v4_meta();

            $is_enabled = isset( $home_v4['hpc']['is_enabled'] ) ? filter_var( $home_v4['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_homepage_v4',  'jobhunt_homepage_content',                 isset( $home_v4['hpc']['priority'] ) ? intval( $home_v4['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_job_categories_block',          isset( $home_v4['jcb']['priority'] ) ? intval( $home_v4['jcb']['priority'] ) : 20 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_job_list_tabs',                 isset( $home_v4['jlt']['priority'] ) ? intval( $home_v4['jlt']['priority'] ) : 30 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_app_promo_block',               isset( $home_v4['ap']['priority'] ) ? intval( $home_v4['ap']['priority'] ) : 40 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_candidate_info_block',          isset( $home_v4['ci']['priority'] ) ? intval( $home_v4['ci']['priority'] ) : 50 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_company_info_carousel',         isset( $home_v4['cic']['priority'] ) ? intval( $home_v4['cic']['priority'] ) : 60 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_recent_posts',                  isset( $home_v4['rp']['priority'] ) ? intval( $home_v4['rp']['priority'] ) : 70 );
            add_action( 'jobhunt_homepage_v4', 'jobhunt_home_v4_how_it_works_block',            isset( $home_v4['hiw']['priority'] ) ? intval( $home_v4['hiw']['priority'] ) : 80 );
        }
    }
}
