<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<li <?php wc_product_class( 'job-pricing', $product ); ?>>
    <div class="job-pricing-inner">
        <?php
        /**
         * job_package_wc_before_shop_loop_item hook.
         */
        do_action( 'job_package_wc_before_shop_loop_item' );

        /**
         * job_package_wc_before_shop_loop_item_title hook.
         * @hooked woocommerce_job_pricng_head_wrapper
         */
        do_action( 'job_package_wc_before_shop_loop_item_title' );

        /**
         * job_package_wc_shop_loop_item_title hook.
         * @hooked woocommerce_template_loop_product_title
         * @hooked woocommerce_template_loop_product_price
         */
        do_action( 'job_package_wc_shop_loop_item_title' );

        /**
         * job_package_wc_after_shop_loop_item_title hook.
         * @hooked woocommerce_job_pricng_wrapper_end
         */
        do_action( 'job_package_wc_after_shop_loop_item_title' );

        /**
         * job_package_wc_after_shop_loop_item hook.
         * @hooked woocommerce_product_description_wrapper
         * @hooked woocommerce_template_product_description
         * @hooked woocommerce_template_loop_add_to_cart
         * @hooked woocommerce_job_pricng_wrapper_end
         */
        do_action( 'job_package_wc_after_shop_loop_item' );
        ?>
    </div>
</li>
