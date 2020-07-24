<?php
/**
 * Jobhunt WooCommerce hooks
 *
 * @package jobhunt
 */

/**
 * Styles
 *
 * @see  jobhunt_woocommerce_scripts()
 */

/**
 * Layout
 *
 * @see  jobhunt_before_wc_content()
 * @see  jobhunt_after_wc_content()
 * @see  woocommerce_breadcrumb()
 * @see  jobhunt_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',                   20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',       10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end',   10 );
remove_action( 'woocommerce_after_shop_loop',     'woocommerce_pagination',                   10 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_result_count',                 20 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_catalog_ordering',             30 );
add_action( 'woocommerce_before_main_content',    'jobhunt_before_wc_content',                10 );
add_action( 'woocommerce_after_main_content',     'jobhunt_after_wc_content',                 10 );
add_action( 'jobhunt_content_top',                'jobhunt_shop_messages',                    15 );
add_action( 'jobhunt_page_header_aside',          'woocommerce_breadcrumb',                   10 );

add_action( 'woocommerce_after_shop_loop',        'jobhunt_sorting_wrapper',               9 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_pagination',                10 );
add_action( 'woocommerce_after_shop_loop',        'jobhunt_sorting_wrapper_close',         31 );

add_action( 'woocommerce_before_shop_loop',       'jobhunt_sorting_wrapper',               9 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_result_count',                 10 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_catalog_ordering',             20 );
add_action( 'woocommerce_before_shop_loop',       'jobhunt_sorting_wrapper_close',         31 );

add_action( 'jobhunt_footer',                  'jobhunt_handheld_footer_bar',           999 );

// Legacy WooCommerce columns filter.
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
	add_filter( 'loop_shop_columns', 'jobhunt_loop_columns' );
	add_action( 'woocommerce_before_shop_loop', 'jobhunt_product_columns_wrapper', 40 );
	add_action( 'woocommerce_after_shop_loop', 'jobhunt_product_columns_wrapper_close', 40 );
}

/**
 * Products
 *
 * @see jobhunt_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',               15 );
add_action( 'woocommerce_after_single_product_summary',    'jobhunt_upsell_display',                15 );

remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 6 );

add_action( 'woocommerce_after_single_product_summary',    'jobhunt_single_product_pagination',     30 );
add_action( 'jobhunt_after_footer',                     'jobhunt_sticky_single_add_to_cart',     999 );

/**
 * Header
 *
 * @see jobhunt_product_search()
 * @see jobhunt_header_cart()
 */
add_action( 'jobhunt_header', 'jobhunt_product_search', 40 );
add_action( 'jobhunt_header', 'jobhunt_header_cart',    60 );

/**
 * Cart fragment
 *
 * @see jobhunt_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'jobhunt_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'jobhunt_cart_link_fragment' );
}

/**
 * Integrations
 *
 * @see jobhunt_woocommerce_brands_archive()
 * @see jobhunt_woocommerce_brands_single()
 * @see jobhunt_woocommerce_brands_homepage_section()
 */
if ( class_exists( 'WC_Brands' ) ) {
	add_action( 'woocommerce_archive_description', 'jobhunt_woocommerce_brands_archive', 5 );
	add_action( 'woocommerce_single_product_summary', 'jobhunt_woocommerce_brands_single', 4 );
	add_action( 'homepage', 'jobhunt_woocommerce_brands_homepage_section', 80 );
}

/**
 * Job Pricing
 *
 */
add_action( 'job_package_wc_before_shop_loop_item_title', 'woocommerce_job_pricng_head_wrapper'     , 5 );
add_action( 'job_package_wc_shop_loop_item_title', 'woocommerce_template_loop_product_title'        , 10 );
add_action( 'job_package_wc_shop_loop_item_title', 'woocommerce_template_loop_price'                , 20 );
add_action( 'job_package_wc_after_shop_loop_item_title', 'woocommerce_job_pricng_wrapper_end'       , 5 );

add_action( 'job_package_wc_after_shop_loop_item', 'woocommerce_product_description_wrapper'        , 5 );
add_action( 'job_package_wc_after_shop_loop_item', 'woocommerce_template_product_description'       , 10 );
add_action( 'job_package_wc_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart'          , 20 );
add_action( 'job_package_wc_after_shop_loop_item', 'woocommerce_job_pricng_wrapper_end'             , 99 );


add_filter( 'woocommerce_breadcrumb_defaults', 'jobhunt_change_breadcrumb_delimiter' );
add_filter( 'jobhunt_site_content_page_title', 'jobhunt_woocommerce_page_title' );
add_filter( 'jobhunt_site_content_page_subtitle', 'jobhunt_woocommerce_page_subtitle' );

add_filter( 'shortcode_atts_products', 'jobhunt_add_to_products_shortcode', 10, 4 );
add_filter( 'shortcode_atts_sale_products', 'jobhunt_add_to_products_shortcode', 10, 4 );
add_filter( 'shortcode_atts_best_selling_products', 'jobhunt_add_to_products_shortcode', 10, 4 );
add_filter( 'shortcode_atts_top_rated_products', 'jobhunt_add_to_products_shortcode', 10, 4 );
add_action( 'woocommerce_shortcode_before_products_loop', 'jobhunt_set_template_prop_in_wc_loop', 10 );
add_action( 'woocommerce_shortcode_before_sale_products_loop', 'jobhunt_set_template_prop_in_wc_loop', 10 );
add_action( 'woocommerce_shortcode_before_best_selling_products_loop', 'jobhunt_set_template_prop_in_wc_loop', 10 );
add_action( 'woocommerce_shortcode_before_top_rated_products_loop', 'jobhunt_set_template_prop_in_wc_loop', 10 );

add_filter( 'woocommerce_product_categories_widget_args', 'jobhunt_modify_wc_product_cat_widget_args', 10 );
