<?php

function jh_wpjmc_get_page_id( $page ) {

    $option_name = '';
    switch( $page ) {
        case 'companies':
            $option_name = 'job_manager_companies_page_id';
        break;
    }

    $page_id = 0;

    if ( ! empty( $option_name ) ) {
        $page_id = get_option( $option_name );
    }

    $page_id = apply_filters( 'jobhunt_wpjm_get_' . $page . '_page_id', $page_id );
    return $page_id ? absint( $page_id ) : -1;
}

if ( ! function_exists( 'is_company_taxonomy' ) ) {

    /**
     * Is_company_taxonomy - Returns true when viewing a company taxonomy archive.
     *
     * @return bool
     */
    function is_company_taxonomy() {
        return is_tax( get_object_taxonomies( 'company' ) );
    }
}

function jobhunt_add_showing_to_company_listings_result( $results, $companies ) {

    $search_location    = isset( $_REQUEST['search_location'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_location'] ) ) : '';
    $search_keywords    = isset( $_REQUEST['search_keywords'] ) ? sanitize_text_field( stripslashes( $_REQUEST['search_keywords'] ) ) : '';

    $showing     = '';
    $showing_all = false;

    if ( $companies->post_count ) {

        $showing_all = true;

        $start = (int) $companies->get( 'offset' ) + 1;
        $end   = $start + (int)$companies->post_count - 1;

        if ( $companies->max_num_pages > 1 ) {
            $showing = sprintf( esc_html__( 'Showing %s - %s of %s companies', 'jobhunt'), $start, $end, $companies->found_posts );
        } else {
            $showing =  sprintf( _n( 'Showing one job', 'Showing all %s companies', $companies->found_posts, 'jobhunt' ), $companies->found_posts );
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

/**
 * Sets up the jh_wpjmc_loop global from the passed args or from the main query.
 *
 * @param array $args Args to pass into the global.
 */
function jh_wpjmc_setup_loop( $args = array() ) {
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
    if ( $GLOBALS['wp_query']->get( 'jh_wpjmc_query' ) ) {
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
    if ( isset( $GLOBALS['jh_wpjmc_loop'] ) ) {
        $default_args = array_merge( $default_args, $GLOBALS['jh_wpjmc_loop'] );
    }

    $GLOBALS['jh_wpjmc_loop'] = wp_parse_args( $args, $default_args );
}

/**
 * Resets the jh_wpjmc_loop global.
 *
 */
function jh_wpjmc_reset_loop() {
    unset( $GLOBALS['jh_wpjmc_loop'] );
}

/**
 * Gets a property from the jh_wpjmc_loop global.
 *
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
function jh_wpjmc_get_loop_prop( $prop, $default = '' ) {
    jh_wpjmc_setup_loop(); // Ensure shop loop is setup.

    return isset( $GLOBALS['jh_wpjmc_loop'], $GLOBALS['jh_wpjmc_loop'][ $prop ] ) ? $GLOBALS['jh_wpjmc_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the jh_wpjmc_loop global.
 *
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function jh_wpjmc_set_loop_prop( $prop, $value = '' ) {
    if ( ! isset( $GLOBALS['jh_wpjmc_loop'] ) ) {
        jh_wpjmc_setup_loop();
    }
    $GLOBALS['jh_wpjmc_loop'][ $prop ] = $value;
}

if ( ! function_exists( 'jh_get_company_keyword_search' ) ) {
    /**
     * Adds join and where query for keywords.
     *
     * @since 1.0.0
     * @param string $search
     * @return string
     */
    function jh_get_company_keyword_search( $search ) {
        global $wpdb, $jh_wpjmc_search_keyword;

        // Searchable Meta Keys: set to empty to search all meta keys
        $searchable_meta_keys = array(
            '_company_tagline',
            '_company_location',
            '_company_website',
            '_company_email',
            '_company_phone',
            '_company_twitter',
            '_company_facebook',
            '_company_googleplus',
        );

        $searchable_meta_keys = apply_filters( 'jh_wpjmc_searchable_meta_keys', $searchable_meta_keys );

        // Set Search DB Conditions
        $conditions   = array();

        // Search Post Meta
        if( apply_filters( 'jh_wpjmc_search_post_meta', true ) ) {

            // Only selected meta keys
            if( $searchable_meta_keys ) {
                $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key IN ( '" . implode( "','", array_map( 'esc_sql', $searchable_meta_keys ) ) . "' ) AND meta_value LIKE '%" . esc_sql( $jh_wpjmc_search_keyword ) . "%' )";
            } else {
                // No meta keys defined, search all post meta value
                $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . esc_sql( $jh_wpjmc_search_keyword ) . "%' )";
            }
        }

        // Search taxonomy
        $conditions[] = "{$wpdb->posts}.ID IN ( SELECT object_id FROM {$wpdb->term_relationships} AS tr LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id WHERE t.name LIKE '%" . esc_sql( $jh_wpjmc_search_keyword ) . "%' )";

        /**
         * Filters the conditions to use when querying job listings. Resulting array is joined with OR statements.
         *
         * @since 1.26.0
         *
         * @param array  $conditions          Conditions to join by OR when querying job listings.
         * @param string $jh_wpjmc_search_keyword Search query.
         */
        $conditions = apply_filters( 'jh_wpjmc_search_conditions', $conditions, $jh_wpjmc_search_keyword );
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

function jh_wpjmc_get_all_taxonomies() {
    $taxonomies = array();

    $taxonomy_objects = get_object_taxonomies( 'company', 'objects' );
    foreach ( $taxonomy_objects as $taxonomy_object ) {
        $taxonomies[] = array(
            'taxonomy'  => $taxonomy_object->name,
            'name'      => $taxonomy_object->label,
        );
    }

    return $taxonomies;
}

class JH_WPJMC_Query {

    /**
     * Reference to the main job query on the page.
     *
     * @var array
     */
    private static $jh_wpjmc_query;

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
        if ( $this->is_showing_page_on_front( $q ) && $this->page_on_front_is( jh_wpjmc_get_page_id( 'companies' ) ) ) {
            $_query = wp_parse_args( $q->query );
            if ( empty( $_query ) || ! array_diff( array_keys( $_query ), array( 'preview', 'page', 'paged', 'cpage', 'orderby' ) ) ) {
                $q->set( 'page_id', (int) get_option( 'page_on_front' ) );
                $q->is_page = true;
                $q->is_home = false;

                // WP supporting themes show post type archive.
                $q->set( 'post_type', 'company' );
            }
        }

        // Special check for companies with the PRODUCT POST TYPE ARCHIVE on front.
        if ( $q->is_page() && 'page' === get_option( 'show_on_front' ) && absint( $q->get( 'page_id' ) ) === jh_wpjmc_get_page_id( 'companies' ) ) {
            // This is a front-page companies.
            $q->set( 'post_type', 'company' );
            $q->set( 'page_id', '' );

            if ( isset( $q->query['paged'] ) ) {
                $q->set( 'paged', $q->query['paged'] );
            }

            // Define a variable so we know this is the front page companies later on.
            if( ! defined( 'COMPANIES_IS_ON_FRONT' ) ) {
                define( 'COMPANIES_IS_ON_FRONT', true );
            }

            // Get the actual WP page to avoid errors and let us use is_front_page().
            // This is hacky but works. Awaiting https://core.trac.wordpress.org/ticket/21096.
            global $wp_post_types;

            $companies_page = get_post( jh_wpjmc_get_page_id( 'companies' ) );

            $wp_post_types['company']->ID         = $companies_page->ID;
            $wp_post_types['company']->post_title = $companies_page->post_title;
            $wp_post_types['company']->post_name  = $companies_page->post_name;
            $wp_post_types['company']->post_type  = $companies_page->post_type;
            $wp_post_types['company']->ancestors  = get_ancestors( $companies_page->ID, $companies_page->post_type );

            // Fix conditional Functions like is_front_page.
            $q->is_singular          = false;
            $q->is_post_type_archive = true;
            $q->is_archive           = true;
            $q->is_page              = true;

            // Remove post type archive name from front page title tag.
            add_filter( 'post_type_archive_title', '__return_empty_string', 5 );
        } elseif ( ! $q->is_post_type_archive( 'company' ) && ! $q->is_tax( get_object_taxonomies( 'company' ) ) ) {
            // Only apply to company categories, the company post archive, the companies page, and company taxonomies.
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
        $q->set( 'jh_wpjmc_query', 'company_query' );
        $q->set( 'posts_per_page', $this->get_posts_per_page( $q->get( 'posts_per_page' ), true ) );

        // Store reference to this query.
        self::$jh_wpjmc_query = $q;
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
            global $jh_wpjmc_search_keyword;
            $jh_wpjmc_search_keyword = sanitize_text_field( $_GET['search_keywords'] );

            if ( ! empty( $jh_wpjmc_search_keyword ) && strlen( $jh_wpjmc_search_keyword ) >= apply_filters( 'job_manager_get_companies_keyword_length_threshold', 2 ) ) {
                $q->set( 's' , $jh_wpjmc_search_keyword );
                add_filter( 'posts_search', 'jh_get_company_keyword_search' );
            }
        } elseif ( ! empty( $_GET['s'] ) ) {
            global $jh_wpjmc_search_keyword;
            $jh_wpjmc_search_keyword = sanitize_text_field( $_GET['s'] );

            if ( ! empty( $jh_wpjmc_search_keyword ) && strlen( $jh_wpjmc_search_keyword ) >= apply_filters( 'job_manager_get_companies_keyword_length_threshold', 2 ) ) {
                add_filter( 'posts_search', 'jh_get_company_keyword_search' );
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
        return array_filter( apply_filters( 'jh_companies_query_meta_query', $meta_query, $this ) );
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
            $operator   = 'all' === get_option( 'job_manager_company_category_filter_type', 'all' ) && sizeof( $categories ) > 1 ? 'AND' : 'IN';
            $tax_query[] = array(
                'taxonomy'         => 'company_category',
                'field'            => $field,
                'terms'            => array_values( $categories ),
                'include_children' => $operator !== 'AND' ,
                'operator'         => $operator
            );
        }

        return array_filter( apply_filters( 'jh_companies_query_tax_query', $tax_query, $this ) );
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

        return array_filter( apply_filters( 'jh_companies_query_date_query', $date_query, $this ) );
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
            $per_page = get_option( 'job_manager_companies_per_page' );
        }

        return absint( apply_filters( 'jh_companies_query_posts_per_page', $per_page ) );
    }

    /**
     * Return a meta query for filtering by location.
     *
     * @return array
     */
    private function search_location_filter_meta_query() {
        if ( ! empty( $_GET['search_location'] ) ) {
            $location_meta_keys = array( 'geolocation_formatted_address', '_company_location', 'geolocation_state_long' );
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
     * Returns an array of arguments for ordering companies based on the selected values.
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
                    $orderby_value = apply_filters( 'jh_companies_default_catalog_orderby', 'date' );
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

        return apply_filters( 'jh_companies_get_catalog_ordering_args', $args );
    }

    /**
     * Get the main query which job queries ran against.
     *
     * @return array
     */
    public static function get_main_query() {
        return self::$jh_wpjmc_query;
    }

    /**
     * Get the tax query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_tax_query() {
        $tax_query = isset( self::$jh_wpjmc_query->tax_query, self::$jh_wpjmc_query->tax_query->queries ) ? self::$jh_wpjmc_query->tax_query->queries : array();

        return $tax_query;
    }

    /**
     * Get the meta query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_meta_query() {
        $args       = isset( self::$jh_wpjmc_query->query_vars ) ? self::$jh_wpjmc_query->query_vars : array();
        $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

        return $meta_query;
    }

    /**
     * Get the date query which was used by the main query.
     *
     * @return array
     */
    public static function get_main_date_query() {
        $date_query = isset( self::$jh_wpjmc_query->date_query, self::$jh_wpjmc_query->date_query->queries ) ? self::$jh_wpjmc_query->date_query->queries : array();

        return $date_query;
    }

    /**
     * Based on WP_Query::parse_search
     */
    public static function get_main_search_query_sql() {
        global $wpdb;

        $args         = isset( self::$jh_wpjmc_query->query_vars ) ? self::$jh_wpjmc_query->query_vars : array();
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
            $taxonomies     = jh_wpjmc_get_all_taxonomies();

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

$jh_wpjmc_query = new JH_WPJMC_Query();

if ( ! function_exists( 'jobhunt_modify_register_post_type_companies' ) ) {
    function jobhunt_modify_register_post_type_companies( $args ) {
        $companies_page_id = jh_wpjmc_get_page_id( 'companies' );
        if(  $companies_page_id && get_post( $companies_page_id ) ) {
            $args['has_archive'] = urldecode( get_page_uri( $companies_page_id ) );
            $args['rewrite'] = array(
                'slug'       => esc_html_x( 'company', 'Company permalink - resave permalinks after changing this', 'jobhunt' ),
                'with_front' => false,
                'feeds'      => true,
            );
        }

        return $args;
    }
}

add_filter( 'register_post_type_company', 'jobhunt_modify_register_post_type_companies' );

/**
 * Add company fields in post job form
 */
if ( ! function_exists( 'jobhunt_submit_job_form_fields' ) ) {
    function jobhunt_submit_job_form_fields() {
        $fields = array(
            'company_description' => array(
                'label'       => esc_html__( 'Description', 'jobhunt' ),
                'type'        => 'wp-editor',
                'required'    => false,
                'priority'    => 5,
            ),
            'company_team_size' => array(
                'label'       => esc_html__( 'Team size', 'jobhunt' ),
                'type'        => 'term-select',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose Team Size&hellip;', 'jobhunt' ),
                'priority'    => 5,
                'default'     => '',
                'taxonomy'    => 'company_team_size',
            ),
            'company_category' => array(
                'label'       => esc_html__( 'Category', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'required'    => false,
                'placeholder' => '',
                'priority'    => 5,
                'default'     => '',
                'taxonomy'    => 'company_category',
            ),
            'company_location' => array(
                'label'       => esc_html__( 'Location', 'jobhunt' ),
                'description' => esc_html__( 'Leave this blank if the location is not important', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'e.g. "London"', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_email' => array(
                'label'       => esc_html__( 'Email', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'you@yourdomain.com', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_phone' => array(
                'label'       => esc_html__( 'Phone', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'Phone Number', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_facebook' => array(
                'label'       => esc_html__( 'Facebook', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'Facebook page url', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_googleplus' => array(
                'label'       => esc_html__( 'Google+', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'Google+ url', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_linkedin' => array(
                'label'       => esc_html__( 'LinkedIn', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'LinkedIn url', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_since' => array(
                'label'       => esc_html__( 'Since', 'jobhunt' ),
                'type'        => 'date',
                'required'    => false,
                'placeholder' => esc_html__( 'Established date/year', 'jobhunt' ),
                'priority'    => 6,
            )
        );

        return apply_filters( 'jobhunt_submit_job_form_company_fields' , $fields );
    }
}

if ( ! function_exists( 'jobhunt_submit_company_form_required_fields' ) ) {
    function jobhunt_submit_company_form_required_fields() {
        $required_fields = array(
            'post_fields'  => array( 'company_name', 'company_logo', 'company_description' ),
            'tax_fields'   => array( 'company_team_size', 'company_category' ),
            'meta_fields'  => array( 'company_website', 'company_tagline', 'company_video', 'company_twitter', 'company_location', 'company_email', 'company_phone', 'company_facebook', 'company_googleplus', 'company_linkedin', 'company_since' )
        );

        return apply_filters( 'jobhunt_submit_company_form_required_fields' , $required_fields );
    }
}

if ( ! function_exists( 'jobhunt_add_custom_job_company_fields' ) ) {
    function jobhunt_add_custom_job_company_fields() {
        $company_fields = jobhunt_submit_job_form_fields();
        $required_fields = jobhunt_submit_company_form_required_fields();

        $job_id = ! empty( $_REQUEST['job_id'] ) ? absint( $_REQUEST['job_id'] ) : 0;
        $company_id = 0;

        if ( ! job_manager_user_can_edit_job( $job_id ) ) {
            $job_id = 0;
        }

        if( $job_id ) {
            $post_title = get_post_meta( $job_id, '_company_name', true );
            if( ! empty( $post_title ) ) {
                $post_title = stripslashes( html_entity_decode( $post_title ) );
                $company = get_page_by_title( $post_title, OBJECT, 'company' );
                $company_id = isset( $company->ID ) ? $company->ID : 0;
            }
        }

        foreach ( $company_fields as $key => $field ) : ?>
            <?php if( $company_id ) {
                if ( ! isset( $field['value'] ) ) {
                    if ( 'company_description' === $key ) {
                        $field['value'] = $company->post_content;

                    } elseif ( ! empty( $field['taxonomy'] ) ) {
                        $field['value'] = wp_get_object_terms( $company->ID, $field['taxonomy'], array( 'fields' => 'ids' ) );

                    } else {
                        $field['value'] = get_post_meta( $company->ID, '_' . $key, true );
                    }
                }
            } ?>
            <?php  ?>
            <fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
                <label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . esc_html__( '(optional)', 'jobhunt' ) . '</small>', $field ) ); ?></label>
                <div class="field <?php echo esc_attr( $field['required'] ? 'required-field' : '' ); ?>">
                    <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
                </div>
            </fieldset>
        <?php endforeach;
    }
}

add_action( 'submit_job_form_company_fields_end', 'jobhunt_add_custom_job_company_fields' );

if ( ! function_exists( 'jobhunt_update_job_form_fields' ) ) {
    function jobhunt_update_job_form_fields( $job_id, $values ) {
        $required_fields = jobhunt_submit_company_form_required_fields();

        $post_fields = array();
        $tax_fields = array();
        $meta_fields = array();

        foreach ( $required_fields['post_fields'] as $field_name ) {
            if( $field_name == 'company_description' ) {
                $post_fields[ $field_name ] = isset( $_POST[ $field_name ] ) ? wp_kses_post( $_POST[ $field_name ] ) : '';
            } else {
                $post_fields[ $field_name ] = isset( $_POST[ $field_name ] ) ? jobhunt_clean( $_POST[ $field_name ] ) : '';
            }
        }

        foreach ( $required_fields['tax_fields'] as $field_name ) {
            $tax_fields[ $field_name ] = isset( $_POST[ $field_name ] ) ? jobhunt_clean( $_POST[ $field_name ] ) : '';
        }

        foreach ( $required_fields['meta_fields'] as $field_name ) {
            $meta_fields[ $field_name ] = isset( $_POST[ $field_name ] ) ? jobhunt_clean( $_POST[ $field_name ] ) : '';
        }

        if( empty( $post_fields['company_logo'] ) && ! empty( $values['company']['company_logo'] ) ) {
            $post_fields['company_logo'] = $values['company']['company_logo'];
        }

        if( isset( $_POST['job_manager_form'] ) && $_POST['job_manager_form'] == 'submit-job' ) {
            $post_fields    = array_filter( $post_fields, 'jobhunt_strlen' );
            $tax_fields     = array_filter( $tax_fields, 'jobhunt_strlen' );
            $meta_fields    = array_filter( $meta_fields, 'jobhunt_strlen' );
        }

        if( ! empty( $post_fields ) ) {
            $post_title = stripslashes( html_entity_decode( $post_fields['company_name'] ) );
            $company = get_page_by_title( $post_title, OBJECT, 'company' );
            $company_id = isset( $company->ID ) ? $company->ID : 0;

            $default_company_status = apply_filters( 'jobhunt_wpjmc_default_company_status', 'pending' );

            $post_data = array(
                'post_title'     => $post_fields['company_name'],
                'post_content'   => isset( $post_fields['company_description'] ) ? $post_fields['company_description'] : '',
                'post_type'      => 'company',
                'comment_status' => 'closed',
                'post_status'    => $default_company_status,
            );

            if ( $company_id && is_a( $company, 'WP_Post' ) && ( $company->post_author == get_current_user_id() || current_user_can('administrator') ) ) {
                $post_data['ID'] = $company_id;
                if( isset( $_POST['job_manager_form'] ) && $_POST['job_manager_form'] == 'submit-job' ) {
                    $post_data['post_content'] = isset( $company->post_content ) ? $company->post_content : '';
                    $post_data['post_status'] = isset( $company->post_status ) ? $company->post_status : $default_company_status;
                }

                if( isset( $_POST['job_manager_form'] ) && $_POST['job_manager_form'] == 'edit-job' ) {
                    $post_data['post_status'] = isset( $company->post_status ) ? $company->post_status : $default_company_status;
                }

                wp_update_post( $post_data );
            } else {
                $company_id = wp_insert_post( $post_data );
            }

            if( ! empty( $post_fields['company_logo'] ) ) {
                $attachment_id = is_numeric( $post_fields['company_logo'] ) ? absint( $post_fields['company_logo'] ) : '';
                if ( empty( $attachment_id ) ) {
                    delete_post_thumbnail( $company_id );
                } else {
                    set_post_thumbnail( $company_id, $attachment_id );
                }
            }

            if( ! empty( $tax_fields ) ) {
                foreach ( $tax_fields as $key => $value ) {
                    $terms = array();
                    if ( is_array( $value ) ) {
                        $terms = array_map( 'absint', $value );
                    } elseif( $value > 0 ) {
                        $terms = array( absint( $value ) );
                    }
                    wp_set_object_terms( $company_id, $terms, $key, false );
                }
            }

            if( ! empty( $meta_fields ) ) {
                foreach ( $meta_fields as $key => $value ) {
                    update_post_meta( $company_id, '_' . $key, $value );
                }
            }
        }
    }
}

add_action( 'job_manager_update_job_data', 'jobhunt_update_job_form_fields', 10, 2 );

/**
 * Return whether or not the company has been featured
 *
 * @param  object $post
 * @return boolean
 */
if ( ! function_exists( 'is_company_featured' ) ) {
    function is_company_featured( $post = null ) {
        $post = get_post( $post );

        return $post->_featured ? true : false;
    }
}

/**
 * Get the company openings jobs
 */
if ( ! function_exists( 'get_the_company_job_listing' ) ) {
    function get_the_company_job_listing( $post = null ) {
        if( ! $post ) {
            global $post;
        }

        return get_posts( array( 'post_type' => 'job_listing', 'meta_key' => '_company_name', 'meta_value' => $post->post_title, 'nopaging' => true ) );
    }
}

/**
 * Get the company openings count
 */
if ( ! function_exists( 'get_the_company_job_listing_count' ) ) {
    function get_the_company_job_listing_count( $post = null ) {
        $posts = get_the_company_job_listing( $post );
        return count( $posts );
    }
}
