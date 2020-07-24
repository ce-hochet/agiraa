<?php
/**
 * Banner With Image Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! empty( $title ) || ! empty( $sub_title ) ) :

    $section_class = empty( $section_class ) ? 'jh-section banner-with-image-section' : 'jh-section banner-with-image-section ' . $section_class;

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
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
        <div class="container">
            <div class="banner-with-image-section-inner">
                <div class="banner-with-image-details">
                    <?php
                    if( ! empty( $title ) ) {
                        echo '<h3 class="title">' . wp_kses_post( $title ) . '</h3>' ;
                    }
                    if( ! empty( $sub_title ) ) {
                        echo '<span class="sub-title">' . wp_kses_post( $sub_title ) . '</span>' ;
                    }
                    ?>
                </div>
                <?php
                if( ! empty( $image[0] ) ) {
                    echo '<div class="banner-thumbnail">';
                        echo '<img src="' . esc_url( $image[0] ).'" alt="' . esc_attr__( 'Banner Image', 'jobhunt' ) . '">' ;
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
