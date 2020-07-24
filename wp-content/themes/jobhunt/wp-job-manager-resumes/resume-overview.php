<?php
/**
 * Candidate Overview
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$candidate_overview_details = apply_filters( 'jobhunt_single_candidate_overview_details', array(
    'experience' => array(
        'icon'          => 'la la-sliders',
        'label'         => esc_html__( 'Experience', 'jobhunt' ),
        'taxonomy'      => 'resume_experience',
    ),
    'age' => array(
        'icon'          => 'la la-hourglass-2',
        'label'         => esc_html__( 'Age', 'jobhunt' ),
        'taxonomy'      => 'resume_age',
    ),
    'current_salary' => array(
        'icon'          => 'la la-money',
        'label'         => esc_html__( 'Current Salary', 'jobhunt' ),
        'taxonomy'      => 'resume_current_salary',
    ),
    'expected_salary' => array(
        'icon'          => 'la la-line-chart',
        'label'         => esc_html__( 'Expected Salary', 'jobhunt' ),
        'taxonomy'      => 'resume_expected_salary',
    ),
    'gender' => array(
        'icon'          => 'la la-mars-double',
        'label'         => esc_html__( 'Gender', 'jobhunt' ),
        'taxonomy'      => 'resume_gender',
    ),
    'language' => array(
        'icon'          => 'la la-language',
        'label'         => esc_html__( 'Language', 'jobhunt' ),
        'taxonomy'      => 'resume_language',
    ),
    'education_level' => array(
        'icon'          => 'la la-graduation-cap',
        'label'         => esc_html__( 'Education Level', 'jobhunt' ),
        'taxonomy'      => 'resume_education_level',
    )
) );

if ( $candidate_overview_details ) :

$check_output = 0;
foreach( $candidate_overview_details as $key => $candidate_overview_detail ) { 
    if( ! empty ( $candidate_overview_detail['taxonomy'] ) && taxonomy_exists( $candidate_overview_detail['taxonomy'] ) ) {
        global $post;
        $candidate_overview_details[$key]['value'] = jobhunt_get_wpjm_taxomony_data( $post, $candidate_overview_detail['taxonomy']  );
    } elseif( ! empty ( $candidate_overview_detail['callback'] ) && function_exists( $candidate_overview_detail['callback'] ) ) {
        ob_start();
        call_user_func( $candidate_overview_detail['callback'], $key, $candidate_overview_detail );
        $candidate_overview_details[$key]['value'] = ob_get_clean();
    }

    if ( !empty ( $candidate_overview_details[$key]['value'] ) ) {
        $check_output++;
    }
}

if ( $check_output > 0) : ?>
    <div class="single-resume__widget single-resume__overview">
        <h2 class="single-resume__widget--title"><?php echo apply_filters( 'jobhunt_single_candidate_overview_title', esc_html__( 'Candidate Overview', 'jobhunt' ) ); ?></h2>
        <ul class="single-resume__widget--content">
            <?php foreach( $candidate_overview_details as $candidate_overview_detail ) :
                if ( ! empty ( $candidate_overview_detail['value'] ) ) : ?>
                    <li>
                        <div class="single-resume-overview__detail">
                            <div class="single-resume-overview__detail--icon"><i class="<?php echo esc_attr( $candidate_overview_detail['icon'] ); ?>"></i></div>
                            <div class="single-resume-overview__detail--content">
                                <h6><?php echo esc_html( $candidate_overview_detail['label'] ); ?></h6>
                                <div class="single-resume-overview__detail-content--value"><?php echo wp_kses_post( $candidate_overview_detail['value'] ); ?></div>
                            </div>
                        </div>
                    </li>
                <?php endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif;
endif;
