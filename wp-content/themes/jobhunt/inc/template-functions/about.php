<?php
/**
 * Template tags for About
 */

function jobhunt_get_default_about_options() {
    $about = array(
        'ac'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'About Job Hunt', 'jobhunt' ),
            'about_content'     => wp_kses_post( __( '<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much.</p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.</p>
                <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much. </p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy. </p>', 'jobhunt' ) ),
        ),
        'fl'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'section_title'     => esc_html__( 'Our Service', 'jobhunt' ),
            'features'          => array(
                array(
                    'icon'              => 'la la-clock-o',
                    'feature_title'     => esc_html__( 'Advertise A Job', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
                array(
                    'icon'              => 'la la-search',
                    'feature_title'     => esc_html__( 'CV Search', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
                array(
                    'icon'              => 'la la-user',
                    'feature_title'     => esc_html__( 'Recruiter Profiles', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
                array(
                    'icon'              => 'la la-codepen',
                    'feature_title'     => esc_html__( 'Temp Search', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
                array(
                    'icon'              => 'la la-tv',
                    'feature_title'     => esc_html__( 'Display Jobs', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
                array(
                    'icon'              => 'la la-diamond',
                    'feature_title'     => esc_html__( 'For Agencies', 'jobhunt' ),
                    'feature_desc'      => esc_html__( 'Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere. Morbi in lectus.', 'jobhunt' ),
                ),
            )
        ),
        'ts'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
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
        'cb'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
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
        'rp'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
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
    );

    return apply_filters( 'jobhunt_about_default_options', $about );
}

function jobhunt_get_about_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_about_options = get_post_meta( $post->ID, '_about_options', true );
        $about_options = maybe_unserialize( $clean_about_options );

        if( ! is_array( $about_options ) ) {
            $about_options = json_decode( $clean_about_options, true );
        }

        if ( $merge_default ) {
            $default_options = jobhunt_get_default_about_options();
            $about = wp_parse_args( $about_options, $default_options );
        } else {
            $about = $about_options;
        }

        return apply_filters( 'jobhunt_about_meta', $about, $post );
    }
}

if ( ! function_exists( 'jobhunt_about_about_content' ) ) {
    function jobhunt_about_about_content() {
        $about    = jobhunt_get_about_meta();
        $ac_options = $about['ac'];

        $is_enabled = isset( $ac_options['is_enabled'] ) ? filter_var( $ac_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $ac_options['animation'] ) ? $ac_options['animation'] : '';

        $args = apply_filters( 'jobhunt_about_about_content_args', array(
            'section_class'     => '',
            'animation'         => $animation,
            'section_title'     => isset( $ac_options['section_title'] ) ? $ac_options['section_title'] : esc_html__( 'About Job Hunt', 'jobhunt' ),
            'about_content'     => isset( $ac_options['about_content'] ) ? $ac_options['about_content'] : wp_kses_post(__( '<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much.</p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.</p>
                <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much. </p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy. </p>', 'jobhunt' ) ),
            'image'           => isset( $ac_options['image'] ) && intval( $ac_options['image'] ) ? wp_get_attachment_image_src( $ac_options['image'], array( '720', '440' ) ) : array( '//placehold.it/720x440', '720', '440' ),
        ) );

        jobhunt_about_content( $args );
    }
}

if ( ! function_exists( 'jobhunt_about_features_list_block' ) ) {
    /**
     *
     */
    function jobhunt_about_features_list_block() {
        $about      = jobhunt_get_about_meta();
        $fl_options = $about['fl'];

        $is_enabled = isset( $fl_options['is_enabled'] ) ? filter_var( $fl_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $fl_options['animation'] ) ? $fl_options['animation'] : '';

        $args = apply_filters( 'jobhunt_about_features_list_block_args', array(
            'section_class'     => '',
            'animation'         => $animation,
            'section_title'     => isset( $fl_options['section_title'] ) ? $fl_options['section_title'] : esc_html__( 'Our Service', 'jobhunt' ),
            'features'          => array()
        ) );

        foreach ( $fl_options['features'] as $key => $feature ) {
            if( isset( $feature['icon'] ) && isset( $feature['feature_title'] ) && isset( $feature['feature_desc'] ) ) {
                $args['features'][] = array(
                    'icon'          => $feature['icon'],
                    'feature_title' => $feature['feature_title'],
                    'feature_desc'  => $feature['feature_desc'],
                );
            }
        }

        jobhunt_features_list_block( $args );
    }
}

if ( ! function_exists( 'jobhunt_about_testimonial_block' ) ) {
    /**
     * Dispaly Job Testimonial Block in About
     */
    function jobhunt_about_testimonial_block() {

        if ( is_testimonials_activated() ) {
            $about        = jobhunt_get_about_meta();
            $ts_options     = $about['ts'];

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

            $args = apply_filters( 'jobhunt_about_testimonial_block_args', array(
                'animation'             => $animation,
                'section_title'         => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : esc_html__( 'Kind Words From Happy Candidates', 'jobhunt' ),
                'sub_title'             => isset( $ts_options['sub_title'] ) ? $ts_options['sub_title'] : esc_html__( 'What other people thought about the service provided by Jobhunt', 'jobhunt' ),
                'columns'               => isset( $ts_options['columns'] ) ? $ts_options['columns'] : 2,
                'bg_choice'             => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'image',
                'bg_color'              => isset( $ts_options['bg_color'] ) ? $ts_options['bg_color'] : '',
                'bg_image'              => isset( $ts_options['bg_image'] ) && intval( $ts_options['bg_image'] ) ? wp_get_attachment_image_src( $ts_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
                'type'                  => isset( $ts_options['type'] ) ? $ts_options['type'] :'v1',
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

if ( ! function_exists( 'jobhunt_about_counters_block' ) ) {
    /**
     *
     */
    function jobhunt_about_counters_block() {
        $about    = jobhunt_get_about_meta();
        $cb_options = $about['cb'];

        $is_enabled = isset( $cb_options['is_enabled'] ) ? filter_var( $cb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $cb_options['animation'] ) ? $cb_options['animation'] : '';

        $args = apply_filters( 'jobhunt_home_v5_counters_block_args', array(
            'section_class'     => '',
            'animation'         => $animation,
            'type'              => isset( $ts_options['type'] ) ? $ts_options['type'] : 'v2',
            'bg_choice'         => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'color',
            'bg_color'          => isset( $ts_options['bg_color'] ) ? $ts_options['bg_color'] : '',
            'bg_image'          => isset( $ts_options['bg_image'] ) && intval( $ts_options['bg_image'] ) ? wp_get_attachment_image_src( $ts_options['bg_image'], array( '2230', '1370' ) ) : array( '//placehold.it/2230x1370', '2230', '1370' ),
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

if ( ! function_exists( 'jobhunt_about_recent_posts' ) ) {
    /**
     * Display Posts
     */
    function jobhunt_about_recent_posts() {

        $about    = jobhunt_get_about_meta();
        $rp_options = $about['rp'];

        $is_enabled = isset( $rp_options['is_enabled'] ) ? filter_var( $rp_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $rp_options['animation'] ) ? $rp_options['animation'] : '';

        $args = apply_filters( 'jobhunt_about_recent_posts_args', array(
            'section_class'     => isset( $rp_options['section_class'] ) ? $rp_options['section_class'] : '',
            'animation'         => $animation,
            'type'              => isset( $ts_options['bg_choice'] ) ? $ts_options['bg_choice'] : 'v1',
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

if( ! function_exists( 'jobhunt_about_hook_control' ) ) {
    function jobhunt_about_hook_control() {
        if( is_page_template( array( 'template-aboutpage.php' ) ) ) {
            remove_all_actions( 'jobhunt_aboutpage' );

            $about = jobhunt_get_about_meta();

            $is_enabled = isset( $about['hpc']['is_enabled'] ) ? filter_var( $about['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( $is_enabled ) {
                add_action( 'jobhunt_aboutpage',  'jobhunt_homepage_content',                   isset( $about['hpc']['priority'] ) ? intval( $about['hpc']['priority'] ) : 10 );
            }

            add_action( 'jobhunt_aboutpage', 'jobhunt_about_about_content',                     isset( $about['ac']['priority'] ) ? intval( $about['ac']['priority'] ) : 20 );
            add_action( 'jobhunt_aboutpage', 'jobhunt_about_features_list_block',               isset( $about['fl']['priority'] ) ? intval( $about['fl']['priority'] ) : 30 );
            add_action( 'jobhunt_aboutpage', 'jobhunt_about_testimonial_block',                 isset( $about['ts']['priority'] ) ? intval( $about['ts']['priority'] ) : 40 );
            add_action( 'jobhunt_aboutpage', 'jobhunt_about_counters_block',                    isset( $about['cb']['priority'] ) ? intval( $about['cb']['priority'] ) : 50 );
            add_action( 'jobhunt_aboutpage', 'jobhunt_about_recent_posts',                      isset( $about['rp']['priority'] ) ? intval( $about['rp']['priority'] ) : 60 );
        }
    }
}
