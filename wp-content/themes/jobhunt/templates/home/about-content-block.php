<?php
/**
 * About Content
 *
 * @author  MadrasThemes
 * @package Kidos/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section jobhunt-about-content-section' : 'jh-section jobhunt-about-content-section ' . $section_class;
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <?php if( ! empty( $section_title ) ) : ?>
        <div class="section-header">
            <?php
            if( ! empty( $section_title ) ) {
                echo '<h3 class="section-title">' . wp_kses_post( $section_title ) . '</h3>' ;
            }
            ?>
        </div>
    <?php endif; ?>
    <div class="about-content">
        <?php
        if ( ! empty( $image[0] ) ) {
            echo '<div class="content-image"><img src="' . esc_url( $image[0] ) . '" alt="' . esc_attr__( 'About Content Image', 'jobhunt' ) . '"></div>' ;
        }

        if( ! empty( $about_content ) ) {
            echo '<div class="content">' . wp_kses_post( $about_content ) . '</div>' ;
        }
        ?>
    </div>
    <?php do_action( 'jobhunt_share' ); ?>
</section>
