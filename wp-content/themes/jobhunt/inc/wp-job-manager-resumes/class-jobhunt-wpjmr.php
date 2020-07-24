<?php
/**
 * Jobhunt WP Job Manager Resume Class
 *
 * @package  jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Jobhunt_WPJMR' ) ) :

    class Jobhunt_WPJMR {

        public function __construct() {
            $this->includes();
            add_filter( 'body_class', array( $this, 'resume_body_classes' ) );
            add_action( 'jobhunt_sidebar_args', array( $this, 'sidebar_register' ) );
            add_action( 'widgets_init', array( $this, 'widgets_register' ) );
            add_filter( 'resume_manager_settings', array( $this, 'resume_manager_modified_settings' ) );

            add_action( 'wp_ajax_jobhunt_live_search_resumes_suggest', array( __CLASS__, 'live_search_resumes_suggest' ) );
            add_action( 'wp_ajax_nopriv_jobhunt_live_search_resumes_suggest', array( __CLASS__, 'live_search_resumes_suggest' ) );
        }

        public function includes() {
            include_once get_template_directory() . '/inc/wp-job-manager-resumes/class-jh-wpjmr-template-loader.php';
        }

        public function resume_body_classes( $classes ) {
            if( is_post_type_archive( 'resume' ) || is_page( jh_wpjmr_get_page_id( 'resume' ) ) || is_resume_taxonomy() ) {
                $classes[] = 'post-type-archive-resume';
                
                $resume_type = jobhunt_get_wpjmr_style();
                if ( ! empty ( $resume_type ) ) {
                    $classes[] = 'resume-type-' . $resume_type;
                }

                $blog_style = jobhunt_get_blog_style();
                if( ( $key = array_search( $blog_style, $classes ) ) !== false ) {
                    unset($classes[$key]);
                }

                $sidebar_type = jobhunt_get_wpjmr_sidebar_style();
                if ( ! empty ( $sidebar_type ) ) {
                    $layout = jobhunt_get_blog_layout();
                    if( ( $key = array_search( $layout, $classes ) ) !== false ) {
                        unset($classes[$key]);
                    }
                    $classes[] = $sidebar_type;
                }
            }
            
            $resume_single_type = jobhunt_get_wpjmr_single_style();
            
            if( is_singular( 'resume' ) ) {
                if ( ! empty ( $resume_single_type ) ) {
                    $classes[] = 'resume-single-type-' . $resume_single_type;
                }
            }

            if ( is_page( jh_wpjmr_get_page_id( 'submit_resume_form' ) ) ) {
                if ( ! empty ( $resume_single_type ) ) {
                    $classes[] = 'resume-single-type-' . $resume_single_type;
                }
            }

            return $classes;
        }

        public function sidebar_register( $sidebar_args ) {

            $sidebar_args['sidebar_resume'] = array(
                'name'        => esc_html__( 'Resume Sidebar', 'jobhunt' ),
                'id'          => 'sidebar-resume',
                'description' => esc_html__( 'Widgets added to this region will appear in the Resume page.', 'jobhunt' ),
            );

            return $sidebar_args;
        }

        public function widgets_register() {
            // Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager-resumes/widgets/class-jh-wpjmr-widget-resume-search.php';
            register_widget( 'JH_WPJMR_Widget_Resume_Search' );

            // Location Search Widget
            require_once get_template_directory() . '/inc/wp-job-manager-resumes/widgets/class-jh-wpjmr-widget-resume-location-search.php';
            register_widget( 'JH_WPJMR_Widget_Resume_Location_Search' );

            // Date Filter Widget
            require_once get_template_directory() . '/inc/wp-job-manager-resumes/widgets/class-jh-wpjmr-widget-resume-date-filter.php';
            register_widget( 'JH_WPJMR_Widget_Date_Filter' );

            // Filter Widget
            require_once get_template_directory() . '/inc/wp-job-manager-resumes/widgets/class-jh-wpjmr-widget-layered-nav.php';
            register_widget( 'JH_WPJMR_Widget_Layered_Nav' );
        }

        public static function get_current_page_url() {
            if ( ! ( is_post_type_archive( 'resume' ) || is_page( jh_wpjmr_get_page_id( 'resume' ) ) ) && ! is_resume_taxonomy() ) {
                return;
            }

            if ( defined( 'RESUMES_IS_ON_FRONT' ) ) {
                $link = home_url( '/' );
            } elseif ( is_post_type_archive( 'resume' ) || is_page( jh_wpjmr_get_page_id( 'resume' ) ) ) {
                $link = get_permalink( jh_wpjmr_get_page_id( 'resume' ) );
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
            if ( $_chosen_taxonomies = JH_WPJMR_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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
            if ( $_chosen_taxonomies = JH_WPJMR_Query::get_layered_nav_chosen_taxonomies() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
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

        public function resume_manager_modified_settings( $settings ) {
            if ( post_type_exists( "resume" ) ) {
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_experience',
                    'std'        => '1',
                    'label'      => esc_html__( 'Experience', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing experience', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of experience when submitting a job. Note: an admin has to create experience before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_age',
                    'std'        => '1',
                    'label'      => esc_html__( 'Age', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing age', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of age when submitting a job. Note: an admin has to create age before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_current_salary',
                    'std'        => '1',
                    'label'      => esc_html__( 'Current Salary', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing current salary', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of current salary when submitting a job. Note: an admin has to create current salary before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_expected_salary',
                    'std'        => '1',
                    'label'      => esc_html__( 'Expected Salary', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing expected salary', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of expected salary when submitting a job. Note: an admin has to create expected salary before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_gender',
                    'std'        => '1',
                    'label'      => esc_html__( 'Gender', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing gender', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of gender when submitting a job. Note: an admin has to create gender before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_education_level',
                    'std'        => '1',
                    'label'      => esc_html__( 'Education Level', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing education level', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of education level when submitting a job. Note: an admin has to create education level before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'       => 'resume_manager_enable_language',
                    'std'        => '1',
                    'label'      => esc_html__( 'Language', 'jobhunt' ),
                    'cb_label'   => esc_html__( 'Enable listing language', 'jobhunt' ),
                    'desc'       => esc_html__( 'This lets users select from a list of language when submitting a job. Note: an admin has to create language before site users can select them.', 'jobhunt' ),
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );
                $settings['resume_listings'][1][] = array(
                    'name'      => 'resume_manager_resumes_listing_style',
                    'std'       => 'v1',
                    'label'     => esc_html__( 'Resumes Listings Style', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the style for resumes listing style. This lets the plugin know the style of resumes listings.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'v1'        => esc_html__( 'Style v1', 'jobhunt' ),
                        'v2'        => esc_html__( 'Style v2', 'jobhunt' ),
                        'v3'        => esc_html__( 'Style v3', 'jobhunt' ),
                    )
                );
                $settings['resume_listings'][1][] = array(
                    'name'      => 'resume_manager_resumes_listing_sidebar',
                    'std'       => 'left-sidebar',
                    'label'     => esc_html__( 'Resumes Listings Sidebar', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the position for resumes listing sidebar. This lets the plugin know the position of resumes listings sidebar.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'left-sidebar'      => esc_html__( 'Left Sidebar', 'jobhunt' ),
                        'right-sidebar'     => esc_html__( 'Right Sidebar', 'jobhunt' ),
                        'full-width'        => esc_html__( 'Full Width', 'jobhunt' ),
                    )
                );
                $settings['resume_listings'][1][] = array(
                    'name'      => 'resume_manager_single_resume_style',
                    'std'       => 'v1',
                    'label'     => esc_html__( 'Single Resume Style', 'jobhunt' ),
                    'desc'      => esc_html__( 'Select the style for single resume style. This lets the plugin know the style of single resume.', 'jobhunt' ),
                    'type'      => 'select',
                    'options'   => array(
                        'v1'        => esc_html__( 'Style v1', 'jobhunt' ),
                        'v2'        => esc_html__( 'Style v2', 'jobhunt' ),
                    )
                );
                if ( jobhunt_get_wpjmr_single_style() == 'v1' ) {
                    $settings['resume_listings'][1][] = array(
                        'name'      => 'resume_manager_single_resume_contact_form',
                        'std'       => '',
                        'label'     => esc_html__( 'Single Resume Contact Form', 'jobhunt' ),
                        'desc'      => esc_html__( 'Select the form for single resume contact form. This lets the plugin know the contact form of single resume. This only for single resume style v1', 'jobhunt' ),
                        'type'      => 'select',
                        'options'   => jobhunt_get_forms()
                    );
                }
            }

            return $settings;
        }

        public static function live_search_resumes_suggest() {
            $suggestions = array();
            $posts = get_posts( array(
                's'                 => $_REQUEST['term'],
                'post_type'         => 'resume',
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
    }

endif;
return new Jobhunt_WPJMR();