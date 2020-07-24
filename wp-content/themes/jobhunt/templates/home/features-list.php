<?php
/**
 * Features List
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section jobhunt-features-section' : 'jh-section jobhunt-features-section ' . $section_class;
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <?php if( ! empty( $section_title ) ) : ?>
    <header class="section-header">
        <h2 class="section-title"><?php echo wp_kses_post( $section_title ); ?></h2>
    </header>
    <?php endif; ?>
    <ul class="features">
        <?php foreach( $features as $feature ) : ?>
            <?php if ( ! empty( $feature['icon'] ) ) : ?>
            <li class="feature">
                <div class="feature-inner">
                    <div class="feature-thumbnail">
                        <i class="<?php echo esc_attr( $feature['icon'] ); ?>"></i>
                    </div>
                    <div class="feature-info">
                        <?php
                            if( ! empty( $feature['feature_title'] ) ) {
                                echo '<h3 class="feature-title">' . wp_kses_post( $feature['feature_title'] ) . '</h3>' ;
                            }
                        ?>
                        <?php
                            if( ! empty( $feature['feature_desc'] ) ) {
                                echo '<span class="feature-desc">' . wp_kses_post( $feature['feature_desc'] ) . '</span>' ;
                            }
                        ?>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>