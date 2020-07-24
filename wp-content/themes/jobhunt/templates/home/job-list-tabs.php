<?php
/**
 * Job List Tabs
 *
 * @package Jobhunt/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( jobhunt_is_wp_job_manager_activated() ) {
    $section_class = empty( $section_class ) ? 'jh-section job-list-tab-section' : 'jh-section job-list-tab-section ' . $section_class;

    if( ! empty( $type ) ) {
        $section_class .= ' ' . $type;
    }

    $tab_uniqid = 'job-list-tab-' . uniqid();

    if ( ! empty( $animation ) ) {
        $section_class .= ' animate-in-view';
    }

    ?>
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
        <div class="container">
            <div class="job-list-tab-inner">
                <ul class="nav nav-tabs">

                    <?php
                    foreach( $args['tabs'] as $key => $tab ) {

                        $tab_id = ! empty( $tab['id'] ) ? $tab['id'] : $tab_uniqid . '-' . $key;

                    ?>
                    <li class="nav-item">
                        <a class="nav-link<?php if ( $key == 0 ) : ?> show active<?php endif; ?>" href="#<?php echo esc_attr( $tab_id ); ?>" data-toggle="tab">
                            <?php echo wp_kses_post ( $tab['title'] ); ?>
                        </a>
                    </li>
                    <?php } ?>

                </ul>

                <div class="tab-content">

                    <?php
                    foreach( $args['tabs'] as $key => $tab ) :
                        $tab_id = ! empty( $tab['id'] ) ? $tab['id'] : $tab_uniqid . '-' . $key;
                    ?>

                    <div class="tab-pane<?php if ( $key == 0 ) : ?> show active<?php endif; ?>" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel">
                        <?php echo apply_filters( 'jobhunt_job_list_html', do_shortcode( $tab['shortcode'] ) ); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
