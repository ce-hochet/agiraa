<?php
/**
 * Dual Banner Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section dual-banner-section' : 'jh-section dual-banner-section ' . $section_class;

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
} elseif ( ! empty( $bg_image[0] ) ) {
    $style_attr = 'background-image: url( ' . esc_url( $bg_image[0] ) . ' );';
}

$banners[1]['caption_align'] = 'align-end';

?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
    <div class="container">
        <div class="dual-banner-inner">
            <ul class="banners">
                <?php foreach( $banners as $banner ) : ?>

                    <?php if( ! empty( $banner['title'] ) || ! empty( $banner['sub_title'] ) ) : ?>
                        <li class="banner<?php if ( ! empty( $banner['caption_align'] ) ) { echo ' align-end'; } ?>">
                            <div class="banner-caption">
                                <?php
                                if( ! empty( $banner['title'] ) ) {
                                    echo '<h4 class="banner-title">' . wp_kses_post( $banner['title'] ) . '</h4>' ;
                                }
                                if( ! empty( $banner['sub_title'] ) ) {
                                    echo '<span class="sub-title">' . wp_kses_post( $banner['sub_title'] ) . '</span>' ;
                                }
                                ?>
                            </div>
                            <?php
                            if( ! empty( $banner['action_text'] ) ) { 
                            echo '
                            <div class="banner-action">
                                <a href="'. esc_url( $banner['action_link'] ) . '">' . wp_kses_post( $banner['action_text'] ) . '</a>
                            </div>' ;
                            }
                            ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
