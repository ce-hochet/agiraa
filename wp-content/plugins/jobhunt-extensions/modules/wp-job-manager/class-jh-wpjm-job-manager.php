<?php

class JH_WPJM_Job_Manager {

    public function __construct() {

        if ( $this->is_wpjm_activated() ) {
            add_action( 'init', array( $this, 'register_taxonomies' ) );
            remove_shortcode( 'jobs' );
            add_shortcode( 'jobs', array( $this, 'output_jobs' ) );

            include_once( dirname( __FILE__ ) . '/class-jh-wpjm-job-manager-company.php' );
            include_once( dirname( __FILE__ ) . '/class-jh-wpjm-job-manager-resume.php' );
        }
    }

    public function is_wpjm_activated() {
        return class_exists( 'WP_Job_Manager' ) ? true : false;
    }

    public function register_taxonomies() {
        if ( ! post_type_exists( 'job_listing' ) ) {
            return;
        }

        $admin_capability = 'manage_job_listings';

        /**
         * Taxonomies
         */
        $taxonomies_args = apply_filters( 'jobhunt_job_listing_taxonomies_list', array(
            'job_listing_salary'        => array(
                'singular'                  => esc_html__( 'Job Salary', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Salaries', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-salary', 'Job salary permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_salary', true)
            ),
            'job_listing_career_level'  => array(
                'singular'                  => esc_html__( 'Job Career Level', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Career level', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-career-level', 'Job career level permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_career_level', true)
            ),
            'job_listing_experience'    => array(
                'singular'                  => esc_html__( 'Job Experience', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Experience', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-experience', 'Job experience permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_experience', true)
            ),
            'job_listing_gender'        => array(
                'singular'                  => esc_html__( 'Job Gender', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Gender', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-gender', 'Job gender permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_gender', true)
            ),
            'job_listing_industry'      => array(
                'singular'                  => esc_html__( 'Job Industry', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Industries', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-industry', 'Job industry permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_industry', true)
            ),
            'job_listing_qualification' => array(
                'singular'                  => esc_html__( 'Job Qualification', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Job Qualification', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'job-qualification', 'Job qualification permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('job_manager_enable_qualification', true)
            )
        ) );

        foreach ( $taxonomies_args as $taxonomy_name => $taxonomy_args ) {
            if( $taxonomy_args['enable'] ) {
                $singular  = $taxonomy_args['singular'];
                $plural    = $taxonomy_args['plural'];
                $slug      = $taxonomy_args['slug'];

                $args = apply_filters( 'register_taxonomy_{$taxonomy_name}_args', array(
                        'hierarchical'      => true,
                        'update_count_callback' => '_update_post_term_count',
                        'label'             => $plural,
                        'labels'            => array(
                            'name'              => $plural,
                            'singular_name'     => $singular,
                            'menu_name'         => ucwords( $plural ),
                            'search_items'      => sprintf( esc_html__( 'Search %s', 'jobhunt-extensions' ), $plural ),
                            'all_items'         => sprintf( esc_html__( 'All %s', 'jobhunt-extensions' ), $plural ),
                            'parent_item'       => sprintf( esc_html__( 'Parent %s', 'jobhunt-extensions' ), $singular ),
                            'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'jobhunt-extensions' ), $singular ),
                            'edit_item'         => sprintf( esc_html__( 'Edit %s', 'jobhunt-extensions' ), $singular ),
                            'update_item'       => sprintf( esc_html__( 'Update %s', 'jobhunt-extensions' ), $singular ),
                            'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'jobhunt-extensions' ), $singular ),
                            'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'jobhunt-extensions' ),  $singular )
                        ),
                        'show_ui'               => true,
                        'show_in_rest'          => true,
                        'show_tagcloud'         => false,
                        'public'                => true,
                        'capabilities'          => array(
                            'manage_terms'      => $admin_capability,
                            'edit_terms'        => $admin_capability,
                            'delete_terms'      => $admin_capability,
                            'assign_terms'      => $admin_capability,
                        ),
                        'rewrite'           => array(
                            'slug'          => $slug,
                            'with_front'    => false,
                            'hierarchical'  => true
                        )
                    )
                );

                register_taxonomy( $taxonomy_name, 'job_listing', $args );
            }
        }
    }

    public function output_jobs( $atts ) {
        global $wpjm_jobs_query;
        
        ob_start();

        extract( $atts = shortcode_atts( apply_filters( 'job_manager_output_jobs_defaults', array(
            'per_page'                  => get_option( 'job_manager_per_page' ),
            'orderby'                   => 'featured',
            'order'                     => 'DESC',
            'view'                      => 'list',

            // Filters + cats
            'show_filters'              => true,
            'show_categories'           => true,
            'show_category_multiselect' => get_option( 'job_manager_enable_default_category_multiselect', false ),
            'show_pagination'           => false,
            'show_more'                 => true,

            // Limit what jobs are shown based on category, post status, and type
            'categories'                => '',
            'job_types'                 => '',
            'post_status'               => '',
            'featured'                  => null, // True to show only featured, false to hide featured, leave null to show both.
            'filled'                    => null, // True to show only filled, false to hide filled, leave null to show both/use the settings.

            // Default values for filters
            'location'                  => '',
            'keywords'                  => '',
            'selected_category'         => '',
            'selected_job_types'        => implode( ',', array_values( get_job_listing_types( 'id=>slug' ) ) ),

        ) ), $atts ) );

        if ( ! get_option( 'job_manager_enable_categories' ) ) {
            $show_categories = false;
        }

        // String and bool handling
        $show_filters              = $this->string_to_bool( $show_filters );
        $show_categories           = $this->string_to_bool( $show_categories );
        $show_category_multiselect = $this->string_to_bool( $show_category_multiselect );
        $show_more                 = $this->string_to_bool( $show_more );
        $show_pagination           = $this->string_to_bool( $show_pagination );

        if ( ! is_null( $featured ) ) {
            $featured = ( is_bool( $featured ) && $featured ) || in_array( $featured, array( '1', 'true', 'yes' ) ) ? true : false;
        }

        if ( ! is_null( $filled ) ) {
            $filled = ( is_bool( $filled ) && $filled ) || in_array( $filled, array( '1', 'true', 'yes' ) ) ? true : false;
        }

        // Array handling
        $categories         = is_array( $categories ) ? $categories : array_filter( array_map( 'trim', explode( ',', $categories ) ) );
        $job_types          = is_array( $job_types ) ? $job_types : array_filter( array_map( 'trim', explode( ',', $job_types ) ) );
        $post_status        = is_array( $post_status ) ? $post_status : array_filter( array_map( 'trim', explode( ',', $post_status ) ) );
        $selected_job_types = is_array( $selected_job_types ) ? $selected_job_types : array_filter( array_map( 'trim', explode( ',', $selected_job_types ) ) );

        // Get keywords and location from querystring if set
        if ( ! empty( $_GET['search_keywords'] ) ) {
            $keywords = sanitize_text_field( $_GET['search_keywords'] );
        }
        if ( ! empty( $_GET['search_location'] ) ) {
            $location = sanitize_text_field( $_GET['search_location'] );
        }
        if ( ! empty( $_GET['search_category'] ) ) {
            $selected_category = sanitize_text_field( $_GET['search_category'] );
        }

        $data_attributes        = array(
            'location'        => $location,
            'keywords'        => $keywords,
            'show_filters'    => $show_filters ? 'true' : 'false',
            'show_pagination' => $show_pagination ? 'true' : 'false',
            'per_page'        => $per_page,
            'orderby'         => $orderby,
            'order'           => $order,
            'categories'      => implode( ',', $categories ),
        );
        if ( $show_filters ) {

            get_job_manager_template( 'job-filters.php', array( 'per_page' => $per_page, 'orderby' => $orderby, 'order' => $order, 'show_categories' => $show_categories, 'categories' => $categories, 'selected_category' => $selected_category, 'job_types' => $job_types, 'atts' => $atts, 'location' => $location, 'keywords' => $keywords, 'selected_job_types' => $selected_job_types, 'show_category_multiselect' => $show_category_multiselect ) );

            get_job_manager_template( 'job-listings-start.php', array( 'atts' => $atts ) );
            get_job_manager_template( 'job-listings-end.php' );

            if ( ! $show_pagination && $show_more ) {
                echo '<a class="load_more_jobs" href="#" style="display:none;"><strong>' . esc_html__( 'Load more listings', 'jobhunt-extensions' ) . '</strong></a>';
            }

        } else {
            $jobs = get_job_listings( apply_filters( 'job_manager_output_jobs_args', array(
                'search_location'   => $location,
                'search_keywords'   => $keywords,
                'post_status'       => $post_status,
                'search_categories' => $categories,
                'job_types'         => $job_types,
                'orderby'           => $orderby,
                'order'             => $order,
                'posts_per_page'    => $per_page,
                'featured'          => $featured,
                'filled'            => $filled
            ) ) );

            if ( ! empty( $job_types ) ) {
                $data_attributes[ 'job_types' ] = implode( ',', $job_types );
            }

            if ( $jobs->have_posts() ) : ?>

                <?php do_action( 'jh_wpjm_before_shortcode_job_listings_start', $jobs, $atts ); ?>
                
                <?php get_job_manager_template( 'job-listings-start.php', array( 'atts' => $atts ) ); ?>

                <?php while ( $jobs->have_posts() ) : $jobs->the_post(); ?>
                    <?php get_job_manager_template_part( 'content', 'job_listing' ); ?>
                <?php endwhile; ?>

                <?php get_job_manager_template( 'job-listings-end.php' ); ?>

                <?php if ( $jobs->found_posts > $per_page && $show_more ) : ?>

                    <?php wp_enqueue_script( 'wp-job-manager-ajax-filters' ); ?>

                    <?php if ( $show_pagination ) : ?>
                        <?php echo get_job_listing_pagination( $jobs->max_num_pages ); ?>
                    <?php else : ?>
                        <a class="load_more_jobs" href="#"><strong><?php esc_html_e( 'Load more listings', 'jobhunt-extensions' ); ?></strong></a>
                    <?php endif; ?>

                <?php endif; ?>

            <?php else :
                do_action( 'job_manager_output_jobs_no_results' );
            endif;

            wp_reset_postdata();
        }

        $data_attributes_string = '';
        if ( ! is_null( $featured ) ) {
            $data_attributes[ 'featured' ]    = $featured ? 'true' : 'false';
        }
        if ( ! is_null( $filled ) ) {
            $data_attributes[ 'filled' ]      = $filled ? 'true' : 'false';
        }
        if ( ! empty( $post_status ) ) {
            $data_attributes[ 'post_status' ] = implode( ',', $post_status );
        }
        foreach ( $data_attributes as $key => $value ) {
            $data_attributes_string .= 'data-' . esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
        }

        $job_listings_output = apply_filters( 'job_manager_job_listings_output', ob_get_clean() );

        return '<div class="job_listings" ' . $data_attributes_string . '>' . $job_listings_output . '</div>';
    }

    /**
     * Gets string as a bool.
     *
     * @param  string $value
     * @return bool
     */
    public function string_to_bool( $value ) {
        return ( is_bool( $value ) && $value ) || in_array( $value, array( '1', 'true', 'yes' ) ) ? true : false;
    }
}

global $jh_wpjm_job_manager;
$jh_wpjm_job_manager = new JH_WPJM_Job_Manager();