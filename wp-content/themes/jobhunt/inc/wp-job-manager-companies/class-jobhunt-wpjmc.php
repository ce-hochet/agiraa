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
            $this->includes();
            add_filter( 'body_class', array( $this, 'company_body_classes' ) );
            add_action( 'jobhunt_sidebar_args', array( $this, 'sidebar_register' ) );
            add_action( 'widgets_init', array( $this, 'widgets_register' ) );
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

            // All current filters.
            if ( $_chosen_taxonomies = JH_WPJMC_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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
            if ( $_chosen_taxonomies = JH_WPJMC_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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