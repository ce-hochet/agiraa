<?php
/**
 *
 */

if ( ! function_exists( 'jobhunt_template_job_listing_link_open' ) ) {
    function jobhunt_template_job_listing_link_open() {
        ?><a href="<?php the_job_permalink(); ?>"><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_company_logo' ) ) {
    function jobhunt_template_job_listing_company_logo() {
        ?><div class="job-listing-company-logo"><?php
            global $post;
            $post = get_post( $post );
            if ( has_post_thumbnail( $post ) ) {
                jobhunt_the_company_logo();
            } else {
                $job_id = get_the_ID();
                $company = '';

                if( $job_id ) {
                    if( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() && $comapny_id = get_post_meta( $job_id, '_company_id', true ) ) {
                        if( ! empty( $comapny_id ) ) {
                            $company = get_post( $comapny_id );
                        }
                    } else {
                        $post_title = get_post_meta( $job_id, '_company_name', true );
                        if( ! empty( $post_title ) ) {
                            $company = get_page_by_title( $post_title, OBJECT, 'company' );
                        }
                    }
                }

                if ( ! empty ( $company ) && has_post_thumbnail( $company ) ) {
                    $logo = get_the_company_logo( $company, 'thumbnail' );
                    echo '<img class="company_logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_the_company_name( $company ) ) . '" />';
                } else {
                    jobhunt_the_company_logo();
                }
            }
        ?></div><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_detail_open' ) ) {
    function jobhunt_template_job_listing_detail_open() {
        ?><div class="job-details"><?php
    }
}


if ( ! function_exists( 'jobhunt_template_job_listing_detail_inner_open' ) ) {
    function jobhunt_template_job_listing_detail_inner_open() {
        ?><div class="job-details-inner"><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_title' ) ) {
    function jobhunt_template_job_listing_title() {
        ?><h3 class="job-listing-loop-job__title"><?php wpjm_the_job_title(); ?></h3><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_company_details' ) ) {
    function jobhunt_template_job_listing_company_details() {
        ?><div class="job-listing-company company">
            <?php the_company_name( '<strong>', '</strong> ' ); ?>
            <?php the_company_tagline( '<span class="tagline">', '</span>' ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_location' ) ) {
    function jobhunt_template_job_listing_location() {
        ?><div class="job-location location">
            <i class="la la-map-marker"></i><?php the_job_location( false ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_detail_inner_close' ) ) {
    function jobhunt_template_job_listing_detail_inner_close() {
        ?></div><!-- /.job-details-inner --><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_detail_close' ) ) {
    function jobhunt_template_job_listing_detail_close() {
        ?></div><!-- /.job-details --><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_loop_job_meta' ) ) {
    function jobhunt_template_job_listing_loop_job_meta() {
        echo '<div class="job-listing-meta meta">';
            do_action( 'jobhunt_job_listing_meta_start' );
            do_action( 'jobhunt_job_listing_meta' );
            do_action( 'jobhunt_job_listing_meta_end' );
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_job_publishd_date' ) ) {
    function jobhunt_job_publishd_date() {
        ?><span class="job-published-date date"><?php jobhunt_the_job_publish_date(); ?></span><?php
    }
}

if ( ! function_exists( 'jobhunt_template_job_listing_link_close' ) ) {
    function jobhunt_template_job_listing_link_close() {
        ?></a><?php
    }
}

if ( ! function_exists( 'jobhunt_get_jobs_sidebar' ) ) {
    function jobhunt_get_jobs_sidebar() {
        jobhunt_get_sidebar( 'jobs' );
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_description' ) ) {
    function jobhunt_single_job_listing_description() {
        ?><div class="single-job-listing__description job-description">
            <?php wpjm_the_job_description(); ?>
        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_application' ) ) {
    function jobhunt_single_job_listing_application() {
        if ( candidates_can_apply() ) {
            get_job_manager_template( 'job-application.php' );
        }
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_overview' ) ) {
    function jobhunt_single_job_listing_overview() {
        get_job_manager_template( 'job-listing-overview.php' );
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_location_map' ) ) {
    function jobhunt_single_job_listing_location_map() {
        get_job_manager_template( 'job-listing-location-map.php' );
    }
}

if ( ! function_exists( 'jobhunt_the_company_logo' ) ) {
    function jobhunt_the_company_logo( $args = array() ) {
        $defaults = apply_filters( 'jobhunt_company_logo_args', array(
            'size'    => 'thumbnail',
            'default' => null,
            'post'    => null
        ) );
        $args = wp_parse_args( $defaults, $args );
        extract( $args );
        the_company_logo( $size, $default, $post );
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_share' ) ) {
    function jobhunt_single_job_listing_share() {
        do_action( 'jobhunt_share' );
    }
}

if ( ! function_exists( 'jobhunt_single_job_listing_related_jobs' ) ) {
    function jobhunt_single_job_listing_related_jobs() {
        if( apply_filters( 'jobhunt_single_job_listing_related_jobs', true ) ) {
            if( jobhunt_is_astoundify_job_manager_regions_activated() ) {
                $region_obj = wp_job_manager_regions()->template;
                remove_filter( 'the_job_location', array( $region_obj , 'the_listing_location' ), 10, 2 );
            }
            get_job_manager_template( 'job-listing-related-jobs.php' );
        }
    }
}

if ( ! function_exists( 'jobhunt_job_listing_showing_jobs' ) ) {
    function jobhunt_job_listing_showing_jobs() {
        
    }
}

if ( ! function_exists( 'jobhunt_wpjm_result_count' ) ) {
    function jobhunt_wpjm_result_count() {
        
        if ( ! jh_wpjm_get_loop_prop( 'is_paginated' ) ) {
            return;
        }
        
        $args = array(
            'total'    => jh_wpjm_get_loop_prop( 'total' ),
            'per_page' => jh_wpjm_get_loop_prop( 'per_page' ),
            'current'  => jh_wpjm_get_loop_prop( 'current_page' ),
        );

        extract( $args );

        ?><div class="showing_jobs"><span><?php 
        if ( $total <= $per_page || -1 === $per_page ) {
            /* translators: %d: total results */
            printf( _n( 'Showing the single job', 'Showing all %d jobs', $total, 'jobhunt' ), $total );
        } else {
            $first = ( $per_page * $current ) - $per_page + 1;
            $last  = min( $total, $per_page * $current );
            /* translators: 1: first job 2: last job 3: total jobs */
            printf( _nx( 'Showing the single job', 'Showing %1$d&ndash;%2$d of %3$d jobs', $total, 'with first and last job', 'jobhunt' ), $first, $last, $total );
        }
        ?></span></div><?php
    }
}

if ( ! function_exists( 'jobhunt_no_jobs_found_info' ) ) {
    function jobhunt_no_jobs_found_info() {
        ?><p class="jobhunt-info no-jobs-found"><?php echo apply_filters( 'jobhunt_no_jobs_found_info', esc_html__( 'No jobs were found matching your selection.', 'jobhunt' ) ); ?></p><?php
    }
}

if ( ! function_exists( 'jobhunt_wpjm_pagination' ) ) {
    function jobhunt_wpjm_pagination() {
        global $wp_query;
        $total   = isset( $total ) ? $total : jh_wpjm_get_loop_prop( 'total_pages' );
        $current = isset( $current ) ? $current : jh_wpjm_get_loop_prop( 'current_page' );
        $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
        $format  = isset( $format ) ? $format : '';
        if ( $total <= 1 ) {
            return;
        }
        ?>
        <nav class="wpjm-pagination">
            <?php
                echo paginate_links( apply_filters( 'jh_wpjm_pagination_args', array( // WPCS: XSS ok.
                    'base'         => $base,
                    'format'       => $format,
                    'add_args'     => false,
                    'current'      => max( 1, $current ),
                    'total'        => $total,
                    'prev_text'    => is_rtl() ? '&rarr;' : '&larr;',
                    'next_text'    => is_rtl() ? '&larr;' : '&rarr;',
                    'type'         => 'list',
                    'end_size'     => 3,
                    'mid_size'     => 3,
                ) ) );
            ?>
        </nav><?php
    }
}

add_action( 'template_redirect', 'jh_wpjm_template_redirect' );

function jh_wpjm_template_redirect() {
    global $wp_query, $wp;

    if ( ! empty( $_GET['page_id'] ) && '' === get_option( 'permalink_structure' ) && jh_wpjm_get_page_id( 'jobs' ) === absint( $_GET['page_id'] ) && get_post_type_archive_link( 'job_listing' ) ) { // WPCS: input var ok, CSRF ok.

        // When default permalinks are enabled, redirect shop page to post type archive url.
        wp_safe_redirect( get_post_type_archive_link( 'job_listing' ) );
        exit;

    }
}

if ( ! function_exists( 'jh_wpjm_shortcode_result_count' ) ) {
    function jh_wpjm_shortcode_result_count( $jobs = array(), $atts = array() ){
        $results = array(
            'showing_all' => false,
            'showing'     => ''
        );
        $results = jobhunt_add_showing_to_listings_result( $results, $jobs );

        if ( $results['showing_all'] ) ?><div class="showing_jobs">
            <span><?php echo esc_html( $results['showing'] ); ?></span>
        </div><?php
    }
}

if ( ! function_exists( 'jobhunt_wpjm_job_sorting_open' ) ) {
    function jobhunt_wpjm_job_sorting_open() {
        echo '<div class="jobs-sorting">';
    }
}

if ( ! function_exists( 'jobhunt_wpjm_job_sorting_close' ) ) {
    function jobhunt_wpjm_job_sorting_close() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_wpjm_job_catalog_ordering' ) ) {
    function jobhunt_wpjm_job_catalog_ordering() {
        if ( ! jh_wpjm_get_loop_prop( 'is_paginated' ) || 0 >= jh_wpjm_get_loop_prop( 'total', 0 ) ) {
            return;
        }

        $catalog_orderby_options = apply_filters( 'jobhunt_jobs_catalog_orderby', array(
            'date'       => esc_html__( 'New Jobs', 'jobhunt' ),
            'featured'   => esc_html__( 'Featured', 'jobhunt' ),
            'menu_order' => esc_html__( 'Menu Order', 'jobhunt' ),
            'title-asc'  => esc_html__( 'Name: Ascending', 'jobhunt' ),
            'title-desc' => esc_html__( 'Name: Descending', 'jobhunt' ),
        ) );

        $default_orderby = jh_wpjm_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'jh_job_listing_default_catalog_orderby', 'date' );
        $orderby         = isset( $_GET['orderby'] ) ? jobhunt_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

        if ( jh_wpjm_get_loop_prop( 'is_search' ) ) {
            $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'jobhunt' ) ), $catalog_orderby_options );

            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
            $orderby = current( array_keys( $catalog_orderby_options ) );
        }

        ?>
        <label><?php echo apply_filters( 'jobhunt_jobs_catalog_orderby_label', esc_html__( 'Sort by' , 'jobhunt' ) ); ?></label>
        <form method="get">
            <select name="orderby" class="orderby" onchange="this.form.submit();">
                <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                    <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="paged" value="1" />
        </form>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_wpjm_job_per_page' ) ) {
    /**
     * Outputs a dropdown for user to select how many jobs to show per page
     */
    function jobhunt_wpjm_job_per_page() {
        
        global $wp_query;

        $action             = '#';
        $cat                = '';
        $cat                = $wp_query->get_queried_object();
        $method             = apply_filters( 'jobhunt_wpjm_jpp_method', 'post' );
        $return_to_first    = apply_filters( 'jobhunt_wpjm_jpp_return_to_first', false );
        $total              = $wp_query->found_posts;
        $per_page           = $wp_query->get( 'posts_per_page' );
        $_per_page          = 10;

        // Generate per page options
        $jobs_per_page_options = array();
        while( $_per_page < $total ) {
            $jobs_per_page_options[] = $_per_page;
            $_per_page = $_per_page * 2;
        }

        if ( empty( $jobs_per_page_options ) ) {
            return;
        }

        $jobs_per_page_options[] = -1;

        // Set action url if option behaviour is true
        // Paste QUERY string after for filter and orderby support
        $server_query_string = function_exists( 'jobhunt_get_server_query_string' ) ? jobhunt_get_server_query_string() : '';
        $query_string = ! empty( $server_query_string ) ? '?' . add_query_arg( array( 'jpp' => false ), $server_query_string ) : null;

        if ( isset( $cat->term_id ) && isset( $cat->taxonomy ) && $return_to_first ) :
            $action = get_term_link( $cat->term_id, $cat->taxonomy ) . $query_string;
        elseif ( $return_to_first ) :
            $action = get_permalink( jh_wpjm_get_page_id( 'jobs' ) ) . $query_string;
        endif;

        // Only show on product categories
        if ( ! ( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) || is_job_listing_taxonomy() ) ) :
            return;
        endif;
        
        do_action( 'jobhunt_wpjm_jpp_before_dropdown_form' );

        ?><form method="POST" action="<?php echo esc_url( $action ); ?>" class="form-jobhunt-wpjm-jpp"><?php

             do_action( 'jobhunt_wpjm_jpp_before_dropdown' );

            ?><select name="jpp" onchange="this.form.submit()" class="jobhunt-wpjm-wjpp-select c-select"><?php

                foreach( $jobs_per_page_options as $key => $value ) :

                    ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $per_page ); ?>><?php
                        $jpp_text = apply_filters( 'jobhunt_wpjm_jpp_text', esc_html__( 'Show %s', 'jobhunt' ), $value );
                        esc_html( printf( $jpp_text, $value == -1 ? esc_html__( 'All', 'jobhunt' ) : $value ) ); // Set to 'All' when value is -1
                    ?></option><?php

                endforeach;

            ?></select><?php

            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) :

                if ( 'jpp' === $key || 'submit' === $key ) :
                    continue;
                endif;
                if ( is_array( $val ) ) :
                    foreach( $val as $inner_val ) :
                        ?><input type="hidden" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo esc_attr( $inner_val ); ?>" /><?php
                    endforeach;
                else :
                    ?><input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $val ); ?>" /><?php
                endif;
            endforeach;

            do_action( 'jobhunt_wpjm_jpp_after_dropdown' );

        ?></form><?php

        do_action( 'jobhunt_wpjm_jpp_after_dropdown_form' );
    }
}

if ( ! function_exists( 'jobhunt_job_listing_control_bar_start' ) ) {
    function jobhunt_job_listing_control_bar_start() {
        echo '<div class="jh-jobs-control-bar">';
    }
}

if ( ! function_exists( 'jobhunt_job_listing_control_bar_end' ) ) {
    function jobhunt_job_listing_control_bar_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_job_listing_info_display' ) ) {
    function jobhunt_job_listing_info_display() {
        global $post;
        $post = get_post( $post ); ?>
        <div class="job_listing-single-job-info">
            <div class="job-listing-single-job__title-type">
                <h3 class="job-listing-single-job__title"><?php wpjm_the_job_title(); ?></h3>
                <?php jobhunt_job_listing_job_type();
                if ( jobhunt_is_wp_job_manager_claim_listing_activated() ) {
                    jobhunt_add_claim_link(false);
                } ?>
            </div>
            <div class="job-listing-single-location-salary-posted">
                <?php if ( get_the_job_location() ) {
                    $map_link = jobhunt_is_astoundify_job_manager_regions_activated() ? false : true; ?>
                    <div class="location"><i class="la la-map-marker"></i><?php the_job_location( $map_link ); ?></div>
                <?php }
                if ( ( $salary = wp_get_object_terms( $post->ID, 'job_listing_salary', array( 'fields' => 'names' ) ) ) && is_array( $salary ) ) {
                    echo '<div class="job-listing_single_job__salary"><i class="la la-money"></i><span>' . esc_html__( 'Monthly Salary : ', 'jobhunt' ) . '</span>' . jobhunt_get_wpjm_taxomony_data( $post, 'job_listing_salary' ) . '</div>';
                } ?>
                <div class="date-posted"><i class="la la-calendar"></i><?php the_job_publish_date(); ?></div>
                <?php jobhunt_display_the_deadline(); ?>
            </div>
            <?php if ( ( $type = wp_get_object_terms( $post->ID, 'job_listing_career_level', array( 'fields' => 'names' ) ) ) && is_array( $type ) ) {
                echo '<div class="job-listing_single_job__category"><label>' . esc_html__( 'Roles :', 'jobhunt' ) . '</label>' . jobhunt_get_wpjm_taxomony_data( $post, 'job_listing_career_level' ) . '</div>';
            } ?>
        </div>
    <?php }
}

/**
 * Show deadline on job pages
 */
if ( ! function_exists( 'jobhunt_display_the_deadline' ) ) {
    function jobhunt_display_the_deadline() {
        global $post;

        if ( jobhunt_is_wp_job_manager_application_deadline_activated() ) {
            if ( $deadline = get_post_meta( $post->ID, '_application_deadline', true ) ) {
                $expiring_days = apply_filters( 'job_manager_application_deadline_expiring_days', 2 );
                $expiring = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= $expiring_days );
                $expired  = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= 0 );

                if ( is_singular( 'job_listing' ) && $expired ) {
                    return;
                }

                echo '<div class="application-deadline ' . ( $expiring ? 'expiring' : '' ) . ' ' . ( $expired ? 'expired' : '' ) . '"><label>' . ( $expired ? esc_html__( 'Closed', 'jobhunt' ) : esc_html__( 'Closes', 'jobhunt' ) ) . ':</label> ' . date_i18n( esc_html__( 'M j, Y', 'jobhunt' ), strtotime( $deadline ) ) . '</div>';
            }
        }
    }
}

if ( ! function_exists( 'jobhunt_form_preview_job_remove_comment' ) ) {
    function jobhunt_form_preview_job_remove_comment() {
        remove_action( 'single_job_listing', 'jobhunt_display_comments', 99 );
    }
}
