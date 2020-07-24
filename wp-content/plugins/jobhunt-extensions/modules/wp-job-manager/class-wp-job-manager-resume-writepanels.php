<?php

class JH_WPJM_Resume_Writepanels {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'resume_manager_save_resume', array( $this, 'save_resume_data' ), 1, 2 );

    }

    public function add_meta_boxes() {
        add_meta_box( 'candidate_award_data', esc_html__( 'Awards', 'jobhunt-extensions' ), array( $this, 'award_data' ), 'resume', 'normal' );
    }

    public function award_data( $post ) {
        $fields = $this->candidate_award_fields();
        WP_Resume_Manager_Writepanels::repeated_rows_html( esc_html__( 'Awards', 'jobhunt-extensions' ), $fields, get_post_meta( $post->ID, '_candidate_awards', true ) );
    }

    public function candidate_award_fields() {
        return apply_filters( 'resume_manager_candidate_award_fields', array(
            'award_title' => array(
                'label'       => esc_html__( 'Award Title', 'jobhunt-extensions' ),
                'name'        => 'candidate_award_title[]',
                'placeholder' => '',
                'description' => ''
            ),
            'date' => array(
                'label'       => esc_html__( 'Start/end date', 'jobhunt-extensions' ),
                'name'        => 'candidate_award_date[]',
                'placeholder' => '',
                'description' => ''
            ),
            'notes' => array(
                'label'       => esc_html__( 'Notes', 'jobhunt-extensions' ),
                'name'        => 'candidate_award_notes[]',
                'placeholder' => '',
                'description' => '',
                'type'        => 'textarea',
            )
        ) );
    }

    public function save_resume_data( $post_id, $post ) {
        global $wpdb;

        $save_repeated_fields = array(
            '_candidate_awards' => $this->candidate_award_fields()
        );

        foreach ( $save_repeated_fields as $meta_key => $fields ) {
            WP_Resume_Manager_Writepanels::save_repeated_row( $post_id, $meta_key, $fields );
        }
    }
}

new JH_WPJM_Resume_Writepanels();