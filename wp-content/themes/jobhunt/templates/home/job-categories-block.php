<?php
/**
 * Job Categories Block
 *
 * @package Jobhunt/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( jobhunt_is_wp_job_manager_activated() && get_option( 'job_manager_enable_categories' ) ) {
    $section_id = 'jh-scroll-here';
    $section_class = empty( $section_class ) ? 'jh-section job-categories-section' : 'jh-section job-categories-section ' . $section_class;

    if( ! empty( $type ) ) {
        $section_class .= ' ' . $type;
    }

    if ( ! empty( $animation ) ) {
        $section_class .= ' animate-in-view';
    }

    $category_args = jobhunt_get_atts_for_taxonomy_slugs( $category_args );
    $categories = get_terms( 'job_listing_category', $category_args );

    if ( is_wp_error( $categories ) ) {
        return;
    }

    ?>
    <section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
        <div class="container">
            <?php if( ! empty( $section_title ) || ! empty( $sub_title ) ) : ?>
            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="job-categories-section__inner">
                <ul class="job-categories">
                    <?php foreach( $categories as $category ) : ?>
                        <?php $icon = get_term_meta( $category->term_id, 'icon', true ); ?>
                        <li class="job-category">
                            <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                                <?php
                                if ( ! empty( $icon ) ) {
                                    ?>
                                    <div class="media-icon">
                                        <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="media-caption">
                                    <h4 class="category-titile"><?php echo esc_html( $category->name ); ?></h4>
                                    <span class= "job-count"><?php echo esc_html( sprintf( _n( '%s open position', '%s open positions', $category->count, 'jobhunt' ), $category->count ) ); ?></span>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if( ! empty( $action_link ) && ! empty( $action_text ) ) : ?>
                    <div class="action">
                        <a class="action-link" href="<?php echo esc_url( $action_link ); ?>"><?php echo esc_html( $action_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}
