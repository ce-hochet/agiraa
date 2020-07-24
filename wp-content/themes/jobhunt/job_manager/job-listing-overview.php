<?php
/**
 * Job Listing Overview
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$job_overview_details = apply_filters( 'jobhunt_single_job_overview_details', array(
    'offered_salary' => array(
        'icon'          => 'la la-money',
        'label'         => esc_html__( 'Offered Salary', 'jobhunt' ),
        'taxonomy'      => 'job_listing_salary',
    ),
    'gender' => array(
        'icon'          => 'la la-mars-double',
        'label'         => esc_html__( 'Gender', 'jobhunt' ),
        'taxonomy'      => 'job_listing_gender',
    ),
    'career_level' => array(
        'icon'          => 'la la-bar-chart',
        'label'         => esc_html__( 'Career Level', 'jobhunt' ),
        'taxonomy'      => 'job_listing_career_level',
    ),
    'industry' => array(
        'icon'          => 'la la-industry',
        'label'         => esc_html__( 'Industry', 'jobhunt' ),
        'taxonomy'      => 'job_listing_industry',
    ),
    'experience' => array(
        'icon'          => 'la la-sliders',
        'label'         => esc_html__( 'Experience', 'jobhunt' ),
        'taxonomy'      => 'job_listing_experience',
    ),
    'qualification' => array(
        'icon'          => 'la la-graduation-cap',
        'label'         => esc_html__( 'Qualification', 'jobhunt' ),
        'taxonomy'      => 'job_listing_qualification',
    )
) );

if ( $job_overview_details ) :

$check_output = 0;
foreach( $job_overview_details as $key => $job_overview_detail ) {
    if( ! empty ( $job_overview_detail['taxonomy'] ) && taxonomy_exists( $job_overview_detail['taxonomy'] ) ) {
        global $post;
        $job_overview_details[$key]['value'] = jobhunt_get_wpjm_taxomony_data( $post, $job_overview_detail['taxonomy'] );
    } elseif( ! empty ( $job_overview_detail['callback'] ) && function_exists( $job_overview_detail['callback'] ) ) {
        ob_start();
        call_user_func( $job_overview_detail['callback'], $key, $job_overview_detail );
        $job_overview_details[$key]['value'] = ob_get_clean();
    }

    if ( ! empty( $job_overview_details[$key]['value'] ) ) {
        $check_output++;
    }
}

if ( $check_output > 0) : ?>
    <div class="single-job-listing__widget single-job-listing__overview">
        <h5 class="single-job-listing__widget--title"><?php echo apply_filters( 'jobhunt_single_job_overview_title', esc_html__( 'Job Overview', 'jobhunt' ) ); ?></h5>
        <ul class="single-job-listing__widget--content">
            <?php foreach( $job_overview_details as $job_overview_detail ) : 
                if ( ! empty( $job_overview_detail['value'] ) ) : ?>
                    <li>
                        <div class="single-job-listing-overview__detail">
                            <div class="single-job-listing-overview__detail--icon"><i class="<?php echo esc_attr( $job_overview_detail['icon'] ); ?>"></i></div>
                            <div class="single-job-listing-overview__detail--content">
                                <h6><?php echo esc_html( $job_overview_detail['label'] ); ?></h6>
                                <div class="single-job-listing-overview__detail-content--value"><?php echo wp_kses_post( $job_overview_detail['value'] ); ?></div>
                            </div>
                        </div>
                    </li>
                <?php endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif;
endif;