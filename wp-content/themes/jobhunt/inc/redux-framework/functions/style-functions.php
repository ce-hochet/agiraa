<?php
/**
 * Filter functions for Styling Section of Theme Options
 */

if ( ! function_exists( 'redux_toggle_use_predefined_colors' ) ) {
    function redux_toggle_use_predefined_colors( $enable ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['use_predefined_color'] ) && $jobhunt_options['use_predefined_color'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if( ! function_exists( 'redux_apply_primary_color' ) ) {
    function redux_apply_primary_color( $color ) {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['main_color'] ) ) {
            $color = $jobhunt_options['main_color'];
        }

        return $color;
    }
}

if ( ! function_exists( 'sass_darken' ) ) {
    function sass_darken( $hex, $percent ) {
        preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
        str_replace( '%', '', $percent );
        $percent = (int) $percent;
        $color = "#";
        for( $i = 1; $i <= 3; $i++ ) {
            $primary_colors[$i] = hexdec( $primary_colors[$i] );
            if ( $percent > 50 ) $percent = 50;
            $dv = 100 - ( $percent * 2 );
            $primary_colors[$i] = round( $primary_colors[$i] * ( $dv ) / 100 );
            $color .= str_pad( dechex( $primary_colors[$i] ), 2, '0', STR_PAD_LEFT );
        }
        return $color;
    }
}

if ( ! function_exists( 'sass_lighten' ) ) {
    function sass_lighten( $hex, $percent ) {
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $percent = (int) $percent;
        $color = "#";
        for($i = 1; $i <= 3; $i++) {
            $primary_colors[$i] = hexdec($primary_colors[$i]);
            $primary_colors[$i] = round($primary_colors[$i] * (100+($percent*2))/100);
            $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
        }
        return $color;
    }
}

if ( ! function_exists( 'sass_yiq' ) ) {
    function sass_yiq( $hex ) {
        $length = strlen( $hex );
        if( $length < 5 ) {
            $hex = ltrim($hex,"#");
            $hex = '#' . $hex . $hex;
        }

        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $color);

        for($i = 1; $i <= 3; $i++) {
            $color[$i] = hexdec($color[$i]);
        }
        $yiq = (($color[1]*299)+($color[2]*587)+($color[3]*114))/1000;
        return ($yiq >= 128) ? '#000' : '#fff';
    }
}

if ( ! function_exists( 'redux_apply_custom_color_css' ) ) {
    function redux_apply_custom_color_css() {
        global $jobhunt_options;

        if ( isset( $jobhunt_options['use_predefined_color'] ) && $jobhunt_options['use_predefined_color'] ) {
            return;
        }

        $how_to_include = isset( $jobhunt_options['include_custom_color'] ) ? $jobhunt_options['include_custom_color'] : '1';

        if ( $how_to_include == '1' ) {
            $custom_color_css = redux_get_custom_color_css();
            $custom_color_css_handle = 'jobhunt-style';
            wp_add_inline_style( $custom_color_css_handle, $custom_color_css );
        } else {
            $custom_color_file = get_stylesheet_directory() . '/custom-color.css';

            if ( file_exists( $custom_color_file ) ) {
                wp_enqueue_style( 'jobhunt-custom-color', get_stylesheet_directory_uri() . '/custom-color.css' );
            }
        }
    }
}

