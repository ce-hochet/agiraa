<?php

if ( jobhunt_is_wp_job_manager_alert_activated() ) {
    global $job_manager_alerts;
    remove_filter( 'job_manager_job_filters_showing_jobs_links', array( $job_manager_alerts, 'alert_link' ), 10, 2 );
    add_action( 'jobhunt_modify_single_job_listing_hooks_before', 'jobhunt_modify_wp_job_manager_alert_hooks' );

    if ( ! function_exists( 'jobhunt_modify_wp_job_manager_alert_hooks' ) ) {
        function jobhunt_modify_wp_job_manager_alert_hooks( $style ) {
            global $job_manager_alerts;
            $wpjm_alerts_proirity = 15;
            if ( $style == 'v2' ) {
                $wpjm_alerts_proirity = 30;
            } elseif ( $style == 'v3' ) {
                $wpjm_alerts_proirity = 5;
            }
            remove_action( 'single_job_listing_end', array( $job_manager_alerts, 'single_alert_link' ) );
            add_action( 'single_job_listing_sidebar', array( $job_manager_alerts, 'single_alert_link' ), $wpjm_alerts_proirity );
        }
    }
}

if ( jobhunt_is_wp_job_manager_applications_activated() ) {
    if ( ! function_exists( 'jobhunt_job_applications_past_logged_out_notification' ) ) {
        function jobhunt_job_applications_past_logged_out_notification() {
            if( ! is_user_logged_in() ) {
                ?><div id="job-manager-past-applications">
                    <p class="account-sign-in"><?php esc_html_e( 'You need to be signed in to manage your past applications.', 'jobhunt' ); ?> <a class="button" href="<?php echo esc_url( apply_filters( 'job_manager_past_applications_login_url', wp_login_url( get_permalink() ) ) ); ?>"><?php esc_html_e( 'Sign in', 'jobhunt' ); ?></a></p>
                </div>
                <?php
            }
        }
    }
    add_action( 'job_manager_job_applications_past_logged_out', 'jobhunt_job_applications_past_logged_out_notification', 25 );

    add_filter( 'job_manager_job_application_login_url', 'jobhunt_submit_job_form_login_url' );
    add_filter( 'job_manager_past_applications_login_url', 'jobhunt_submit_job_form_login_url' );
}

if ( jobhunt_is_wp_job_manager_bookmark_activated() ) {
    add_filter( 'job_manager_bookmark_form_login_url', 'jobhunt_submit_job_form_login_url' );

    add_action( 'jobhunt_modify_single_job_listing_hooks_before', 'jobhunt_modify_wp_job_manager_bookmark_hooks' );

    if ( ! function_exists( 'jobhunt_modify_wp_job_manager_bookmark_hooks' ) ) {
        function jobhunt_modify_wp_job_manager_bookmark_hooks( $style ) {
            global $job_manager_bookmarks;
            $wpjm_bookmark_proirity = 15;
            if ( $style == 'v2' ) {
                $wpjm_bookmark_proirity = 30;
            } elseif ( $style == 'v3' ) {
                $wpjm_bookmark_proirity = 5;
            }
            remove_action( 'single_job_listing_meta_after', array( $job_manager_bookmarks, 'bookmark_form' ) );
            add_action( 'single_job_listing_sidebar', array( $job_manager_bookmarks, 'bookmark_form' ), $wpjm_bookmark_proirity );
        }
    }
}

if ( jobhunt_is_wp_job_manager_claim_listing_activated() ) {
    add_filter( 'wpjmcl_job-listing_front_css', '__return_false' );
    add_action( 'jobhunt_modify_single_job_listing_hooks_before', 'jobhunt_modify_wp_job_manager_claim_listing_hooks' );
    add_filter( 'single_job_listing_meta_end', 'jobhunt_add_claim_link' );

    if ( ! function_exists( 'jobhunt_modify_wp_job_manager_claim_listing_hooks' ) ) {
        function jobhunt_modify_wp_job_manager_claim_listing_hooks() {
            $setup = wpjmcl\job_listing\Setup::get_instance();
            remove_action( 'single_job_listing_start', array( $setup, 'add_claim_link' ) );
        }
    }

    if ( ! function_exists( 'jobhunt_add_claim_link' ) ) {
        function jobhunt_add_claim_link( $list = true ) {
            $setup = wpjmcl\job_listing\Setup::get_instance();
            ob_start();
            $setup->add_claim_link();
            $claim = ob_get_clean();
            
            if ( $list !== false ) {
                echo '<li class="claim-link">' . $claim . '</li>';
            } else {
                echo '<div class="claim-link">' . $claim . '</div>';
            }
        }
    }
}

