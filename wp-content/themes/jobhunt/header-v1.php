<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
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

<?php do_action( 'jobhunt_before_site' ); ?>

<div class="off-canvas-wrapper">
<div id="page" class="hfeed site">
    <?php do_action( 'jobhunt_before_header' ); ?>

    <header class="site-header header-v1 <?php echo jobhunt_header_additional_classes(); ?>" style="<?php jobhunt_header_styles(); ?>">
        
        <div class="<?php echo jobhunt_has_handheld_header() ? 'desktop-only' : ''; ?> <?php echo jobhunt_has_sticky_header() ? 'jobhunt-stick-this' : ''; ?>">
            <div class="container">
                <div class="site-header-inner">

                    <?php
                    /**
                     * Functions hooked into jobhunt_header action
                     *
                     * @hooked jobhunt_site_branding             - 10
                     * @hooked jobhunt_primary_nav               - 20
                     * @hooked jobhunt_post_a_job                - 30
                     * @hooked jobhunt_secondary_nav             - 40
                     */
                    do_action( 'jobhunt_header_v1' ); ?>

                </div>
            </div>
        </div>

        <?php
        /**
         * @hooked jobhunt_header_handheld - 10
         */
        do_action( 'jobhunt_after_header' ); ?>
    
    </header><!-- /.site-header -->

    <?php
    /**
     * Functions hooked in to jobhunt_before_content
     *
     */
    do_action( 'jobhunt_before_content' ); ?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <div class="site-content-inner">
                <?php
                do_action( 'jobhunt_content_top' );
