<?php

if ( ! function_exists( 'jobhunt_modify_output_jobs_defaults' ) ) {
    function jobhunt_modify_output_jobs_defaults( $args ) {
        $args['view'] = 'default';
        return $args;
    }
}

function jh_wpjm_get_page_id( $page ) {

    $option_name = '';
    switch( $page ) {
        case 'jobs':
            $option_name = 'job_manager_jobs_page_id';
        break;
        case 'jobs-dashboard':
            $option_name = 'job_manager_job_dashboard_page_id';
        break;
        case 'post-a-job':
            $option_name = 'job_manager_submit_job_form_page_id';
        break;
    }

    $page_id = 0;

    if ( ! empty( $option_name ) ) {
        $page_id = get_option( $option_name );
    }

    $page_id = apply_filters( 'jobhunt_wpjm_get_' . $page . '_page_id', $page_id );
    return $page_id ? absint( $page_id ) : -1;
}

if ( ! function_exists( 'is_job_listing_taxonomy' ) ) {

    /**
     * Is_job_listing_taxonomy - Returns true when viewing a job_listing taxonomy archive.
     *
     * @return bool
     */
    function is_job_listing_taxonomy() {
        return is_tax( get_object_taxonomies( 'job_listing' ) );
    }
}

function jobhunt_add_showing_to_listings_result( $results, $jobs ) {

    $search_location    = isset( $_REQUEST['search_location'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_location'] ) ) : '';
    $search_keywords    = isset( $_REQUEST['search_keywords'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_keywords'] ) ) : '';

    $showing     = '';
    $showing_all = false;

    if ( $jobs->post_count ) {

        $showing_all = true;

        $start = (int) $jobs->get( 'offset' ) + 1;
        $end   = $start + (int)$jobs->post_count - 1;

        if ( $jobs->max_num_pages > 1 ) {
            $showing = sprintf( esc_html__( 'Showing %s - %s of %s jobs', 'jobhunt'), $start, $end, $jobs->found_posts );
        } else {
            $showing =  sprintf( _n( 'Showing one job', 'Showing all %s jobs', $jobs->found_posts, 'jobhunt' ), $jobs->found_posts );
        }


        if ( ! empty( $search_keywords ) ) {
            $showing = sprintf( wp_kses_post( '%s matching <span class="highlight">%s</span>', 'jobhunt' ), $showing, $search_keywords );
        }

        if ( ! empty( $search_location ) ) {
            $showing = sprintf( wp_kses_post( '%s in <span class="highlight">%s</span>', 'jobhunt' ), $showing, $search_location );
        }
    }
    $results['showing']     = $showing;
    $results['showing_all'] = $showing_all;
    return $results;
}

if ( ! function_exists( 'jobhunt_wpjm_page_title' ) ) {
    function jobhunt_wpjm_page_title( $title ) {

        if( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) ) {
            $style = jobhunt_get_wpjm_style();
            if ( $style == 'list-classic' ) :
                jobhunt_job_header_search_block();
                jobhunt_wpjm_get_all_active_filters_bar();
                $title = '';
            elseif ( $style == 'grid' ) :
                jobhunt_job_header_search_block();
                $title = '';
            else :
                $title = esc_html__( 'Jobs', 'jobhunt' );
            endif;
        } elseif ( is_singular( 'job_listing' ) ) {
            $style = jobhunt_get_wpjm_single_style();
            if ( $style == 'v2' && get_the_company_name() ) {
                $title = get_the_company_name();
            }else {
                $title = single_post_title( '', false );
            }
        } elseif ( is_wpjm_taxonomy() ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }
}

if ( ! function_exists( 'jobhunt_wpjm_page_subtitle' ) ) {
    function jobhunt_wpjm_page_subtitle( $subtitle ) {

        if( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) ) {
            $subtitle = '';
        } elseif ( is_singular( 'job_listing' ) ) {
            $style = jobhunt_get_wpjm_single_style();
            if ( $style == 'v1' ) :
                if ( jobhunt_is_wp_job_manager_bookmark_activated() ) {
                    global $job_manager_bookmarks;
                    remove_action( 'single_job_listing_meta_after', array( $job_manager_bookmarks, 'bookmark_form' ) );
                }
                ob_start();
                job_listing_meta_display();
                $subtitle = ob_get_clean();
            else :
                $subtitle = '';
            endif;
        }

        return $subtitle;
    }
}

if ( ! function_exists( 'jobhunt_wpjm_wc_account_dashboard' ) ) {
    function jobhunt_wpjm_wc_account_dashboard() {
        echo '<p>';
            $company_dashboard_page_id = get_option( 'job_manager_company_dashboard_page_id' );
            $job_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
            $candidate_dashboard_page_id = get_option( 'resume_manager_candidate_dashboard_page_id' );

            $is_applications_manager_active = function_exists( 'jobhunt_is_wp_job_manager_applications_activated' ) && jobhunt_is_wp_job_manager_applications_activated();

            if( $is_applications_manager_active ) {
                $job_dashboard_text = esc_html__( 'To check your Job Listings and Applications visit %1$sJob Dashboard%2$s.', 'jobhunt' );
            } else {
                $job_dashboard_text = esc_html__( 'To check your Job Listings visit %1$sJob Dashboard%2$s.', 'jobhunt' );
            }

            $company_dashboard_text = esc_html__( 'To check your Company Listings visit %1$sCompany Dashboard%2$s.', 'jobhunt' );
            $candidate_dashboard_text = esc_html__( 'To check your Resumes visit %1$sCandidate Dashboard%2$s.', 'jobhunt' );

            $user = wp_get_current_user();

            if ( in_array( 'employer', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) {
                if( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() ) {
                    echo sprintf(
                        $company_dashboard_text,
                        '<a href="' . esc_url( get_permalink($company_dashboard_page_id)) . '">',
                        '</a>'
                    );
                    echo '<br/>';
                }
                echo sprintf(
                    $job_dashboard_text,
                    '<a href="' . esc_url( get_permalink($job_dashboard_page_id)) . '">',
                    '</a>'
                );
                echo '<br/>';
            }
            if ( in_array( 'candidate', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) {
                echo sprintf(
                    $candidate_dashboard_text,
                    '<a href="' . esc_url( get_permalink($candidate_dashboard_page_id)) . '">',
                    '</a>'
                );
            }
        echo '</p>';
    }
}

add_action( 'woocommerce_account_dashboard', 'jobhunt_wpjm_wc_account_dashboard' );

if ( ! function_exists( 'jobhunt_modify_single_job_listing_hooks' ) ) {
    function jobhunt_modify_single_job_listing_hooks() {
        $style = jobhunt_get_wpjm_single_style();

        do_action( 'jobhunt_modify_single_job_listing_hooks_before', $style );
        
        remove_action( 'single_job_listing_start', 'job_listing_meta_display', 20 );

        if ( $style == 'v2' ) {
            remove_action( 'single_job_listing_start', 'job_listing_company_display', 30 );
            remove_action( 'single_job_listing', 'jobhunt_single_job_listing_related_jobs', 40 );
            remove_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_application', 10 );
            remove_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_overview', 20 );
            remove_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_location_map', 30 );

            add_action( 'single_job_listing', 'jobhunt_job_listing_info_display', 5 );
            add_action( 'single_job_listing', 'jobhunt_single_job_listing_overview', 20 );
            add_action( 'single_job_listing_sidebar', 'job_listing_company_display', 10 );
            add_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_application', 20 );
        }

        if ( $style == 'v3' ) {
            remove_action( 'single_job_listing_start', 'job_listing_company_display', 30 );
            remove_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_application', 10 );
            remove_action( 'single_job_listing_sidebar', 'jobhunt_single_job_listing_location_map', 30 );
            add_action( 'single_job_listing_inner_before', 'job_listing_company_display', 30 );
        }

        do_action( 'jobhunt_modify_single_job_listing_hooks_after', $style );
    }
}

if ( ! function_exists( 'jobhunt_job_header_search_block' ) ) {
    /**
     * Display Job Header Search block
     */
    function jobhunt_job_header_search_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_job_header_search_block_args', array(
            'section_title'             => esc_html__( 'Explore Thousand Of Jobs With Just Simple Search...', 'jobhunt' ),
            'sub_title'                 => '',
            'search_placeholder_text'   => esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'show_category_select'      => false,
            'search_button_icon'        => 'la la-search',
            'search_button_text'        => esc_html__( 'Search', 'jobhunt' ),
            'show_browse_button'        => false,
            'browse_button_label'       => esc_html__( 'Or browse job offers by', 'jobhunt' ),
            'browse_button_text'        => esc_html__( 'Category', 'jobhunt' ),
            'browse_button_link'        => '#'
        ) );

        $args = wp_parse_args( $args, $defaults );

        extract( $args );

        $jobs_page_id = jh_wpjm_get_page_id( 'jobs' );
        $jobs_page_url = get_permalink( $jobs_page_id );

        ?><div class="job-search-block">

            <?php do_action( 'jobhunt_job_header_search_block_before' ); ?>

            <?php if ( ! empty( $section_title ) || ! empty( $sub_title ) ) : ?>
            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="job-search-form">
                <form method="GET" action="<?php echo esc_url( $jobs_page_url ); ?>">
                    <div class="job-search-keywords">
                        <label class="sr-only" for="search_keywords"><?php echo esc_html__( 'Keywords', 'jobhunt' ); ?></label>
                        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php echo esc_attr( $search_placeholder_text ); ?>"/>
                    </div>
                    <?php if ( jobhunt_is_astoundify_job_manager_regions_activated() && get_option( 'job_manager_regions_filter' ) ) : ?>
                        <div class="job-search-location region-location">
                            <label class="sr-only" for="filter_job_listing_region"><?php echo esc_html__( 'Region', 'jobhunt' ); ?></label>
                            <?php wp_dropdown_categories( array('taxonomy' => 'job_listing_region', 'show_option_all' => ' Select Region','hierarchical' => 1, 'name' => 'filter_job_listing_region','id' => 'search_category','class' => 'jobhunt-job-region-select','value_field' => 'name','orderby' => 'name' ) ); ?>
                        </div>
                    <?php else : ?>
                        <div class="job-search-location">
                            <label class="sr-only" for="search_location"><?php echo esc_html__( 'Location', 'jobhunt' ); ?></label>
                            <input type="text" id="search_location" name="search_location" placeholder="<?php echo esc_attr( $location_placeholder_text ); ?>"/>
                        </div>
                    <?php endif; ?>
                    <?php if ( $show_category_select ) : ?>
                    <div class="job-search-category">
                        <label class="sr-only" for="search_category"><?php echo esc_html__( 'Category', 'jobhunt' ); ?></label>
                        <select id="search_category" name="search_category">
                            <option value=""><?php echo esc_html( $category_select_text ); ?></option>
                            <?php foreach ( get_job_listing_categories() as $cat ) : ?>
                            <option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="job-search-submit">
                        <button type="submit" value="<?php echo esc_attr( $search_button_text ); ?>"><i class="<?php echo esc_attr( $search_button_icon ); ?>"></i><span class="job-search-text"><?php echo esc_html( $search_button_text ); ?></span></button>
                    </div>
                    <input type="hidden" name="post_type" value="job_listing"/>
                </form>
                <?php if ( $show_browse_button ) : ?>
                    <div class="browse-jobs-by-category">
                        <span><?php echo esc_html( $browse_button_label ); ?></span>
                        <a href="<?php echo esc_url( $browse_button_link ); ?>" title="<?php echo esc_attr( $browse_button_text ); ?>"><?php echo esc_html( $browse_button_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php do_action( 'jobhunt_job_header_search_block_after' ); ?>

        </div><?php
    }
}

/**
 * Sets up the jh_wpjm_loop global from the passed args or from the main query.
 *
 * @param array $args Args to pass into the global.
 */
function jh_wpjm_setup_loop( $args = array() ) {
    $default_args = array(
        'loop'         => 0,
        'columns'      => 1,
        'name'         => '',
        'is_shortcode' => false,
        'is_paginated' => true,
        'is_search'    => false,
        'is_filtered'  => false,
        'total'        => 0,
        'total_pages'  => 0,
        'per_page'     => 0,
        'current_page' => 1,
    );

    // If this is a main WC query, use global args as defaults.
    if ( $GLOBALS['wp_query']->get( 'jh_wpjm_query' ) ) {
        $default_args = array_merge( $default_args, array(
            'is_search'    => $GLOBALS['wp_query']->is_search(),
            'total'        => $GLOBALS['wp_query']->found_posts,
            'total_pages'  => $GLOBALS['wp_query']->max_num_pages,
            'per_page'     => $GLOBALS['wp_query']->get( 'posts_per_page' ),
            'current_page' => max( 1, $GLOBALS['wp_query']->get( 'paged', 1 ) ),
        ) );
    }

    // Merge any existing values.
    if ( isset( $GLOBALS['jh_wpjm_loop'] ) ) {
        $default_args = array_merge( $default_args, $GLOBALS['jh_wpjm_loop'] );
    }

    $GLOBALS['jh_wpjm_loop'] = wp_parse_args( $args, $default_args );
}

/**
 * Resets the jh_wpjm_loop global.
 *
 */
function jh_wpjm_reset_loop() {
    unset( $GLOBALS['jh_wpjm_loop'] );
}

/**
 * Gets a property from the jh_wpjm_loop global.
 *
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
function jh_wpjm_get_loop_prop( $prop, $default = '' ) {
    jh_wpjm_setup_loop(); // Ensure shop loop is setup.

    return isset( $GLOBALS['jh_wpjm_loop'], $GLOBALS['jh_wpjm_loop'][ $prop ] ) ? $GLOBALS['jh_wpjm_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the jh_wpjm_loop global.
 *
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function jh_wpjm_set_loop_prop( $prop, $value = '' ) {
    if ( ! isset( $GLOBALS['jh_wpjm_loop'] ) ) {
        jh_wpjm_setup_loop();
    }
    $GLOBALS['jh_wpjm_loop'][ $prop ] = $value;
}

function jh_wpjm_get_all_taxonomies() {
    $taxonomies = array();

    $taxonomy_objects = get_object_taxonomies( 'job_listing', 'objects' );
    foreach ( $taxonomy_objects as $taxonomy_object ) {
        $taxonomies[] = array(
            'taxonomy'  => $taxonomy_object->name,
            'name'      => $taxonomy_object->label,
        );
    }

    return $taxonomies;
}

function jh_wpjm_get_all_date_filters() {
    return apply_filters( 'jh_wpjm_get_all_date_filters' , array(
        '1-hour'    => esc_html__( 'Last Hour', 'jobhunt' ),
        '24-hours'  => esc_html__( 'Last 24 Hours', 'jobhunt' ),
        '7-days'    => esc_html__( 'Last 7 Days', 'jobhunt' ),
        '14-days'   => esc_html__( 'Last 14 Days', 'jobhunt' ),
        '30-days'   => esc_html__( 'Last 30 Days', 'jobhunt' ),
        'all'       => esc_html__( 'All', 'jobhunt' ),
    ) );
}

class JH_WPJM_Query {

    /**
     * Reference to the main job query on the page.
     *
     * @var array
     */
    private static $jh_wpjm_query;

    /**
     * Stores chosen taxonomies.
     *
     * @var array
     */
    private static $_chosen_taxonomies;

    public function __construct() {
        if ( ! is_admin() ) {
            add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
        }
    }

    /**
     * Are we currently on the front page?
     *
     * @param WP_Query $q Query instance.
     * @return bool
     */
    private function is_showing_page_on_front( $q ) {
        return $q->is_home() && 'page' === get_option( 'show_on_front' );
    }

    /**
     * Is the front page a page we define?
     *
     * @param int $page_id Page ID.
     * @return bool
     */
    private function page_on_front_is( $page_id ) {
        return absint( get_option( 'page_on_front' ) ) === absint( $page_id );
    }

    public function pre_get_posts( $q ) {
        if ( ! $q->is_main_query() ){
            return;
        }

        // When orderby is set, WordPress shows posts on the front-page. Get around that here.
        if ( $this->is_showing_page_on_front( $q ) && $this->page_on_front_is( jh_wpjm_get_page_id( 'jobs' ) ) ) {
            $_query = wp_parse_args( $q->query );
            if ( empty( $_query ) || ! array_diff( array_keys( $_query ), array( 'preview', 'page', 'paged', 'cpage', 'orderby' ) ) ) {
                $q->set( 'page_id', (int) get_option( 'page_on_front' ) );
                $q->is_page = true;
                $q->is_home = false;

                // WP supporting themes show post type archive.
                $q->set( 'post_type', 'job_listing' );
            }
        }

        // Special check for jobs with the PRODUCT POST TYPE ARCHIVE on front.
        if ( $q->is_page() && 'page' === get_option( 'show_on_front' ) && absint( $q->get( 'page_id' ) ) === jh_wpjm_get_page_id( 'jobs' ) ) {
            // This is a front-page jobs.
            $q->set( 'post_type', 'job_listing' );
            $q->set( 'page_id', '' );

            if ( isset( $q->query['paged'] ) ) {
                $q->set( 'paged', $q->query['paged'] );
            }

            // Define a variable so we know this is the front page jobs later on.
            if( ! defined( 'JOBS_IS_ON_FRONT' ) ) {
                define( 'JOBS_IS_ON_FRONT', true );
            }

            // Get the actual WP page to avoid errors and let us use is_front_page().
            // This is hacky but works. Awaiting https://core.trac.wordpress.org/ticket/21096.
            global $wp_post_types;

            $jobs_page = get_post( jh_wpjm_get_page_id( 'jobs' ) );

            $wp_post_types['job_listing']->ID         = $jobs_page->ID;
            $wp_post_types['job_listing']->post_title = $jobs_page->post_title;
            $wp_post_types['job_listing']->post_name  = $jobs_page->post_name;
            $wp_post_types['job_listing']->post_type  = $jobs_page->post_type;
            $wp_post_types['job_listing']->ancestors  = get_ancestors( $jobs_page->ID, $jobs_page->post_type );

            // Fix conditional Functions like is_front_page.
            $q->is_singular          = false;
            $q->is_post_type_archive = true;
            $q->is_archive           = true;
            $q->is_page              = true;

            // Remove post type archive name from front page title tag.
            add_filter( 'post_type_archive_title', '__return_empty_string', 5 );
        } elseif ( ! $q->is_post_type_archive( 'job_listing' ) && ! $q->is_tax( get_object_taxonomies( 'job_listing' ) ) ) {
            // Only apply to job_listing categories, the job_listing post archive, the jobs page, and job_listing taxonomies.
            return;
        }

        if ( ! is_feed() ) {
            $ordering = $this->get_catalog_ordering_args();
            $q->set( 'orderby', $ordering['orderby'] );
            $q->set( 'order', $ordering['order'] );

            if ( isset( $ordering['meta_key'] ) ) {
                $q->set( 'meta_key', $ordering['meta_key'] );
            }
        }

        // Query vars that affect posts shown.
        $this->get_search_query( $q );
        $q->set( 'meta_query', $this->get_meta_query( $q->get( 'meta_query' ), true ) );
        $q->set( 'tax_query', $this->get_tax_query( $q->get( 'tax_query' ), true ) );
        $q->set( 'date_query', $this->get_date_query( $q->get( 'date_query' ), true ) );
        $q->set( 'jh_wpjm_query', 'job_listing_query' );
        $q->set( 'posts_per_page', $this->get_posts_per_page( $q->get( 'posts_per_page' ), true ) );

        // Hide Expired jobs
        if ( 0 === intval( get_option( 'job_manager_hide_expired', get_option( 'job_manager_hide_expired_content', 1 ) ) ) ) {
            $post_status = array( 'publish', 'expired' );
        } else {
            $post_status = array( 'publish' );
        }

        $q->set( 'post_status', $post_status );

        // Store reference to this query.
        self::$jh_wpjm_query = $q;
    }

    /**
     * Appends meta queries to an array.
     *
     * @param  array $meta_query Meta query.
     * @param  bool  $main_query If is main query.
     * @return array
     */
    public function get_search_query( $q ) {
        if ( ! empty( $_GET['search_keywords'] ) ) {
            global $job_manager_keyword;
            $job_manager_keyword = sanitize_text_field( $_GET['search_keywords'] );

            if ( ! empty( $job_manager_keyword ) && strlen( $job_manager_keyword ) >= apply_filters( 'job_manager_get_listings_keyword_length_threshold', 2 ) ) {
                $q->set( 's' , $job_manager_keyword );
                add_filter( 'posts_search', 'get_job_listings_keyword_search' );
            }
        } elseif ( ! empty( $_GET['s'] ) ) {
            global $job_manager_keyword;
            $job_manager_keyword = sanitize_text_field( $_GET['s'] );

            if ( ! empty( $job_manager_keyword ) && strlen( $job_manager_keyword ) >= apply_filters( 'job_manager_get_listings_keyword_length_threshold', 2 ) ) {
                add_filter( 'posts_search', 'get_job_listings_keyword_search' );
            }
        }
    }

    /**
     * Appends meta queries to an array.
     *
     * @param  array $meta_query Meta query.
     * @param  bool  $main_query If is main query.
     * @return array
     */
    public function get_meta_query( $meta_query = array(), $main_query = false ) {
        if ( ! is_array( $meta_query ) ) {
            $meta_query = array();
        }
        $meta_query['search_location_filter'] = $this->search_location_filter_meta_query();

        if ( 1 === absint( get_option( 'job_manager_hide_filled_positions' ) ) ) {
            $meta_query[] = array(
                'key'     => '_filled',
                'value'   => '1',
                'compare' => '!=',
            );
        }

        return array_filter( apply_filters( 'jh_job_listing_query_meta_query', $meta_query, $this ) );
    }

    /**
     * Appends tax queries to an array.
     *
     * @param  array $tax_query  Tax query.
     * @param  bool  $main_query If is main query.
     * @return array
     */
    public function get_tax_query( $tax_query = array(), $main_query = false ) {
        if ( ! is_array( $tax_query ) ) {
            $tax_query = array(
                'relation' => 'AND',
            );
        }

        // Layered nav filters on terms.
        if ( $main_query ) {
            foreach ( $this->get_layered_nav_chosen_taxonomies() as $taxonomy => $data ) {
                $tax_query[] = array(
                    'taxonomy'         => $taxonomy,
                    'field'            => 'slug',
                    'terms'            => $data['terms'],
                    'operator'         => 'and' === $data['query_type'] ? 'AND' : 'IN',
                    'include_children' => false,
                );
            }
        }

        // Filter by category.
        if ( ! empty( $_GET['search_category'] ) ) {
            $categories = is_array( $_GET['search_category'] ) ? $_GET['search_category'] : array_filter( array_map( 'trim', explode( ',', $_GET['search_category'] ) ) );
            $field      = is_numeric( $categories[0] ) ? 'term_id' : 'slug';
            $operator   = 'all' === get_option( 'job_manager_category_filter_type', 'all' ) && sizeof( $categories ) > 1 ? 'AND' : 'IN';
            $tax_query[] = array(
                'taxonomy'         => 'job_listing_category',
                'field'            => $field,
                'terms'            => array_values( $categories ),
                'include_children' => $operator !== 'AND' ,
                'operator'         => $operator
            );
        }

        return array_filter( apply_filters( 'jh_job_listing_query_tax_query', $tax_query, $this ) );
    }

    /**
     * Appends date queries to an array.
     *
     * @param  array $date_query Date query.
     * @param  bool  $main_query If is main query.
     * @return array
     */
    public function get_date_query( $date_query = array(), $main_query = false ) {
        if ( ! is_array( $date_query ) ) {
            $date_query = array();
        }

        if ( ! empty( $_GET['posted_before'] ) ) {
            $posted_before  = jobhunt_clean( wp_unslash( $_GET['posted_before'] ) );
            $posted_arr     = explode( '-', $posted_before );
            $date_query[] = array(
                'after' => implode( ' ', $posted_arr ) . ' ago'
            );
        }

        return array_filter( apply_filters( 'jh_job_listing_query_date_query', $date_query, $this ) );
    }

    /**
     * Return posts_per_page value.
     *
     * @param  int   $per_page posts_per_page value.
     * @param  bool  $main_query If is main query.
     * @return int
     */
    public function get_posts_per_page( $per_page = 10, $main_query = false ) {
        if( $main_query ) {
            $per_page = get_option( 'job_manager_per_page' );
        }

        return intval( apply_filters( 'jh_job_listing_query_posts_per_page', $per_page ) );
    }

    /**
     * Return a meta query for filtering by location.
     *
     * @return array
     */
    private function search_location_filter_meta_query() {
        if ( ! empty( $_GET['search_location'] ) ) {
            $location_meta_keys = array( 'geolocation_formatted_address', '_job_location', 'geolocation_state_long' );
            $location_search    = array( 'relation' => 'OR' );
            foreach ( $location_meta_keys as $meta_key ) {
                $location_search[] = array(
                    'key'     => $meta_key,
                    'value'   => $_GET['search_location'],
                    'compare' => 'like'
                );
            }

            return $location_search;
        }

        return array();
    }

    /**
     * Returns an array of arguments for ordering jobs based on the selected values.
     *
     * @param string $orderby Order by param.
     * @param string $order Order param.
     * @return array
     */
    public function get_catalog_ordering_args( $orderby = '', $order = '' ) {
        // Get ordering from query string unless defined.
        if ( ! $orderby ) {
            $orderby_value = isset( $_GET['orderby'] ) ? jobhunt_clean( (string) wp_unslash( $_GET['orderby'] ) ) : jobhunt_clean( get_query_var( 'orderby' ) ); // WPCS: sanitization ok, input var ok, CSRF ok.

            if ( ! $orderby_value ) {
                if ( is_search() ) {
                    $orderby_value = 'relevance';
                } else {
                    $orderby_value = apply_filters( 'jh_job_listing_default_catalog_orderby', 'date' );
                }
            }

            // Get order + orderby args from string.
            $orderby_value = explode( '-', $orderby_value );
            $orderby       = esc_attr( $orderby_value[0] );
            $order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
        }

        $orderby = strtolower( $orderby );
        $order   = strtoupper( $order );
        $args    = array(
            'orderby'  => $orderby,
            'order'    => ( 'DESC' === $order ) ? 'DESC' : 'ASC',
            'meta_key' => '', // @codingStandardsIgnoreLine
        );

        switch ( $orderby ) {
            case 'menu_order':
                $args['orderby'] = 'menu_order title';
                break;
            case 'title':
                $args['orderby'] = 'title';
                $args['order']   = ( 'DESC' === $order ) ? 'DESC' : 'ASC';
                break;
            case 'relevance':
                $args['orderby'] = 'relevance';
                $args['order']   = 'DESC';
                break;
            case 'rand':
                $args['orderby'] = 'rand'; // @codingStandardsIgnoreLine
                break;
            case 'date':
                $args['orderby'] = 'date ID';
                $args['order']   = ( 'ASC' === $order ) ? 'ASC' : 'DESC';
                break;
            case 'featured':
                $args['orderby'] = 'meta_value date ID';
                $args['meta_key'] = '_featured';
                $args['order']   = ( 'ASC' === $order ) ? 'ASC' : 'DESC';
                break;
        }

        return apply_filters( 'jh_job_listing_get_catalog_ordering_args', $args );
    }

    /**
     * Get the main query which job queries ran against.
     *
     * @return array
     */
    public static function get_main_query() {
        return self::$jh_wpjm_query;
    }

    /**
     * Get the tax query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_tax_query() {
        $tax_query = isset( self::$jh_wpjm_query->tax_query, self::$jh_wpjm_query->tax_query->queries ) ? self::$jh_wpjm_query->tax_query->queries : array();

        return $tax_query;
    }

    /**
     * Get the meta query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_meta_query() {
        $args       = isset( self::$jh_wpjm_query->query_vars ) ? self::$jh_wpjm_query->query_vars : array();
        $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

        return $meta_query;
    }

    /**
     * Get the date query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_date_query() {
        $date_query = isset( self::$jh_wpjm_query->date_query, self::$jh_wpjm_query->date_query->queries ) ? self::$jh_wpjm_query->date_query->queries : array();

        return $date_query;
    }

    /**
     * Based on WP_Query::parse_search
     */
    public static function get_main_search_query_sql() {
        global $wpdb;

        $args       = isset( self::$jh_wpjm_query->query_vars ) ? self::$jh_wpjm_query->query_vars : array();
        $search_terms = isset( $args['search_terms'] ) ? $args['search_terms'] : array();
        $sql          = array();

        foreach ( $search_terms as $term ) {
            // Terms prefixed with '-' should be excluded.
            $include = '-' !== substr( $term, 0, 1 );

            if ( $include ) {
                $like_op  = 'LIKE';
                $andor_op = 'OR';
            } else {
                $like_op  = 'NOT LIKE';
                $andor_op = 'AND';
                $term     = substr( $term, 1 );
            }

            $like  = '%' . $wpdb->esc_like( $term ) . '%';
            $sql[] = $wpdb->prepare( "(($wpdb->posts.post_title $like_op %s) $andor_op ($wpdb->posts.post_excerpt $like_op %s) $andor_op ($wpdb->posts.post_content $like_op %s))", $like, $like, $like ); // unprepared SQL ok.
        }

        if ( ! empty( $sql ) && ! is_user_logged_in() ) {
            $sql[] = "($wpdb->posts.post_password = '')";
        }

        return implode( ' AND ', $sql );
    }

    /**
     * Get an array of taxonomies and terms selected with the layered nav widget.
     *
     * @return array
     */
    public static function get_layered_nav_chosen_taxonomies() {
        if ( ! is_array( self::$_chosen_taxonomies ) ) {
            self::$_chosen_taxonomies = array();
            $taxonomies     = jh_wpjm_get_all_taxonomies();

            if ( ! empty( $taxonomies ) ) {
                foreach ( $taxonomies as $tax ) {
                    $taxonomy = $tax['taxonomy'];
                    $filter_terms = ! empty( $_GET[ 'filter_' . $taxonomy ] ) ? explode( ',', jobhunt_clean( wp_unslash( $_GET[ 'filter_' . $taxonomy ] ) ) ) : array(); // WPCS: sanitization ok, input var ok, CSRF ok.

                    if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) ) {
                        continue;
                    }

                    $query_type                                     = ! empty( $_GET[ 'query_type_' . $taxonomy ] ) && in_array( $_GET[ 'query_type_' . $taxonomy ], array( 'and', 'or' ), true ) ? jobhunt_clean( wp_unslash( $_GET[ 'query_type_' . $taxonomy ] ) ) : ''; // WPCS: sanitization ok, input var ok, CSRF ok.
                    self::$_chosen_taxonomies[ $taxonomy ]['terms'] = array_map( 'sanitize_title', $filter_terms ); // Ensures correct encoding.
                    self::$_chosen_taxonomies[ $taxonomy ]['query_type'] = $query_type ? $query_type : apply_filters( 'jobhunt_wpjm_layered_nav_default_query_type', 'and' );
                }
            }
        }
        return self::$_chosen_taxonomies;
    }
}

