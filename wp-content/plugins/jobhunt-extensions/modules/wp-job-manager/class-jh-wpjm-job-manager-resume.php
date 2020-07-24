<?php

class JH_WPJM_Job_Manager_Resume {

    public function __construct() {

        if ( $this->is_wpjmr_activated() ) {
            add_action( 'init', array( $this, 'register_taxonomies' ) );

            if( is_admin() ) {
                include_once( dirname( __FILE__ ) . '/class-wp-job-manager-resume-writepanels.php' );
            }
        }
    }

    public function is_wpjmr_activated() {
        return class_exists( 'WP_Resume_Manager' ) ? true : false;
    }

    public function register_taxonomies() {
        if ( ! post_type_exists( 'resume' ) ) {
            return;
        }

        $admin_capability = 'manage_resumes';

        /**
         * Taxonomies
         */
        $taxonomies_args = apply_filters( 'jobhunt_resume_taxonomies_list', array(
            'resume_experience'    => array(
                'singular'                  => esc_html__( 'Candidate Experience', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Experience', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-experience', 'Candidate experience permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_experience', true)
            ),
            'resume_age'        => array(
                'singular'                  => esc_html__( 'Candidate Age', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Age', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-age', 'Candidate age permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_age', true)
            ),
            'resume_current_salary'        => array(
                'singular'                  => esc_html__( 'Candidate Current Salary', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Current Salary', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-current-salary', 'Candidate current salary permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_current_salary', true)
            ),
            'resume_expected_salary'        => array(
                'singular'                  => esc_html__( 'Candidate Expected Salary', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Expected Salary', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-expected-salary', 'Candidate expected salary permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_expected_salary', true)
            ),
            'resume_gender'        => array(
                'singular'                  => esc_html__( 'Candidate Gender', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Gender', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-gender', 'Candidate gender permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_gender', true)
            ),
            'resume_education_level'  => array(
                'singular'                  => esc_html__( 'Candidate Education Level', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Education Level', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-education-level', 'Candidate education level permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_education_level', true)
            ),
            'resume_language'      => array(
                'singular'                  => esc_html__( 'Candidate Language', 'jobhunt-extensions' ),
                'plural'                    => esc_html__( 'Candidate Languages', 'jobhunt-extensions' ),
                'slug'                      => esc_html_x( 'resume-language', 'Candidate language permalink - resave permalinks after changing this', 'jobhunt-extensions' ),
                'enable'                    => get_option('resume_manager_enable_language', true)
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

                register_taxonomy( $taxonomy_name, 'resume', $args );
            }
        }
    }
}

global $jh_wpjm_job_manager_resume;
$jh_wpjm_job_manager_resume = new JH_WPJM_Job_Manager_Resume();