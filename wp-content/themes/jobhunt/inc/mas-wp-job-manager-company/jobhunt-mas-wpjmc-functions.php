<?php
if ( ! function_exists( 'jobhunt_single_company_remove_mas_plugin_hooks' ) ) {
    function jobhunt_single_company_remove_mas_plugin_hooks( $page ) {
        remove_action( 'single_company_start', 'mas_wpjmc_single_company_content_open', 10 );
        remove_action( 'single_company', 'mas_wpjmc_single_company_header', 10 );
        remove_action( 'single_company', 'mas_wpjmc_single_company_features', 20 );
        remove_action( 'single_company', 'mas_wpjmc_single_company_description', 30 );
        remove_action( 'single_company', 'mas_wpjmc_single_company_video', 40 );
        remove_action( 'single_company_end', 'mas_wpjmc_single_company_content_close', 10 );
    }
}
add_action( 'single_company_before', 'jobhunt_single_company_remove_mas_plugin_hooks', 5 );

if( ! function_exists( 'jobhunt_company_content_remove_mas_plugin_hooks' ) ) {
    function jobhunt_company_content_remove_mas_plugin_hooks() {
        remove_action( 'company_start', 'mas_wpjmc_company_loop_open', 10 );
        remove_action( 'company', 'mas_wpjmc_company_loop_content', 10 );
        remove_action( 'company_end', 'mas_wpjmc_company_loop_close', 10 );

        remove_action( 'company_before_loop', 'mas_wpjmc_setup_loop' );
        remove_action( 'company_after_loop', 'mas_wpjmc_pagination', 100 );
        remove_action( 'company_after_loop', 'mas_wpjmc_reset_loop', 999 );
    }
}
add_action( 'company_content_area_before', 'jobhunt_company_content_remove_mas_plugin_hooks', 5 );

if( ! function_exists( 'jobhunt_mas_company_manager_company_modify_fields' ) ) {
    function jobhunt_mas_company_manager_company_modify_fields( $fields ) {
        $fields['_company_googleplus'] = array(
            'label'       => esc_html__( 'Google+', 'jobhunt' ),
            'placeholder' => esc_html__( 'company google plus page link', 'jobhunt' ),
        );
        $fields['_company_linkedin'] = array(
            'label'       => esc_html__( 'LinkedIn', 'jobhunt' ),
            'placeholder' => esc_html__( 'company linkedin page link', 'jobhunt' ),
        );
        return $fields;
    }
}
add_filter( 'company_manager_company_fields', 'jobhunt_mas_company_manager_company_modify_fields' );

if( ! function_exists( 'jobhunt_mas_submit_company_form_modify_fields' ) ) {
    function jobhunt_mas_submit_company_form_modify_fields( $fields ) {
        if( ! taxonomy_exists( 'company_strength' ) && isset( $fields['company_fields']['company_strength'] ) ) {
            unset( $fields['company_fields']['company_strength'] );
        }

        if( ! taxonomy_exists( 'company_average_salary' ) && isset( $fields['company_fields']['company_average_salary'] ) ) {
            unset( $fields['company_fields']['company_average_salary'] );
        }

        if( ! taxonomy_exists( 'company_revenue' ) && isset( $fields['company_fields']['company_revenue'] ) ) {
            unset( $fields['company_fields']['company_revenue'] );
        }

        if( isset( $fields['company_fields']['company_category'] ) ) {
            $fields['company_fields']['company_category']['label'] = esc_html__( 'Category', 'jobhunt' );
            $fields['company_fields']['company_category']['type'] = 'term-multiselect';
        }

        // if( isset( $fields['company_fields']['company_excerpt'] ) ) {
        //     unset( $fields['company_fields']['company_excerpt'] );
        // }

        if( taxonomy_exists( 'company_team_size' ) ) {
            $fields['company_fields']['company_team_size'] = array(
                'label'       => esc_html__( 'Team size', 'jobhunt' ),
                'type'        => 'term-select',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose Team Size&hellip;', 'jobhunt' ),
                'priority'    => 65,
                'default'     => '',
                'taxonomy'    => 'company_team_size',
            );
        }

        $fields['company_fields']['company_googleplus'] = array(
            'label'       => esc_html__( 'Google+', 'jobhunt' ),
            'type'        => 'text',
            'required'    => false,
            'placeholder' => esc_html__( 'Google+ url', 'jobhunt' ),
            'priority'    => 57,
        );

        $fields['company_fields']['company_linkedin'] = array(
            'label'       => esc_html__( 'LinkedIn', 'jobhunt' ),
            'type'        => 'text',
            'required'    => false,
            'placeholder' => esc_html__( 'LinkedIn url', 'jobhunt' ),
            'priority'    => 58,
        );

        return $fields;
    }
}
add_filter( 'submit_company_form_fields', 'jobhunt_mas_submit_company_form_modify_fields' );