$jh_wpjm_query = new JH_WPJM_Query();

if ( ! function_exists( 'jobhunt_wpjm_get_all_active_filters_bar' ) ) {
    function jobhunt_wpjm_get_all_active_filters_bar() {
        if ( ! ( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) ) && ! is_job_listing_taxonomy() ) {
            return;
        }

        $_chosen_taxonomies = JH_WPJM_Query::get_layered_nav_chosen_taxonomies();
        $search_query       = isset( $_GET['s'] ) ? jobhunt_clean( wp_unslash( $_GET['s'] ) ) : ''; // WPCS: input var ok, CSRF ok.
        $search_location    = isset( $_GET['search_location'] ) ? jobhunt_clean( wp_unslash( $_GET['search_location'] ) ) : ''; // WPCS: input var ok, CSRF ok.
        $posted_before      = isset( $_GET['posted_before'] ) ? jobhunt_clean( wp_unslash( $_GET['posted_before'] ) ) : ''; // WPCS: input var ok, CSRF ok.
        $base_link          = Jobhunt_WPJM::get_current_page_url();
        $all_filter_args    = array();

        if ( 0 < count( $_chosen_taxonomies ) || ! empty( $posted_before ) || ! empty( $search_query ) || ! empty( $search_location ) ) {
            echo '<div class="jobhunt-wpjm-active-filters">';

            echo '<ul>';

            // Attributes.
            if ( ! empty( $_chosen_taxonomies ) ) {
                foreach ( $_chosen_taxonomies as $taxonomy => $data ) {
                    foreach ( $data['terms'] as $term_slug ) {
                        $term = get_term_by( 'slug', $term_slug, $taxonomy );
                        if ( ! $term ) {
                            continue;
                        }

                        $filter_name    = 'filter_' . sanitize_title( $taxonomy );
                        $current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', jobhunt_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array(); // WPCS: input var ok, CSRF ok.
                        $current_filter = array_map( 'sanitize_title', $current_filter );
                        $new_filter     = array_diff( $current_filter, array( $term_slug ) );

                        $all_filter_args[] = $filter_name;
                        $link = remove_query_arg( array( $filter_name ), $base_link );

                        if ( count( $new_filter ) > 0 ) {
                            $link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
                        }

                        echo '<li class="chosen"><span>' . esc_html( $term->name ) . '</span><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'jobhunt' ) . '" href="' . esc_url( $link ) . '"><i class="la la-close"></i></a></li>';
                    }
                }
            }

            if ( $search_query ) {
                $all_filter_args[] = 's';
                $link = remove_query_arg( 's', $base_link );
                echo '<li class="chosen"><span>' . esc_html( $search_query ) . '</span><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'jobhunt' ) . '" href="' . esc_url( $link ) . '"><i class="la la-close"></i></a></li>'; // WPCS: XSS ok.
            }

            if ( $search_location ) {
                $all_filter_args[] = 'search_location';
                $link = remove_query_arg( 'search_location', $base_link );
                echo '<li class="chosen"><span>' . esc_html( $search_location ) . '</span><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'jobhunt' ) . '" href="' . esc_url( $link ) . '"><i class="la la-close"></i></a></li>'; // WPCS: XSS ok.
            }

            if ( $posted_before ) {
                $all_filter_args[] = 'posted_before';
                $link = remove_query_arg( 'posted_before', $base_link );
                $all_date_filters = jh_wpjm_get_all_date_filters();
                $posted_before_name = array_key_exists( $posted_before, $all_date_filters ) ? $all_date_filters[$posted_before] : $posted_before;
                echo '<li class="chosen"><span>' . esc_html( $posted_before_name ) . '</span><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'jobhunt' ) . '" href="' . esc_url( $link ) . '"><i class="la la-close"></i></a></li>'; // WPCS: XSS ok.
            }

            echo '</ul>';

            $link = remove_query_arg( $all_filter_args, $base_link );
            echo '<div class="clear-all"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'jobhunt' ) . '" href="' . esc_url( $link ) . '">' . esc_html__( 'Clean', 'jobhunt' ) . '</a></div>'; // WPCS: XSS ok.

            echo '</div>';
        }
    }
}

