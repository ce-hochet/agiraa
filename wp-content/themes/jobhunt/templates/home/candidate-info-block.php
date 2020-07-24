<?php
/**
 * Candidate Info Block
 *
 * @package jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( jobhunt_is_wp_resume_manager_activated() ) {
    $section_class = empty( $section_class ) ? 'jh-section candidate-profile-section' : 'jh-section candidate-profile-section ' . $section_class;

    $query_args['post_type'] = "resume";

    if( isset( $query_args['limit'] ) ) {
        $query_args['posts_per_page'] = $query_args['limit'];
    }

    if ( ! empty( $is_featured ) ) {
        $query_args['meta_query'][] = array(
            'key'     => '_featured',
            'value'   => '1',
            'compare' => $is_featured ? '=' : '!='
        );
    }

    $wp_query = new WP_Query( $query_args );


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
    <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?> <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
        <div class="container">
            <div class="candidate-profile-inner">
                <div class="section-header">
                    <?php if ( ! empty( $section_title ) ) : ?>
                        <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $sub_title ) ) : ?>
                        <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                    <?php endif; ?>
                </div>
                <ul class="candidates" data-ride="slick" data-slick='<?php echo htmlspecialchars( json_encode( $carousel_args ), ENT_QUOTES, 'UTF-8' ); ?>'>
                    <?php
                    if ( $wp_query->have_posts() ):
                        $candidates = get_posts( $query_args );
                        foreach ( $candidates as $candidate ) : ?>
                            <li class="candidate">
                                <div class="candidate-inner">
                                    <div class="candidate-info">
                                        <?php
                                        if ( ! empty( $candidate->_candidate_photo ) ) {
                                            echo '<img class="candidate-photo" src="' . esc_attr( $candidate->_candidate_photo ) . '" alt="' . esc_attr( $candidate->post_title ) . '" />';
                                        } else {
                                            echo '<img src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzIwMCcgd2lkdGg9JzIwMCcgIGZpbGw9IiNmZmZmZmYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBkPSJNNTcuNCw1NmMtMC4zLTAuMS0yLjQtMS4xLTEuMS01aDBjMy40LTMuNSw2LTkuMiw2LTE0LjdjMC04LjUtNS43LTEzLTEyLjMtMTNjLTYuNiwwLTEyLjMsNC41LTEyLjMsMTMgICBjMCw1LjYsMi42LDExLjMsNiwxNC44YzEuMywzLjUtMS4xLDQuOC0xLjYsNWMtNi45LDIuNS0xNSw3LjEtMTUsMTEuNmMwLDEuMiwwLDAuNSwwLDEuN2MwLDYuMSwxMS45LDcuNSwyMi45LDcuNSAgIGMxMSwwLDIyLjgtMS40LDIyLjgtNy41YzAtMS4yLDAtMC41LDAtMS43QzcyLjgsNjIuOSw2NC43LDU4LjQsNTcuNCw1NnoiPjwvcGF0aD48L2c+PC9zdmc+"" class="placeholder" alt="' . esc_attr( $candidate->post_title ) . '">';
                                        }
                                        ?>
                                        <div class="candidate-info-inner">
                                            <?php
                                                if( ! empty( $candidate->post_title ) ) {
                                                    echo '<h4 class="candidate-name">' . wp_kses_post( $candidate->post_title ) . '</h4>' ;
                                                    echo '<span class="profession">' . wp_kses_post( $candidate->_candidate_title ) . '</span>' ;
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if( ! empty( $candidate->post_content ) ) {
                                        echo '<div class="candidate-content">';
                                            echo '<p>' . wp_kses_post( wp_trim_words( $candidate->post_content , 8 ) ) . '</p>' ;
                                        echo '</div>';
                                    }
                                    ?>
                                    <a class="view-resume" href="<?php the_permalink( $candidate->ID ); ?>"><?php  echo esc_html__('View Resume' , 'jobhunt'); ?><i class="la la-arrow-right"></i></a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?> 
                </ul>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}
