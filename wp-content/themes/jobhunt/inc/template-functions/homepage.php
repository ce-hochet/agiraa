<?php
/**
 * Template functions hooked into the homepage templates
 */
if ( ! function_exists( 'jobhunt_get_atts_for_shortcode' ) ) {
    function jobhunt_get_atts_for_shortcode( $args ) {
        $atts = array();

        if ( isset( $args['shortcode'] ) ) {

            if ( 'product_attribute' == $args['shortcode'] && ! empty( $args['attribute'] ) && ! empty( $args['terms'] ) ) {

                $atts['attribute']      = $args['attribute'];
                $atts['terms']          = $args['terms'];
                $atts['terms_operator'] = ! empty( $args['terms_operator'] ) ? $args['terms_operator'] : 'IN';

            } elseif ( 'product_category' == $args['shortcode'] && ! empty( $args['product_category_slug'] ) ) {

                $atts['category']       = $args['product_category_slug'];
                $atts['cat_operator']   = ! empty( $args['cat_operator'] ) ? $args['cat_operator'] : 'IN';

            } elseif ( 'products' == $args['shortcode'] && ! empty( $args['products_ids_skus'] ) ) {

                $ids_or_skus            = ! empty( $args['products_choice'] ) ? $args['products_choice'] : 'ids';
                $atts[$ids_or_skus]     = $args['products_ids_skus'];
                $atts['orderby']        = 'post__in';

            } elseif ( $args['shortcode'] == 'sale_products'  ) {

                $atts['on_sale']        = true;

            } elseif ($args['shortcode'] == 'best_selling_products'  ) {

                $atts['best_selling']   = true;

            } elseif ( $args['shortcode'] == 'featured_products'  ) {

                $atts['visibility']     = 'featured';

            } elseif ( $args['shortcode'] == 'top_rated_products' ) {

                $atts['top_rated']      = true;

            } elseif ( $args['shortcode'] == 'recent_products' ) {

                $atts['visibility']     = 'visible';

            }
        }

        if( isset( $args['shortcode_atts'] ) ) {
            $atts = wp_parse_args( $atts, $args['shortcode_atts'] );
        }

        return $atts;
    }
}

if ( ! function_exists( 'jobhunt_get_atts_for_taxonomy_slugs' ) ) {
    function jobhunt_get_atts_for_taxonomy_slugs( $args ) {
        if ( ! empty( $args['slugs'] ) ) {
            $cat_slugs = is_array( $args['slugs'] ) ? $args['slugs'] : explode( ',', $args['slugs'] );
            $cat_slugs = array_map( 'trim', $cat_slugs );
            $args['slug'] = $cat_slugs;
            $args['orderby'] = 'slug__in';
            $args['order'] = 'ASC';
        }

        return $args;
    }
}

if ( ! function_exists( 'jobhunt_homepage_content' ) ) {
    /**
     * Display homepage content
     * Hooked into the `homepage` action in the homepage template
     *
     * @since  1.0.0
     * @return  void
     */
    function jobhunt_homepage_content() {
        while ( have_posts() ) {
            the_post();

            ?>
            <div class="entry-content">
                <?php
                    the_content();
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobhunt' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div>
            <?php

        } // end of the loop.
    }
}

