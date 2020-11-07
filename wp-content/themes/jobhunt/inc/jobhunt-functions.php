<?php
/**
 * Jobhunt  functions.
 *
 * @package jobhunt
 */

/**
 * Enables template debug mode
 *
 */
function jobhunt_template_debug_mode() {
    if ( ! defined( 'JOBHUNT_TEMPLATE_DEBUG_MODE' ) ) {
        $status_options = get_option( 'woocommerce_status_options', array() );
        if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
            define( 'JOBHUNT_TEMPLATE_DEBUG_MODE', true );
        } else {
            define( 'JOBHUNT_TEMPLATE_DEBUG_MODE', false );
        }
    }
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function jobhunt_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $located = jobhunt_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin
    $located = apply_filters( 'jobhunt_get_template', $located, $template_name, $args, $template_path, $default_path );

    do_action( 'jobhunt_before_template_part', $template_name, $template_path, $located, $args );

    include( $located );

    do_action( 'jobhunt_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function jobhunt_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path = 'templates/';
    }

    if ( ! $default_path ) {
        $default_path = 'templates/';
    }

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Get default template
    if ( ! $template || JOBHUNT_TEMPLATE_DEBUG_MODE ) {
        $template = $default_path . $template_name;
    }

    // Return what we found
    return apply_filters( 'jobhunt_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'jobhunt_get_header_version' ) ) {
    /**
     * Gets the Header version set in theme options
     */
    function jobhunt_get_header_version() {
        global $post;

        $template_file = '';

        if ( isset( $post ) ) {
            $template_file = get_post_meta( $post->ID, '_wp_page_template', true );
        }

        switch( $template_file ) {
            case 'template-homepage-v1.php':
                $home_v1        = jobhunt_get_home_v1_meta();
                $header_style   = ! empty( $home_v1['header_style'] ) ? $home_v1['header_style'] : 'v1';
                $header_version = apply_filters( 'jobhunt_home_v1_header_version', $header_style );
                break;
            case 'template-homepage-v2.php':
                $home_v2        = jobhunt_get_home_v2_meta();
                $header_style   = ! empty( $home_v2['header_style'] ) ? $home_v2['header_style'] : 'v2';
                $header_version = apply_filters( 'jobhunt_home_v2_header_version', $header_style );
                break;
            case 'template-homepage-v3.php':
                $home_v3        = jobhunt_get_home_v3_meta();
                $header_style   = ! empty( $home_v3['header_style'] ) ? $home_v3['header_style'] : 'v3';
                $header_version = apply_filters( 'jobhunt_home_v3_header_version', $header_style );
                break;
            case 'template-homepage-v4.php':
                $home_v4        = jobhunt_get_home_v4_meta();
                $header_style   = ! empty( $home_v4['header_style'] ) ? $home_v4['header_style'] : 'v4';
                $header_version = apply_filters( 'jobhunt_home_v4_header_version', $header_style );
                break;
            case 'template-homepage-v5.php':
                $home_v5        = jobhunt_get_home_v5_meta();
                $header_style   = ! empty( $home_v5['header_style'] ) ? $home_v5['header_style'] : 'v5';
                $header_version = apply_filters( 'jobhunt_home_v5_header_version', $header_style );
                break;
            case 'template-aboutpage.php':
                $about        = jobhunt_get_about_meta();
                $header_style   = ! empty( $about['header_style'] ) ? $about['header_style'] : 'v1';
                $header_version = apply_filters( 'jobhunt_about_header_version', $header_style );
                break;
            default:
                $header_version = apply_filters( 'jobhunt_header_version', 'v1' );
        }
        
        return $header_version;
    }
}

