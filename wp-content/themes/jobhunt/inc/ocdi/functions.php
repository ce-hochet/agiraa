<?php

function jobhunt_ocdi_import_files() {
    $dd_path    = jobhunt_is_wp_resume_manager_activated() ? trailingslashit( get_template_directory() ) . 'assets/dummy-data/demo/' : trailingslashit( get_template_directory() ) . 'assets/dummy-data/demo-without-core-addon-bundle/';
    $dd_path_el = trailingslashit( get_template_directory() ) . 'assets/dummy-data/elementor/';

    $import_files = array(
        array(
            'import_file_name'             => 'Jobhunt',
            'categories'                   => array( 'Jobs' ),
            'local_import_file'            => $dd_path . 'dummy-data.xml',
            'local_import_widget_file'     => $dd_path . 'widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => $dd_path . 'redux-options.json',
                    'option_name' => 'jobhunt_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'screenshot.png',
            'import_notice'                => esc_html__( 'Import process may take 3-5 minutes. If you facing any issues please contact our support.', 'jobhunt' ),
            'preview_url'                  => 'https://demo.chethemes.com/jobhunt/',
        )
    );

    if ( jobhunt_is_elementor_activated() ) {
        $import_files[] = array(
            'import_file_name'             => 'Jobhunt - Elementor',
            'categories'                   => array( 'Jobs' ),
            'local_import_file'            => $dd_path_el . 'dummy-data.xml',
            'local_import_widget_file'     => $dd_path_el . 'widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => $dd_path_el . 'redux-options.json',
                    'option_name' => 'jobhunt_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'screenshot.png',
            'import_notice'                => esc_html__( 'Import process may take 3-5 minutes. If you facing any issues please contact our support.', 'jobhunt' ),
            'preview_url'                  => 'https://demo.chethemes.com/jobhunt/',
        );
    }

    return apply_filters( 'jobhunt_ocdi_files_args', $import_files );
}

function jobhunt_ocdi_before_content_import( $selected_import ) {
    update_option( 'job_manager_enable_categories', 1 );
    update_option( 'job_manager_enable_types', 1 );
    update_option( 'resume_manager_enable_categories', 1 );
    update_option( 'resume_manager_enable_skills', 1 );
}

function jobhunt_ocdi_after_import_setup( $selected_import ) {
    
    // Assign menus to their locations.
    $top_bar_left       = get_term_by( 'name', 'Top Bar Left', 'nav_menu' );
    $top_bar_right      = get_term_by( 'name', 'Top Bar Right', 'nav_menu' );
    $primary_nav        = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'top_bar_left'      => $top_bar_left->term_id,
            'top_bar_right'     => $top_bar_right->term_id,
            'primary-nav'       => $primary_nav->term_id,
            'handheld'          => $primary_nav->term_id,
        )
    );

    // Assign front page and posts page (blog page)
    $front_page_id      = get_page_by_title( 'Home v1' );
    $blog_page_id       = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Assign pages for WP Job Manager
    $jobs_page_id                   = get_page_by_title( 'Jobs' );
    $job_dashboard_page_id          = get_page_by_title( 'Job Dashboard' );
    $submit_job_page_id             = get_page_by_title( 'Post a Job' );

    $companies_page_id              = get_page_by_title( 'Employers' );

    $resumes_page_id                = get_page_by_title( 'Resumes' );
    $candidate_dashboard_page_id    = get_page_by_title( 'Candidate Dashboard' );
    $submit_resume_page_id          = get_page_by_title( 'Submit Resume' );

    update_option( 'job_manager_jobs_page_id', $jobs_page_id->ID );
    update_option( 'job_manager_job_dashboard_page_id', $job_dashboard_page_id->ID );
    update_option( 'job_manager_submit_job_form_page_id', $submit_job_page_id->ID );

    update_option( 'job_manager_companies_page_id', $companies_page_id->ID );

    update_option( 'resume_manager_resumes_page_id', $resumes_page_id->ID );
    update_option( 'resume_manager_candidate_dashboard_page_id', $candidate_dashboard_page_id->ID );
    update_option( 'resume_manager_submit_resume_form_page_id', $submit_resume_page_id->ID );

    // Enable Registration on site
    update_option( 'users_can_register', 1 );

    if ( jobhunt_is_woocommerce_activated() ) {
        // Assign WooCommerce pages
        $shop_page_id       = get_page_by_title( 'Shop' );
        $cart_page_id       = get_page_by_title( 'Cart' );
        $checkout_page_id   = get_page_by_title( 'Checkout' );
        $myaccount_page_id  = get_page_by_title( 'My Account' );
        $terms_page_id      = get_page_by_title( 'Terms and Conditions' );

        update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
        update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
        update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
        update_option( 'woocommerce_myaccount_page_id', $myaccount_page_id->ID );
        update_option( 'woocommerce_terms_page_id', $terms_page_id->ID );
        
        // Enable Registration on "My Account" page
        update_option( 'woocommerce_enable_myaccount_registration', 'yes' );

        if ( function_exists( 'wc_delete_product_transients' ) ) {
            wc_delete_product_transients();
        }
        if ( function_exists( 'wc_delete_shop_order_transients' ) ) {
            wc_delete_shop_order_transients();
        }
        if ( function_exists( 'wc_delete_expired_transients' ) ) {
            wc_delete_expired_transients();
        }
    }

    jobhunt_ocdi_import_wpforms();

    // Set Visualcomposer Builder for Static Blocks
    if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
        vc_set_default_editor_post_types( array( 'page', 'static_block' ) );
    }

    // Flush rewrite rules
    if ( function_exists( 'flush_rewrite_rules' ) ) {
        flush_rewrite_rules();
    }
}

