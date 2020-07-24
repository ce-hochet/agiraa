<?php
/**
 * Filter functions for Typography Section of Theme Options
 */

if( ! function_exists( 'redux_has_google_fonts' ) ) {
    function redux_has_google_fonts( $load_default ) {
        global $jobhunt_options;

        if( isset( $jobhunt_options['use_predefined_font'] ) ) {
            $load_default = $jobhunt_options['use_predefined_font'];
        }

        return $load_default;
    }
}

if( ! function_exists( 'redux_apply_custom_fonts' ) ) {
    function redux_apply_custom_fonts() {
        global $jobhunt_options;

        if( isset( $jobhunt_options['use_predefined_font'] ) && !$jobhunt_options['use_predefined_font'] ) {
            $title_font             = $jobhunt_options['jobhunt_title_font'];
            $content_font           = $jobhunt_options['jobhunt_content_font'];
            $title_font_family      = $title_font['font-family'];
            $title_font_weight      = $title_font['font-weight'];
            $content_font_family    = $content_font['font-family'];
            $content_font_weight    = $content_font['font-weight'];

            $custom_font_css        = '
            h1, .h1,
            h2, .h2,
            h3, .h3,
            h4, .h4,
            h5, .h5,
            h6, .h6{
                font-family: ' . $title_font_family . ' !important;
                font-weight: ' . $title_font_weight . ' !important;
            }

            label,
            .button,
            .job-type,
            blockquote,
            b, strong, dt, th,
            .post-navigation .post-direction,
            .tag-share .tags-links .tags-label,
            .widget .widget-title,
            .comment-list .woocommerce-review__author,
            .comment-list .woocommerce-review__author a,
            .comment-respond .comment-reply-title,
            ul.page-numbers a,
            ul.page-numbers span,
            .woocommerce-result-count,
            form.woocommerce-cart-form + .cart-collaterals .checkout-button,
            .shop_table:not(.subscription_details) .product-name a,
            button[name="woocommerce_checkout_place_order"],
            .showing_jobs span,
            .load_more_jobs,
            .job-list-tab-section .nav-tabs .nav-link,
            .job-pricing-inner .woocommerce-Price-amount,
            .page-template-template-homepage-v2 .job-search-block form .job-search-submit button,
            .page-template-template-homepage-v2 .job-search-block form .resume-search-submit button,
            .page-template-template-homepage-v2 .resume-search-block form .job-search-submit button,
            .page-template-template-homepage-v2 .resume-search-block form .resume-search-submit button,
            .page-template-template-homepage-v5 .job-search-block .section-sub-title,
            .page-template-template-homepage-v5 .resume-search-block .section-sub-title,
            article .entry-meta, article.post .entry-meta,
            #customer_login .woocommerce-form .woocommerce-LostPassword,
            .woocommerce-form.woocommerce-form-login .woocommerce-LostPassword,
            .woocommerce-MyAccount-navigation ul,
            .subscription_details tbody td:first-child,
            .jobhunt-register-login-form .nav li a {
                font-family: ' . $title_font_family . ' !important;
            }

            body {
                font-family: ' . $content_font_family . ' !important;
                font-weight: ' . $content_font_weight . ' !important;
            }
            ';

            $custom_font_css_handle = wp_style_is( 'jobhunt-color', 'enqueued' ) ? 'jobhunt-color' : 'jobhunt-style';
            wp_add_inline_style( $custom_font_css_handle, $custom_font_css );
        }
    }
}
