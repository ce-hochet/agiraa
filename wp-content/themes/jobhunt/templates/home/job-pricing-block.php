<?php
/**
 * Pricing Table
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'jh-section job-pricing-section' : 'jh-section job-pricing-section ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$shortcode_atts['template'] = "product-job-package";

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ): ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <div class="section-header">
        <?php
        if( ! empty( $section_title ) ) {
            echo '<h3 class="section-title">' . esc_html( $section_title ) . '</h3>' ;
        }
        if( ! empty( $sub_title ) ) {
            echo '<span class="section-sub-title">' . esc_html( $sub_title ) . '</span>' ;
        }
        ?>
    </div>
    <?php 
    echo apply_filters( 'jobhunt_job_pricing_html', jobhunt_do_shortcode( 'products' , $shortcode_atts ) ); ?>
</section>