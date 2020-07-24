<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

?>

<div class="single-company-page">
    <?php do_action( 'single_company_content_before' ); ?>
    <?php do_action( 'single_company_head' ); ?>
    <div class="single-company__inner">
        <div class="single-company__content-area">
            <?php do_action( 'single_company_before' ); ?>
            <?php do_action( 'single_company' ); ?>
            <?php do_action( 'single_company_after' ); ?>
        </div>
        <div class="single-company__sidebar">
            <?php do_action( 'single_company_sidebar' ); ?>
        </div>
    </div>
    <?php do_action( 'single_company_content_after' ); ?>
</div>
