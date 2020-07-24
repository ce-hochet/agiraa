<?php

class JH_WPJM_Job_Manager_CPT {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_types' ), 0 );
        add_filter( 'job_manager_settings', array( $this, 'job_manager_company_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 20 );
        add_filter( 'manage_company_posts_columns', array( $this, 'custom_company_columns' ) );
        add_action( 'manage_company_posts_custom_column' , array( $this, 'custom_company_column' ), 10, 2 );
    }

    public function admin_enqueue_scripts() {
        wp_enqueue_style( 'job_manager_admin_css', JOB_MANAGER_PLUGIN_URL . '/assets/css/admin.css', array(), JOB_MANAGER_VERSION );
        wp_enqueue_script( 'job_manager_admin_js', JOB_MANAGER_PLUGIN_URL . '/assets/js/admin.min.js', array( 'jquery', 'jquery-tiptip' ), JOB_MANAGER_VERSION, true );
    }


    public function custom_company_columns($columns) {
        unset( $columns['title'] );
        unset( $columns['date'] );
        $columns['company_image'] = '';
        $columns['title'] = esc_html__( 'Company Name', 'jobhunt-extensions' );
        $columns['date'] = esc_html__( 'Posted Date', 'jobhunt-extensions' );

        echo '<style type="text/css">';
        echo '.column-company_image { width:60px; box-sizing:border-box } .column-company_image img { max-width:100%; } @media (max-width: 768px) { .column-title,.column-company_image { display: table-cell !important; } .wp-list-table .is-expanded,.wp-list-table .column-primary .toggle-row { display:none !important } .wp-list-table td.column-primary { padding-right: 10px; } }';
        echo '</style>';

        return $columns;
    }

    // Add the data to the custom columns for the company post type:
    public function custom_company_column( $column, $post_id ) {
        switch ( $column ) {

            case 'company_image' :
                echo the_company_logo();
            break;

        }
    }

    public function register_post_types() {
        if ( post_type_exists( "company" ) ) {
            return;
        }

        $admin_capability = 'manage_job_listings';

        /**
         * Taxonomies
         */
        $singular  = esc_html__( 'Company category', 'jobhunt-extensions' );
        $plural    = esc_html__( 'Company categories', 'jobhunt-extensions' );

        $args = apply_filters( 'register_taxonomy_company_category_args', array(
                'hierarchical'          => true,
                'update_count_callback' => '_update_post_term_count',
                'label'                 => $plural,
                'labels'                => array(
                    'name'                  => $plural,
                    'singular_name'         => $singular,
                    'menu_name'             => ucwords( $plural ),
                    'search_items'          => sprintf( esc_html__( 'Search %s', 'jobhunt-extensions' ), $plural ),
                    'all_items'             => sprintf( esc_html__( 'All %s', 'jobhunt-extensions' ), $plural ),
                    'parent_item'           => sprintf( esc_html__( 'Parent %s', 'jobhunt-extensions' ), $singular ),
                    'parent_item_colon'     => sprintf( esc_html__( 'Parent %s:', 'jobhunt-extensions' ), $singular ),
                    'edit_item'             => sprintf( esc_html__( 'Edit %s', 'jobhunt-extensions' ), $singular ),
                    'update_item'           => sprintf( esc_html__( 'Update %s', 'jobhunt-extensions' ), $singular ),
                    'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'jobhunt-extensions' ), $singular ),
                    'new_item_name'         => sprintf( esc_html__( 'New %s Name', 'jobhunt-extensions' ),  $singular )
                ),
                'show_ui'               => true,
                'show_tagcloud'         => false,
                'public'                => true,
                'capabilities'          => array(
                    'manage_terms'          => $admin_capability,
                    'edit_terms'            => $admin_capability,
                    'delete_terms'          => $admin_capability,
                    'assign_terms'          => $admin_capability,
                ),
                'rewrite'               => array(
                    'slug'                  => esc_html_x( 'company-category', 'Company permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                    'with_front'            => false,
                    'hierarchical'          => true
                )
            )
        );

        register_taxonomy( 'company_category', 'company', $args );

        $singular  = esc_html__( 'Team size', 'jobhunt-extensions' );
        $plural    = esc_html__( 'Team sizes', 'jobhunt-extensions' );

        $args = apply_filters( 'register_taxonomy_company_team_size_args', array(
                'hierarchical'          => true,
                'label'                 => $plural,
                'labels'                => array(
                    'name'                  => $plural,
                    'singular_name'         => $singular,
                    'menu_name'             => ucwords( $plural ),
                    'search_items'          => sprintf( esc_html__( 'Search %s', 'jobhunt-extensions' ), $plural ),
                    'all_items'             => sprintf( esc_html__( 'All %s', 'jobhunt-extensions' ), $plural ),
                    'parent_item'           => sprintf( esc_html__( 'Parent %s', 'jobhunt-extensions' ), $singular ),
                    'parent_item_colon'     => sprintf( esc_html__( 'Parent %s:', 'jobhunt-extensions' ), $singular ),
                    'edit_item'             => sprintf( esc_html__( 'Edit %s', 'jobhunt-extensions' ), $singular ),
                    'update_item'           => sprintf( esc_html__( 'Update %s', 'jobhunt-extensions' ), $singular ),
                    'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'jobhunt-extensions' ), $singular ),
                    'new_item_name'         => sprintf( esc_html__( 'New %s Name', 'jobhunt-extensions' ),  $singular )
                ),
                'show_ui'               => true,
                'show_tagcloud'         => false,
                'public'                => true,
                'capabilities'          => array(
                    'manage_terms'          => $admin_capability,
                    'edit_terms'            => $admin_capability,
                    'delete_terms'          => $admin_capability,
                    'assign_terms'          => $admin_capability,
                ),
                'rewrite'               => array(
                    'slug'                  => esc_html_x( 'company-team-size', 'Company permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                    'with_front'            => false,
                    'hierarchical'          => true
                )
            )
        );

        register_taxonomy( 'company_team_size', 'company', $args );

        /**
         * Post types
         */
        $singular  = esc_html__( 'Company', 'jobhunt-extensions' );
        $plural    = esc_html__( 'Companies', 'jobhunt-extensions' );

        $has_archive = esc_html_x( 'companies', 'Post type archive slug - resave permalinks after changing this', 'jobhunt-extensions' );

        $rewrite     = array(
            'slug'       => esc_html_x( 'company', 'Company permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
            'with_front' => false,
            'feeds'      => true,
            'pages'      => false
        );

        register_post_type( "company",
            apply_filters( "register_post_type_company", array(
                'labels'                => array(
                    'name'                  => $plural,
                    'singular_name'         => $singular,
                    'menu_name'             => $plural,
                    'all_items'             => sprintf( esc_html__( 'All %s', 'jobhunt-extensions' ), $plural ),
                    'add_new'               => esc_html__( 'Add New', 'jobhunt-extensions' ),
                    'add_new_item'          => sprintf( esc_html__( 'Add %s', 'jobhunt-extensions' ), $singular ),
                    'edit'                  => esc_html__( 'Edit', 'jobhunt-extensions' ),
                    'edit_item'             => sprintf( esc_html__( 'Edit %s', 'jobhunt-extensions' ), $singular ),
                    'new_item'              => sprintf( esc_html__( 'New %s', 'jobhunt-extensions' ), $singular ),
                    'view'                  => sprintf( esc_html__( 'View %s', 'jobhunt-extensions' ), $singular ),
                    'view_item'             => sprintf( esc_html__( 'View %s', 'jobhunt-extensions' ), $singular ),
                    'search_items'          => sprintf( esc_html__( 'Search %s', 'jobhunt-extensions' ), $plural ),
                    'not_found'             => sprintf( esc_html__( 'No %s found', 'jobhunt-extensions' ), $plural ),
                    'not_found_in_trash'    => sprintf( esc_html__( 'No %s found in trash', 'jobhunt-extensions' ), $plural ),
                    'parent'                => sprintf( esc_html__( 'Parent %s', 'jobhunt-extensions' ), $singular )
                ),
                'description'           => sprintf( esc_html__( 'This is where you can create and manage %s.', 'jobhunt-extensions' ), $plural ),
                'public'                => true,
                'show_ui'               => class_exists( 'WP_Job_Manager' ),
                'menu_icon'             => 'dashicons-building',
                'capability_type'       => 'post',
                'capabilities' => array(
                    'publish_posts'         => $admin_capability,
                    'edit_posts'            => $admin_capability,
                    'edit_others_posts'     => $admin_capability,
                    'delete_posts'          => $admin_capability,
                    'delete_others_posts'   => $admin_capability,
                    'read_private_posts'    => $admin_capability,
                    'edit_post'             => $admin_capability,
                    'delete_post'           => $admin_capability,
                    'read_post'             => $admin_capability
                ),
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'hierarchical'          => false,
                'rewrite'               => $rewrite,
                'query_var'             => true,
                'supports'              => array( 'title', 'editor', 'custom-fields', 'publicize', 'thumbnail' ),
                'has_archive'           => $has_archive,
                'show_in_nav_menus'     => false
            ) )
        );
    }

    public function job_manager_company_settings( $settings ) {
        if ( post_type_exists( "company" ) ) {
            $settings['company'] = array(
                esc_html__( 'Company', 'jobhunt-extensions' ),
                array(
                    array(
                        'name'        => 'job_manager_companies_per_page',
                        'std'         => '10',
                        'placeholder' => '',
                        'label'       => esc_html__( 'Listings Per Page', 'jobhunt-extensions' ),
                        'desc'        => esc_html__( 'Number of job listings to display per page.', 'jobhunt-extensions' ),
                        'attributes'  => array()
                    ),
                    array(
                        'name'      => 'job_manager_companies_page_id',
                        'std'       => '',
                        'label'     => esc_html__( 'Company Listings Page', 'jobhunt-extensions' ),
                        'desc'      => esc_html__( 'Select the page for company listing. This lets the plugin know the location of the company listings page.', 'jobhunt-extensions' ),
                        'type'      => 'page'
                    ),
                    array(
                        'name'      => 'job_manager_companies_listing_style',
                        'std'       => 'v1',
                        'label'     => esc_html__( 'Company Listings Style', 'jobhunt-extensions' ),
                        'desc'      => esc_html__( 'Select the style for company listing style. This lets the plugin know the style of company listings.', 'jobhunt-extensions' ),
                        'type'      => 'select',
                        'options'   => array(
                            'v1'        => esc_html__( 'Style v1', 'jobhunt-extensions' ),
                            'v2'        => esc_html__( 'Style v2', 'jobhunt-extensions' ),
                            'v3'        => esc_html__( 'Style v3', 'jobhunt-extensions' ),
                        )
                    ),
                    array(
                        'name'      => 'job_manager_companies_listing_sidebar',
                        'std'       => 'left-sidebar',
                        'label'     => esc_html__( 'Company Listings Sidebar', 'jobhunt-extensions' ),
                        'desc'      => esc_html__( 'Select the position for company listing sidebar. This lets the plugin know the position of company listings sidebar.', 'jobhunt-extensions' ),
                        'type'      => 'select',
                        'options'   => array(
                            'left-sidebar'      => esc_html__( 'Left Sidebar', 'jobhunt-extensions' ),
                            'right-sidebar'     => esc_html__( 'Right Sidebar', 'jobhunt-extensions' ),
                            'full-width'        => esc_html__( 'Full Width', 'jobhunt-extensions' ),
                        )
                    ),
                    array(
                        'name'      => 'job_manager_single_company_style',
                        'std'       => 'v1',
                        'label'     => esc_html__( 'Single Company Style', 'jobhunt-extensions' ),
                        'desc'      => esc_html__( 'Select the style for single company style. This lets the plugin know the style of single company.', 'jobhunt-extensions' ),
                        'type'      => 'select',
                        'options'   => array(
                            'v1'        => esc_html__( 'Style v1', 'jobhunt-extensions' ),
                            'v2'        => esc_html__( 'Style v2', 'jobhunt-extensions' ),
                        )
                    ),
                    array(
                        'name'      => 'job_manager_single_company_contact_form',
                        'std'       => '',
                        'label'     => esc_html__( 'Single Company Contact Form', 'jobhunt-extensions' ),
                        'desc'      => esc_html__( 'Select the form for single company contact form. This lets the plugin know the contact form of single company.', 'jobhunt-extensions' ),
                        'type'      => 'select',
                        'options'   => function_exists( 'jobhunt_get_forms' ) ? jobhunt_get_forms() : array( 0 => esc_html__( 'Please select a form', 'jobhunt-extensions' ) )
                    ),
                ),
            );
        }

        return $settings;
    }
}

return new JH_WPJM_Job_Manager_CPT();