if ( ! function_exists( 'redux_get_custom_color_css' ) ) {
    function redux_get_custom_color_css() {
        global $jobhunt_options;

        $primary_color_1        = isset( $jobhunt_options['custom_primary_color_1'] ) ? $jobhunt_options['custom_primary_color_1'] : '#fb236a';
        $primary_color_2        = isset( $jobhunt_options['custom_primary_color_2'] ) ? $jobhunt_options['custom_primary_color_2'] : '#8b91dd';
        $secondary_bg_color     = isset( $jobhunt_options['custom_secondary_bg_color'] ) ? $jobhunt_options['custom_secondary_bg_color'] : '#555555';
        $primary_text_color     = isset( $jobhunt_options['custom_primary_text_color'] ) ? $jobhunt_options['custom_primary_text_color'] : '#ffffff';

        $styles             = '
        blockquote,
        article .entry-title a:hover,
        article .entry-title a:focus,
        article.post .entry-title a:hover,
        article.post .entry-title a:focus,
        .comment-content .reply a,
        .comment-form .required,
        .blog-grid article.post .entry-meta .comments-link a,
        .blog-grid article.post .entry-meta .posted-on a,
        .pagination li a .meta-nav,
        .widget_search form.search-form label:after,
        .widget_search .woocommerce-product-search label:after,
        .jobhunt_recent_posts_widget a:hover i,
        .jobhunt_recent_posts_widget a:focus i,
        .widget_calendar .calendar_wrap a:hover,
        .widget_calendar .calendar_wrap a:focus,
        .widget ul li a:hover,
        .widget ul li a:focus,
        .widget_rss .widget-title a:hover,
        .widget_rss .widget-title a:focus,
        article .media-attachment .post-icon:hover i,
        article.post .media-attachment .post-icon:hover i,
        article .media-attachment .post-icon:focus i,
        article.post .media-attachment .post-icon:focus i,
        .site-header-inner-wrapper .menu li a:hover,
        .site-header-inner-wrapper .menu li a:focus,
        .footer-v2 .footer-widgets a:hover,
        .footer-v2 .footer-widgets a:focus,
        .footer-v2 .footer-widgets address a:hover,
        .footer-v2 .footer-widgets address a:focus,
        .footer-v2 .footer-widgets .textwidget a:hover,
        .footer-v2 .footer-widgets .textwidget a:focus,
        .footer-v2 .footer-widgets .textwidget a:hover p,
        .footer-v2 .footer-widgets .textwidget a:focus p,
        .footer-v2 .footer-widgets .widget_nav_menu .menu-item a:hover,
        .footer-v2 .footer-widgets .widget_nav_menu .menu-item a:focus,
        .footer-v2 .footer-widgets .widget ul li a:hover,
        .footer-v2 .footer-widgets .widget ul li a:focus,
        .footer-v3 .footer-widgets a:hover,
        .footer-v3 .footer-widgets a:focus,
        .footer-v3 .footer-widgets address a:hover,
        .footer-v3 .footer-widgets address a:focus,
        .footer-v3 .footer-widgets .textwidget a:hover,
        .footer-v3 .footer-widgets .textwidget a:focus,
        .footer-v3 .footer-widgets .textwidget a:hover p,
        .footer-v3 .footer-widgets .textwidget a:focus p,
        .footer-v3 .footer-widgets .widget_nav_menu .menu-item:hover,
        .footer-v3 .footer-widgets .widget_nav_menu .menu-item:focus,
        .footer-v3 .footer-widgets .widget_nav_menu .menu-item:hover a,
        .footer-v3 .footer-widgets .widget_nav_menu .menu-item:focus a,
        .footer-v3 .footer-widgets .widget ul li a:hover,
        .footer-v3 .footer-widgets .widget ul li a:focus,
        .footer-v5 .footer-widgets a:hover,
        .footer-v5 .footer-widgets a:focus,
        .footer-v5 .footer-widgets address a:hover,
        .footer-v5 .footer-widgets address a:focus,
        .footer-v5 .footer-widgets .textwidget a:hover,
        .footer-v5 .footer-widgets .textwidget a:focus,
        .footer-v5 .footer-widgets .textwidget a:hover p,
        .footer-v5 .footer-widgets .textwidget a:focus p,
        .footer-v5 .footer-widgets .widget_nav_menu .menu-item a:hover,
        .footer-v5 .footer-widgets .widget_nav_menu .menu-item a:focus,
        .footer-v5 .footer-widgets .widget ul li a:hover,
        .footer-v5 .footer-widgets .widget ul li a:focus,
        .v1 .job-category .job-count,
        .v1 .job-category > a:hover i,
        .blog-grid article.post .post-readmore a:hover,
        .blog-grid article.post .post-readmore a:focus,
        .blog-grid article .post-readmore a:hover,
        .blog-grid article .post-readmore a:focus,
        .blog-list article.post .post-readmore a:hover,
        .blog-list article.post .post-readmore a:focus,
        .blog-list article .post-readmore a:hover,
        .blog-list article .post-readmore a:focus,
        .how-it-works-section.v1 .step i,
        .job-pricing-inner .woocommerce-Price-amount,
        .job-list-section .load_more_jobs strong,
        .how-it-works-section.v3 .step:hover i,
        .candidate-profile-inner .view-resume,
        .v4.job-categories-section .job-category i,
        .v2.jh-site-stats-section .site-stats .stats-count,
        .v4.how-it-works-section .step i,
        .job-list-tab-section .load_more_jobs strong,
        .jobhunt-faq-section .faq-content-question-header h5[data-toggle="collapse"]::after,
        .faq-with-testimonail-section .slick-dots li.slick-active button::before,
        .header-search-icon .job-search-block .job-search-keywords::after,
        .header-search-icon .job-search-block .job-search-location::after,
        .header-search-icon .resume-search-block .resume-search-keywords::after,
        .header-search-icon .resume-search-block .resume-search-location::after,
        .page-template-template-homepage-v1 .job-search-block .job-search-keywords::after,
        .page-template-template-homepage-v1 .job-search-block .job-search-location::after,
        .page-template-template-homepage-v1 .resume-search-block .resume-search-keywords::after,
        .page-template-template-homepage-v1 .resume-search-block .resume-search-location::after,
        .page-template-template-homepage-v1 .site-content-page-header-inner::after,
        .page-template-template-homepage-v3 .site-content-page-header-inner::after,
        .jh-companies .company-category .categories a,
        .widget-area .jobhunt-wpjm-search button,
        .widget_jobhunt_wpjm_location_search button,
        .jobhunt-wpjmc-search button,
        .jobhunt-wpjmc-location-search button,
        .jobhunt-wpjmr-search button,
        .jobhunt-wpjmr-location-search button,
        .woocommerce-product-search button,
        .widget_jobhunt_wpjm_date_filter .jobhunt-wpjm-date-filter-list__item.chosen a::before,
        .widget_jobhunt_wpjmc_date_filter .jobhunt-wpjmc-date-filter-list__item.chosen a::before,
        .widget_jobhunt_wpjmr_date_filter .jobhunt-wpjmr-date-filter-list__item.chosen a::before,
        .company-profile-inner .company-location,
        .single-resume-content .single-resume__content-area .resume-manager-education dt::before,
        .single-resume-content .single-resume__content-area .resume-manager-skills li::before,
        .job-listing-company strong,
        .post-type-archive-job_listing .job-search-block .job-search-keywords::after,
        .post-type-archive-job_listing .job-search-block .job-search-location::after,
        .type-list-classic.post-type-archive-job_listing .jobhunt-wpjm-active-filters > ul .chosen a,
        .job-list-summary-section .job_summary_content strong,
        .page-template-template-homepage-v1 .jh-scroll-to a i,
        .page-template-template-homepage-v3 .jh-scroll-to a i,
        .page-template-template-homepage-v5 .jh-scroll-to a i:hover,
        .comment-list .woocommerce-review__published-date,
        .comment-list .woocommerce-review__published-date a,
        .job_listing.job_position_featured .job-listing-loop-job__title {
            color: ' . $primary_color_1 . ';
        }

        .site-header.header-v5,
        .footer-v2 .footer-widget .social-menu-widget .menu-item a:hover,
        .footer-v2 .footer-wadget .social-menu-widget .menu-item a:focus,
        .footer-v2 .footer-widget .social-menu-widget li a:hover,
        .footer-v2 .footer-widget .social-menu-widget li a:focus,
        .v2.job-categories-section .job-category:hover i,
        .v1.jh-site-stats-section,
        .product.featured .job-pricing-inner,
        .how-it-works-section.v2 .step i,
        .banner-with-image-section::after,
        .dual-banner-inner .banners .align-end::after,
        .feature-inner:hover .feature-thumbnail i,
        .feature-inner:focus .feature-thumbnail i,
        .error-404 .home-button a:hover,
        .error-404 .home-button a:focus,
        .error-404 .search-submit:hover,
        .error-404 .search-submit:focus,
        .how-it-works-step,
        .header-menu .sub-menu > li > a.active,
        .header-menu .sub-menu > li > a:active,
        .company-profile-inner .slick-arrow:hover,
        .company-profile-inner .slick-arrow:focus,
        .jobhunt-wpjm-active-filters > ul .chosen a,
        .type-list-classic.post-type-archive-job_listing .jobhunt-wpjm-active-filters > ul .chosen a:hover,
        #submit-job-form .job-manager-uploaded-file-preview .job-manager-remove-uploaded-file::before,
        .site-header.header-v5 .jobhunt-stick-this.stuck,
        .off-canvas-navbar-toggle-buttons .navbar-toggler,
        #scrollUp:hover,
        #scrollUp:focus,
        .banners-block:not(.with-action):hover,
        .page-template-template-homepage-v1 .jh-scroll-to a:hover i,
        .page-template-template-homepage-v1 .jh-scroll-to a:focus i,
        .page-template-template-homepage-v3 .jh-scroll-to a:hover i,
        .page-template-template-homepage-v3 .jh-scroll-to a:focus i {
            background-color: ' . $primary_color_1 . ';
        }

        .how-it-works-section.v1 .step i,
        .how-it-works-section.v1 .step + .step::before,
        .how-it-works-section.v2 .step + .step::before,
        .v2 .testimonials img,
        .blog-grid .comments-link,
        .v3 .testimonials img,
        .how-it-works-section.v3 .step:hover i,
        .feature-inner:hover .feature-thumbnail i,
        .feature-inner:focus .feature-thumbnail i,
        .error-404 .home-button a:hover,
        .error-404 .home-button a:focus,
        .error-404 .search-submit:hover,
        .error-404 .search-submit:focus,
        .company-profile-inner .slick-arrow:hover,
        .company-profile-inner .slick-arrow:focus,
        #scrollUp:hover,
        #scrollUp:focus,
        .page-template-template-homepage-v1 .jh-scroll-to a:hover,
        .page-template-template-homepage-v1 .jh-scroll-to a:focus,
        .widget_price_filter .ui-slider .ui-slider-handle {
            border-color: ' . $primary_color_1 . ';
        }

        .header-v4 .header-menu li.menu-item-user-page a,
        .header-v4 .header-menu li.menu-item-register a {
            color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
        }

        .header-v4 .header-menu li.menu-item-user-page a:hover,
        .header-v4 .header-menu li.menu-item-register a:hover {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        .post-a-job a,
        .jobhunt_newsletter_widget .newsletter-form button[type="submit"],
        .checkout-button,
        button[name="woocommerce_checkout_place_order"],
        .application_button,
        .job-pricing-inner .job-pricing-features a,
        .job-list-tab-section .nav-tabs .nav-link.active,
        .contact-form input[type="submit"],
        .page-template-template-homepage-v4 .job-search-block form button,
        .page-template-template-homepage-v5 .job-search-block .job-search-submit button,
        .page-template-template-homepage-v2 .job-search-block form .job-search-submit button,
        .page-template-template-homepage-v4 .resume-search-block form button,
        .page-template-template-homepage-v5 .resume-search-block .resume-search-submit button,
        .page-template-template-homepage-v2 .resume-search-block form .resume-search-submit button,
        .company-single-head__right .company-location-map,
        .companies-listing-a-z .company-group-inner .company-letter,
        .resume-single-type-v2 .single-resume-content-navbar .contact-candidate-email a,
        .job-manager-form fieldset .resume-manager-data-row .resume-manager-remove-row,
        .resume-manager-candidate-dashboard tfoot a,
        .job-manager-job-dashboard-content tfoot a,
        article.post-password-required .post-password-form input[type="submit"],
        article.post.post-password-required .post-password-form input[type="submit"],
        .handheld-sidebar-toggle .btn,
        .woocommerce-mini-cart__buttons .button.checkout,
        .job-manager-form.wp-job-manager-bookmarks-form .remove-bookmark,
        .job_tags a,
        .onsale,
        .wpforms-container.contact-form .wpforms-form .wpforms-submit-container .wpforms-submit,
        .wpforms-container.newsletter-form .wpforms-form .wpforms-submit-container .wpforms-submit {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        .post-a-job a:hover,
        .jobhunt_newsletter_widget .newsletter-form button[type="submit"]:hover,
        .checkout-button:hover,
        button[name="woocommerce_checkout_place_order"]:hover,
        .application_button:hover,
        .job-pricing-inner .job-pricing-features a:hover,
        .job-list-tab-section .nav-tabs .nav-link.active:hover,
        .contact-form input[type="submit"]:hover,
        .page-template-template-homepage-v4 .job-search-block form button:hover,
        .page-template-template-homepage-v5 .job-search-block .job-search-submit button:hover,
        .page-template-template-homepage-v2 .job-search-block form .job-search-submit button:hover,
        .page-template-template-homepage-v4 .resume-search-block form button:hover,
        .page-template-template-homepage-v5 .resume-search-block .resume-search-submit button:hover,
        .page-template-template-homepage-v2 .resume-search-block form .resume-search-submit button:hover,
        .company-single-head__right .company-location-map:hover,
        .companies-listing-a-z .company-group-inner .company-letter:hover,
        .resume-single-type-v2 .single-resume-content-navbar .contact-candidate-email a:hover,
        .job-manager-form fieldset .resume-manager-data-row .resume-manager-remove-row:hover,
        .resume-manager-candidate-dashboard tfoot a:hover,
        .job-manager-job-dashboard-content tfoot a:hover,
        article.post-password-required .post-password-form input[type="submit"]:hover,
        article.post.post-password-required .post-password-form input[type="submit"]:hover,
        .handheld-sidebar-toggle .btn:hover,
        .woocommerce-mini-cart__buttons .button.checkout:hover,
        .job-manager-form.wp-job-manager-bookmarks-form .remove-bookmark:hover,
        .job_tags a:hover,
        .onsale:hover,
        .wpforms-container.contact-form .wpforms-form .wpforms-submit-container .wpforms-submit:hover,
        .wpforms-container.newsletter-form .wpforms-form .wpforms-submit-container .wpforms-submit:hover {
            background-color: ' . $secondary_bg_color . ';
            border-color: ' . $secondary_bg_color . ';
            color: ' . sass_yiq( $secondary_bg_color ) . ';
        }

        .product.featured .job-pricing-inner .job-pricing-features a,
        #resume_preview input.button {
            border-color: #fb236a;
        }

        .product.featured .job-pricing-inner .job-pricing-features a:hover,
        #resume_preview input.button:hover {
            background-color: ' . $secondary_bg_color . ';
            border-color: ' . $secondary_bg_color . ';
            color: ' . sass_yiq( $secondary_bg_color ) . ';
        }

        a:hover,
        .post-author-info .media-heading a:hover,
        .post-author-info .media-heading a:focus,
        article .posted-on a:hover,
        article .posted-on a:focus,
        article.post .posted-on a:hover,
        article.post .posted-on a:focus,
        article .comments-link a:hover,
        article .comments-link a:focus,
        article.post .comments-link a:hover,
        article.post .comments-link a:focus,
        article .cat-links a:hover,
        article .cat-links a:focus,
        article.post .cat-links a:hover,
        article.post .cat-links a:focus,
        .comment-list .woocommerce-review__published-date a,
        .comment-list .woocommerce-review__published-date,
        .single-job-listing-overview__detail--icon,
        .v1 .job-category i,
        .v1 .testimonial-inner::before,
        .jh-resumes .candidate-title strong,
        .page-template-template-homepage-v3 .job-search-block .section-title,
        .page-template-template-homepage-v3 .resume-search-block .section-title,
        .jh-companies .company-title-position .open-positions,
        .company-single-head__left i,
        .single-company__inner .company-overview-inner i,
        .single-resume-inner .single-candidate-details .job-title,
        .resume-single-type-v1 .single-resume-content-navbar ul li a.active,
        .single-resume-content .single-resume__content-area .resume-manager-education .location,
        .single-resume-content .single-resume__content-area .resume-manager-experience dt::before,
        .single-resume-content .single-resume__content-area .resume-manager-experience .job_title,
        .single-resume-content .single-resume__content-area .resume-manager-awards .award-title,
        .single-resume-content .single-resume__content-area .resume-manager-awards dt::before,
        .single-resume__overview .single-resume__widget--content li i,
        .resume-single-type-v2 .single-resume-content-navbar .navbar-links li a.active,
        .job_listing-single-job-info .job-listing-single-location-salary-posted > div > i,
        .job_listing-single-job-info .job-listing_single_job__salary a,
        .job_listing-single-job-info .job-listing-single-location-salary-posted > div a:hover,
        .job_listing-single-job-info .job-listing-single-location-salary-posted > div a:focus,
        .job_listing-single-job-info .job-listing_single_job__category a:hover,
        .job_listing-single-job-info .job-listing_single_job__category a:focus,
        .single-job-listing-company__contact > a::before,
        .single-job-listing-company__contact > span::before,
        .single-job-listing-company__contact > a:hover,
        .single-job-listing-company__contact > a:focus,
        .job-single-type-v3 .job-location-type .location i,,
        .wpjm-activated .woocommerce-MyAccount-navigation-link a:hover,
        .wpjm-activated .woocommerce-MyAccount-navigation-link a:focus,
        .wpjm-activated .woocommerce-MyAccount-navigation-link.is-active a,
        .jobhunt-wpjm-active-filters .clear-all a,
        .single_job_listing .application-deadline:before,
        .single-company__inner .company-overview-inner .value a:hover,
        .single-company__inner .company-overview-inner .value a:focus,
        .single-resume__overview .single-resume__widget--content > li .single-resume-overview__detail-content--value a:hover,
        .single-resume__overview .single-resume__widget--content > li .single-resume-overview__detail-content--value a:focus,
        .claim-link a:hover,
        .claim-link a:focus,
        .job_listing.job_position_featured .job-listing-loop-job__title:after {
            color: ' . $primary_color_2 . ';
        }

        .banners-block:not(.with-action),
        .resume-single-type-v1 .single-candidate-head-left .categories li a:hover,
        .resume-single-type-v1 .single-candidate-head-left .categories li a:focus,
        .resume-single-type-v2 .single-candidate-details .categories li a:hover,
        .resume-single-type-v2 .single-candidate-details .categories li a:focus,
        .error-404 .search-submit {
            background-color: ' . $primary_color_2 . ';
        }

        .company-type-v3 .jh-companies .company-inner:hover,
        .error-404 .search-submit {
            border-color: ' . $primary_color_2 . ';
        }

        .resume-single-type-v1 .single-resume-content-navbar ul li a.active  {
            border-bottom-color: ' . $primary_color_2 . ';
        }

        .page-template-template-homepage-v1 .job-search-block .section-sub-title,
        .page-template-template-homepage-v1 .resume-search-block .section-sub-title {
            color: ' . sass_lighten( $primary_color_2  , '20%') . ';
        }

        .company-letters ul,
        .jh-companies-control-bar .companies-sorting select {
            background-color: ' . sass_lighten( $primary_color_2  , '27%') . ';
        }

        .testimonial-block.v1::after,
        .banners-block.with-action::after {
            background-color: ' . sass_darken( $primary_color_2  , '40%') . ';
        }

        .error-404 .content-404::after,
        .post-type-archive-job_listing .header-bg-default + .site-content-page-header:after,
        .single-job_listing .header-bg-default + .site-content-page-header:after,
        .post-type-archive-resume .header-bg-default + .site-content-page-header:after,
        .post-type-archive-company .header-bg-default + .site-content-page-header:after,
        .single-company .header-bg-default + .site-content-page-header:after,
        .single-resume-head::before,
        .single-job-preview .site-content-page-header::after,
        .single-resume-preview.single-resume .site-content-page-header::after,
        .blog .header-bg-default + .site-content-page-header:after,
        .blog-archive .header-bg-default + .site-content-page-header:after,
        .single.single-post .header-bg-default + .site-content-page-header:after,
        .page-template-default .header-bg-default + .site-content-page-header:after,
        .page-template-template-aboutpage .header-bg-default + .site-content-page-header:after,
        .page-template-template-sidebar .header-bg-default + .site-content-page-header:after,
        .page-template-template-job-sidebar .header-bg-default + .site-content-page-header:after,
        .page-template-template-resume-sidebar .header-bg-default + .site-content-page-header:after,
        .page-template-template-company-sidebar .header-bg-default + .site-content-page-header:after  {
            background: linear-gradient(45deg, ' . sass_darken( $primary_color_2  , '10%') . ' 0%, ' . sass_darken( $primary_color_2  , '60%') . ' 100%);
        }

        .company-letters ul li:first-child a,
        #submit-job-form > p strong a {
            background-color: ' . $primary_color_2 . ';
            border-color: ' . $primary_color_2 . ';
            color: ' . sass_yiq( $primary_color_2 ) . ';
        }

        .company-letters ul li:first-child a:hover,
        #submit-job-form > p strong a:hover {
            background-color: ' . $secondary_bg_color . ';
            border-color: ' . $secondary_bg_color . ';
            color: ' . sass_yiq( $secondary_bg_color ) . ';
        }

        .header-search-icon .job-search-block .job-search-submit button,
        .page-template-template-homepage-v1 .job-search-block .job-search-submit button,
        .page-template-template-homepage-v3 .job-search-block .job-search-submit button,
        .header-search-icon .resume-search-block .resume-search-submit button,
        .page-template-template-homepage-v1 .resume-search-block .resume-search-submit button,
        .page-template-template-homepage-v3 .resume-search-block .resume-search-submit button,
        #submit-resume-form .ui-sortable .resume-manager-add-row,
        #submit-resume-form .field .resume-manager-add-row,
        .post-type-archive-job_listing .job-search-block .job-search-submit button {
            background-color: ' . $primary_color_2 . ';
            border-color: ' . $primary_color_2 . ';
            color: ' . sass_yiq( $primary_color_2 ) . ';
        }

        .header-search-icon .job-search-block .job-search-submit button:hover,
        .page-template-template-homepage-v1 .job-search-block .job-search-submit button:hover,
        .page-template-template-homepage-v3 .job-search-block .job-search-submit button:hover,
        .header-search-icon .resume-search-block .resume-search-submit button:hover,
        .page-template-template-homepage-v1 .resume-search-block .resume-search-submit button:hover,
        .page-template-template-homepage-v3 .resume-search-block .resume-search-submit button:hover,
        #submit-resume-form .ui-sortable .resume-manager-add-row:hover,
        #submit-resume-form .field .resume-manager-add-row:hover,
        .post-type-archive-job_listing .job-search-block .job-search-submit button:hover {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        #customer_login .woocommerce-Button,
        .woocommerce-form.woocommerce-form-login .woocommerce-Button,
        .woocommerce-ResetPassword .woocommerce-Button,
        .jobhunt-register-login-form .tab-content input[type="submit"] {
            background-color: ' . sass_darken( $primary_color_2  , '40%') . ';
            border-color: ' . sass_darken( $primary_color_2  , '40%') . ';
            color: ' . sass_yiq( sass_darken( $primary_color_2  , '40%') ) . ';
        }

        #customer_login .woocommerce-Button:hover,
        .woocommerce-form.woocommerce-form-login .woocommerce-Button:hover,
        .woocommerce-ResetPassword .woocommerce-Button:hover,
        .jobhunt-register-login-form .tab-content input[type="submit"]:hover {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        @media (max-width: 767.98px) {
            .header-search-icon .job-search-block .job-search-submit button,
            .page-template-template-homepage-v1 .job-search-block .job-search-submit button,
            .page-template-template-homepage-v3 .job-search-block .job-search-submit button,
            .header-search-icon .resume-search-block .resume-search-submit button,
            .page-template-template-homepage-v1 .resume-search-block .resume-search-submit button,
            .page-template-template-homepage-v3 .resume-search-block .resume-search-submit button {
                background-color: ' . sass_darken( $primary_color_2  , '40%') . ';
                border-color: ' . sass_darken( $primary_color_2  , '40%') . ';
                color: ' . sass_yiq( sass_darken( $primary_color_2  , '40%') ) . ';
            }
        }

        @media (max-width: 767.98px) {
            .header-search-icon .job-search-block .job-search-submit button:hover,
            .page-template-template-homepage-v1 .job-search-block .job-search-submit button:hover,
            .page-template-template-homepage-v3 .job-search-block .job-search-submit button:hover,
            .header-search-icon .resume-search-block .resume-search-submit button:hover,
            .page-template-template-homepage-v1 .resume-search-block .resume-search-submit button:hover,
            .page-template-template-homepage-v3 .resume-search-block .resume-search-submit button:hover {
                background-color: ' . $primary_color_1 . ';
                border-color: ' . $primary_color_1 . ';
                color: ' . sass_yiq( $primary_color_1 ) . ';
            }
        }

        div.how-it-works-image .image-gradient::before {
            background-image: linear-gradient(45deg, ' . $primary_color_1 . ' 0%, ' . sass_darken( $primary_color_2  , '40%') . ' 100%);
        }

        .post-readmore a,
        input[type="submit"],
        .job-manager-form input[type="button"],
        .comment-respond .comment-form input[type="submit"],
        .job-categories-section .action .action-link,
        .job-list-section .load_more_jobs,
        .job-list-tab-section .load_more_jobs,
        .woocommerce-MyAccount-content .woocommerce-Address .edit,
        .apply_with_resume input[type="submit"],
        .job-manager-form .wpjmsq-job-questions-wrapper .remove_question_item {
            color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
        }

        .post-readmore a:hover,
        input[type="submit"]:hover,
        .job-manager-form input[type="button"]:hover,
        .comment-respond .comment-form input[type="submit"]:hover,
        .job-categories-section .action .action-link:hover,
        .job-list-section .load_more_jobs:hover,
        .job-list-tab-section .load_more_jobs:hover,
        .woocommerce-MyAccount-content .woocommerce-Address .edit:hover,
        .apply_with_resume input[type="submit"]:hover,
        .job-manager-form .wpjmsq-job-questions-wrapper .remove_question_item:hover {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        .jh-resumes .view-resume-action a,
        .company-single-head__left .open-positions,
        .company-profile-inner .open-positions,
        .resume-single-type-v1 .single-resume-inner .single-candidate-head-right .candidate-resume a,
        .resume-single-type-v2 .single-candidate-head-right .candidate-resume a {
            color: ' . $primary_color_2 . ';
            border-color: ' . $primary_color_2 . ';
        }

        .jh-resumes .view-resume-action a:hover,
        .company-single-head__left .open-positions:hover,
        .company-profile-inner .open-positions:hover,
        .resume-single-type-v1 .single-resume-inner .single-candidate-head-right .candidate-resume a:hover,
        .resume-single-type-v2 .single-candidate-head-right .candidate-resume a:hover {
            background-color: ' . $primary_color_2 . ';
            border-color: ' . $primary_color_2 . ';
            color: ' . sass_yiq( $primary_color_2 ) . ';
        }

        .woocommerce-MyAccount-content .woocommerce-info .button {
            background-color: ' . $secondary_bg_color . ';
            border-color: ' . $secondary_bg_color . ';
            color: ' . sass_yiq( $secondary_bg_color ) . ';
        }

        .woocommerce-MyAccount-content .woocommerce-info .button:hover {
            background-color: ' . $primary_color_1 . ';
            border-color: ' . $primary_color_1 . ';
            color: ' . sass_yiq( $primary_color_1 ) . ';
        }

        .type-list-classic.post-type-archive-job_listing .jobhunt-wpjm-active-filters > ul .chosen span:hover {
            color: ' . $primary_color_2 . ';
        }

        @media (min-width: 1200px) {
            .single-resume-inner .single-candidate-head-left .categories li a:hover,
            .resume-single-type-v2 .single-candidate-head-right .candidate-resume a:hover {
                color: ' . $primary_color_2 . ';
            }
        }';

        return $styles;
    }
}

function redux_toggle_custom_css_page() {
    global $jobhunt_options;

    if ( isset( $jobhunt_options['use_predefined_color'] ) && $jobhunt_options['use_predefined_color'] ) {
        $should_add = false;
    } else {
        if ( !isset( $jobhunt_options['include_custom_color'] ) ) {
            $jobhunt_options['include_custom_color'] = '1';
        }

        if ( $jobhunt_options['include_custom_color'] == '2' ) {
            $should_add = true;
        } else {
            $should_add = false;
        }
    }

    return $should_add;
}
