<?php
/**
 * Recent Post Block
 *
 * @author  MadrasThemes
 * @package Jobhunt/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'jh-section jh-recent-articles blog-grid' : 'jh-section jh-recent-articles blog-grid ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

if( ! empty( $type ) ) {
    $section_class .= ' ' . $type;
}

$recent_posts = new WP_Query( $query_args );
if ( $recent_posts->have_posts() ) : ?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"
    <?php endif; ?>>
    <div class="container">
        <div class="jh-recent-articles-inner">
            <?php if( ! empty( $section_title ) || ! empty( $sub_title ) ) : ?>
            <header class="section-header">
                <?php if( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo wp_kses_post ( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo wp_kses_post ( $sub_title ); ?></span>
                <?php endif; ?>
            </header>
            <?php endif; ?>
            <div class="posts columns-<?php echo esc_attr( $columns ); ?>">
                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                <article class="post">
                    <div class="post-inner">
                        <?php
                            echo '<div class="media-attachment">';
                            jobhunt_post_thumbnail( '390x280-crop', true );
                            echo '</div>';
                            jobhunt_post_body_wrap_start();
                            jobhunt_post_header();
                            echo '<div class="entry-content">';
                            echo wp_trim_words( get_the_content() , 12, '....' );
                            echo '</div>';
                            jobhunt_post_readmore();
                            jobhunt_post_body_wrap_end();
                        ?>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>
<?php endif;
wp_reset_postdata();
