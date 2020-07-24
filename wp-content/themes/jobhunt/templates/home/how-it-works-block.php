<?php
/**
 * How It Works Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section how-it-works-section' : 'jh-section how-it-works-section ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

if( ! empty( $type ) ) {
    $section_class .= ' ' . $type;
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
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
    <ul class="steps">
        <?php foreach( $steps as $step ) : ?>
            <?php if ( ! empty( $step['icon'] ) ) : ?>
            <li class="step">
                <div class="step-thumbnail">
                    <i class="<?php echo esc_attr( $step['icon'] ); ?>"></i>
                </div>
                <div class="step-info">
                    <?php
                        if( ! empty( $step['step_title'] ) ) {
                            echo '<h4 class="step-title">' . wp_kses_post( $step['step_title'] ) . '</h4>' ;
                        }
                        if( ! empty( $step['step_desc'] ) ) {
                            echo '<span class="step-desc">' . wp_kses_post( $step['step_desc'] ) . '</span>' ;
                        }
                    ?>
                </div>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>