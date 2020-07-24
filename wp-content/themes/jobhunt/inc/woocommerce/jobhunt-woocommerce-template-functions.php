<?php
/**
 * WooCommerce Template Functions.
 *
 * @package jobhunt
 */

if ( ! function_exists( 'jobhunt_before_wc_content' ) ) {
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     *
     * @since   1.0.0
     * @return  void
     */
    function jobhunt_before_wc_content() {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
        <?php
    }
}

if ( ! function_exists( 'jobhunt_after_wc_content' ) ) {
    /**
     * After Content
     * Closes the wrapping divs
     *
     * @since   1.0.0
     * @return  void
     */
    function jobhunt_after_wc_content() {
        ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
    }
}

if ( ! function_exists( 'jobhunt_cart_link_fragment' ) ) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param  array $fragments Fragments to refresh via AJAX.
     * @return array            Fragments to refresh via AJAX
     */
    function jobhunt_cart_link_fragment( $fragments ) {
        global $woocommerce;

        ob_start();
        jobhunt_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        ob_start();
        jobhunt_handheld_footer_bar_cart_link();
        $fragments['a.footer-cart-contents'] = ob_get_clean();

        return $fragments;
    }
}

if ( ! function_exists( 'jobhunt_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function jobhunt_cart_link() {
        ?>
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'jobhunt' ); ?>">
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'jobhunt' ), WC()->cart->get_cart_contents_count() ) );?></span>
            </a>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_product_search' ) ) {
    /**
     * Display Product Search
     *
     * @since  1.0.0
     * @uses  jobhunt_is_woocommerce_activated() check if WooCommerce is activated
     * @return void
     */
    function jobhunt_product_search() {
        if ( jobhunt_is_woocommerce_activated() ) { ?>
            <div class="site-search">
                <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
            </div>
        <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_header_cart' ) ) {
    /**
     * Display Header Cart
     *
     * @since  1.0.0
     * @uses  jobhunt_is_woocommerce_activated() check if WooCommerce is activated
     * @return void
     */
    function jobhunt_header_cart() {
        if ( jobhunt_is_woocommerce_activated() ) {
            if ( is_cart() ) {
                $class = 'current-menu-item';
            } else {
                $class = '';
            }
        ?>
        <ul id="site-header-cart" class="site-header-cart menu">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php jobhunt_cart_link(); ?>
            </li>
            <li>
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </li>
        </ul>
        <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_upsell_display' ) ) {
    /**
     * Upsells
     * Replace the default upsell function with our own which displays the correct number product columns
     *
     * @since   1.0.0
     * @return  void
     * @uses    woocommerce_upsell_display()
     */
    function jobhunt_upsell_display() {
        $columns = apply_filters( 'jobhunt_upsells_columns', 3 );
        woocommerce_upsell_display( -1, $columns );
    }
}

if ( ! function_exists( 'jobhunt_sorting_wrapper' ) ) {
    /**
     * Sorting wrapper
     *
     * @since   1.4.3
     * @return  void
     */
    function jobhunt_sorting_wrapper() {
        echo '<div class="jobhunt-sorting">';
    }
}

if ( ! function_exists( 'jobhunt_sorting_wrapper_close' ) ) {
    /**
     * Sorting wrapper close
     *
     * @since   1.4.3
     * @return  void
     */
    function jobhunt_sorting_wrapper_close() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper
     *
     * @since   2.2.0
     * @return  void
     */
    function jobhunt_product_columns_wrapper() {
        $columns = jobhunt_loop_columns();
        echo '<div class="columns-' . absint( $columns ) . '">';
    }
}

if ( ! function_exists( 'jobhunt_loop_columns' ) ) {
    /**
     * Default loop columns on product archives
     *
     * @return integer products per row
     * @since  1.0.0
     */
    function jobhunt_loop_columns() {
        $columns = 3; // 3 products per row

        if ( function_exists( 'wc_get_default_products_per_row' ) ) {
            $columns = wc_get_default_products_per_row();
        }

        return apply_filters( 'jobhunt_loop_columns', $columns );
    }
}

if ( ! function_exists( 'jobhunt_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close
     *
     * @since   2.2.0
     * @return  void
     */
    function jobhunt_product_columns_wrapper_close() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_shop_messages' ) ) {
    /**
     * Jobhunt shop messages
     *
     * @since   1.4.4
     * @uses    jobhunt_do_shortcode
     */
    function jobhunt_shop_messages() {
        if ( ! is_checkout() ) {
            echo wp_kses_post( jobhunt_do_shortcode( 'woocommerce_messages' ) );
        }
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_pagination' ) ) {
    /**
     * Jobhunt WooCommerce Pagination
     * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
     * but since Jobhunt adds pagination before that function is excuted we need a separate function to
     * determine whether or not to display the pagination.
     *
     * @since 1.4.4
     */
    function jobhunt_woocommerce_pagination() {
        if ( woocommerce_products_will_display() ) {
            woocommerce_pagination();
        }
    }
}

if ( ! function_exists( 'jobhunt_promoted_products' ) ) {
    /**
     * Featured and On-Sale Products
     * Check for featured products then on-sale products and use the appropiate shortcode.
     * If neither exist, it can fallback to show recently added products.
     *
     * @since  1.5.1
     * @param integer $per_page total products to display.
     * @param integer $columns columns to arrange products in to.
     * @param boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
     * @uses  jobhunt_is_woocommerce_activated()
     * @uses  wc_get_featured_product_ids()
     * @uses  wc_get_product_ids_on_sale()
     * @uses  jobhunt_do_shortcode()
     * @return void
     */
    function jobhunt_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
        if ( jobhunt_is_woocommerce_activated() ) {

            if ( wc_get_featured_product_ids() ) {

                echo '<h2>' . esc_html__( 'Featured Products', 'jobhunt' ) . '</h2>';

                echo jobhunt_do_shortcode( 'featured_products', array(
                                            'per_page' => $per_page,
                                            'columns'  => $columns,
                ) );
            } elseif ( wc_get_product_ids_on_sale() ) {

                echo '<h2>' . esc_html__( 'On Sale Now', 'jobhunt' ) . '</h2>';

                echo jobhunt_do_shortcode( 'sale_products', array(
                                            'per_page' => $per_page,
                                            'columns'  => $columns,
                ) );
            } elseif ( $recent_fallback ) {

                echo '<h2>' . esc_html__( 'New In Store', 'jobhunt' ) . '</h2>';

                echo jobhunt_do_shortcode( 'recent_products', array(
                                            'per_page' => $per_page,
                                            'columns'  => $columns,
                ) );
            }
        }
    }
}

if ( ! function_exists( 'jobhunt_handheld_footer_bar' ) ) {
    /**
     * Display a menu intended for use on handheld devices
     *
     * @since 2.0.0
     */
    function jobhunt_handheld_footer_bar() {
        $links = array(
            'my-account' => array(
                'priority' => 10,
                'callback' => 'jobhunt_handheld_footer_bar_account_link',
            ),
            'search'     => array(
                'priority' => 20,
                'callback' => 'jobhunt_handheld_footer_bar_search',
            ),
            'cart'       => array(
                'priority' => 30,
                'callback' => 'jobhunt_handheld_footer_bar_cart_link',
            ),
        );

        if ( wc_get_page_id( 'myaccount' ) === -1 ) {
            unset( $links['my-account'] );
        }

        if ( wc_get_page_id( 'cart' ) === -1 ) {
            unset( $links['cart'] );
        }

        $links = apply_filters( 'jobhunt_handheld_footer_bar_links', $links );
        ?>
        <div class="jobhunt-handheld-footer-bar">
            <ul class="columns-<?php echo count( $links ); ?>">
                <?php foreach ( $links as $key => $link ) : ?>
                    <li class="<?php echo esc_attr( $key ); ?>">
                        <?php
                        if ( $link['callback'] ) {
                            call_user_func( $link['callback'], $key, $link );
                        }
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_handheld_footer_bar_search' ) ) {
    /**
     * The search callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function jobhunt_handheld_footer_bar_search() {
        echo '<a href="#">' . esc_attr__( 'Search', 'jobhunt' ) . '</a>';
        jobhunt_product_search();
    }
}

if ( ! function_exists( 'jobhunt_handheld_footer_bar_cart_link' ) ) {
    /**
     * The cart callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function jobhunt_handheld_footer_bar_cart_link() {
        ?>
            <a class="footer-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'jobhunt' ); ?>">
                <span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
            </a>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_handheld_footer_bar_account_link' ) ) {
    /**
     * The account callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function jobhunt_handheld_footer_bar_account_link() {
        echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_attr__( 'My Account', 'jobhunt' ) . '</a>';
    }
}

if ( ! function_exists( 'jobhunt_single_product_pagination' ) ) {
    /**
     * Single Product Pagination
     *
     * @since 2.3.0
     */
    function jobhunt_single_product_pagination() {
        if ( class_exists( 'Jobhunt_Product_Pagination' ) || true !== get_theme_mod( 'jobhunt_product_pagination' ) ) {
            return;
        }

        // Show only products in the same category?
        $same_category = apply_filters( 'jobhunt_single_product_pagination_same_category', false );

        // Get previous and next products
        $previous_product = get_previous_post( $same_category );
        $next_product     = get_next_post( $same_category );

        if ( ! $previous_product && ! $next_product ) {
            return;
        }

        if ( $previous_product ) {
            $previous_product = wc_get_product( $previous_product->ID );
        }

        if ( $next_product ) {
            $next_product = wc_get_product( $next_product->ID );
        }

        ?>
        <nav class="jobhunt-product-pagination" aria-label="<?php esc_attr_e( 'More products', 'jobhunt' ); ?>">
            <?php if ( $previous_product && $previous_product->is_visible() ) : ?>
                <?php previous_post_link( '%link', wp_kses_post( $previous_product->get_image() ) . '<span class="jobhunt-product-pagination__title">%title</span>', $same_category, '', 'product_cat' ); ?>
            <?php endif; ?>

            <?php if ( $next_product && $next_product->is_visible() ) : ?>
                <?php next_post_link( '%link', wp_kses_post( $next_product->get_image() ) . '<span class="jobhunt-product-pagination__title">%title</span>', $same_category, '', 'product_cat' ); ?>
            <?php endif; ?>
        </nav><!-- .jobhunt-product-pagination -->
        <?php
    }
}

if ( ! function_exists( 'jobhunt_sticky_single_add_to_cart' ) ) {
    /**
     * Sticky Add to Cart
     *
     * @since 2.3.0
     */
    function jobhunt_sticky_single_add_to_cart() {
        global $product;

        if ( class_exists( 'Jobhunt_Sticky_Add_to_Cart' ) || true !== get_theme_mod( 'jobhunt_sticky_add_to_cart' ) ) {
            return;
        }

        if ( ! is_product() ) {
            return;
        }

        $params = apply_filters( 'jobhunt_sticky_add_to_cart_params', array(
            'trigger_class' => 'entry-summary'
        ) );

        wp_localize_script( 'jobhunt-sticky-add-to-cart', 'jobhunt_sticky_add_to_cart_params', $params );

        wp_enqueue_script( 'jobhunt-sticky-add-to-cart' );
        ?>
            <section class="jobhunt-sticky-add-to-cart">
                <div class="col-full">
                    <div class="jobhunt-sticky-add-to-cart__content">
                        <?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
                        <div class="jobhunt-sticky-add-to-cart__content-product-info">
                            <span class="jobhunt-sticky-add-to-cart__content-title"><?php esc_attr_e( 'You\'re viewing:', 'jobhunt' ); ?> <strong><?php the_title(); ?></strong></span>
                            <span class="jobhunt-sticky-add-to-cart__content-price"><?php echo wp_kses_data( $product->get_price_html() ); ?></span>
                            <?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
                        </div>
                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="jobhunt-sticky-add-to-cart__content-button button alt">
                            <?php echo esc_attr( $product->add_to_cart_text() ); ?>
                        </a>
                    </div>
                </div>
            </section><!-- .jobhunt-sticky-add-to-cart -->
        <?php
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_brands_homepage_section' ) ) {
    /**
     * Display WooCommerce Brands
     * Hooked into the `homepage` action in the homepage template.
     * Requires WooCommerce Brands.
     *
     * @since  2.3.0
     * @link   https://woocommerce.com/products/brands/
     * @uses   apply_filters()
     * @uses   jobhunt_do_shortcode()
     * @uses   wp_kses_post()
     * @uses   do_action()
     * @return void
     */
    function jobhunt_woocommerce_brands_homepage_section() {
        $args = apply_filters( 'jobhunt_woocommerce_brands_args', array(
            'number'     => 6,
            'columns'    => 4,
            'orderby'    => 'name',
            'show_empty' => false,
            'title'      => esc_html__( 'Shop by Brand', 'jobhunt' ),
        ) );

        echo '<section class="jobhunt-product-section jobhunt-woocommerce-brands" aria-label="' . esc_attr__( 'Product Brands', 'jobhunt' ) . '">';

        do_action( 'jobhunt_homepage_before_woocommerce_brands' );

        echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

        do_action( 'jobhunt_homepage_after_woocommerce_brands_title' );

        echo jobhunt_do_shortcode( 'product_brand_thumbnails', apply_filters( 'jobhunt_woocommerce_brands_shortcode_args', array(
            'number'     => absint( $args['number'] ),
            'columns'    => absint( $args['columns'] ),
            'orderby'    => esc_attr( $args['orderby'] ),
            'show_empty' => (bool) $args['show_empty'],
        ) ) );

        do_action( 'jobhunt_homepage_after_woocommerce_brands' );

        echo '</section>';
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_brands_archive' ) ) {
    /**
     * Display brand image on brand archives
     * Requires WooCommerce Brands.
     *
     * @since  2.3.0
     * @link   https://woocommerce.com/products/brands/
     * @uses   is_tax()
     * @uses   wp_kses_post()
     * @uses   get_brand_thumbnail_image()
     * @uses   get_queried_object()
     * @return void
     */
    function jobhunt_woocommerce_brands_archive() {
        if ( is_tax( 'product_brand' ) ) {
            echo wp_kses_post( get_brand_thumbnail_image( get_queried_object() ) );
        }
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_brands_single' ) ) {
    /**
     * Output product brand image for use on single product pages
     * Requires WooCommerce Brands.
     *
     * @since  2.3.0
     * @link   https://woocommerce.com/products/brands/
     * @uses   jobhunt_do_shortcode()
     * @uses   wp_kses_post()
     * @return void
     */
    function jobhunt_woocommerce_brands_single() {
        $brand = jobhunt_do_shortcode( 'product_brand', array(
            'class' => ''
        ) );

        if ( empty( $brand ) ) {
            return;
        }

        ?>
        <div class="jobhunt-wc-brands-single-product">
            <?php echo wp_kses_post( $brand ); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_change_breadcrumb_delimiter' ) ) {
    function jobhunt_change_breadcrumb_delimiter( $defaults ) {
        $defaults['delimiter'] = ' &mdash; ';
        return $defaults;
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_page_title' ) ) {
    function jobhunt_woocommerce_page_title( $page_title ) {
        if ( is_shop() || is_product() || is_product_category() || is_product_tag() || is_tax( get_object_taxonomies( 'product' ) ) ) {
            $page_title = woocommerce_page_title( false );
        }

        return $page_title;
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_page_subtitle' ) ) {
    function jobhunt_woocommerce_page_subtitle( $page_subtitle ) {
        if ( is_shop() || is_product() || is_product_category() || is_product_tag() || is_tax( get_object_taxonomies( 'product' ) ) ) {
            ob_start();
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            $page_subtitle = ob_get_clean();
        }

        return $page_subtitle;
    }
}

if ( ! function_exists( 'jobhunt_woocommerce_products_header' ) ) {
    function jobhunt_woocommerce_products_header() {
        ?><header class="woocommerce-products-header">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            ?>
        </header><?php
    }
}

if ( ! function_exists( 'woocommerce_job_pricng_head_wrapper' ) ) {
    function woocommerce_job_pricng_head_wrapper() {
      echo "<div class=\"job-pricing-header\">";
    }
}

if ( ! function_exists( 'woocommerce_job_pricng_wrapper_end' ) ) {
    function woocommerce_job_pricng_wrapper_end() {
      echo "</div>";
    }
}

if ( ! function_exists( 'woocommerce_product_description_wrapper' ) ) {
    function woocommerce_product_description_wrapper() {
      echo "<div class=\"job-pricing-features\">";
    }
}


if ( ! function_exists( 'woocommerce_template_product_description' ) ) {
    function woocommerce_template_product_description() {
      wc_get_template( 'single-product/tabs/description.php' );
    }
}

if ( ! function_exists( 'jobhunt_modify_wc_product_cat_widget_args' ) ) {
    function jobhunt_modify_wc_product_cat_widget_args( $args ) {
        require_once get_template_directory() . '/inc/woocommerce/classes/class-jobhunt-product-cat-list-walker.php';
        $args['walker'] = new Jobhunt_WC_Product_Cat_List_Walker;
        return $args;
    }
}