if( ! function_exists( 'jobhunt_wc_account_menu_item_classes' ) ) {
    function jobhunt_wc_account_menu_item_classes( $classes, $endpoint ) {
        global $post;

        if ( jobhunt_is_woocommerce_subscriptions_activated() ) {
            $post_slug = $post->post_name;
            if( $post_slug == 'subscriptions' ) {
                if( $endpoint == 'subscriptions' ) {
                    $classes[] = 'is-active';
                } else {
                    if ( ( $key = array_search( 'is-active', $classes ) ) !== false ) {
                        unset( $classes[$key] );
                    }
                }
            }
        }

        return $classes;
    }
}
add_filter( 'woocommerce_account_menu_item_classes', 'jobhunt_wc_account_menu_item_classes', 10, 2 );

if ( jobhunt_is_wp_job_manager_ziprecruiter_activated() || jobhunt_is_wp_job_manager_indeed_integration_activated() ) {  
    if( ! function_exists( 'jobhunt_wp_job_manager_get_listings_result_start' ) ) {
        function jobhunt_wp_job_manager_get_listings_result_start() {
            ob_start();
        }
    }

    if( ! function_exists( 'jobhunt_wp_job_manager_get_listings_result_end' ) ) {
        function jobhunt_wp_job_manager_get_listings_result_end() {
            global $wp_query, $jh_wpjm_loop;

            $result = array();

            if( ! have_posts() ) {
                $no_jobs_found = ob_get_clean();
                $result['html'] = '';
            } else {
                $result['html'] = ob_get_clean();
            }

            if ( $jh_wpjm_loop['total'] > 0 ){
                $result['found_jobs'] = true;
            } else {
                $result['found_jobs'] = false;
            }

            $result['max_num_pages'] = $jh_wpjm_loop['total_pages'];
            $default_job_type = jobhunt_is_wp_job_manager_indeed_integration_activated() ? (array) get_job_listing_types( 'names' ) : array();

            $_REQUEST['page']    = $jh_wpjm_loop['current_page'];
            $_REQUEST['filter_job_type']   = isset( $_GET[ 'filter_job_listing_type' ] ) ? explode( ',', jobhunt_clean( wp_unslash( $_GET[ 'filter_job_listing_type' ] ) ) ) : $default_job_type;
            $_REQUEST['search_location']   = isset( $_GET['search_location'] ) ? jobhunt_clean( wp_unslash( $_GET['search_location'] ) ) : null;
            $_REQUEST['search_categories'] = isset( $_GET[ 'search_category' ] ) ? explode( ',', jobhunt_clean( wp_unslash( $_GET[ 'search_category' ] ) ) ) : array();
            $_REQUEST['search_keywords']   = isset( $_GET['s'] ) ? jobhunt_clean( wp_unslash( $_GET['s'] ) ) : null;

            $output = WP_Job_Manager_Importer_Integration::job_manager_get_listings_result( $result, $wp_query );
            if( ! have_posts() ) {
                if( ! empty( $output['html'] ) ) {
                    get_job_manager_template( 'job-listings-start.php' );
                    echo $output['html'];
                    get_job_manager_template( 'job-listings-end.php' );
                } else {
                    echo $no_jobs_found;
                }
            } else {
                echo $output['html'];
            }
        }
    }

    add_filter( 'job_manager_indeed_geolocate_country', '__return_false' );

    add_action( 'jobhunt_job_listing_loop_start', 'jobhunt_wp_job_manager_get_listings_result_start', 0 );
    add_action( 'jobhunt_job_listing_loop_end', 'jobhunt_wp_job_manager_get_listings_result_end', 999 );

    add_action( 'jobhunt_no_jobs_found', 'jobhunt_wp_job_manager_get_listings_result_start', 0 );
    add_action( 'jobhunt_no_jobs_found', 'jobhunt_wp_job_manager_get_listings_result_end', 999 );
}

if ( jobhunt_is_astoundify_job_manager_reviews_activated() ) {
    //add comment on single job
    add_action( 'single_job_listing', 'jobhunt_display_comments', 99 );

    if ( ! function_exists ( 'jh_child_register_post_type_job_listing_enable_comments' ) ) {
        function jh_child_register_post_type_job_listing_enable_comments( $post_type ) {
            $post_type['supports'][] = 'comments';
            return $post_type;
        }
    }
    add_filter( 'register_post_type_job_listing', 'jh_child_register_post_type_job_listing_enable_comments' );

    if ( ! function_exists ( 'jobhunt_submit_job_form_save_job_data' ) ) {
        function jobhunt_submit_job_form_save_job_data( $data ) {
            $data['comment_status'] = 'open';
            return $data;
        }
    }
    add_filter( 'submit_job_form_save_job_data', 'jobhunt_submit_job_form_save_job_data' );
}
