<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package jobhunt
 */
 ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
    do_action( 'jobhunt_before_site' );

    $page_args = apply_filters( 'jobhunt_404_page_args', array(
        'bg_img'        => '',
        'img_src'       => get_template_directory_uri() . '/assets/images/404.svg',
        'page_title'    => esc_html__( 'We Are Sorry, Page Not Found', 'jobhunt' ),
        'sub_title'     => esc_html__( 'Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist. Check the Url you entered for any mistakes and try again.', 'jobhunt' ),
        'button_text'   => esc_html__( 'Back to Homepage', 'jobhunt'),
        'button_link'   => home_url( '/' )
    ) );

    $style_attr = '';
    if ( ! empty( $page_args['bg_img'] ) ) {
        $style_attr = 'background-image: url( ' . esc_url( $page_args['bg_img'] ) . ' );';
    }
?>

<div id="page" class="hfeed site">

    <div id="content" class="site-content" tabindex="-1" >
        <div class="container">
            <div class="site-content-inner">

                <div id="primary" class="content-area">

                    <main id="main" class="site-main">

                        <div class="error-404 not-found">

                            <div class="page-content">
                                <div class="content-404" <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
                                    <div class="content-404-inner">
                                        <?php if( ! empty( $page_args['img_src'] ) ) : ?>
                                        <div class="header-image">
                                            <img src="<?php echo esc_url( $page_args['img_src'] ); ?>" alt="<?php echo esc_attr__( 'Error404 Image', 'jobhunt' ); ?>" class="error404-image" />
                                        </div><!-- .header-image -->
                                        <?php endif; ?>

                                        <h4><?php echo wp_kses_post( $page_args['page_title'] ); ?></h4>
                                        <p><?php echo wp_kses_post( $page_args['sub_title'] ); ?></p>

                                        <div class="form-search" aria-label="<?php echo esc_attr__( 'Search', 'jobhunt' ); ?>">
                                            <?php get_search_form(); ?>
                                        </div>
                                        <div class="home-button">
                                            <a href="<?php echo esc_url( $page_args['button_link'] ); ?>"><?php echo wp_kses_post( $page_args['button_text'] ); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .page-content -->
                        </div><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->

            </div><!-- .site-content-inner -->
        </div><!-- .container -->
    </div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
