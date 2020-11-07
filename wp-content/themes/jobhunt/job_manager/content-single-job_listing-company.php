<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-company.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.14.0
 * @version     1.28.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( ! get_the_company_name() ) {
    return;
}

global $post;
$post = get_post( $post );
$style = jobhunt_get_wpjm_single_style();

$job_id = get_the_ID();
$company = '';

if( $job_id ) {
    if( function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) && jobhunt_is_mas_wp_job_manager_company_activated() && $comapny_id = get_post_meta( $job_id, '_company_id', true ) ) {
        if( ! empty( $comapny_id ) ) {
            $company = get_post( $comapny_id );
        }
    } else {
        $post_title = get_post_meta( $job_id, '_company_name', true );
        if( ! empty( $post_title ) ) {
            $company = get_page_by_title( $post_title, OBJECT, 'company' );
        }
    }
}
?>

<div class="single-job-listing-company company">
    <div class="single-job-listing-company__logo">
        <?php
        if ( has_post_thumbnail( $post ) ) {
            jobhunt_the_company_logo();
        } elseif ( ! empty ( $company ) && has_post_thumbnail( $company ) ) {
            $logo = get_the_company_logo( $company, 'thumbnail' );
            echo '<img class="company_logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_the_company_name( $company ) ) . '" />';
        } else {
            jobhunt_the_company_logo();
        } ?>
    </div>
    <div class="single-job-listing-company__details">
        
        <?php 
        if ( ! empty ( $company ) ) {
            echo '<h3 class="single-job-listing-company__name">';
                if( get_post_status( $company) == 'publish' ) {
                    echo '<a href="' . esc_url( get_permalink( $company ) ) . '">' . esc_html( get_the_title( $company ) ) . '</a>';
                } else {
                    echo esc_html( get_the_title( $company ) );
                }
            echo '</h3>';
        } else {
            the_company_name( '<h3 class="single-job-listing-company__name">', '</h3>' );
        }
        
        if ( $style != 'v3' ) {
            the_company_tagline( '<p class="single-job-listing-company__tagline">', '</p>' );
        } else{
            echo '<div class="job-location-type">';
                if ( get_the_job_location() ) {
                    $map_link = jobhunt_is_astoundify_job_manager_regions_activated() ? false : true;
                    ?>
                    <div class="location"><i class="la la-map-marker"></i><?php the_job_location( $map_link ); ?></div>
                <?php }
                jobhunt_job_listing_job_type(); 
                if ( jobhunt_is_wp_job_manager_claim_listing_activated() ) {
                    jobhunt_add_claim_link(false);
                } ?>
            <?php echo '</div>';
        } ?>

        <div class="single-job-listing-company__contact">
            <?php
            if ( $style != 'v3' ) {
                if ( $website = get_the_company_website() ) : ?>
                    <a class="single-job-listing-company__contact--website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"><?php echo wp_kses_post( $website ); ?></a>
                <?php elseif ( ! empty ( $company && $website = get_the_company_website_link($company) ) ) : ?>
                     <a class="single-job-listing-company__contact--website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"><?php echo wp_kses_post( $website ); ?></a>
                <?php endif;
            } else {
                ?><span class="job-post-published date"><?php the_job_publish_date(); ?></span><?php
            }
            if ( ! empty ( $company && $phone = get_the_company_phone( $company, 'company' ) ) ) : ?>
                <span class="single-job-listing-company__contact--phone"><?php echo wp_kses_post( $phone ); ?></span>
            <?php endif;
            if ( $apply = get_the_job_application_method() && isset( $apply->type ) && $apply->type == 'email' ) :
                $application_email = $apply->email; ?>
                <a class="single-job-listing-company__contact--application-email" href="<?php echo esc_url( 'mailto:' . $application_email ); ?>" target="_blank" rel="nofollow"><?php echo wp_kses_post( $application_email ); ?></a>
            <?php elseif ( ! empty ( $company && $email = get_the_company_email( $company ) ) ) : ?>
                <a class="single-job-listing-company__contact--application-email" href="<?php echo esc_url( 'mailto:' . $email ); ?>" target="_blank" rel="nofollow"><?php echo wp_kses_post( $email ); ?></a>
            <?php endif; ?>
            <?php if ( $style == 'v3' ) {
                jobhunt_display_the_deadline();
            } ?>
        </div>
    </div>
    <?php if ( $style == 'v3' ) {
        jobhunt_single_job_listing_application();
    } ?>
</div>