if ( ! function_exists( 'jobhunt_wpjm_job_per_page_dropdown_posts_per_page' ) ) {
    function jobhunt_wpjm_job_per_page_dropdown_posts_per_page( $per_page ) {
        if ( isset( $_REQUEST['jpp'] ) ) :
            $per_page = intval( $_REQUEST['jpp'] );
            setcookie( 'jobs_per_page', intval( $_REQUEST['jpp'] ), time() + 86400, "/");
        elseif ( isset( $_COOKIE[ 'jobs_per_page' ] ) ) :
            $per_page = intval( $_COOKIE[ 'jobs_per_page' ] );
        endif;

        return $per_page;
    }
}

add_filter( 'jh_job_listing_query_posts_per_page', 'jobhunt_wpjm_job_per_page_dropdown_posts_per_page' );

if ( ! function_exists( 'jobhunt_modify_register_post_type_job_listing' ) ) {
    function jobhunt_modify_register_post_type_job_listing( $args ) {
        $args['show_in_rest'] = true;

        $jobs_page_id = jh_wpjm_get_page_id( 'jobs' );
        if(  $jobs_page_id && get_post( $jobs_page_id ) ) {
            $permalinks = WP_Job_Manager_Post_Types::get_permalink_structure();
            $args['has_archive'] = urldecode( get_page_uri( $jobs_page_id ) );
            $args['rewrite'] = $permalinks['job_rewrite_slug'] ? array(
                'slug'       => $permalinks['job_rewrite_slug'],
                'with_front' => false,
                'feeds'      => true,
            ) : false;
        }

        return $args;
    }
}

