<?php
/**
 * Job List Block
 *
 * @package Jobhunt/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( jobhunt_is_wp_job_manager_activated() ) {
    $section_class = empty( $section_class ) ? 'jh-section job-list-section' : 'jh-section job-list-section ' . $section_class;

    if( ! empty( $type ) ) {
        $section_class .= ' ' . $type;
    }

    if ( strpos($shortcode, 'view="grid"')) {
        $section_class .= ' grid-view';
    }

    if ( ! empty( $animation ) ) {
        $section_class .= ' animate-in-view';
    }

    ?>
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
        <div class="container">
            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <?php echo apply_filters( 'jobhunt_job_list_html', do_shortcode( $shortcode ) ); ?>
        </div>
    </section>
    <?php
}
