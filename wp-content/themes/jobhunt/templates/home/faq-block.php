<?php
/**
 * Faq Section
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section jobhunt-faq-section' : 'jh-section jobhunt-faq-section ' . $section_class;
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

?>

<Section class="<?php echo esc_attr( $section_class ); ?>"  <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <div class="container">
        <div class="faq-section-inner">
            <?php if( ! empty( $section_title ) ) : ?>
            <header class="section-header">
                <h3 class="section-title"><?php echo wp_kses_post( $section_title ); ?></h3>
            </header>
            <?php endif; ?>
            <?php echo apply_filters( 'jobhunt_faq_html', do_shortcode( $shortcode ) ); ?>
        </div>
    </div>
</Section>