add_filter( 'register_post_type_job_listing', 'jobhunt_modify_register_post_type_job_listing' );

if ( ! function_exists( 'jobhunt_the_job_publish_date' ) ) {
    function jobhunt_the_job_publish_date( $post = null ) {
        $date_format = get_option( 'job_manager_date_format' );

        if ( 'default' === $date_format ) {
            $display_date = esc_html__( 'Posted on ', 'jobhunt' ) . date_i18n( get_option( 'date_format' ), get_post_time( 'U' ) );
        } else {
            // translators: Placeholder %s is the relative, human readable time since the job listing was posted.
            $display_date = sprintf( esc_html__( '%s ago', 'jobhunt' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) );
        }

        echo '<time datetime="' . esc_attr( get_post_time( 'Y-m-d' ) ) . '">' . wp_kses_post( $display_date ) . '</time>';
    }
}

if ( ! function_exists( 'get_the_company_aplication_email' ) ) {
    function get_the_company_aplication_email( $post = null ) {
        $post = get_post( $post );
        $email  = $post->_application;

        if ( ! $post || 'job_listing' !== $post->post_type ) {
            return;
        }

        if ( empty( $email ) ) {
            return apply_filters( 'the_job_application_email_method', false, $post );
        }else {
            return apply_filters( 'the_job_application_email', $email, $post );
        }
    }
}