function jobhunt_ocdi_before_widgets_import() {

    $sidebars_widgets = get_option('sidebars_widgets');
    $all_widgets = array();

    array_walk_recursive( $sidebars_widgets, function ($item, $key) use ( &$all_widgets ) {
        if( ! isset( $all_widgets[$key] ) ) {
            $all_widgets[$key] = $item;
        } else {
            $all_widgets[] = $item;
        }
    } );

    if( isset( $all_widgets['array_version'] ) ) {
        $array_version = $all_widgets['array_version'];
        unset( $all_widgets['array_version'] );
    }

    $new_sidebars_widgets = array_fill_keys( array_keys( $sidebars_widgets ), array() );

    $new_sidebars_widgets['wp_inactive_widgets'] = $all_widgets;
    if( isset( $array_version ) ) {
        $new_sidebars_widgets['array_version'] = $array_version;
    }

    update_option( 'sidebars_widgets', $new_sidebars_widgets );
}

function jobhunt_kc_force_enable_static_block() {
    if( class_exists( 'KingComposer' ) && apply_filters( 'jobhunt_kc_force_enable_static_block', true ) ) {
        global $kc;
        $kc->add_content_type( 'static_block' );
    }
}


function jobhunt_ocdi_import_wpforms() {
    if ( ! function_exists( 'wpforms' ) ) {
        return;
    }

    $forms = [
        [
            'file' => 'wpforms-contact-form.json'
        ],
        [
            'file' => 'wpforms-newsletter-form.json'
        ],
    ];

    foreach ( $forms as $form ) {
        ob_start();
        jobhunt_get_template( $form['file'], array(), 'assets/dummy-data/wpforms/' );
        $form_json = ob_get_clean();
        $form_data = json_decode( $form_json, true );

        if ( empty( $form_data[0] ) ) {
            continue;
        }
        $form_data = $form_data[0];
        $form_title = $form_data['settings']['form_title'];

        if( !empty( $form_data['id'] ) ) {
            $form_content = array(
                'field_id' => '0',
                'settings' => array(
                    'form_title' => sanitize_text_field( $form_title ),
                    'form_desc'  => '',
                ),
            );

            // Merge args and create the form.
            $form = array(
                'import_id'     => (int) $form_data['id'],
                'post_title'    => esc_html( $form_title ),
                'post_status'   => 'publish',
                'post_type'     => 'wpforms',
                'post_content'  => wpforms_encode( $form_content ),
            );

            $form_id = wp_insert_post( $form );
        } else {
            // Create initial form to get the form ID.
            $form_id   = wpforms()->form->add( $form_title );
        }

        if ( empty( $form_id ) ) {
            continue;
        }

        $form_data['id'] = $form_id;
        // Save the form data to the new form.
        wpforms()->form->update( $form_id, $form_data );
    }
}