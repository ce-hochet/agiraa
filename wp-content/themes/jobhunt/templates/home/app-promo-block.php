<?php
/**
 * App Promo Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section app-promo-section' : 'jh-section app-promo-section ' . $section_class;

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
        <div class="app-promo-section-inner">
            <div class="app-promo-details">
                <?php if( ! empty( $section_title ) || ! empty( $sub_title ) ) : ?>
                <div class="section-header">
                    <?php
                    if( ! empty( $section_title ) ) {
                        echo '<h3 class="section-title">' . wp_kses_post( $section_title ) . '</h3>' ;
                    }
                    if( ! empty( $sub_title ) ) {
                        echo '<span class="section-sub-title">' . wp_kses_post( $sub_title ) . '</span>' ;
                    }
                    ?>
                </div>
                <?php endif; ?>
                <ul class="app-promo-links">
                    <?php foreach( $apps as $app ) : ?>
                        <?php if ( ! empty( $app['link'] ) ) : ?>
                        <li class="app-promo-link">
                            <a href="<?php echo esc_url( $app['link'] ); ?>">
                                <div class="app-store-icon">
                                    <?php
                                        if( ! empty( $app['icon'] ) ) {
                                            echo '<i class="' . esc_attr( $app['icon'] ).'"></i>' ;
                                        }
                                    ?>
                                </div>
                                <div class="app-link-info">
                                    <?php
                                        if( ! empty( $app['app_title'] ) ) {
                                            echo '<h4 class="app-title">' . wp_kses_post( $app['app_title'] ) . '</h4>' ;
                                        }
                                        if( ! empty( $app['app_desc'] ) ) {
                                            echo '<span class="app-sub-title">' . wp_kses_post( $app['app_desc'] ) . '</span>' ;
                                        }
                                    ?>
                                </div>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="app-promo-banner">
                <?php
                    if( ! empty( $image[0] ) ) {
                        echo '<img src="' . esc_url( $image[0] ).'" alt="' . esc_attr__( 'App Promo Image', 'jobhunt' ) . '">' ;
                    }
                ?>
            </div>
        </div>
    </div>
</section>