if ( ! function_exists( 'jobhunt_get_footer_version' ) ) {
    /**
     * Gets the Header version set in theme options
     */
    function jobhunt_get_footer_version() {
        global $post;

        $template_file = '';

        if ( isset( $post ) ) {
            $template_file = get_post_meta( $post->ID, '_wp_page_template', true );
        }

        switch( $template_file ) {
            case 'template-homepage-v1.php':
                $home_v1        = jobhunt_get_home_v1_meta();
                $footer_style   = ! empty( $home_v1['footer_style'] ) ? $home_v1['footer_style'] : 'v1';
                $footer_version = apply_filters( 'jobhunt_home_v1_footer_version', $footer_style );
                break;
            case 'template-homepage-v2.php':
                $home_v2        = jobhunt_get_home_v2_meta();
                $footer_style   = ! empty( $home_v2['footer_style'] ) ? $home_v2['footer_style'] : 'v2';
                $footer_version = apply_filters( 'jobhunt_home_v2_footer_version', $footer_style );
                break;
            case 'template-homepage-v3.php':
                $home_v3        = jobhunt_get_home_v3_meta();
                $footer_style   = ! empty( $home_v3['footer_style'] ) ? $home_v3['footer_style'] : 'v3';
                $footer_version = apply_filters( 'jobhunt_home_v3_footer_version', $footer_style );
                break;
            case 'template-homepage-v4.php':
                $home_v4        = jobhunt_get_home_v4_meta();
                $footer_style   = ! empty( $home_v4['footer_style'] ) ? $home_v4['footer_style'] : 'v4';
                $footer_version = apply_filters( 'jobhunt_home_v4_footer_version', $footer_style );
                break;
            case 'template-homepage-v5.php':
                $home_v5        = jobhunt_get_home_v5_meta();
                $footer_style   = ! empty( $home_v5['footer_style'] ) ? $home_v5['footer_style'] : 'v5';
                $footer_version = apply_filters( 'jobhunt_home_v5_footer_version', $footer_style );
                break;
            case 'template-aboutpage.php':
                $about        = jobhunt_get_about_meta();
                $footer_style   = ! empty( $about['footer_style'] ) ? $about['footer_style'] : 'v1';
                $footer_version = apply_filters( 'jobhunt_about_footer_version', $footer_style );
                break;
            default:
                $footer_version = apply_filters( 'jobhunt_footer_version', 'v1' );
        }

        return $footer_version;
    }
}

