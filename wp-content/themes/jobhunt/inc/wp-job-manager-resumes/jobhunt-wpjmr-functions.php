<?php

function jh_wpjmr_get_page_id( $page ) {

    $option_name = '';
    switch( $page ) {
        case 'resume':
            $option_name = 'resume_manager_resumes_page_id';
        break;
        case 'submit_resume_form':
            $option_name = 'resume_manager_submit_resume_form_page_id';
        break;
        case 'candidate_dashboard':
            $option_name = 'resume_manager_candidate_dashboard_page_id';
        break;
    }

    $page_id = 0;

    if ( ! empty( $option_name ) ) {
        $page_id = get_option( $option_name );
    }

    $page_id = apply_filters( 'jobhunt_wpjmr_get_' . $page . '_page_id', $page_id );
    return $page_id ? absint( $page_id ) : -1;
}

if ( ! function_exists( 'is_resume_taxonomy' ) ) {

    /**
     * Is_resume_taxonomy - Returns true when viewing a resume taxonomy archive.
     *
     * @return bool
     */
    function is_resume_taxonomy() {
        return is_tax( get_object_taxonomies( 'resume' ) );
    }
}

function jobhunt_add_showing_to_resume_listings_result( $results, $resumes ) {

    $search_location    = isset( $_REQUEST['search_location'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_location'] ) ) : '';
    $search_keywords    = isset( $_REQUEST['search_keywords'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_keywords'] ) ) : '';

    $showing     = '';
    $showing_all = false;

    if ( $resumes->post_count ) {

        $showing_all = true;

        $start = (int) $resumes->get( 'offset' ) + 1;
        $end   = $start + (int)$resumes->post_count - 1;

        if ( $resumes->max_num_pages > 1 ) {
            $showing = sprintf( esc_html__( 'Showing %s - %s of %s resumes', 'jobhunt'), $start, $end, $resumes->found_posts );
        } else {
            $showing =  sprintf( _n( 'Showing one job', 'Showing all %s resumes', $resumes->found_posts, 'jobhunt' ), $resumes->found_posts );
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

if ( ! function_exists( 'jobhunt_wpjmr_page_title' ) ) {
    function jobhunt_wpjmr_page_title( $title ) {

        if( is_post_type_archive( 'resume' ) ) {
            $title = esc_html__( 'Candidates', 'jobhunt' );
        } elseif ( is_singular( 'resume' ) ) {
            $title = single_post_title( '', false );
        } elseif ( is_tax( get_object_taxonomies( 'resume' ) ) ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }
}

if ( ! function_exists( 'jobhunt_wpjmr_page_subtitle' ) ) {
    function jobhunt_wpjmr_page_subtitle( $subtitle ) {

        if( is_post_type_archive( 'resume' ) ) {
            $subtitle = '';
        } elseif ( is_singular( 'resume' ) ) {
            $subtitle = '';
        }

        return $subtitle;
    }
}

/**
 * Sets up the jh_wpjmr_loop global from the passed args or from the main query.
 *
 * @param array $args Args to pass into the global.
 */
function jh_wpjmr_setup_loop( $args = array() ) {
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
    if ( $GLOBALS['wp_query']->get( 'jh_wpjmr_query' ) ) {
        $default_args = array_merge( $default_args, array(
            'is_search'    => $GLOBALS['wp_query']->is_search(),
            // 'is_filtered'  => is_filtered(),
            'total'        => $GLOBALS['wp_query']->found_posts,
            'total_pages'  => $GLOBALS['wp_query']->max_num_pages,
            'per_page'     => $GLOBALS['wp_query']->get( 'posts_per_page' ),
            'current_page' => max( 1, $GLOBALS['wp_query']->get( 'paged', 1 ) ),
        ) );
    }

    // Merge any existing values.
    if ( isset( $GLOBALS['jh_wpjmr_loop'] ) ) {
        $default_args = array_merge( $default_args, $GLOBALS['jh_wpjmr_loop'] );
    }

    $GLOBALS['jh_wpjmr_loop'] = wp_parse_args( $args, $default_args );
}

/**
 * Resets the jh_wpjmr_loop global.
 *
 */
function jh_wpjmr_reset_loop() {
    unset( $GLOBALS['jh_wpjmr_loop'] );
}

/**
 * Gets a property from the jh_wpjmr_loop global.
 *
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
function jh_wpjmr_get_loop_prop( $prop, $default = '' ) {
    jh_wpjmr_setup_loop(); // Ensure shop loop is setup.

    return isset( $GLOBALS['jh_wpjmr_loop'], $GLOBALS['jh_wpjmr_loop'][ $prop ] ) ? $GLOBALS['jh_wpjmr_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the jh_wpjmr_loop global.
 *
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function jh_wpjmr_set_loop_prop( $prop, $value = '' ) {
    if ( ! isset( $GLOBALS['jh_wpjmr_loop'] ) ) {
        jh_wpjmr_setup_loop();
    }
    $GLOBALS['jh_wpjmr_loop'][ $prop ] = $value;
}

if ( ! function_exists( 'jh_get_resume_keyword_search' ) ) {
    /**
     * Adds join and where query for keywords.
     *
     * @since 1.0.0
     * @param string $search
     * @return string
     */
    function jh_get_resume_keyword_search( $search ) {
        global $wpdb, $jh_wpjmr_search_keyword;

        // Searchable Meta Keys: set to empty to search all meta keys
        $searchable_meta_keys = array(
            '_candidate_title',
            '_candidate_email',
            '_candidate_location',
            '_candidate_twitter',
            '_candidate_facebook',
            '_candidate_googleplus',
            '_candidate_linkedin',
            '_candidate_instagram',
            '_candidate_youtube',
            '_candidate_behance',
            '_candidate_pinterest',
            '_candidate_github',
        );

        $searchable_meta_keys = apply_filters( 'jh_wpjmr_searchable_meta_keys', $searchable_meta_keys );

        // Set Search DB Conditions
        $conditions   = array();

        // Search Post Meta
        if( apply_filters( 'jh_wpjmr_search_post_meta', true ) ) {

            // Only selected meta keys
            if( $searchable_meta_keys ) {
                $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key IN ( '" . implode( "','", array_map( 'esc_sql', $searchable_meta_keys ) ) . "' ) AND meta_value LIKE '%" . esc_sql( $jh_wpjmr_search_keyword ) . "%' )";
            } else {
                // No meta keys defined, search all post meta value
                $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . esc_sql( $jh_wpjmr_search_keyword ) . "%' )";
            }
        }

        // Search taxonomy
        $conditions[] = "{$wpdb->posts}.ID IN ( SELECT object_id FROM {$wpdb->term_relationships} AS tr LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id WHERE t.name LIKE '%" . esc_sql( $jh_wpjmr_search_keyword ) . "%' )";

        /**
         * Filters the conditions to use when querying job listings. Resulting array is joined with OR statements.
         *
         * @since 1.26.0
         *
         * @param array  $conditions          Conditions to join by OR when querying job listings.
         * @param string $jh_wpjmr_search_keyword Search query.
         */
        $conditions = apply_filters( 'jh_wpjmr_search_conditions', $conditions, $jh_wpjmr_search_keyword );
        if ( empty( $conditions ) ) {
            return $search;
        }

        $conditions_str = implode( ' OR ', $conditions );

        if ( ! empty( $search ) ) {
            $search = preg_replace( '/^ AND /', '', $search );
            $search = " AND ( {$search} OR ( {$conditions_str} ) )";
        } else {
            $search = " AND ( {$conditions_str} )";
        }

        return $search;
    }
}

function jh_wpjmr_get_all_date_filters() {
    return apply_filters( 'jh_wpjmr_get_all_date_filters' , array(
        '1-hour'    => esc_html__( 'Last Hour', 'jobhunt' ),
        '24-hours'  => esc_html__( 'Last 24 Hours', 'jobhunt' ),
        '7-days'    => esc_html__( 'Last 7 Days', 'jobhunt' ),
        '14-days'   => esc_html__( 'Last 14 Days', 'jobhunt' ),
        '30-days'   => esc_html__( 'Last 30 Days', 'jobhunt' ),
        'all'       => esc_html__( 'All', 'jobhunt' ),
    ) );
}

function jh_wpjmr_get_all_taxonomies() {
    $taxonomies = array();

    $taxonomy_objects = get_object_taxonomies( 'resume', 'objects' );
    foreach ( $taxonomy_objects as $taxonomy_object ) {
        $taxonomies[] = array(
            'taxonomy'  => $taxonomy_object->name,
            'name'      => $taxonomy_object->label,
        );
    }

    return $taxonomies;
}

class JH_WPJMR_Query {

    /**
     * Reference to the main job query on the page.
     *
     * @var array
     */
    private static $jh_wpjmr_query;

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
        if ( $this->is_showing_page_on_front( $q ) && $this->page_on_front_is( jh_wpjmr_get_page_id( 'resume' ) ) ) {
            $_query = wp_parse_args( $q->query );
            if ( empty( $_query ) || ! array_diff( array_keys( $_query ), array( 'preview', 'page', 'paged', 'cpage', 'orderby' ) ) ) {
                $q->set( 'page_id', (int) get_option( 'page_on_front' ) );
                $q->is_page = true;
                $q->is_home = false;

                // WP supporting themes show post type archive.
                $q->set( 'post_type', 'resume' );
            }
        }

        // Special check for resume with the PRODUCT POST TYPE ARCHIVE on front.
        if ( $q->is_page() && 'page' === get_option( 'show_on_front' ) && absint( $q->get( 'page_id' ) ) === jh_wpjmr_get_page_id( 'resume' ) ) {
            // This is a front-page resume.
            $q->set( 'post_type', 'resume' );
            $q->set( 'page_id', '' );

            if ( isset( $q->query['paged'] ) ) {
                $q->set( 'paged', $q->query['paged'] );
            }

            // Define a variable so we know this is the front page resume later on.
            if( ! defined( 'RESUMES_IS_ON_FRONT' ) ) {
                define( 'RESUMES_IS_ON_FRONT', true );
            }

            // Get the actual WP page to avoid errors and let us use is_front_page().
            // This is hacky but works. Awaiting https://core.trac.wordpress.org/ticket/21096.
            global $wp_post_types;

            $resume_page = get_post( jh_wpjmr_get_page_id( 'resume' ) );

            $wp_post_types['resume']->ID         = $resume_page->ID;
            $wp_post_types['resume']->post_title = $resume_page->post_title;
            $wp_post_types['resume']->post_name  = $resume_page->post_name;
            $wp_post_types['resume']->post_type  = $resume_page->post_type;
            $wp_post_types['resume']->ancestors  = get_ancestors( $resume_page->ID, $resume_page->post_type );

            // Fix conditional Functions like is_front_page.
            $q->is_singular          = false;
            $q->is_post_type_archive = true;
            $q->is_archive           = true;
            $q->is_page              = true;

            // Remove post type archive name from front page title tag.
            add_filter( 'post_type_archive_title', '__return_empty_string', 5 );
        } elseif ( ! $q->is_post_type_archive( 'resume' ) && ! $q->is_tax( get_object_taxonomies( 'resume' ) ) ) {
            // Only apply to resume categories, the resume post archive, the resume page, and resume taxonomies.
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
        $q->set( 'jh_wpjmr_query', 'resume_query' );
        $q->set( 'posts_per_page', $this->get_posts_per_page( $q->get( 'posts_per_page' ), true ) );
        $q->set( 'post_status', array( 'publish' ) );

        // Store reference to this query.
        self::$jh_wpjmr_query = $q;
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
            global $jh_wpjmr_search_keyword;
            $jh_wpjmr_search_keyword = sanitize_text_field( $_GET['search_keywords'] );

            if ( ! empty( $jh_wpjmr_search_keyword ) && strlen( $jh_wpjmr_search_keyword ) >= apply_filters( 'job_manager_get_resumes_keyword_length_threshold', 2 ) ) {
                $q->set( 's' , $jh_wpjmr_search_keyword );
                add_filter( 'posts_search', 'jh_get_resume_keyword_search' );
            }
        } elseif ( ! empty( $_GET['s'] ) ) {
            global $jh_wpjmr_search_keyword;
            $jh_wpjmr_search_keyword = sanitize_text_field( $_GET['s'] );

            if ( ! empty( $jh_wpjmr_search_keyword ) && strlen( $jh_wpjmr_search_keyword ) >= apply_filters( 'job_manager_get_resumes_keyword_length_threshold', 2 ) ) {
                add_filter( 'posts_search', 'jh_get_resume_keyword_search' );
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
        return array_filter( apply_filters( 'jh_resumes_query_meta_query', $meta_query, $this ) );
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
            $operator   = 'all' === get_option( 'job_manager_resume_category_filter_type', 'all' ) && sizeof( $categories ) > 1 ? 'AND' : 'IN';
            $tax_query[] = array(
                'taxonomy'         => 'resume_category',
                'field'            => $field,
                'terms'            => array_values( $categories ),
                'include_children' => $operator !== 'AND' ,
                'operator'         => $operator
            );
        }

        return array_filter( apply_filters( 'jh_resumes_query_tax_query', $tax_query, $this ) );
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

        return array_filter( apply_filters( 'jh_resumes_query_date_query', $date_query, $this ) );
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
            $per_page = get_option( 'resume_manager_per_page' );
        }

        return absint( apply_filters( 'jh_resumes_query_posts_per_page', $per_page ) );
    }

    /**
     * Return a meta query for filtering by location.
     *
     * @return array
     */
    private function search_location_filter_meta_query() {
        if ( ! empty( $_GET['search_location'] ) ) {
            $location_meta_keys = array( 'geolocation_formatted_address', '_candidate_location', 'geolocation_state_long' );
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
     * Returns an array of arguments for ordering resumes based on the selected values.
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
                    $orderby_value = apply_filters( 'jh_resumes_default_catalog_orderby', 'date' );
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
        }

        return apply_filters( 'jh_resumes_get_catalog_ordering_args', $args );
    }

    /**
     * Get the main query which job queries ran against.
     *
     * @return array
     */
    public static function get_main_query() {
        return self::$jh_wpjmr_query;
    }

    /**
     * Get the tax query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_tax_query() {
        $tax_query = isset( self::$jh_wpjmr_query->tax_query, self::$jh_wpjmr_query->tax_query->queries ) ? self::$jh_wpjmr_query->tax_query->queries : array();

        return $tax_query;
    }

    /**
     * Get the meta query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_meta_query() {
        $args       = isset( self::$jh_wpjmr_query->query_vars ) ? self::$jh_wpjmr_query->query_vars : array();
        $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

        return $meta_query;
    }

    /**
     * Get the date query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_date_query() {
        $date_query = isset( self::$jh_wpjmr_query->date_query, self::$jh_wpjmr_query->date_query->queries ) ? self::$jh_wpjmr_query->date_query->queries : array();

        return $date_query;
    }

    /**
     * Based on WP_Query::parse_search
     */
    public static function get_main_search_query_sql() {
        global $wpdb;

        $args         = isset( self::$jh_wpjmr_query->query_vars ) ? self::$jh_wpjmr_query->query_vars : array();
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
            $taxonomies     = jh_wpjmr_get_all_taxonomies();

            if ( ! empty( $taxonomies ) ) {
                foreach ( $taxonomies as $tax ) {
                    $taxonomy = $tax['taxonomy'];
                    $filter_terms = ! empty( $_GET[ 'filter_' . $taxonomy ] ) ? explode( ',', jobhunt_clean( wp_unslash( $_GET[ 'filter_' . $taxonomy ] ) ) ) : array(); // WPCS: sanitization ok, input var ok, CSRF ok.

                    if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) ) {
                        continue;
                    }

                    $query_type                                     = ! empty( $_GET[ 'query_type_' . $taxonomy ] ) && in_array( $_GET[ 'query_type_' . $taxonomy ], array( 'and', 'or' ), true ) ? jobhunt_clean( wp_unslash( $_GET[ 'query_type_' . $taxonomy ] ) ) : ''; // WPCS: sanitization ok, input var ok, CSRF ok.
                    self::$_chosen_taxonomies[ $taxonomy ]['terms'] = array_map( 'sanitize_title', $filter_terms ); // Ensures correct encoding.
                    self::$_chosen_taxonomies[ $taxonomy ]['query_type'] = $query_type ? $query_type : apply_filters( 'jobhunt_wpjmc_layered_nav_default_query_type', 'and' );
                }
            }
        }
        return self::$_chosen_taxonomies;
    }
}

$jh_wpjmr_query = new JH_WPJMR_Query();

if ( ! function_exists( 'jobhunt_modify_register_post_type_resumes' ) ) {
    function jobhunt_modify_register_post_type_resumes( $args ) {
        $resumes_page_id = jh_wpjmr_get_page_id( 'resume' );
        if(  $resumes_page_id && get_post( $resumes_page_id ) ) {
            $args['has_archive'] = urldecode( get_page_uri( $resumes_page_id ) );
            $args['rewrite'] = array(
                'slug'       => esc_html_x( 'resume', 'Resume permalink - resave permalinks after changing this', 'jobhunt' ),
                'with_front' => false,
                'feeds'      => true,
            );
        }

        $args['exclude_from_search'] = false;

        return $args;
    }
}

add_filter( 'register_post_type_resume', 'jobhunt_modify_register_post_type_resumes' );

if ( ! function_exists( 'jobhunt_add_custom_resume_fields' ) ) {
    function jobhunt_add_custom_resume_fields( $fields ) {
        $fields['_candidate_twitter'] = array(
            'label'       => esc_html__( 'Twitter', 'jobhunt' ),
            'placeholder' => esc_html__( 'your twitter page link', 'jobhunt' ),
        );
        $fields['_candidate_facebook'] = array(
            'label'       => esc_html__( 'Facebook', 'jobhunt' ),
            'placeholder' => esc_html__( 'your facebook page link', 'jobhunt' ),
        );
        $fields['_candidate_googleplus'] = array(
            'label'       => esc_html__( 'Google+', 'jobhunt' ),
            'placeholder' => esc_html__( 'your google plus page link', 'jobhunt' ),
        );
        $fields['_candidate_linkedin'] = array(
            'label'       => esc_html__( 'Linked in', 'jobhunt' ),
            'placeholder' => esc_html__( 'your linked in page link', 'jobhunt' ),
        );
        $fields['_candidate_instagram'] = array(
            'label'       => esc_html__( 'Instagram', 'jobhunt' ),
            'placeholder' => esc_html__( 'your instagram page link', 'jobhunt' ),
        );
        $fields['_candidate_youtube'] = array(
            'label'       => esc_html__( 'Youtube', 'jobhunt' ),
            'placeholder' => esc_html__( 'your youtube page link', 'jobhunt' ),
        );
        $fields['_candidate_behance'] = array(
            'label'       => esc_html__( 'Behance', 'jobhunt' ),
            'placeholder' => esc_html__( 'your behance page link', 'jobhunt' ),
        );
        $fields['_candidate_pinterest'] = array(
            'label'       => esc_html__( 'Pinterest', 'jobhunt' ),
            'placeholder' => esc_html__( 'your pinterest page link', 'jobhunt' ),
        );
        $fields['_candidate_github'] = array(
            'label'       => esc_html__( 'Github', 'jobhunt' ),
            'placeholder' => esc_html__( 'your github in page link', 'jobhunt' ),
        );
        return $fields;
    }
}

add_filter('resume_manager_resume_fields', 'jobhunt_add_custom_resume_fields' );

if ( ! function_exists( 'jobhunt_add_custom_submit_resume_form_fields' ) ) {
    function jobhunt_add_custom_submit_resume_form_fields( $fields ) {
        if ( get_option('resume_manager_enable_experience') ) {
            $fields['resume_fields']['resume_experience'] = array(
                'label'       => esc_html__( 'Candidate Experience', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'resume_experience',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a experience…', 'jobhunt' ),
                'priority'    => 7
            );
        }

        if ( get_option('resume_manager_enable_current_salary') ) {
            $fields['resume_fields']['resume_current_salary'] = array(
                'label'       => esc_html__( 'Candidate Current Salary', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'resume_current_salary',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a current salary…', 'jobhunt' ),
                'priority'    => 7
            );
        }
            
        if ( get_option('resume_manager_enable_expected_salary') ) {
            $fields['resume_fields']['resume_expected_salary'] = array(
                'label'       => esc_html__( 'Candidate Expected Salary', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'resume_expected_salary',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a expected salary…', 'jobhunt' ),
                'priority'    => 7
            );
        }

        if ( get_option('resume_manager_enable_education_level') ) {
            $fields['resume_fields']['resume_education_level'] = array(
                'label'       => esc_html__( 'Candidate Education Level', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'resume_education_level',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a education level…', 'jobhunt' ),
                'priority'    => 7
            );
        }

        if ( get_option('resume_manager_enable_language') ) {
            $fields['resume_fields']['resume_language'] = array(
                'label'       => esc_html__( 'Candidate Language', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'taxonomy'    => 'resume_language',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a language…', 'jobhunt' ),
                'priority'    => 7
            );
        }

        if ( get_option('resume_manager_enable_gender') ) {
            $fields['resume_fields']['resume_gender'] = array(
                'label'       => esc_html__( 'Candidate Gender', 'jobhunt' ),
                'type'        => 'term-select',
                'taxonomy'    => 'resume_gender',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a gender…', 'jobhunt' ),
                'default'     => '',
                'priority'    => 10
            );
        }

        if ( get_option('resume_manager_enable_age') ) {
            $fields['resume_fields']['resume_age'] = array(
                'label'       => esc_html__( 'Candidate Age', 'jobhunt' ),
                'type'        => 'term-select',
                'taxonomy'    => 'resume_age',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose a age…', 'jobhunt' ),
                'default'     => '',
                'priority'    => 10
            );
        }    
            
        $fields['resume_fields']['candidate_twitter'] = array(
            'label'       => esc_html__( 'Twitter', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your twitter page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_facebook'] = array(
            'label'       => esc_html__( 'Facebook', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your facebook page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_googleplus'] = array(
            'label'       => esc_html__( 'Google+', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your google plus page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_linkedin'] = array(
            'label'       => esc_html__( 'Linked in', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your linked in page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_instagram'] = array(
            'label'       => esc_html__( 'Instagram', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your instagram page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_youtube'] = array(
            'label'       => esc_html__( 'Youtube', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your youtube page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_behance'] = array(
            'label'       => esc_html__( 'Behance', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your behance page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_pinterest'] = array(
            'label'       => esc_html__( 'Pinterest', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your pinterest page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_github'] = array(
            'label'       => esc_html__( 'Github', 'jobhunt' ),
            'type'        => 'text',
            'placeholder' => esc_html__( 'your github in page link', 'jobhunt' ),
            'priority'    => 6,
            'required'    => false
        );
        $fields['resume_fields']['candidate_awards'] = array(
            'label'       => esc_html__( 'Awards', 'jobhunt' ),
            'add_row'     => esc_html__( 'Add Awards', 'jobhunt' ),
            'type'        => 'repeated', // repeated
            'required'    => false,
            'placeholder' => '',
            'priority'    => 12,
            'fields'      => array(
                'award_title' => array(
                    'label'       => esc_html__( 'Award Title', 'jobhunt' ),
                    'type'        => 'text',
                    'required'    => true,
                    'placeholder' => '',
                    'description' => ''
                ),
                'date' => array(
                    'label'       => esc_html__( 'Start/end date', 'jobhunt' ),
                    'type'        => 'text',
                    'required'    => true,
                    'placeholder' => '',
                    'description' => ''
                ),
                'notes' => array(
                    'label'       => esc_html__( 'Notes', 'jobhunt' ),
                    'required'    => false,
                    'placeholder' => '',
                    'description' => '',
                    'type'        => 'textarea',
                )
            )
        );
        return $fields;
    }
}

add_filter( 'submit_resume_form_fields', 'jobhunt_add_custom_submit_resume_form_fields' );

if( ! function_exists( 'jobhunt_submit_resume_form_fields_get_resume_data' ) ) {
    function jobhunt_submit_resume_form_fields_get_resume_data( $fields, $resume ){
        foreach ( $fields as $group_key => $group_fields ) {
            foreach ( $group_fields as $key => $field ) {
                if( isset( $fields[ $group_key ][ $key ]['type'] ) && ( $fields[ $group_key ][ $key ]['type'] == 'term-multiselect' ) && isset( $fields[ $group_key ][ $key ]['taxonomy'] ) ) {
                    $fields[ $group_key ][ $key ]['taxonomy'];
                    $fields[ $group_key ][ $key ]['value'] = wp_get_object_terms( $resume->ID, $fields[ $group_key ][ $key ]['taxonomy'], array( 'fields' => 'ids' ) );
                }
            }
        }
        return $fields;
    }
}

add_filter( 'submit_resume_form_fields_get_resume_data', 'jobhunt_submit_resume_form_fields_get_resume_data', 10, 2 );

/**
 * Echo the twitter page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_twitter_page' ) ) {
    function the_candidate_twitter_page( $post = null ) {
        if ( ! empty( get_the_candidate_twitter_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_twitter_page( $post ) ) . '" class="candidate-twitter"><i class="fab fa-twitter"></i></a>';
        }
    }
}

/**
 * Get the twitter page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_twitter_page' ) ) {
    function get_the_candidate_twitter_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_twitter && ! strstr( $post->_candidate_twitter, 'http:' ) && ! strstr( $post->_candidate_twitter, 'https:' ) ) {
            $post->_candidate_twitter = 'https://' . $post->_candidate_twitter;
        }

        return apply_filters( 'the_candidate_twitter_page', $post->_candidate_twitter, $post );
    }
}

/**
 * Echo the facebook page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_facebook_page' ) ) {
    function the_candidate_facebook_page( $post = null ) {
        if ( ! empty( get_the_candidate_facebook_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_facebook_page( $post ) ) . '" class="candidate-facebook"><i class="fab fa-facebook-f"></i></a>';
        }
    }
}

/**
 * Get the facebook page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_facebook_page' ) ) {
    function get_the_candidate_facebook_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_facebook && ! strstr( $post->_candidate_facebook, 'http:' ) && ! strstr( $post->_candidate_facebook, 'https:' ) ) {
            $post->_candidate_facebook = 'https://' . $post->_candidate_facebook;
        }

        return apply_filters( 'the_candidate_facebook_page', $post->_candidate_facebook, $post );
    }
}

/**
 * Echo the googleplus page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_googleplus_page' ) ) {
    function the_candidate_googleplus_page( $post = null ) {
        if ( ! empty( get_the_candidate_googleplus_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_googleplus_page( $post ) ) . '" class="candidate-google-plus"><i class="fab fa-google"></i></a>';
        }
    }
}

/**
 * Get the googleplus page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_googleplus_page' ) ) {
    function get_the_candidate_googleplus_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_googleplus && ! strstr( $post->_candidate_googleplus, 'http:' ) && ! strstr( $post->_candidate_googleplus, 'https:' ) ) {
            $post->_candidate_googleplus = 'https://' . $post->_candidate_googleplus;
        }

        return apply_filters( 'the_candidate_googleplus_page', $post->_candidate_googleplus, $post );
    }
}

/**
 * Echo the linkedin page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_linkedin_page' ) ) {
    function the_candidate_linkedin_page( $post = null ) {
        if ( ! empty( get_the_candidate_linkedin_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_linkedin_page( $post ) ) . '" class="candidate-linkedin"><i class="fab fa-linkedin-in"></i></a>';
        }
    }
}

/**
 * Get the linkedin page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_linkedin_page' ) ) {
    function get_the_candidate_linkedin_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_linkedin && ! strstr( $post->_candidate_linkedin, 'http:' ) && ! strstr( $post->_candidate_linkedin, 'https:' ) ) {
            $post->_candidate_linkedin = 'https://' . $post->_candidate_linkedin;
        }

        return apply_filters( 'the_candidate_linkedin_page', $post->_candidate_linkedin, $post );
    }
}

/**
 * Echo the instagram page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_instagram_page' ) ) {
    function the_candidate_instagram_page( $post = null ) {
        if ( ! empty( get_the_candidate_instagram_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_instagram_page( $post ) ) . '" class="candidate-instagram"><i class="fab fa-instagram"></i></a>';
        }
    }
}

/**
 * Get the instagram page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_instagram_page' ) ) {
    function get_the_candidate_instagram_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_instagram && ! strstr( $post->_candidate_instagram, 'http:' ) && ! strstr( $post->_candidate_instagram, 'https:' ) ) {
            $post->_candidate_instagram = 'https://' . $post->_candidate_instagram;
        }

        return apply_filters( 'the_candidate_instagram_page', $post->_candidate_instagram, $post );
    }
}

/**
 * Echo the youtube page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_youtube_page' ) ) {
    function the_candidate_youtube_page( $post = null ) {
        if ( ! empty( get_the_candidate_youtube_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_youtube_page( $post ) ) . '" class="candidate-youtube"><i class="fab fa-youtube"></i></i></a>';
        }
    }
}

/**
 * Get the youtube page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_youtube_page' ) ) {
    function get_the_candidate_youtube_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_youtube && ! strstr( $post->_candidate_youtube, 'http:' ) && ! strstr( $post->_candidate_youtube, 'https:' ) ) {
            $post->_candidate_youtube = 'https://' . $post->_candidate_youtube;
        }

        return apply_filters( 'the_candidate_youtube_page', $post->_candidate_youtube, $post );
    }
}

/**
 * Echo the behance page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_behance_page' ) ) {
    function the_candidate_behance_page( $post = null ) {
        if ( ! empty( get_the_candidate_behance_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_behance_page( $post ) ) . '" class="candidate-behance"><i class="fab fa-behance"></i></a>';
        }
    }
}

/**
 * Get the behance page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_behance_page' ) ) {
    function get_the_candidate_behance_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_behance && ! strstr( $post->_candidate_behance, 'http:' ) && ! strstr( $post->_candidate_behance, 'https:' ) ) {
            $post->_candidate_behance = 'https://' . $post->_candidate_behance;
        }

        return apply_filters( 'the_candidate_behance_page', $post->_candidate_behance, $post );
    }
}
/**
 * Echo the pinterest page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_pinterest_page' ) ) {
    function the_candidate_pinterest_page( $post = null ) {
        if ( ! empty( get_the_candidate_pinterest_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_pinterest_page( $post ) ) . '" class="candidate-pinterest"><i class="fab fa-pinterest"></i></a>';
        }
    }
}

/**
 * Get the pinterest page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_pinterest_page' ) ) {
    function get_the_candidate_pinterest_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_pinterest && ! strstr( $post->_candidate_pinterest, 'http:' ) && ! strstr( $post->_candidate_pinterest, 'https:' ) ) {
            $post->_candidate_pinterest = 'https://' . $post->_candidate_pinterest;
        }

        return apply_filters( 'the_candidate_pinterest_page', $post->_candidate_pinterest, $post );
    }
}

/**
 * Echo the github page for a candidate
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_candidate_github_page' ) ) {
    function the_candidate_github_page( $post = null ) {
        if ( ! empty( get_the_candidate_github_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_candidate_github_page( $post ) ) . '" class="candidate-github"><i class="fab fa-github"></i></a>';
        }
    }
}

/**
 * Get the github page for a candidate
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_candidate_github_page' ) ) {
    function get_the_candidate_github_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return;

        if ( $post->_candidate_github && ! strstr( $post->_candidate_github, 'http:' ) && ! strstr( $post->_candidate_github, 'https:' ) ) {
            $post->_candidate_github = 'https://' . $post->_candidate_github;
        }

        return apply_filters( 'the_candidate_github_page', $post->_candidate_github, $post );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmr_style' ) ) {
    function jobhunt_get_wpjmr_style() {
        $style = get_option( 'resume_manager_resumes_listing_style' );
        return apply_filters( 'jobhunt_get_wpjmr_resumes_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmr_sidebar_style' ) ) {
    function jobhunt_get_wpjmr_sidebar_style() {
        $layout = get_option( 'resume_manager_resumes_listing_sidebar' );
        return apply_filters( 'jobhunt_get_wpjmr_resumes_layout', $layout );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmr_single_style' ) ) {
    function jobhunt_get_wpjmr_single_style() {
        $style = get_option( 'resume_manager_single_resume_style' );
        return apply_filters( 'jobhunt_get_wpjmr_resume_single_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmr_header_bg_img' ) ) {
    function jobhunt_get_wpjmr_header_bg_img() {
        $bg_url = '';
        $resumes_page_id = jh_wpjmr_get_page_id( 'resume' );
        if( has_post_thumbnail( $resumes_page_id ) ) {
            $bg_url = get_the_post_thumbnail_url( $resumes_page_id, 'full' );
        }

        return apply_filters( 'jobhunt_get_wpjmr_header_bg_img', $bg_url );
    }
}

if ( ! function_exists( 'jobhunt_resume_header_search_block' ) ) {
    /**
     * Display Resume/Candidate Header Search block
     */
    function jobhunt_resume_header_search_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_resume_header_search_block_args', array(
            'section_title'             => esc_html__( 'Find Candidate', 'jobhunt' ),
            'sub_title'                 => esc_html__( 'We have 2.567 resumes in our database', 'jobhunt' ),
            'search_placeholder_text'   => esc_html__( 'Search freelancer services (e.g. logo design)', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'category_select_text'      => esc_html__( 'Any Category', 'jobhunt' ),
            'show_category_select'      => false,
            'search_button_icon'        => 'la la-search',
            'search_button_text'        => esc_html__( 'Search', 'jobhunt' ),
            'show_browse_button'        => false,
            'browse_button_label'       => esc_html__( 'Or browse resumes offers by', 'jobhunt' ),
            'browse_button_text'        => esc_html__( 'Category', 'jobhunt' ),
            'browse_button_link'        => '#'
        ) );

        $args = wp_parse_args( $args, $defaults );

        extract( $args );

        $resumes_page_id = jh_wpjmr_get_page_id( 'resume' );
        $resumes_page_url = get_permalink( $resumes_page_id );

        ?><div class="resume-search-block">

            <?php do_action( 'jobhunt_resume_header_search_block_before' ); ?>

            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <div class="resume-search-form">
                <form method="GET" action="<?php echo esc_url( $resumes_page_url ); ?>">
                    <div class="resume-search-keywords">
                        <label class="sr-only" for="search_keywords"><?php echo esc_html__( 'Keywords', 'jobhunt' ); ?></label>
                        <input type="text" id="search_keywords" name="s" placeholder="<?php echo esc_attr( $search_placeholder_text ); ?>"/>
                    </div>
                    <div class="resume-search-location">
                        <label class="sr-only" for="search_location"><?php echo esc_html__( 'Location', 'jobhunt' ); ?></label>
                        <input type="text" id="search_location" name="search_location" placeholder="<?php echo esc_attr( $location_placeholder_text ); ?>"/>
                    </div>
                    <?php if ( $show_category_select ) : ?>
                    <div class="resume-search-category">
                        <label class="sr-only" for="search_category"><?php echo esc_html__( 'Category', 'jobhunt' ); ?></label>
                        <select id="search_category" name="search_category">
                            <option value=""><?php echo esc_html( $category_select_text ); ?></option>
                            <?php foreach ( get_resume_categories() as $cat ) : ?>
                            <option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="resume-search-submit">
                        <button type="submit" value="<?php echo esc_attr( $search_button_text ); ?>"><i class="<?php echo esc_attr( $search_button_icon ); ?>"></i><span class="resume-search-text"><?php echo esc_html( $search_button_text ); ?></span></button>
                    </div>
                    <input type="hidden" name="post_type" value="resume"/>
                </form>
                <?php if ( $show_browse_button ) : ?>
                    <div class="browse-resumes-by-category">
                        <span><?php echo esc_html( $browse_button_label ); ?></span>
                        <a href="<?php echo esc_url( $browse_button_link ); ?>" title="<?php echo esc_attr( $browse_button_text ); ?>"><?php echo esc_html( $browse_button_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php do_action( 'jobhunt_resume_header_search_block_after' ); ?>

        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_submit_resume_form_login_url' ) ) {
    function jobhunt_submit_resume_form_login_url( $login_page_url ) {
        
        if ( ! empty( jobhunt_get_register_login_form_page() ) ) {
            $login_page_url = get_permalink( jobhunt_get_register_login_form_page() ) . '#jh-login-tab-content';
        }

        return $login_page_url;
    }
}

add_filter( 'submit_resume_form_login_url', 'jobhunt_submit_resume_form_login_url' );
