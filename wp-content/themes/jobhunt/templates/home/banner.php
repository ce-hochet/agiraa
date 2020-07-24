<?php
/**
 * Banner
 *
 * @package Jobhunt/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'jh-section banners-block' : 'jh-section banners-block ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

if ( $is_enable_action ) {
    $section_class .= ' with-action';
}

if( ! empty( $bg_image ) && ! is_array( $bg_image ) ) {
    $bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
}

$style_attr = '';
if( isset( $bg_choice ) && $bg_choice == 'color' && ! empty( $bg_color ) ) {
    $style_attr = 'background-color:' . $bg_color  . ';';
} elseif ( ! empty( $bg_image[0] ) ) {
    $style_attr = 'background-image: url( ' . esc_url( $bg_image[0] ) . ' );';
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
    <div class="container">
        <div class="banners-block-inner">
            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <?php if ( $is_enable_action && $action_link && $action_text ) : ?>
                <div class="action">
                    <a class="action-link" href="<?php echo esc_url( $action_link ); ?>"><?php echo esc_html( $action_text ); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