if ( ! function_exists( 'pr' ) ) {
    /**
     * print_r() convenience function.
     *
     * In terminals this will act similar to using print_r() directly, when not run on cli
     * print_r() will also wrap <pre> tags around the output of given variable.
     *
     * @param mixed $var Variable to print out.
     * @return void
     */
    function pr( $var ) {
        if ( ! WP_DEBUG ) {
            return;
        }

        $template = (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
        printf( $template, trim( print_r( $var, true ) ) );
    }
}

if( ! function_exists( 'jobhunt_is_redux_activated' ) ) {
    /**
     * Check if Redux Framework is activated
     */
    function jobhunt_is_redux_activated() {
        return class_exists( 'ReduxFrameworkPlugin' ) ? true : false;
    }
}

/**
 * Check if Elementor is activated
 */
if( ! function_exists( 'jobhunt_is_elementor_activated' ) ) {
    function jobhunt_is_elementor_activated() {
        return did_action( 'elementor/loaded' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_woocommerce_activated' ) ) {
    /**
     * Check if WooCommerce is activated
     */
    function jobhunt_is_woocommerce_activated() {
        return class_exists( 'WooCommerce' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_activated' ) ) {
    /**
     * Check if WP Job Manager is activated
     */
    function jobhunt_is_wp_job_manager_activated() {
        return class_exists( 'WP_Job_Manager' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_resume_manager_activated' ) ) {
    /**
     * Check if WP Resume Manager is activated
     */
    function jobhunt_is_wp_resume_manager_activated() {
        return jobhunt_is_wp_job_manager_activated() && class_exists( 'WP_Resume_Manager' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_company_manager_activated' ) ) {
    /**
     * Check if WP Company Manager is activated
     */
    function jobhunt_is_wp_company_manager_activated() {
        return jobhunt_is_wp_job_manager_activated() && class_exists( 'JH_WPJM_Company_Manager' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_mas_wp_job_manager_company_activated' ) ) {
    /**
     * Check if MAS Companies for WP Job Manager is activated
     */
    function jobhunt_is_mas_wp_job_manager_company_activated() {
        return jobhunt_is_wp_job_manager_activated() && function_exists( 'mas_wpjmc' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_alert_activated' ) ) {
    /**
     * Check if WP Job Manager Alerts is activated
     */
    function jobhunt_is_wp_job_manager_alert_activated() {
        return class_exists( 'WP_Job_Manager_Alerts' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_bookmark_activated' ) ) {
    /**
     * Check if WP Job Manager Bookmarks is activated
     */
    function jobhunt_is_wp_job_manager_bookmark_activated() {
        return class_exists( 'WP_Job_Manager_Bookmarks' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_applications_activated' ) ) {
    /**
     * Check if WP Job Manager Applications is activated
     */
    function jobhunt_is_wp_job_manager_applications_activated() {
        return class_exists( 'WP_Job_Manager_Applications' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_application_deadline_activated' ) ) {
    /**
     * Check if WP Job Manager Application Deadline is activated
     */
    function jobhunt_is_wp_job_manager_application_deadline_activated() {
        return class_exists( 'WP_Job_Manager_Application_Deadline' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_wp_job_manager_claim_listing_activated' ) ) {
    /**
     * Check if WP Job Manager Claim Listing is activated
     */
    function jobhunt_is_wp_job_manager_claim_listing_activated() {
        return function_exists( 'wpjmcl_init' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_astoundify_job_manager_regions_activated' ) ) {
    /**
     * Check if Astoundify Job Regions is activated
     */
    function jobhunt_is_astoundify_job_manager_regions_activated() {
        return class_exists( 'Astoundify_Job_Manager_Regions' ) ? true : false;
    }
}

if ( ! function_exists( 'jobhunt_is_astoundify_job_manager_reviews_activated' ) ) {
    /**
     * Check if Astoundify Job Reviews is activated
     */
    function jobhunt_is_astoundify_job_manager_reviews_activated() {
        return class_exists( 'WP_Job_Manager_Reviews' ) ? true : false;
    }
}

if( ! function_exists( 'jobhunt_is_ocdi_activated' ) ) {
    /**
     * Check if One Click Demo Import is activated
     */
    function jobhunt_is_ocdi_activated() {
        return class_exists( 'OCDI_Plugin' ) ? true : false;
    }
}

if( ! function_exists( 'jobhunt_is_woocommerce_subscriptions_activated' ) ) {
    /**
     * Check if WooCommerce Subscriptions is activated
     */
    function jobhunt_is_woocommerce_subscriptions_activated() {
        return class_exists( 'WC_Subscriptions' ) ? true : false;
    }
}

if( ! function_exists( 'jobhunt_is_wp_job_manager_ziprecruiter_activated' ) ) {
    /**
     * Check if WP Job Manager ZipRecruiter is activated
     */
    function jobhunt_is_wp_job_manager_ziprecruiter_activated() {
        return class_exists( 'WP_Job_Manager_ZipRecruiter_Integration' ) ? true : false;
    }
}

if( ! function_exists( 'jobhunt_is_wp_job_manager_indeed_integration_activated' ) ) {
    /**
     * Check if WP Job Manager Indeed Integration is activated
     */
    function jobhunt_is_wp_job_manager_indeed_integration_activated() {
        return class_exists( 'WP_Job_Manager_Indeed_Integration' ) ? true : false;
    }
}

/**
 * Checks if the current page is a product archive
 * @return boolean
 */
function jobhunt_is_product_archive() {
    if ( jobhunt_is_woocommerce_activated() ) {
        if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function jobhunt_do_shortcode( $tag, array $atts = array(), $content = null ) {
    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
        return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

/**
 * Get the content background color
 * Accounts for the Jobhunt Designer and Jobhunt Powerpack content background option.
 *
 * @since  1.6.0
 * @return string the background color
 */
function jobhunt_get_content_background_color() {
    if ( class_exists( 'Jobhunt_Designer' ) ) {
        $content_bg_color = get_theme_mod( 'sd_content_background_color' );
        $content_frame    = get_theme_mod( 'sd_fixed_width' );
    }

    if ( class_exists( 'Jobhunt_Powerpack' ) ) {
        $content_bg_color = get_theme_mod( 'sp_content_frame_background' );
        $content_frame    = get_theme_mod( 'sp_content_frame' );
    }

    $bg_color = str_replace( '#', '', get_theme_mod( 'background_color' ) );

    if ( class_exists( 'Jobhunt_Powerpack' ) || class_exists( 'Jobhunt_Designer' ) ) {
        if ( $content_bg_color && ( 'true' == $content_frame || 'frame' == $content_frame ) ) {
            $bg_color = str_replace( '#', '', $content_bg_color );
        }
    }

    return '#' . $bg_color;
}

/**
 * Apply inline style to the Jobhunt header.
 *
 * @uses  get_header_image()
 * @since  2.0.0
 */
function jobhunt_header_styles() {
    $is_header_image = get_header_image();
    $header_bg_image = '';

    if ( $is_header_image ) {
        $header_bg_image = 'url(' . esc_url( $is_header_image ) . ')';
    }

    $styles = array();

    if ( '' !== $header_bg_image ) {
        $styles['background-image'] = $header_bg_image;
    }

    $styles = apply_filters( 'jobhunt_header_styles', $styles );

    foreach ( $styles as $style => $value ) {
        echo esc_attr( $style . ': ' . $value . '; ' );
    }
}

/**
 * Apply inline style to the Jobhunt homepage content.
 *
 * @uses  get_the_post_thumbnail_url()
 * @since  2.2.0
 */
function jobhunt_homepage_content_styles() {
    $featured_image   = get_the_post_thumbnail_url( get_the_ID() );
    $background_image = '';

    if ( $featured_image ) {
        $background_image = 'url(' . esc_url( $featured_image ) . ')';
    }

    $styles = array();

    if ( '' !== $background_image ) {
        $styles['background-image'] = $background_image;
    }   

    $styles = apply_filters( 'jobhunt_homepage_content_styles', $styles );

    foreach ( $styles as $style => $value ) {
        echo esc_attr( $style . ': ' . $value . '; ' );
    }
}

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 *
 * @param  strong  $hex   hex color e.g. #111111.
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
 * @return string        brightened/darkened hex color
 * @since  1.0.0
 */
function jobhunt_adjust_color_brightness( $hex, $steps ) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter.
    $steps  = max( -255, min( 255, $steps ) );

    // Format the hex color string.
    $hex    = str_replace( '#', '', $hex );

    if ( 3 == strlen( $hex ) ) {
        $hex    = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }

    // Get decimal values.
    $r  = hexdec( substr( $hex, 0, 2 ) );
    $g  = hexdec( substr( $hex, 2, 2 ) );
    $b  = hexdec( substr( $hex, 4, 2 ) );

    // Adjust number of steps and keep it inside 0 to 255.
    $r  = max( 0, min( 255, $r + $steps ) );
    $g  = max( 0, min( 255, $g + $steps ) );
    $b  = max( 0, min( 255, $b + $steps ) );

    $r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
    $g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
    $b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

    return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Sanitizes choices (selects / radios)
 * Checks that the input matches one of the available choices
 *
 * @param array $input the available choices.
 * @param array $setting the setting object.
 * @since  1.3.0
 */
function jobhunt_sanitize_choices( $input, $setting ) {
    // Ensure input is a slug.
    $input = sanitize_key( $input );

    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;

    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 * @since  1.5.0
 */
function jobhunt_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    /**
     * Query WooCommerce activation
     */
    function is_woocommerce_activated() {
        _deprecated_function( 'is_woocommerce_activated', '2.1.6', 'jobhunt_is_woocommerce_activated' );

        return class_exists( 'woocommerce' ) ? true : false;
    }
}

/**
 * Schema type
 *
 * @return void
 */
function jobhunt_html_tag_schema() {
    _deprecated_function( 'jobhunt_html_tag_schema', '2.0.2' );

    $schema = 'http://schema.org/';
    $type   = 'WebPage';

    if ( is_singular( 'post' ) ) {
        $type = 'Article';
    } elseif ( is_author() ) {
        $type = 'ProfilePage';
    } elseif ( is_search() ) {
        $type   = 'SearchResultsPage';
    }

    echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Sanitizes the layout setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @param array $input the layout options.
 * @since 1.0.3
 */
function jobhunt_sanitize_layout( $input ) {
    _deprecated_function( 'jobhunt_sanitize_layout', '2.0', 'jobhunt_sanitize_choices' );

    $valid = array(
        'right' => 'Right',
        'left'  => 'Left',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Jobhunt Sanitize Hex Color
 *
 * @param string $color The color as a hex.
 * @todo remove in 2.1.
 */
function jobhunt_sanitize_hex_color( $color ) {
    _deprecated_function( 'jobhunt_sanitize_hex_color', '2.0', 'sanitize_hex_color' );

    if ( '' === $color ) {
        return '';
    }

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }

    return null;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 * @todo remove in 2.1.
 */
function jobhunt_categorized_blog() {
    _deprecated_function( 'jobhunt_categorized_blog', '2.0' );

    if ( false === ( $all_the_cool_cats = get_transient( 'jobhunt_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );
        set_transient( 'jobhunt_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so jobhunt_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so jobhunt_categorized_blog should return false.
        return false;
    }
}


if ( ! function_exists( 'jobhunt_get_sidebar' ) ) {
    /**
     * Display jobhunt sidebar
     *
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function jobhunt_get_sidebar( $name = null ) {
        // if ( is_active_sidebar( $name ) ) {
            get_sidebar( $name );
        // }
    }
}

if( !function_exists( 'is_testimonials_activated' ) ) {
    function is_testimonials_activated() {
        return class_exists( 'Woothemes_Testimonials' ) ? true : false ;
    }
}

if ( ! function_exists( 'jobhunt_newsletter_form' ) ) {
    /**
     * Newsletter Form
     *
     */
    function jobhunt_newsletter_form() {
        ob_start();
        ?>
        <form action="/" class="newsletter-form">
            <label for="inputEmail" class="screen-reader-text"><?php echo esc_html__( 'Enter Valid Email Address', 'jobhunt' ); ?></label>
            <input type="email" id="inputEmail" placeholder="<?php echo esc_attr__( 'Enter Valid Email Address', 'jobhunt' ); ?>">
            <button type="submit"><i class="la la-paper-plane-o"></i></button>
        </form>
        <?php
        $newsletter_form = ob_get_clean();
        echo apply_filters( 'jobhunt_newsletter_form', $newsletter_form );
    }
}

if ( ! function_exists( 'jobhunt_get_register_login_form_page' ) ) {
    function jobhunt_get_register_login_form_page() {
        return apply_filters( 'jobhunt_register_login_form_page_id', '' );
    }
}

if ( ! function_exists( 'jobhunt_clean_kses_post' ) ) {
    /**
     * Clean variables using wp_kses_post.
     * @param string|array $var
     * @return string|array
     */
    function jobhunt_clean_kses_post( $var ) {
        return is_array( $var ) ? array_map( 'jobhunt_clean_kses_post', $var ) : wp_kses_post( stripslashes( $var ) );
    }
}

if ( ! function_exists( 'jobhunt_clean' ) ) {
    /**
     * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
     * Non-scalar values are ignored.
     *
     * @param string|array $var Data to sanitize.
     * @return string|array
     */
    function jobhunt_clean( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'jobhunt_clean', $var );
        } else {
            return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
        }
    }
}

if ( ! function_exists( 'jobhunt_strlen' ) ) {
    function jobhunt_strlen( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'jobhunt_strlen', $var );
        } else {
            return strlen( $var );
        }
    }
}

require_once get_template_directory() . '/inc/functions/posts.php';
require_once get_template_directory() . '/inc/functions/single-post.php';
require_once get_template_directory() . '/inc/functions/pages.php';
require_once get_template_directory() . '/inc/functions/menu.php';
require_once get_template_directory() . '/inc/functions/my-account.php';
require_once get_template_directory() . '/inc/functions/header.php';