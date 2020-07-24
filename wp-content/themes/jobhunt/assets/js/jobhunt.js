(function($, window){
    'use strict';

    var is_rtl = $('body,html').hasClass('rtl');

    $( '[data-ride="slick"]' ).each( function() {
        var $slickCarousel = $(this);
        $slickCarousel.slick();
    });

    /*===================================================================================*/
    /*  Modal Register/Login
    /*===================================================================================*/

    $('#modal-register-login').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        if( button.parent('.menu-item-login').length ) {
            $( this ).find( '.jobhunt-register-login-form a[href="#jh-login-tab-content"]' ).tab('show');
        } else if( button.parent('.menu-item-register').length ) {
            $( this ).find( '.jobhunt-register-login-form a[href="#jh-register-tab-content"]' ).tab('show');
        }
    });

    $( document ).ready( function() {
        $( '.widget_jobhunt_wpjm_layered_nav .widget-title, .widget_jobhunt_wpjmr_layered_nav .widget-title, .widget_jobhunt_wpjmc_layered_nav .widget-title, .widget_jobhunt_wpjm_date_filter .widget-title, .widget_jobhunt_wpjmr_date_filter .widget-title, .widget_jobhunt_wpjmc_date_filter .widget-title' ).on( 'click', function() {
            $( this ).parent().toggleClass( 'closed' );
        });
        $( '.widget_jobhunt_wpjm_layered_nav .widget-title, .widget_jobhunt_wpjmr_layered_nav .widget-title, .widget_jobhunt_wpjmc_layered_nav .widget-title, .widget_jobhunt_wpjm_date_filter .widget-title, .widget_jobhunt_wpjmr_date_filter .widget-title, .widget_jobhunt_wpjmc_date_filter .widget-title' ).each( function( index ) {
            if( index > 2 ) {
                $( this ).parent().addClass( 'closed' );
            }
        });

        $( '#resume_preview' ).each( function() {
            $( this ).parents('body').addClass( ' single-resume-preview single-resume' );
            $( this ).parents('#content.site-content').siblings('header.site-header').addClass( ' header-transparent header-bg-default' );
        });

        $( '.companies-listing-a-z .company-letters > ul > li > a' ).on( 'click', function(e) {
            e.preventDefault();
            var target_id = $( this ).data( 'target' );

            // Toggle chosen class
            $( this ).closest( '.companies-listing-a-z' ).find( '.company-letters > ul > li > a' ).removeClass( 'chosen' );
            $( this ).addClass( 'chosen' );

            // Toggle hidden class
            $( this ).closest( '.companies-listing-a-z' ).find( '.company-group' ).removeClass( 'hidden' );
            $( this ).closest( '.companies-listing-a-z' ).find( target_id ).closest( '.company-group' ).siblings( '.company-group' ).addClass( 'hidden' );
        });

        $( '#single-resume-content-navbar-tabs ul > li > a' ).on( 'click', function(e) {
            e.preventDefault();

            // Toggle active class
            $( this ).closest( 'ul' ).find( '> li > a' ).removeClass( 'active' );
            $( this ).addClass( 'active' );

            if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

                if ( target.length ) {

                    var scrollTo = target.offset().top;

                    if ( $( '.admin-bar' ).length > 0 ) {
                        scrollTo = scrollTo - 30;
                    }

                    if ( $( '#single-resume-content-navbar-tabs' ).find( '.jobhunt-stick-this' ).length > 0 ) {
                        scrollTo = scrollTo - 90;
                    }

                    $('html, body').animate({
                        scrollTop: scrollTo
                    }, 1000);
                }
            }
        });

        $('.jh-scroll-to a').on('click', function(e) {
            e.preventDefault();
            var scrollTo = $($(this).attr('href')).offset().top;
            if ( $( '.admin-bar' ).length > 0 ) {
                scrollTo = scrollTo - 30;
            }
            if ( $( '.jobhunt-sticky-header-enabled' ).length > 0 ) {
                scrollTo = scrollTo - 70;
            }
            $('html, body').animate({
                scrollTop: scrollTo
            }, 500, 'linear');
        });

        /*===================================================================================*/
        /*  Off Canvas Menu
        /*===================================================================================*/

        $( '.off-canvas-navigation-wrapper .navbar-toggle-hamburger' ).on( 'click', function() {
            var css_properties = {
                transform:  'translateX(250px)',
                transition: 'all .5s'
            };
            if( is_rtl ) {
                css_properties.transform = 'translateX(-250px)';
            }

            if ( $( this ).parents( '.stuck' ).length > 0 ) {
                $('html, body').animate({
                    scrollTop: $('body')
                }, 0);
            }

            $( this ).closest('.off-canvas-navigation-wrapper').toggleClass( "toggled" );
            $('#page').toggleClass( "off-canvas-bg-opacity" ).css( css_properties );
        } );

        $( '.off-canvas-navigation-wrapper .navbar-toggle-close' ).on( 'click', function() {
            $( this ).closest('.off-canvas-navigation-wrapper').removeClass( "toggled" );
            $('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
        } );

        $( document ).on("click", function(event) {
            if ( $( '.off-canvas-navigation-wrapper' ).hasClass( 'toggled' ) ) {
                if ( ! $( '.off-canvas-navigation-wrapper' ).is( event.target ) && 0 === $( '.off-canvas-navigation-wrapper' ).has( event.target ).length ) {
                    $( '.off-canvas-navigation-wrapper' ).removeClass( "toggled" );
                    $('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
                }
            }
        });

        /*===================================================================================*/
        /*  Sticky
        /*===================================================================================*/

        $('.jobhunt-stick-this').each(function(){
            var jobhunt_stick_this = new Waypoint.Sticky({
                element: $(this),
                stuckClass: 'stuck animated fadeInDown faster',
                offset: function() {
                    return -this.element.clientHeight
                }
            });
        });

        /*===================================================================================*/
        /*  Handheld Sidebar
        /*===================================================================================*/
        // Handheld Sidebar Toggler
        $( '.handheld-sidebar-toggle .sidebar-toggler' ).on( 'click', function() {
            $( this ).closest('.site-content').toggleClass( "active-hh-sidebar" );
        } );

        // Handheld Sidebar Close Trigger when click outside menu slide
        $( document ).on("click", function(event) {
            if ( $( '.site-content' ).hasClass( 'active-hh-sidebar' ) ) {
                if ( ! $( '.handheld-sidebar-toggle' ).is( event.target ) && 0 === $( '.handheld-sidebar-toggle' ).has( event.target ).length && ! $( '#secondary' ).is( event.target ) && 0 === $( '#secondary' ).has( event.target ).length ) {
                    $( '.site-content' ).toggleClass( "active-hh-sidebar" );
                }
            }
        });

        if( jobhunt_options.enable_live_search ) {
            $( '.job-search-form #search_keywords' ).autocomplete({
                source: function(req, response){
                    $.getJSON( jobhunt_options.ajax_url + '?callback=?&action=jobhunt_live_search_jobs_suggest', req, response);
                },
                select: function(event, ui) {
                    location.href = ui.item.link;
                },
                open: function(event, ui) {
                    $(this).autocomplete("widget").width($(this).innerWidth());
                },
                minLength: 3
            });

            $( '.resume-search-form #search_keywords' ).autocomplete({
                source: function(req, response){
                    $.getJSON( jobhunt_options.ajax_url + '?callback=?&action=jobhunt_live_search_resumes_suggest', req, response);
                },
                select: function(event, ui) {
                    location.href = ui.item.link;
                },
                open: function(event, ui) {
                    $(this).autocomplete("widget").width($(this).innerWidth());
                },
                minLength: 3
            });
        }

        if( jobhunt_options.enable_location_geocomplete ) {
            $( '#search_location, .location-search-field' ).geocomplete(jobhunt_options.location_geocomplete_options).bind( "geocode:result", function( event, result ) {
                $( this ).closest("form").submit();
            } );
        }

        /*===================================================================================*/
        /*  Header Icon Search
        /*===================================================================================*/

        // Search Toggler
        $( '.header-search-icon .search-btn' ).on( 'click', function() {
            $( this ).closest('.header-search-icon').toggleClass( "show" );
        } );

        // Search Close Trigger when click outside
        $( document ).on( 'click', function(event) {
            if ( $( '.header-search-icon' ).hasClass( 'show' ) ) {
                if ( ! $( '.header-search-icon' ).is( event.target ) && 0 === $( '.header-search-icon' ).has( event.target ).length ) {
                    $( '.header-search-icon' ).removeClass( "show" );
                }
            }
        });
    });

})(jQuery);