if ( ! function_exists( 'jobhunt_job_categories_block' ) ) {
    /**
     *
     */
    function jobhunt_job_categories_block( $args = array() ) {

        if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {

            $default_args = apply_filters( 'jobhunt_job_categories_block_default_args', array(
                'section_class'         => '',
                'section_title'         => '',
                'sub_title'             => '',
                'type'                  => '',
                'columns'               => 4,
                'action_link'           => '#',
                'action_text'           => esc_html__( 'Browse All Categories', 'jobhunt' ),
                'category_args'         => array(
                    'orderby'               => 'name',
                    'order'                 => 'ASC',
                    'number'                => 8,
                    'hide_empty'            => false,
                    'slugs'                 => '',
                ),
            ) );

            $args = wp_parse_args( $args, $default_args );

            jobhunt_get_template( 'home/job-categories-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_banner' ) ) {
    /**
     *
     */
    function jobhunt_banner( $args = array() ) {

        $default_args = apply_filters( 'jobhunt_banner_default_args', array(
            'section_class'         => '',
            'section_title'         => '',
            'sub_title'             => '',
            'bg_choice'             => '',
            'bg_color'              => '',
            'action_link'           => '#',
            'action_text'           => esc_html__( 'Create an Account', 'jobhunt' ),
            'is_enable_action'      => ''
        ) );

        $args = wp_parse_args( $args, $default_args );

        jobhunt_get_template( 'home/banner.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_job_list_block' ) ) {
    /**
     *
     */
    function jobhunt_job_list_block( $args = array() ) {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $default_args = apply_filters( 'jobhunt_job_list_block_default_args', array(
                'section_class'         => '',
                'section_title'         => '',
                'sub_title'             => '',
                'shortcode'             => ''
            ) );

            $args = wp_parse_args( $args, $default_args );

            jobhunt_get_template( 'home/job-list-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_testimonial_block' ) ) {
    /**
     *
     */
    function jobhunt_testimonial_block( $args = array() ) {

        if ( is_testimonials_activated() ) {

            $default_args = apply_filters( 'jobhunt_testimonial_block_default_args', array(
                'section_class'         => '',
                'section_title'         => '',
                'sub_title'             => '',
                'bg_choice'             => '',
                'bg_color'              => '',
                'type'                  => '',
                'columns'               => '',
                'query_args'            => array(
                    'limit'         => 8,
                    'orderby'       => 'title',
                    'order'         => 'ASC',
                    'size'          => '',
                ),
                'carousel_args'     => array(
                    'slidesToShow'      => 2,
                    'slidesToScroll'    => 2,
                    'dots'              => true,
                    'arrows'            => false,
                    'autoplay'          => false,
                )
            ) );

            $args = wp_parse_args( $args, $default_args );

            if( is_rtl() ) {
                $args['carousel_args']['rtl'] = true;
            }

            jobhunt_get_template( 'home/testimonial-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_recent_posts' ) ) {
    /**
     * Display Posts
     */
    function jobhunt_recent_posts( $args = array() ) {

        $defaults = apply_filters( 'jobhunt_recent_posts_args', array(
            'section_class'     => '',
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => '',
            'limit'             => 3,
            'columns'           => 3,
            'post_choice'       => 'recent',
            'post_ids'          => '',
            'category__in'      => '',
        ) );

        $args = wp_parse_args( $args, $defaults );

        $query_args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby'               => 'date',
            'order'                 => 'desc',
            'posts_per_page'        => 3,
        );

        extract( $args );

        if( ! empty( $limit ) ) {
            $query_args['posts_per_page'] = $limit;
        }

        if( ! empty( $post_choice ) ) {
            if( $post_choice == 'specific' && ! empty( $post_ids ) ) {
                $query_args['post__in'] = explode( ",", $post_ids );
            } elseif( $post_choice == 'category' ) {
                $query_args['category__in'] = explode( ",", $category__in );
            } elseif( $post_choice == 'random' ) {
                $query_args['orderby'] = 'rand';
            }
        }

        $args['query_args'] = apply_filters( 'jobhunt_recent_post_query_args', $query_args );

        jobhunt_get_template( 'home/recent-posts.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_how_it_works_block' ) ) {
    /**
     * Display How It Work
     */
    function jobhunt_how_it_works_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_how_it_works_block_args', array(
            'section_class'     => '',
            'type'              => '',
            'section_title'     => '',
            'sub_title'         => '',
            'steps'             => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/how-it-works-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_counters_block' ) ) {
    /**
     * Display Counter
     */
    function jobhunt_counters_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_counters_block_args', array(
            'section_class'     => '',
            'section_title'     => '',
            'sub_title'         => '',
            'type'              => '',
            'bg_choice'         => '',
            'bg_color'          => '',
            'counters'          => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/counters-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_job_pricing' ) ) {
    /**
     * Displays Job Pricing
     */
    function jobhunt_job_pricing( $args = array() ) {
        if ( jobhunt_is_woocommerce_activated() ) {

            $defaults = apply_filters( 'jobhunt_job_pricing_args', array(
                'section_title'     => '',
                'sub_title'         => '',
                'section_class'     => '',
                'shortcode_atts'    => array(
                    'shortcode'         => '',
                    'template'          => 'product-job-package',
                    'products_choice'   => '',
                    'products_ids_skus' => '',
                    'columns'           => '',
                    'limit'             => '',
                ),
            ) );

            $args = wp_parse_args( $args, $defaults );

            jobhunt_get_template( 'home/job-pricing-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_app_promo_block' ) ) {
    /**
     * Display App Promo
     */
    function jobhunt_app_promo_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_app_promo_block_args', array(
            'section_class'     => '',
            'type'              => '',
            'section_title'     => '',
            'sub_title'         => '',
            'bg_choice'         => '',
            'bg_color'          => '',
            'apps'              => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/app-promo-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_company_info_carousel' ) ) {
    /**
     *
     */
    function jobhunt_company_info_carousel( $args = array() ) {

        if ( jobhunt_is_wp_company_manager_activated() ) {

            $default_args = apply_filters( 'jobhunt_company_info_carousel_default_args', array(
                'section_class'         => '',
                'section_title'         => '',
                'sub_title'             => '',
                'bg_choice'             => '',
                'bg_color'              => '',
                'type'                  => '',
                'columns'               => '',
                'is_featured'           => '',
                'query_args'            => array(
                    'posts_per_page'        => 8,
                    'orderby'               => 'title',
                    'order'                 => 'ASC',
                    'size'                  => '',
                ),
                'carousel_args'     => array(
                    'slidesToShow'      => 4,
                    'slidesToScroll'    => 4,
                    'dots'              => true,
                    'arrows'            => false,
                    'autoplay'          => false,
                )
            ) );

            $args = wp_parse_args( $args, $default_args );

            if( is_rtl() ) {
                $args['carousel_args']['rtl'] = true;
            }

            jobhunt_get_template( 'home/company-info-carousel.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_candidate_info_block' ) ) {
    /**
     *
     */
    function jobhunt_candidate_info_block( $args = array() ) {

        if ( jobhunt_is_wp_resume_manager_activated() ) {

            $default_args = apply_filters( 'jobhunt_candidate_info_block_default_args', array(
                'section_class'         => '',
                'section_title'         => '',
                'sub_title'             => '',
                'bg_choice'             => '',
                'bg_color'              => '',
                'type'                  => '',
                'columns'               => '',
                'is_featured'           => '',
                'query_args'            => array(
                    'limit'         => 8,
                    'orderby'       => 'title',
                    'order'         => 'ASC',
                    'size'          => '',
                ),
                'carousel_args'     => array(
                    'slidesToShow'      => 4,
                    'slidesToScroll'    => 4,
                    'dots'              => true,
                    'arrows'            => false,
                    'autoplay'          => false,
                )
            ) );

            $args = wp_parse_args( $args, $default_args );

            if( is_rtl() ) {
                $args['carousel_args']['rtl'] = true;
            }

            jobhunt_get_template( 'home/candidate-info-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_job_list_tabs' ) ) {
    /**
     *
     */
    function jobhunt_job_list_tabs( $args = array() ) {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $default_args = apply_filters( 'jobhunt_job_list_tabs_default_args', array(
                'section_class'         => '',
                'tabs'                  => array(),
            ) );

            $args = wp_parse_args( $args, $default_args );

            jobhunt_get_template( 'home/job-list-tabs.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_dual_banner_block' ) ) {
    /**
     * Display Dual Banner Block
     */
    function jobhunt_dual_banner_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_dual_banner_block_args', array(
            'section_class'     => '',
            'type'              => '',
            'banners'           => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/dual-banner-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_banner_with_image_block' ) ) {
    /**
     * Display Banner With Image
     */
    function jobhunt_banner_with_image_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_banner_with_image_block_args', array(
            'section_class'     => '',
            'type'              => '',
            'title'             => '',
            'sub_title'         => '',
            'bg_choice'         => '',
            'bg_color'          => '',
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/banner-with-image-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_faq_block' ) ) {
    /**
     * Display Faq
     */
    function jobhunt_faq_block( $args = array() ) {
        $defaults = apply_filters( 'jobhunt_faq_block_args', array(
            'section_class' => '',
            'section_title' => esc_html__( 'Frequently Asked Questions', 'jobhunt' ),
            'bg_choice'     => 'color',
            'bg_color'      => '',
            'bg_image'      => array( '//placehold.it/2100x1100', '2100', '1100' ),
            'shortcode'     => '[mas_faq]'
        ) );

        $args = wp_parse_args( $args, $defaults );

        jobhunt_get_template( 'home/faq-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_faq_with_testimonial_block' ) ) {
    /**
     * Display Faq With Testimonial Block
     */
    function jobhunt_faq_with_testimonial_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_faq_with_testimonial_block_args', array(
            'animation'         => '',
            'section_class'     => '',
            'faq_args'          => array(),
            'ts_args'           => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );

        extract( $args );

        $section_class = empty( $section_class ) ? 'jh-section faq-with-testimonail-section' : 'jh-section faq-with-testimonail-section ' . $section_class;
        ?>

        <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php jobhunt_faq_block( $faq_args ); ?>
            <?php jobhunt_testimonial_block( $ts_args ); ?>
        </section>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_job_list_with_summary' ) ) {
    /**
     *
     */
    function jobhunt_job_list_with_summary( $args = array() ) {

        if ( jobhunt_is_wp_job_manager_activated() ) {

            $default_args = apply_filters( 'jobhunt_job_list_with_summary_default_args', array(
                'section_class'         => '',
                'jobs'                  => array(),
            ) );

            $args = wp_parse_args( $args, $default_args );

            extract( $args );

            jobhunt_get_template( 'home/job-list-with-summary-block.php', $args );
        }
    }
}

if ( ! function_exists( 'jobhunt_about_content' ) ) {
    /**
     * Display About Content
     */
    function jobhunt_about_content( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_about_content_args', array(
            'section_class'     => '',
            'section_title'     => esc_html__( 'About Job Hunt', 'jobhunt' ),
            'about_content'     => wp_kses_post( __( '<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much.</p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.</p>
                <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much. </p>
                <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy. </p>', 'jobhunt' ) ),
            'image'             => array( '//placehold.it/720x440', '720', '440' ),
            'action_link'       => '#',
            'action_text'       => esc_html__( 'Contact Us', 'jobhunt' )
        ) );

        $args = wp_parse_args( $args, $defaults );
        jobhunt_get_template( 'home/about-content-block.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_features_list_block' ) ) {
    /**
     * Display Features list
     */
    function jobhunt_features_list_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_features_list_block_args', array(
            'section_class' => '',
            'section_title' => esc_html__( 'Our Service', 'jobhunt' ),
            'features'      => array(),
        ) );

        $args = wp_parse_args( $args, $defaults );
        jobhunt_get_template( 'home/features-list.php', $args );
    }
}

if ( ! function_exists( 'jobhunt_home_search_block' ) ) {
    /**
     * Display Search block
     */
    function jobhunt_home_search_block( $args = array() ) {

        if ( jobhunt_is_wp_job_manager_activated() ) {
            $defaults =  apply_filters( 'jobhunt_home_search_block_args', array(
                'section_title'             => '',
                'sub_title'                 => '',
                'section_class'             => '',
                'search_type'               => '',
                'search_placeholder_text'   => esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
                'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
                'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
                'show_category_select'      => true,
                'search_button_icon'        => 'la la-search',
                'search_button_text'        => esc_html__( 'Search', 'jobhunt' ),
                'show_browse_button'        => false,
                'browse_button_label'       => esc_html__( 'Or browse job offers by', 'jobhunt' ),
                'browse_button_text'        => esc_html__( 'Category', 'jobhunt' ),
                'browse_button_link'        => '#'
            ) );

            $args = wp_parse_args( $args, $defaults );

            $section_class = empty( $args['section_class'] ) ? 'site-content-page-header' : 'site-content-page-header ' . $args['section_class'];

            ?><header class="<?php echo esc_attr( $section_class ); ?>" <?php echo jobhunt_site_content_bg_image(); ?>>

                <div class="site-content-page-header-inner">

                    <?php
                        do_action( 'jobhunt_home_page_header_before' );

                        if( function_exists( 'jobhunt_is_wp_resume_manager_activated' ) && jobhunt_is_wp_resume_manager_activated() && function_exists( 'jobhunt_resume_header_search_block' ) && $args['search_type'] == 'resume' ) {
                            jobhunt_resume_header_search_block( $args );
                        } else {
                            jobhunt_job_header_search_block( $args );
                        }

                        do_action( 'jobhunt_home_page_header_after' );
                    ?>

                </div>

            </header><?php
        }
    }
}

if ( ! function_exists( 'jobhunt_home_scroll_button' ) ) {
    /**
     * Display Scroll Button for Home Page
     */
    function jobhunt_home_scroll_button() {
        $section_id = 'jh-scroll-here';
        ?>
        <div class="jh-scroll-to">
            <a href="#<?php echo esc_attr( $section_id ); ?>" title="<?php echo esc_attr__( 'Scroll Button', 'jobhunt' ); ?>"><i class="la la-arrow-down"></i></a>
        </div>
        <?php
    }
}

require_once get_template_directory() . '/inc/template-functions/home-v1.php';
require_once get_template_directory() . '/inc/template-functions/home-v2.php';
require_once get_template_directory() . '/inc/template-functions/home-v3.php';
require_once get_template_directory() . '/inc/template-functions/home-v4.php';
require_once get_template_directory() . '/inc/template-functions/home-v5.php';
require_once get_template_directory() . '/inc/template-functions/about.php';
