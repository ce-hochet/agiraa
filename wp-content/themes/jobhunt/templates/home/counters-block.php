<?php
/**
 * Counter Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section jh-site-stats-section' : 'jh-section jh-site-stats-section ' . $section_class;

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
        <div class="jh-site-stats-inner">
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
            <ul class="site-stats-list">
                <?php foreach( $counters as $counter ) : ?>
                    <?php
                    if( ! empty( $counter['counter_title'] ) && ! empty( $counter['count_value'] ) ) : ?>
                        <li class="site-stats">
                            <?php
                                echo '<span class="stats-count">' . esc_html( $counter['count_value'] ) . '</span>' ;
                                echo '<h4 class="stats-title">' . esc_html( $counter['counter_title'] ) . '</h4>' ;
                            ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