if ( ! function_exists( 'jobhunt_get_wpjm_style' ) ) {
    function jobhunt_get_wpjm_style() {
        $style = get_option( 'job_manager_jobs_listing_style' );
        return apply_filters( 'jobhunt_get_wpjm_jobs_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjm_sidebar_style' ) ) {
    function jobhunt_get_wpjm_sidebar_style() {
        $layout = get_option( 'job_manager_jobs_listing_sidebar' );
        return apply_filters( 'jobhunt_get_wpjm_jobs_layout', $layout );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjm_single_style' ) ) {
    function jobhunt_get_wpjm_single_style() {
        $style = get_option( 'job_manager_single_job_style' );
        return apply_filters( 'jobhunt_get_wpjm_job_single_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjm_taxomony_data' ) ) {
    function jobhunt_get_wpjm_taxomony_data( $post = null, $taxonomy = 'job_listing_category', $linkable = true ) {
        if ( taxonomy_exists( $taxonomy ) ) {
            if ( ( $values = get_the_terms( $post, $taxonomy ) ) ) :
                $output = array();

                if ( is_wp_error( $values ) ) {
                    return '';
                }

                if ( ( $name = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'names' ) ) ) && is_array( $name ) ) {
                    if ( $linkable == true) {
                        foreach ( $values as $value ){
                            $output[] = '<a href="' . esc_url( get_term_link( $value ) ) . '">' . esc_html( $value->name ) . '</a>';
                        }
                    } else {
                        foreach ( $values as $value ){
                            $output[] = '<span>' . esc_html( $value->name ) . '</span>';
                        }
                    }

                    return '<ul><li>' . implode( '</li><li>', $output ) . '</li></ul>';
                } else {
                    return ;
                }
            endif;
        }
    }
}

if ( ! function_exists( 'jobhunt_add_custom_job_form_fields' ) ) {
    function jobhunt_add_custom_job_form_fields( $fields ) {
        if ( get_option('job_manager_enable_salary') ) {
            $fields['job']['job_listing_salary'] = array(
                'label'       => esc_html__( 'Job Salary', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_salary',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a salary…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        if ( get_option('job_manager_enable_career_level') ) {
            $fields['job']['job_listing_career_level'] = array(
                'label'       => esc_html__( 'Job Career Level', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_career_level',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a career level…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        if ( get_option('job_manager_enable_experience') ) {
            $fields['job']['job_listing_experience'] = array(
                'label'       => esc_html__( 'Job Experience', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_experience',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a job experience…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        if ( get_option('job_manager_enable_gender') ) {
            $fields['job']['job_listing_gender'] = array(
                'label'       => esc_html__( 'Job Gender', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_gender',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a gender…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        if ( get_option('job_manager_enable_industry') ) {
            $fields['job']['job_listing_industry'] = array(
                'label'       => esc_html__( 'Job Industry', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_industry',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a job industry…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        if ( get_option('job_manager_enable_qualification') ) {
            $fields['job']['job_listing_qualification'] = array(
                'label'       => esc_html__( 'Job Qualification', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'job_listing_qualification',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a job qualification…', 'jobhunt' ),
                'priority'    => 4
            );
        }

        return $fields;
    }
}

add_filter( 'submit_job_form_fields', 'jobhunt_add_custom_job_form_fields' );

if( ! function_exists( 'jobhunt_submit_job_form_fields_get_job_data' ) ) {
    function jobhunt_submit_job_form_fields_get_job_data( $fields, $job ){
        foreach ( $fields as $group_key => $group_fields ) {
            foreach ( $group_fields as $key => $field ) {
                if( isset( $fields[ $group_key ][ $key ]['type'] ) && ( $fields[ $group_key ][ $key ]['type'] == 'term-multiselect' ) && isset( $fields[ $group_key ][ $key ]['taxonomy'] ) ) {
                    $fields[ $group_key ][ $key ]['taxonomy'];
                    $fields[ $group_key ][ $key ]['value'] = wp_get_object_terms( $job->ID, $fields[ $group_key ][ $key ]['taxonomy'], array( 'fields' => 'ids' ) );
                }
            }
        }
        return $fields;
    }
}

add_filter( 'submit_job_form_fields_get_job_data', 'jobhunt_submit_job_form_fields_get_job_data', 10, 2 );

if ( ! function_exists( 'jobhunt_wpjm_wpcf7_notification_email' ) ) {
    function jobhunt_wpjm_wpcf7_notification_email( $components, $cf7, $three = null ) {
        $forms = apply_filters( 'jobhunt_wpjm_wpcf7_notification_email_forms', array(
            'job_listing' => array(
                'contact' => get_option( 'job_manager_single_job_contact_form', false )
            ),
            'company' => array(
                'contact' => get_option( 'job_manager_single_company_contact_form', false )
            ),
            'resume' => array(
                'contact' => get_option( 'resume_manager_single_resume_contact_form', false )
            )
        ) );

        $submission = WPCF7_Submission::get_instance();
        $unit_tag = $submission->get_meta( 'unit_tag' );

        if ( ! preg_match( '/^wpcf7-f(\d+)-p(\d+)-o(\d+)$/', $unit_tag, $matches ) )
            return $components;

        $post_id = (int) $matches[2];
        $object = get_post( $post_id );

        // Prevent issues when the form is not submitted via a listing/resume page
        if ( ! isset( $forms[ $object->post_type ] ) ) {
            return $components;
        }

        if ( ! array_search( $cf7->id(), $forms[ $object->post_type ] ) ) {
            return $components;
        }

        // Bail if this is the second mail
        if ( isset( $three ) && 'mail_2' == $three->name() ) {
            return $components;
        }

        switch ( $object->post_type ) {
            case 'job_listing':
                $recipient = $object->_application ? $object->_application : '';
                break;

            case 'company':
                $recipient = $object->_company_email ? $object->_company_email : '';
                break;

            case 'resume':
                $recipient = $object->_candidate_email ? $object->_candidate_email : '';
                break;

            default:
                $recipient = '';
                break;
        }

        //if we couldn't find the email by now, get it from the listing owner/author
        if ( empty( $recipient ) ) {

            //just get the email of the listing author
            $owner_ID = $object->post_author;

            //retrieve the owner user data to get the email
            $owner_info = get_userdata( $owner_ID );

            if ( false !== $owner_info ) {
                $recipient = $owner_info->user_email;
            }
        }

        $components[ 'recipient' ] = $recipient;

        return $components;
    }
}

add_filter( 'wpcf7_mail_components', 'jobhunt_wpjm_wpcf7_notification_email', 10, 3 );

if ( ! function_exists( 'jobhunt_get_forms' ) ) {
    function jobhunt_get_forms() {
        $forms  = array( 0 => esc_html__( 'Please select a form', 'jobhunt' ) );

        if ( function_exists( 'wpforms' ) ) {
            $_forms = get_posts(
                array(
                    'numberposts' => -1,
                    'post_type'   => 'wpforms',
                    'orderby'     => 'title',
                    'order'       => 'ASC',
                )
            );

            if ( ! empty( $_forms ) ) {

                foreach ( $_forms as $_form ) {
                    $forms[ $_form->ID ] = $_form->post_title;
                }
            }
        } elseif ( function_exists( 'wpcf7' ) ) {
            $_forms = get_posts(
                array(
                    'numberposts' => -1,
                    'post_type'   => 'wpcf7_contact_form',
                )
            );

            if ( ! empty( $_forms ) ) {

                foreach ( $_forms as $_form ) {
                    $forms[ $_form->ID ] = $_form->post_title;
                }
            }
        }

        return $forms;
    }
}

if ( ! function_exists( 'jobhunt_job_listing_job_type' ) ) {
    function jobhunt_job_listing_job_type( $linkable = false ) {
        if ( get_option( 'job_manager_enable_types' ) ) { ?>
            <?php $types = wpjm_get_the_job_types(); ?>
            <?php if ( ! empty( $types ) ) :
                echo '<ul class="job-types">';
                    foreach ( $types as $type ) : ?>
                        <li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>">
                            <?php if ( $linkable ) : ?>
                                <a href="<?php echo esc_url( get_term_link( $type ) ); ?>"><?php echo esc_html( $type->name ); ?></a>
                            <?php else : 
                                echo esc_html( $type->name );
                            endif; ?>
                        </li>
                    <?php endforeach;
                echo '</ul>';
            endif;
        }
    }
}

if ( ! function_exists( 'jobhunt_submit_job_form_login_url' ) ) {
    function jobhunt_submit_job_form_login_url( $login_page_url ) {
        
        if ( ! empty( jobhunt_get_register_login_form_page() ) ) {
            $login_page_url = get_permalink( jobhunt_get_register_login_form_page() ) . '#jh-login-tab-content';
        }

        return $login_page_url;
    }
}

add_filter( 'submit_job_form_login_url', 'jobhunt_submit_job_form_login_url' );

if ( ! function_exists( 'jobhunt_get_wpjm_header_bg_img' ) ) {
    function jobhunt_get_wpjm_header_bg_img() {
        $bg_url = '';
        $jobs_page_id = jh_wpjm_get_page_id( 'jobs' );
        if( has_post_thumbnail( $jobs_page_id ) ) {
            $bg_url = get_the_post_thumbnail_url( $jobs_page_id, 'full' );
        }

        return apply_filters( 'jobhunt_get_wpjm_header_bg_img', $bg_url );
    }
}
