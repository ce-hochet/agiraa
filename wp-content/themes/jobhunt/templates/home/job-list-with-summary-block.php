<?php
/**
 * Job List With Summary Block
 *
 * @package Jobhunt/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( jobhunt_is_wp_job_manager_activated() ) {
    $section_class = empty( $section_class ) ? 'jh-section job-list-summary-section' : 'jh-section job-list-summary-section ' . $section_class;

    if( ! empty( $type ) ) {
        $section_class .= ' ' . $type;
    }

    if ( ! empty( $animation ) ) {
        $section_class .= ' animate-in-view';
    }

    ?>
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
        <div class="job-list-summary-inner">
            <div class="job-list">
                <?php if ( ! empty( $jobs[0]['section_title'] ) ) : ?>
                    <h3 class="title"><?php echo esc_html( $jobs[0]['section_title'] ); ?></h3>
                <?php endif; ?>
                <?php echo apply_filters( 'jobhunt_job_list_html', do_shortcode( $jobs[0]['shortcode'] ) ); ?>
            </div>
            <div class="job-summary">
                <?php if ( ! empty( $jobs[1]['section_title'] ) ) : ?>
                    <h3 class="title"><?php echo esc_html( $jobs[1]['section_title'] ); ?></h3>
                <?php endif; ?>
                <?php echo apply_filters( 'jobhunt_job_list_html', do_shortcode( $jobs[1]['shortcode'] ) ); ?>
            </div>
        </div>
    </section>
    <?php
}
