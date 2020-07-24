<?php
/**
 * Testimonial Block
 *
 * @package jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$query = woothemes_get_testimonials( $query_args );

if( ! empty( $query ) ) {
    $section_class = empty( $section_class ) ? 'jh-section testimonial-block' : 'jh-section testimonial-block ' . $section_class;

    $section_id = 'section-products-carousel-' . uniqid();

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
    <section class="<?php echo esc_attr( $section_class ); ?>" id="<?php echo esc_attr( $section_id ); ?>"  <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
        <div class="container">
            <div class="testimonial-block-inner">
                <div class="section-header">
                    <?php if ( ! empty( $section_title ) ) : ?>
                        <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $sub_title ) ) : ?>
                        <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                    <?php endif; ?>
                </div>
                <ul class="testimonials" data-ride="slick" data-slick='<?php echo htmlspecialchars( json_encode( $carousel_args ), ENT_QUOTES, 'UTF-8' ); ?>'>
                    <?php foreach ($query as $post) : ?>
                        <?php if ( ! empty( $post->post_content ) ) : ?>
                        <li class="testimonial">
                            <div class="testimonial-inner">
                                <div class="customer-info">
                                    <div class="customer-profile-image">
                                        <?php if ( ! empty( $post->image ) ) : ?>
                                            <?php
                                                $img_src_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
                                                $img_src = $img_src_array[0];
                                            ?>
                                            <img src="<?php echo esc_url( $img_src ); ?>" class="profile-pic" alt="<?php echo esc_attr( $post->post_title ); ?>">
                                        <?php else : ?>
                                            <img src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzIwMCcgd2lkdGg9JzIwMCcgIGZpbGw9IiNmZmZmZmYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBkPSJNNTcuNCw1NmMtMC4zLTAuMS0yLjQtMS4xLTEuMS01aDBjMy40LTMuNSw2LTkuMiw2LTE0LjdjMC04LjUtNS43LTEzLTEyLjMtMTNjLTYuNiwwLTEyLjMsNC41LTEyLjMsMTMgICBjMCw1LjYsMi42LDExLjMsNiwxNC44YzEuMywzLjUtMS4xLDQuOC0xLjYsNWMtNi45LDIuNS0xNSw3LjEtMTUsMTEuNmMwLDEuMiwwLDAuNSwwLDEuN2MwLDYuMSwxMS45LDcuNSwyMi45LDcuNSAgIGMxMSwwLDIyLjgtMS40LDIyLjgtNy41YzAtMS4yLDAtMC41LDAtMS43QzcyLjgsNjIuOSw2NC43LDU4LjQsNTcuNCw1NnoiPjwvcGF0aD48L2c+PC9zdmc+"" class="placeholder" alt="<?php echo esc_attr( $post->post_title ); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="customer-info-inner">
                                        <?php
                                            if( ! empty( $post->post_title ) ) {
                                                echo '<h4 class="customer-name">' . wp_kses_post( $post->post_title ) . '</h4>' ;
                                                echo '<span class="customer-designation">' . wp_kses_post( $post->byline ) . '</span>' ;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="customer-feedback">
                                    <?php if( ! empty( $post->post_content ) ) {
                                        if( apply_filters( 'jobhunt_testimonial_block_full_content', false ) ) {
                                            echo '<p>' . wp_kses_post( $post->post_content ) . '</p>' ;
                                        } else {
                                            $excerpt_length = apply_filters( 'jobhunt_testimonial_block_excerpt_length', '20' );
                                            echo '<p>' . wp_kses_post( wp_trim_words( $post->post_content , $excerpt_length ) ) . '</p>' ;
                                        }
                                    } ?>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php
}