if( ! function_exists( 'jobhunt_company_content_remove_mas_plugin_hooks' ) ) {
    function jobhunt_company_content_remove_mas_plugin_hooks() {
        remove_action( 'company_start', 'mas_wpjmc_company_loop_open', 10 );
        remove_action( 'company', 'mas_wpjmc_company_loop_content', 10 );
        remove_action( 'company_end', 'mas_wpjmc_company_loop_close', 10 );

        remove_action( 'company_before_loop', 'mas_wpjmc_setup_loop' );
        remove_action( 'company_after_loop', 'mas_wpjmc_pagination', 100 );
        remove_action( 'company_after_loop', 'mas_wpjmc_reset_loop', 999 );
    }
}
add_action( 'company_content_area_before', 'jobhunt_company_content_remove_mas_plugin_hooks', 5 );

if ( ! function_exists( 'jh_wpjmc_get_page_id' ) ) {
    function jh_wpjmc_get_page_id( $page='companies' ) {
        return mas_wpjmc_get_page_id( $page );
    }
}

/**
 * Sets up the mas_wpjmc_loop global from the passed args or from the main query.
 *
 * @param array $args Args to pass into the global.
 */
if ( ! function_exists( 'jh_wpjmc_setup_loop' ) ) {
    function jh_wpjmc_setup_loop( $args = array() ) {
        mas_wpjmc_setup_loop( $args );
    }
}

/**
 * Resets the mas_wpjmc_loop global.
 *
 */
if ( ! function_exists( 'jh_wpjmc_reset_loop' ) ) {
    function jh_wpjmc_reset_loop() {
        mas_wpjmc_reset_loop();
    }
}

/**
 * Gets a property from the mas_wpjmc_loop global.
 *
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
if ( ! function_exists( 'jh_wpjmc_get_loop_prop' ) ) {
    function jh_wpjmc_get_loop_prop( $prop, $default = '' ) {
        return mas_wpjmc_get_loop_prop( $prop, $default );
    }
}

/**
 * Sets a property in the mas_wpjmc_loop global.
 *
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
if ( ! function_exists( 'jh_wpjmc_set_loop_prop' ) ) {
    function jh_wpjmc_set_loop_prop( $prop, $value = '' ) {
        mas_wpjmc_set_loop_prop( $prop, $value );
    }
}

/**
 * Adds join and where query for keywords.
 *
 * @since 1.0.0
 * @param string $search
 * @return string
 */
if ( ! function_exists( 'jh_get_company_keyword_search' ) ) {
    function jh_get_company_keyword_search( $search ) {
        return mas_wpjmc_get_company_keyword_search( $search );
    }
}

if ( ! function_exists( 'jh_wpjmc_get_all_taxonomies' ) ) {
    function jh_wpjmc_get_all_taxonomies() {
        return mas_wpjmc_get_all_taxonomies();
    }
}

/**
 * Is_company_taxonomy - Returns true when viewing a company taxonomy archive.
 *
 * @return bool
 */
if ( ! function_exists( 'is_company_taxonomy' ) ) {
    function is_company_taxonomy() {
        return mas_wpjmc_is_company_taxonomy();
    }
}

/**
 * Return whether or not the company has been featured
 *
 * @param  object $post
 * @return boolean
 */
if ( ! function_exists( 'is_company_featured' ) ) {
    function is_company_featured( $post = null ) {
        return mas_wpjmc_is_company_featured( $post );
    }
}

if ( ! function_exists( 'jobhunt_add_showing_to_company_listings_result' ) ) {
    function jobhunt_add_showing_to_company_listings_result( $results, $companies ) {
        return mas_wpjmc_add_showing_to_company_listings_result( $results, $companies );
    }
}

/**
 * Get the company openings jobs
 */
if ( ! function_exists( 'get_the_company_job_listing' ) ) {
    function get_the_company_job_listing( $post = null ) {
        return mas_wpjmc_get_the_company_job_listing( $post );
    }
}

/**
 * Get the company openings count
 */
if ( ! function_exists( 'get_the_company_job_listing_count' ) ) {
    function get_the_company_job_listing_count( $post = null ) {
        return mas_wpjmc_get_the_company_job_listing_count( $post );
    }
}
