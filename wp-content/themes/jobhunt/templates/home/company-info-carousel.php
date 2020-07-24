<?php
/**
 * Company Info Carousel
 *
 * @package jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( jobhunt_is_wp_job_manager_activated() ) {
    $section_class = empty( $section_class ) ? 'jh-section company-profile-section' : 'jh-section company-profile-section ' . $section_class;

    $query_args['post_type'] = "company";

    if ( ! empty( $is_featured ) ) {
        $query_args['meta_query'][] = array(
            'key'     => '_featured',
            'value'   => '1',
            'compare' => $is_featured ? '=' : '!='
        );
    }

    $wp_query = new WP_Query( $query_args );


    if ( ! empty( $animation ) ) {
        $section_class .= ' animate-in-view';
    }

    if( ! empty( $type ) ) {
        $section_class .= ' ' . $type;
    }

    if( ! empty( $bg_image ) && ! is_array( $bg_image ) ) {
        $bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
    }

    $style_attr = '';
    if( isset( $bg_choice ) && $bg_choice == 'color' && ! empty( $bg_color ) ) {
        $style_attr = 'background-color:' . $bg_color  . ';';
    } elseif ( isset( $bg_choice ) && $bg_choice == 'image' && ! empty( $bg_image[0] ) ) {
        $style_attr = 'background-image: url( ' . esc_url( $bg_image[0] ) . ' );';
    }

    ?>
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
        <div class="container">
            <div class="company-profile-inner">
                <div class="section-header">
                    <?php if ( ! empty( $section_title ) ) : ?>
                        <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $sub_title ) ) : ?>
                        <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                    <?php endif; ?>
                </div>
                <ul class="companies" data-ride="slick" data-slick='<?php echo htmlspecialchars( json_encode( $carousel_args ), ENT_QUOTES, 'UTF-8' ); ?>'>
                    <?php
                    if ( $wp_query->have_posts() ):
                        $companies = get_posts( $query_args );
                        foreach ($companies as $company) : ?>
                            <li class="company">
                                <a href="<?php the_company_permalink( $company ); ?>" class="company-inner">
                                    <div class="company-info">
                                        <?php the_company_logo( 'thumbnail', null, $company ); 
                                        if( $type != 'v1' ) : ?>
                                            <div class="company-info-inner">
                                                <h4 class="company-name"><?php echo apply_filters( 'jobhunt_company_name', get_the_title( $company ) ); ?></h4>
                                                <?php the_company_location( false, $company );
                                                if( ! empty( get_the_company_job_listing_count( $company ) ) ) : ?>
                                                    <span class="open-positions"><?php echo apply_filters( 'jobhunt_wpjmc_open_positions_info', esc_html( sprintf( _n( '%s Open Position', '%s Open Positions', get_the_company_job_listing_count( $company ), 'jobhunt' ), get_the_company_job_listing_count( $company ) ) ) ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}
