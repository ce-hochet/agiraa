<?php
/**
 * Jobhunt WP Job Manager Class
 *
 * @package  jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Jobhunt_WPJM' ) ) :

    /**
     * The Jobhunt WooCommerce Integration class
     */
    class Jobhunt_WPJM {

        public function __construct() {
            $this->includes();
            add_filter( 'body_class', array( $this, 'wpjm_body_class' ) );
            add_filter( 'job_manager_enqueue_frontend_style', '__return_false', 30 );
            add_action( 'wp_enqueue_scripts', array( $this, 'wpjm_remove_job_manger_style' ), 20 );
            add_action( 'jobhunt_sidebar_args', array( $this, 'sidebar_register' ) );
            add_action( 'widgets_init', array( $this, 'widgets_register' ) );
            add_filter( 'job_manager_settings', array( $this, 'job_manager_modified_settings' ) );

            add_action( 'wp_ajax_jobhunt_live_search_jobs_suggest', array( __CLASS__, 'live_search_jobs_suggest' ) );
            add_action( 'wp_ajax_nopriv_jobhunt_live_search_jobs_suggest', array( __CLASS__, 'live_search_jobs_suggest' ) );

            // Add options for Job Categories
            add_action( "job_listing_category_add_form_fields",         array( $this, 'add_category_fields' ), 10 );
            add_action( "job_listing_category_edit_form_fields",        array( $this, 'edit_category_fields' ), 10, 2 );
            add_action( 'create_job_listing_category',                  array( $this, 'save_category_fields' ), 10, 3 );
            add_action( 'edited_job_listing_category',                  array( $this, 'save_category_fields' ), 10, 3 );
        }

        public function includes() {
            include_once get_template_directory() . '/inc/wp-job-manager/class-jh-wpjm-template-loader.php';
        }

        public function wpjm_body_class( $classes ) {
            if ( jobhunt_is_wp_job_manager_activated() ) {
                $classes[] = 'wpjm-activated';
            }

            if( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) || is_job_listing_taxonomy() ) {
                $classes[] = 'post-type-archive-job_listing';
                
                $job_listing_type = jobhunt_get_wpjm_style();
                if ( ! empty ( $job_listing_type ) ) {
                    $classes[] = 'type-' . $job_listing_type;
                }

                $blog_style = jobhunt_get_blog_style();
                if( ( $key = array_search( $blog_style, $classes ) ) !== false ) {
                    unset($classes[$key]);
                }

                $sidebar_type = jobhunt_get_wpjm_sidebar_style();
                if ( ! empty ( $sidebar_type ) ) {
                    $layout = jobhunt_get_blog_layout();
                    if( ( $key = array_search( $layout, $classes ) ) !== false ) {
                        unset($classes[$key]);
                    }
                    $classes[] = $sidebar_type;
                }
            }

            $job_single_type = jobhunt_get_wpjm_single_style();
            if( is_singular( 'job_listing' ) ) {
                if ( ! empty ( $job_single_type ) ) {
                    $classes[] = 'job-single-type-' . $job_single_type;
                }
            }

            if ( is_page( jh_wpjm_get_page_id( 'post-a-job' ) ) ) {
                if ( ! empty ( $job_single_type ) ) {
                    $classes[] = 'job-single-type-' . $job_single_type;
                }
            }

            if( apply_filters( 'jobhint_is_application_details_open_default', false ) ) {
                $classes[] = 'job-application-details-keep-open';
            }

            return $classes;
        }

        public function wpjm_remove_job_manger_style() {
            wp_deregister_style( 'wp-job-manager-job-listings' );
        }

        public function sidebar_register( $sidebar_args ) {

            $sidebar_args['sidebar_jobs'] = array(
                'name'        => esc_html__( 'Jobs Sidebar', 'jobhunt' ),
                'id'          => 'sidebar-jobs',
                'description' => esc_html__( 'Widgets added to this region will appear in the jobs page.', 'jobhunt' ),
            );

            return $sidebar_args;
        }

        public function widgets_register() {
            // Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager/widgets/class-jh-wpjm-widget-job-search.php';
            register_widget( 'JH_WPJM_Widget_Job_Search' );

            // Location Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager/widgets/class-jh-wpjm-widget-job-location-search.php';
            register_widget( 'JH_WPJM_Widget_Job_Location_Search' );

            // Date Filter Widget
            require_once get_template_directory() . '/inc/wp-job-manager/widgets/class-jh-wpjm-widget-job-date-filter.php';
            register_widget( 'JH_WPJM_Widget_Date_Filter' );

            // Filter Widget
            require_once get_template_directory() . '/inc/wp-job-manager/widgets/class-jh-wpjm-widget-layered-nav.php';
            register_widget( 'JH_WPJM_Widget_Layered_Nav' );
        }

        public static function get_current_page_url() {
            if ( ! ( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) ) && ! is_job_listing_taxonomy() ) {
                return;
            }

            if ( defined( 'JOBS_IS_ON_FRONT' ) ) {
                $link = home_url( '/' );
            } elseif ( is_post_type_archive( 'job_listing' ) || is_page( jh_wpjm_get_page_id( 'jobs' ) ) ) {
                $link = get_permalink( jh_wpjm_get_page_id( 'jobs' ) );
            } else {
                $queried_object = get_queried_object();
                $link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
            }

            // Order by.
            if ( isset( $_GET['orderby'] ) ) {
                $link = add_query_arg( 'orderby', jobhunt_clean( wp_unslash( $_GET['orderby'] ) ), $link );
            }

            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if ( get_search_query() ) {
                $link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
            }

            // Post Type Arg.
            if ( isset( $_GET['post_type'] ) ) {
                $link = add_query_arg( 'post_type', jobhunt_clean( wp_unslash( $_GET['post_type'] ) ), $link );
            }

            // Location Arg.
            if ( isset( $_GET['search_location'] ) ) {
                $link = add_query_arg( 'search_location', jobhunt_clean( wp_unslash( $_GET['search_location'] ) ), $link );
            }

            // Date Filter Arg.
            if ( isset( $_GET['posted_before'] ) ) {
                $link = add_query_arg( 'posted_before', jobhunt_clean( wp_unslash( $_GET['posted_before'] ) ), $link );
            }

            // All current filters.
            if ( $_chosen_taxonomies = JH_WPJM_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
                foreach ( $_chosen_taxonomies as $name => $data ) {
                    $filter_name = sanitize_title( $name );
                    if ( ! empty( $data['terms'] ) ) {
                        $link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
                    }
                    if ( 'or' === $data['query_type'] ) {
                        $link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
                    }
                }
            }

            return $link;
        }

        public static function get_current_page_query_args() {
            $args = array();

            // Order by.
            if ( isset( $_GET['orderby'] ) ) {
                $args['orderby'] = jobhunt_clean( wp_unslash( $_GET['orderby'] ) );
            }

            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if ( get_search_query() ) {
                $args['s'] = rawurlencode( wp_specialchars_decode( get_search_query() ) );
            }

            // Post Type Arg.
            if ( isset( $_GET['post_type'] ) ) {
                $args['post_type'] = jobhunt_clean( wp_unslash( $_GET['post_type'] ) );
            }

            // Location Arg.
            if ( isset( $_GET['search_location'] ) ) {
                $args['search_location'] = jobhunt_clean( wp_unslash( $_GET['search_location'] ) );
            }

            // Date Filter Arg.
            if ( isset( $_GET['posted_before'] ) ) {
                $args['posted_before'] = jobhunt_clean( wp_unslash( $_GET['posted_before'] ) );
            }

            // All current filters.
            if ( $_chosen_taxonomies = JH_WPJM_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
                foreach ( $_chosen_taxonomies as $name => $data ) {
                    $filter_name = sanitize_title( $name );
                    if ( ! empty( $data['terms'] ) ) {
                        $args['filter_' . $filter_name] = implode( ',', $data['terms'] );
                    }
                    if ( 'or' === $data['query_type'] ) {
                        $args['query_type_' . $filter_name] = 'or';
                    }
                }
            }

            return $args;
        }

        public static function live_search_jobs_suggest() {
            $suggestions = array();
            $posts = get_posts( array(
                's'                 => $_REQUEST['term'],
                'post_type'         => 'job_listing',
                'posts_per_page'    => '8',
            ) );

            global $post;

            $results = array();
            foreach ( $posts as $post ) {
                setup_postdata( $post );
                $suggestion = array();
                $suggestion['label'] = html_entity_decode( $post->post_title, ENT_QUOTES, 'UTF-8' );
                $suggestion['link'] = get_permalink( $post->ID );
                
                $suggestions[] = $suggestion;
            }

            // JSON encode and echo
            $response = $_GET["callback"] . "(" . json_encode( $suggestions ) . ")";
            echo wp_kses_post( $response );

            // Don't forget to exit!
            exit;
        }

        /**
         * Job Category metabox fields.
         *
         * @return void
         */
        public function add_category_fields() {
            ?>
            <div class="form-field">
                <label for="job_listing_category_icon"><?php esc_html_e( 'Icon for category', 'jobhunt' ); ?></label>
                <input type="text" name="job_listing_category_icon" id="job_listing_category_icon" value autocomplete="off">
                <p class="description"><?php esc_html_e( 'This is alternative for font based icons','jobhunt' ); ?></p>
            </div>
            <?php
        }

        /**
         * Edit Category metabox fields.
         *
         * @param mixed $term Term (job_listing_category) being edited
         * @param mixed $taxonomy Taxonomy of the term being edited
         */
        public function edit_category_fields( $term ) {
            $icon = get_term_meta( $term->term_id, 'icon', true );
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="job_listing_category_icon"><?php esc_html_e( 'Icon for category', 'jobhunt' ); ?></label></th>
                <td>
                    <input type="text" name="job_listing_category_icon" id="job_listing_category_icon" value="<?php echo esc_attr( $icon ); ?>">
                    <p class="description"><?php esc_html_e( 'This is alternative for font based icons','jobhunt' ); ?></p>
                </td>
            </tr>
            <?php
        }

        /**
         * Save Category metabox fields.
         *
         * @param mixed $term_id Term ID being saved
         * @param mixed $tt_id
         * @param mixed $taxonomy Taxonomy of the term being saved
         * @return void
         */
        public function save_category_fields( $term_id ) {
            if ( isset( $_POST['job_listing_category_icon'] ) ) {
                update_term_meta( $term_id, 'icon', $_POST['job_listing_category_icon'] );
            }
        }

        public function job_manager_modified_settings( $settings ) {
            if ( post_type_exists( "job_listing" ) ) {
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_salary',
                    'std'        => '1',
                    'label'      => esc_html__( 'Salary', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing salary', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of salary when submitting a job. Note: an admin has to create salary before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_career_level',
                    'std'        => '1',
                    'label'      => esc_html__( 'Career Level', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing career level', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of career level when submitting a job. Note: an admin has to create career level before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_experience',
                    'std'        => '1',
                    'label'      => esc_html__( 'Experience', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing experience', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of experience when submitting a job. Note: an admin has to create experience before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_gender',
                    'std'        => '1',
                    'label'      => esc_html__( 'Gender', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing gender', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of gender when submitting a job. Note: an admin has to create gender before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_industry',
                    'std'        => '1',
                    'label'      => esc_html__( 'Industry', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing industry', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of industry when submitting a job. Note: an admin has to create industry before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'       => 'job_manager_enable_qualification',
                    'std'        => '1',
                    'label'      => esc_html__( 'Qualification', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing qualification', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of qualification when submitting a job. Note: an admin has to create qualification before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['job_listings'][1][] = array(
                    'name'      => 'job_manager_jobs_listing_style',
                    'std'       => 'list',
                    'label'     => esc_html__( 'Jobs Listings Style', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the style for jobs listing style. This lets the plugin know the style of jobs listings.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'list'              => esc_html__( 'List', 'jobhunt' ),
                        'list-classic'      => esc_html__( 'List Classic', 'jobhunt' ),
                        'grid'              => esc_html__( 'Grid', 'jobhunt' ),
                    )
                );
                $settings['job_listings'][1][] = array(
                    'name'      => 'job_manager_jobs_listing_sidebar',
                    'std'       => 'left-sidebar',
                    'label'     => esc_html__( 'Jobs Listings Sidebar', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the position for jobs listing sidebar. This lets the plugin know the position of jobs listings sidebar.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'left-sidebar'      => esc_html__( 'Left Sidebar', 'jobhunt' ),
                        'right-sidebar'     => esc_html__( 'Right Sidebar', 'jobhunt' ),
                        'full-width'        => esc_html__( 'Full Width', 'jobhunt' ),
                    )
                );
                $settings['job_listings'][1][] = array(
                    'name'      => 'job_manager_single_job_style',
                    'std'       => 'v1',
                    'label'     => esc_html__( 'Single job Style', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the style for single job style. This lets the plugin know the style of single job.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'v1'        => esc_html__( 'Style v1', 'jobhunt' ),
                        'v2'        => esc_html__( 'Style v2', 'jobhunt' ),
                        'v3'        => esc_html__( 'Style v3', 'jobhunt' ),
                    )
                );
            }

            return $settings;
        }
    }

endif;

return new Jobhunt_WPJM();