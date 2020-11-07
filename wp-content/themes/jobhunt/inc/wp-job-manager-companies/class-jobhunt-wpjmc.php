<?php
/**
 * Jobhunt WP Job Manager Company Class
 *
 * @package  jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Jobhunt_WPJMC' ) ) :

    class Jobhunt_WPJMC {

        public function __construct() {
            if ( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() ) {
                add_filter( 'mas_wpjmc_enqueue_scripts_enable_frontend_css', '__return_false' );
                add_filter( 'job_manager_enhanced_select_enabled', array( $this, 'mas_wpjmc_enhanced_select_enabled' ), 20 );
                add_filter( 'job_manager_shortcodes' , array( $this, 'mas_wpjmc_job_manager_shortcodes' ), 20 );
                add_filter( 'job_manager_settings', array( $this, 'job_manager_mas_company_settings' ), 20 );
                add_filter( 'mas_company_taxonomies_list', array( $this, 'mas_company_modify_taxonomies_list' ), 20 );
            } else {
                $this->includes();
            }
            add_filter( 'body_class', array( $this, 'company_body_classes' ) );
            add_action( 'jobhunt_sidebar_args', array( $this, 'sidebar_register' ) );
            add_action( 'widgets_init', array( $this, 'widgets_register' ) );
        }

        public function mas_wpjmc_enhanced_select_enabled( $enabled ) {
            if ( has_wpjm_shortcode( null, [ 'mas_submit_company_form', 'mas_company_dashboard' ] ) ) {
                $enabled = true;
            }
            return $enabled;
        }

        public function mas_wpjmc_job_manager_shortcodes( $shortcodes ) {
            $shortcodes = array_unique( array_merge( $shortcodes, [ 'mas_submit_company_form', 'mas_company_dashboard' ] ) );
            return $shortcodes;
        }

        public function job_manager_mas_company_settings( $settings ) {
            $settings['mas_wpjmc_settings'][1]['job_manager_companies_listing_style'] = array(
                'name'      => 'job_manager_companies_listing_style',
                'std'       => 'v1',
                'label'     => esc_html__( 'Company Listings Style', 'jobhunt' ),
                'desc'      => esc_html__( 'Select the style for company listing style. This lets the plugin know the style of company listings.', 'jobhunt' ),
                'type'      => 'select',
                'options'   => array(
                    'v1'        => esc_html__( 'Style v1', 'jobhunt' ),
                    'v2'        => esc_html__( 'Style v2', 'jobhunt' ),
                    'v3'        => esc_html__( 'Style v3', 'jobhunt' ),
                )
            );
            $settings['mas_wpjmc_settings'][1]['job_manager_companies_listing_sidebar'] = array(
                'name'      => 'job_manager_companies_listing_sidebar',
                'std'       => 'left-sidebar',
                'label'     => esc_html__( 'Company Listings Sidebar', 'jobhunt' ),
                'desc'      => esc_html__( 'Select the position for company listing sidebar. This lets the plugin know the position of company listings sidebar.', 'jobhunt' ),
                'type'      => 'select',
                'options'   => array(
                    'left-sidebar'      => esc_html__( 'Left Sidebar', 'jobhunt' ),
                    'right-sidebar'     => esc_html__( 'Right Sidebar', 'jobhunt' ),
                    'full-width'        => esc_html__( 'Full Width', 'jobhunt' ),
                )
            );
            $settings['mas_wpjmc_settings'][1]['job_manager_single_company_style'] = array(
                'name'      => 'job_manager_single_company_style',
                'std'       => 'v1',
                'label'     => esc_html__( 'Single Company Style', 'jobhunt' ),
                'desc'      => esc_html__( 'Select the style for single company style. This lets the plugin know the style of single company.', 'jobhunt' ),
                'type'      => 'select',
                'options'   => array(
                    'v1'        => esc_html__( 'Style v1', 'jobhunt' ),
                    'v2'        => esc_html__( 'Style v2', 'jobhunt' ),
                )
            );
            $settings['mas_wpjmc_settings'][1]['job_manager_single_company_contact_form'] = array(
                'name'      => 'job_manager_single_company_contact_form',
                'std'       => '',
                'label'     => esc_html__( 'Single Company Contact Form', 'jobhunt' ),
                'desc'      => esc_html__( 'Select the form for single company contact form. This lets the plugin know the contact form of single company.', 'jobhunt' ),
                'type'      => 'select',
                'options'   => function_exists( 'jobhunt_get_forms' ) ? jobhunt_get_forms() : array( 0 => esc_html__( 'Please select a form', 'jobhunt' ) )
            );
            return $settings;
        }

        public function mas_company_modify_taxonomies_list( $taxonomies_args ) {
            if( isset( $taxonomies_args['company_strength'] ) ) {
                unset( $taxonomies_args['company_strength'] );
            }
            if( isset( $taxonomies_args['company_average_salary'] ) ) {
                unset( $taxonomies_args['company_average_salary'] );
            }
            if( isset( $taxonomies_args['company_revenue'] ) ) {
                unset( $taxonomies_args['company_revenue'] );
            }

            $taxonomies_args['company_team_size'] = array(
                'singular'                  => esc_html__( 'Team size', 'jobhunt' ),
                'plural'                    => esc_html__( 'Team sizes', 'jobhunt' ),
                'slug'                      => esc_html_x( 'company-team-size', 'Company permalink - resave permalinks after changing this', 'jobhunt' ),
                'enable'                    => get_option('job_manager_company_enable_company_team_size', true)
            );

            return $taxonomies_args;
        }

        public function includes() {
            include_once get_template_directory() . '/inc/wp-job-manager-companies/class-jh-wpjmc-template-loader.php';
        }

        public function company_body_classes( $classes ) {
            if( is_post_type_archive( 'company' ) || is_page( jh_wpjmc_get_page_id( 'companies' ) ) || is_company_taxonomy() ) {
                $classes[] = 'post-type-archive-company';
                
                $company_type = jobhunt_get_wpjmc_style();
                if ( ! empty ( $company_type ) ) {
                    $classes[] = 'company-type-' . $company_type;
                }

                $blog_style = jobhunt_get_blog_style();
                if( ( $key = array_search( $blog_style, $classes ) ) !== false ) {
                    unset($classes[$key]);
                }

                $sidebar_type = jobhunt_get_wpjmc_sidebar_style();
                if ( ! empty ( $sidebar_type ) ) {
                    $layout = jobhunt_get_blog_layout();
                    if( ( $key = array_search( $layout, $classes ) ) !== false ) {
                        unset($classes[$key]);
                    }
                    $classes[] = $sidebar_type;
                }
            }

            if( is_singular( 'company' ) ) {
                $company_single_type = jobhunt_get_wpjmc_single_style();
                if ( ! empty ( $company_single_type ) ) {
                    $classes[] = 'company-single-type-' . $company_single_type;
                }
            }

            return $classes; 
        }

        public function sidebar_register( $sidebar_args ) {

            $sidebar_args['sidebar_company'] = array(
                'name'        => esc_html__( 'Company Sidebar', 'jobhunt' ),
                'id'          => 'sidebar-company',
                'description' => esc_html__( 'Widgets added to this region will appear in the Company page.', 'jobhunt' ),
            );

            return $sidebar_args;
        }

        public function widgets_register() {
            // Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager-companies/widgets/class-jh-wpjmc-widget-company-search.php';
            register_widget( 'JH_WPJMC_Widget_Company_Search' );

            // Location Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager-companies/widgets/class-jh-wpjmc-widget-company-location-search.php';
            register_widget( 'JH_WPJMC_Widget_Company_Location_Search' );

            // Filter Widget
            require_once get_template_directory() . '/inc/wp-job-manager-companies/widgets/class-jh-wpjmc-widget-layered-nav.php';
            register_widget( 'JH_WPJMC_Widget_Layered_Nav' );
        }

        public static function get_current_page_url() {
            if ( ! ( is_post_type_archive( 'company' ) || is_page( jh_wpjmc_get_page_id( 'companies' ) ) ) && ! is_company_taxonomy() ) {
                return;
            }

            if ( defined( 'COMPANIES_IS_ON_FRONT' ) ) {
                $link = home_url( '/' );
            } elseif ( is_post_type_archive( 'company' ) || is_page( jh_wpjmc_get_page_id( 'companies' ) ) ) {
                $link = get_permalink( jh_wpjmc_get_page_id( 'companies' ) );
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

            if ( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() ) {
                $_chosen_taxonomies = MAS_WPJMC_Query::get_layered_nav_chosen_taxonomies();
            } else {
                $_chosen_taxonomies = JH_WPJMC_Query::get_layered_nav_chosen_taxonomies();
            }

            // All current filters.
            if ( $_chosen_taxonomies ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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

            if ( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() ) {
                $_chosen_taxonomies = MAS_WPJMC_Query::get_layered_nav_chosen_taxonomies();
            } else {
                $_chosen_taxonomies = JH_WPJMC_Query::get_layered_nav_chosen_taxonomies();
            }

            // All current filters.
            if ( $_chosen_taxonomies ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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
    }

endif;
return new Jobhunt_WPJMC();