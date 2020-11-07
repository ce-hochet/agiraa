<?php
/**
 * Jobhunt Class
 *
 * @since    1.0.0
 * @package  jobhunt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Jobhunt' ) ) :

	/**
	 * The main Jobhunt class
	 */
	class Jobhunt {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->includes();
			$this->init_hooks();
		}

		public function includes() {
			include_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';
		}

		public function init_hooks() {
			add_action( 'after_switch_theme',         array( $this, 'switch_theme' ) );
			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_register' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ),       10 );
			add_action( 'wp_enqueue_scripts',         array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
			add_filter( 'body_class',                 array( $this, 'body_classes' ) );
			add_filter( 'wp_page_menu_args',          array( $this, 'page_menu_args' ) );
			add_action( 'admin_init',                 array( $this, 'add_theme_editor_style' ) );
			add_filter( 'navigation_markup_template', array( $this, 'navigation_markup_template' ) );
			add_action( 'tgmpa_register',             array( $this, 'required_plugins' ) );
			add_action( 'elementor/frontend/before_register_styles', array( $this, 'register_fontawesome_before_elementor_styles' ) );
		}

		/**
		 * Sets up theme default settings.
		 */
		public function switch_theme() {
			update_option( 'job_manager_enable_categories', 1 );
			update_option( 'job_manager_enable_types', 1 );
			update_option( 'resume_manager_enable_categories', 1 );
			update_option( 'resume_manager_enable_skills', 1 );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/jobhunt-it_IT.mo.
			load_theme_textdomain( 'jobhunt', trailingslashit( WP_LANG_DIR ) . 'themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'jobhunt', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/jobhunt/languages/it_IT.mo.
			load_theme_textdomain( 'jobhunt', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Enable support for site logo
			 */
			add_theme_support( 'custom-logo', apply_filters( 'jobhunt_custom_logo_args', array(
				'height'      => 55,
				'width'       => 150,
				'flex-width'  => true,
			) ) );

			// This theme uses wp_nav_menu() in two locations.
			$register_nav_menus_locations = apply_filters( 'jobhunt_register_nav_menus', array(
				'top_bar_left'			=> esc_html__( 'Top Bar Left Menu', 'jobhunt' ),
				'top_bar_right'			=> esc_html__( 'Top Bar Right Menu', 'jobhunt' ),
				'primary-nav'		    => esc_html__( 'Primary Menu', 'jobhunt' ),
				'handheld'				=> esc_html__( 'Handheld Menu', 'jobhunt' ),
			) );

			if( apply_filters( 'jobhunt_enable_header_user_login_dropdown', false ) ) {
				$register_nav_menus_locations['user_dropdown_menu'] = esc_html__( 'User Dropdown Menu', 'jobhunt' );
			}

			register_nav_menus( $register_nav_menus_locations );

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', apply_filters( 'jobhunt_html5_args', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			) ) );

			// Setup the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'jobhunt_custom_background_args', array(
				'default-color' => apply_filters( 'jobhunt_default_background_color', 'ffffff' ),
				'default-image' => '',
			) ) );

			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support( 'site-logo', apply_filters( 'jobhunt_site_logo_args', array(
				'size' => 'full'
			) ) );

			// Declare WooCommerce support.
			add_theme_support( 'woocommerce', apply_filters( 'jobhunt_woocommerce_args', array(
				'single_image_width'    => 416,
				'thumbnail_image_width' => 324,
				'product_grid'          => array(
					'default_columns' => 3,
					'default_rows'    => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
					'min_rows'        => 1
				)
			) ) );

			add_theme_support( 'job-manager-templates' );
			add_theme_support( 'resume-manager-templates' );
			add_theme_support( 'resume-manager-templates' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Declare MAS WP Job Manager Company Archive support.
			add_theme_support( 'mas-wp-job-manager-company-archive' );

			// Register theme images sizes.
			if( apply_filters( 'jobhunt_register_image_sizes', false ) ) {
				add_image_size( '256x276-crop', 256, 276, true );
				add_image_size( '390x280-crop', 390, 280, true );
				add_image_size( '836x340-crop', 836, 340, true );
			}
		}

		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
			$sidebar_args['sidebar'] = array(
				'name'          => esc_html__( 'Sidebar', 'jobhunt' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Widgets added to this region will appear in the blog and single post page.', 'jobhunt' ),
			);

			$rows    = intval( apply_filters( 'jobhunt_footer_widget_rows', 1 ) );
			$regions = intval( apply_filters( 'jobhunt_footer_widget_columns', 4 ) );

			for ( $row = 1; $row <= $rows; $row++ ) {
				for ( $region = 1; $region <= $regions; $region++ ) {
					$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
					$footer   = sprintf( 'footer_%d', $footer_n );

					if ( 1 == $rows ) {
						$footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'jobhunt' ), $region );
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'jobhunt' ), $region );
					} else {
						$footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'jobhunt' ), $row, $region );
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'jobhunt' ), $region, $row );
					}

					$sidebar_args[ $footer ] = array(
						'name'        => $footer_region_name,
						'id'          => sprintf( 'footer-%d', $footer_n ),
						'description' => $footer_region_description,
					);
				}
			}

			$sidebar_args = apply_filters( 'jobhunt_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>',
				);

				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 *
				 * 'jobhunt_header_widget_tags'
				 * 'jobhunt_sidebar_widget_tags'
				 *
				 * 'jobhunt_footer_1_widget_tags'
				 * 'jobhunt_footer_2_widget_tags'
				 * 'jobhunt_footer_3_widget_tags'
				 * 'jobhunt_footer_4_widget_tags'
				 */
				$filter_hook = sprintf( 'jobhunt_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		/**
		 * Register widgets.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_register() {
			// Jobhunt Posts Widget
			include_once get_template_directory() . '/inc/widgets/class-jobhunt-posts-widget.php';
			register_widget( 'Jobhunt_Recent_Posts_Widget' );

			include_once get_template_directory() . '/inc/widgets/class-jobhunt-footer-logo-widget.php';
			register_widget( 'Jobhunt_Footer_Logo_Widget' );

			include_once get_template_directory() . '/inc/widgets/class-jobhunt-newsletter-widget.php';
			register_widget( 'Jobhunt_Newsletter_Widget' );

			include_once get_template_directory() . '/inc/widgets/class-jobhunt-social-menu-widget.php';
			register_widget( 'Social_Menu_Widget' );
		}

		/**
		 * Register Font Awesome before Elementor Styles.
		 */
		public function register_fontawesome_before_elementor_styles() {
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/vendors/fontawesome/css/all' . $suffix . '.css', '', '5.12.0' );
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $jobhunt_version;

			/**
			 * Styles
			 */

			$should_minify_css = apply_filters( 'jobhunt_should_minify_css', false );
			$css_suffix = $should_minify_css ? '.min' : '';

			$css_vendors = apply_filters( 'jobhunt_css_vendors', array(
				'font-awesome'	=> array(
					'css_file' 			=> 'fontawesome/css/all.css',
					'has_minified_file'	=> true,
					'minified_css_file'	=> 'fontawesome/css/all.min.css',
					'version'			=> '5.12.0'
				),
				'line-awesome'	=> array(
					'css_file' 			=> 'line-awesome/css/line-awesome.css',
					'has_minified_file'	=> true,
					'minified_css_file'	=> 'line-awesome/css/line-awesome.min.css',
					'version'			=> '1.3.0'
				),
				'animate'		=> array(
					'css_file' 			=> 'animate.css/animate.css',
					'has_minified_file' => true,
					'minified_css_file' => 'animate.css/animate.min.css',
					'version'           => '3.7.2'
				),
			) );

			$should_minify_css = apply_filters( 'jobhunt_should_minify_css', true );

			foreach( $css_vendors as $handle => $css_vendor ) {

				if ( $should_minify_css && $css_vendor['has_minified_file'] ) {
					$css_file = $css_vendor['minified_css_file'];
				} else {
					$css_file = $css_vendor['css_file'];
				}

				if ( isset( $css_vendor['version'] ) && !empty ( $css_vendor['version'] ) ) {
					$version = $css_vendor['version'];
				} else {
					$version = $jobhunt_version;
				}

				wp_register_style( $handle, get_template_directory_uri() . '/assets/vendors/' . $css_file, '', $version );
				wp_enqueue_style( $handle );
			}


			wp_enqueue_style( 'jobhunt-style', get_template_directory_uri() . '/style.css', '', $jobhunt_version );
			wp_style_add_data( 'jobhunt-style', 'rtl', 'replace' );

			if( apply_filters( 'jobhunt_use_predefined_colors', true ) ) {
				$color_css_file = apply_filters( 'jobhunt_primary_color', 'pink-purple' );
				wp_enqueue_style( 'jobhunt-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.css', '', $jobhunt_version );
			}

			/**
			 * Fonts
			 */
			if ( apply_filters( 'jobhunt_load_default_fonts', true ) ) {
				$google_fonts = apply_filters( 'jobhunt_google_font_families', array(
					'quicksand'  => 'Quicksand:300,400,500,700',
					'montserrat' => 'Montserrat:100,200,300,400,500,600,700,800,900',
					'varela'     => 'Varela+Round'
				) );

				$query_args = array(
					'family' => implode( '%7c', $google_fonts ),
					'subset' => urlencode( 'latin,latin-ext' ),
				);

				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

				wp_enqueue_style( 'google-font-quicksand-montserrat-varela', $fonts_url, array(), null );
			}

			/**
			 * Scripts
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( 'jobhunt-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20130115', true );
			wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper' . $suffix . '.js', array( 'jquery' ), '1.14.3', true );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap' . $suffix . '.js', array( 'jquery' ), '4.1.1', true );
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick' . $suffix . '.js', array(), '1.8.0', true );

			$waypoints_js_handler = function_exists( 'jobhunt_is_elementor_activated' ) && jobhunt_is_elementor_activated() ? 'elementor-waypoints' : 'jobhunt-waypoints';
			wp_enqueue_script( $waypoints_js_handler, get_template_directory_uri() . '/assets/js/jquery.waypoints'. $suffix . '.js', array( 'jquery' ), $jobhunt_version, true );

			if( jobhunt_has_sticky_header() || is_singular( 'resume' ) ) {
				wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky'. $suffix . '.js', array( 'jquery' ), $jobhunt_version, true );
			}

			wp_enqueue_script( 'jobhunt-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(), $jobhunt_version, true );

			if( apply_filters( 'jobhunt_enable_scrollup', true ) ) {
				wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing' . $suffix . '.js', array( 'jquery' ), $jobhunt_version, true );
				wp_enqueue_script( 'jobhunt-scrollup', get_template_directory_uri() . '/assets/js/scrollup' . $suffix . '.js', array( 'jquery' ), $jobhunt_version, true );
			}

			$gmaps_api_key = apply_filters( 'jobhunt_gmaps_browser_api', '' );
			if( apply_filters( 'jobhunt_enable_location_geocomplete', false ) && ! empty( $gmaps_api_key ) ) {
				wp_enqueue_script( 'jobhunt-google-maps', 'https://maps.google.com/maps/api/js?key=' . $gmaps_api_key . '&libraries=places', array(), $jobhunt_version, true );
				wp_enqueue_script( 'jquery-geocomplete', get_template_directory_uri() . '/assets/js/jquery.geocomplete' . $suffix . '.js', array( 'jobhunt-google-maps' ), $jobhunt_version, true );
			}

			if( apply_filters( 'jobhunt_enable_live_search', false ) ) {
				wp_enqueue_script( 'jquery-ui-autocomplete' );
			}

			wp_enqueue_script( 'jobhunt-scripts', get_template_directory_uri() . '/assets/js/jobhunt.js', array( 'bootstrap' ), $jobhunt_version, true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if ( has_nav_menu( 'handheld' ) ) {
				$jobhunt_l10n = array(
					'expand'   => esc_html__( 'Expand child menu', 'jobhunt' ),
					'collapse' => esc_html__( 'Collapse child menu', 'jobhunt' ),
				);

				wp_localize_script( 'jobhunt-navigation', 'jobhuntScreenReaderText', $jobhunt_l10n );
			}

			$jobhunt_js_options = apply_filters( 'jobhunt_localize_script_data', array(
				'ajax_url'						=> admin_url( 'admin-ajax.php' ),
				'ajax_loader_url'				=> get_template_directory_uri() . '/assets/images/ajax-loader.gif',
				'enable_live_search'            => apply_filters( 'jobhunt_enable_live_search', false ),
				'enable_location_geocomplete'	=> apply_filters( 'jobhunt_enable_location_geocomplete', false ) && ! empty( $gmaps_api_key ),
				'location_geocomplete_options'	=> apply_filters( 'jobhunt_location_geocomplete_options', array() ),
			) );

			wp_localize_script( 'jobhunt-scripts', 'jobhunt_options', $jobhunt_js_options );
		}

		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since  1.5.3
		 */
		public function child_scripts() {
			if ( is_child_theme() ) {
				$child_theme = wp_get_theme( get_stylesheet() );
				wp_enqueue_style( 'jobhunt-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
			}
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 * @return array
		 */
		public function page_menu_args( $args ) {
			$args['show_home'] = true;
			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
				$classes[]	= 'no-wc-breadcrumb';
			}

			/**
			 * What is this?!
			 * Take the blue pill, close this file and forget you saw the following code.
			 * Or take the red pill, filter jobhunt_make_me_cute and see how deep the rabbit hole goes...
			 */
			$cute = apply_filters( 'jobhunt_make_me_cute', false );

			if ( true === $cute ) {
				$classes[] = 'jobhunt-cute';
			}

			if ( jobhunt_has_sticky_header() ) {
				$classes[] = 'jobhunt-sticky-header-enabled';
			}

			if ( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() ) ) ) {
				$classes[] = 'blog-archive';
				$classes[] = jobhunt_get_blog_style();
				$classes[] = jobhunt_get_blog_layout();
			} elseif ( is_single() && 'post' == get_post_type() ) {
				$classes[] = jobhunt_get_single_post_layout();
			} elseif( is_search() ) {
				$classes[] = jobhunt_get_blog_style();
				$classes[] = jobhunt_get_blog_layout();
			}

			$classes[] = jobhunt_get_page_extra_class();

			return $classes;
		}

		public function add_theme_editor_style() {
			add_editor_style();
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function navigation_markup_template() {
			$template  = '<nav id="post-navigation" class="navigation %1$s" role="navigation" aria-label="' . esc_html__( 'Post Navigation', 'jobhunt' ) . '">';
			$template .= '<h2 class="screen-reader-text">%2$s</h2>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'jobhunt_navigation_markup_template', $template );
		}

		public function required_plugins() {
			global $jobhunt_version;
			$plugins = apply_filters( 'jobhunt_tgmpa_plugins', array(

				array(
					'name'                  => esc_html__( 'Envato Market', 'jobhunt' ),
					'slug'                  => 'envato-market',
					'source'                => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
					'required'              => false,
					'version'               => '2.0.5',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'					=> esc_html__( 'Jetpack', 'jobhunt' ),
					'slug'					=> 'jetpack',
					'required'				=> false,
					'version'				=> '9.0.2',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'Jobhunt Extensions', 'jobhunt' ),
					'slug'					=> 'jobhunt-extensions',
					'source'				=> get_template_directory() . '/assets/plugins/jobhunt-extensions.zip',
					'required'				=> false,
					'version'				=> $jobhunt_version,
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'KingComposer', 'jobhunt' ),
					'slug'					=> 'kingcomposer',
					'required'				=> false,
					'version'				=> '2.9.5',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'One Click Demo Import', 'jobhunt' ),
					'slug'					=> 'one-click-demo-import',
					'required'				=> false,
					'version'				=> '2.6.1',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'Redux Framework', 'jobhunt' ),
					'slug'					=> 'redux-framework',
					'required'				=> true,
					'version'				=> '4.1.23',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'                  => esc_html__( 'Regenerate Thumbnails', 'jobhunt' ),
					'slug'                  => 'regenerate-thumbnails',
					'required'              => false,
					'version'               => '3.1.4',
					'force_activation'      => false,
					'force_deactivation'    => false,
					'external_url'          => '',
				),

				array(
					'name'					=> esc_html__( 'Testimonials', 'jobhunt' ),
					'slug'					=> 'testimonials-by-woothemes',
					'source'                => 'https://transvelo.github.io/included-plugins/testimonials-by-woothemes.zip',
					'required'				=> false,
					'version'				=> '1.5.4',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
				),

				array(
					'name'					=> esc_html__( 'WooCommerce', 'jobhunt' ),
					'slug'					=> 'woocommerce',
					'required'				=> true,
					'version'				=> '4.6.1',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'WP Job Manager', 'jobhunt' ),
					'slug'					=> 'wp-job-manager',
					'required'				=> true,
					'version'				=> '1.34.3',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

				array(
					'name'					=> esc_html__( 'WPForms Lite', 'jobhunt' ),
					'slug'					=> 'wpforms-lite',
					'required'				=> true,
					'version'				=> '1.6.3.1',
					'force_activation'		=> false,
					'force_deactivation'	=> false,
					'external_url'			=> '',
				),

			) );

			$config = apply_filters( 'jobhunt_tgmpa_config', array(
				'domain'			=> 'jobhunt',
				'default_path' 		=> '',
				'parent_slug' 		=> 'themes.php',
				'menu'				=> 'install-required-plugins',
				'has_notices'		=> true,
				'is_automatic'		=> false,
				'message'			=> '',
				'strings'			=> array(
					'page_title'  					  => esc_html__( 'Install Required Plugins', 'jobhunt' ),
					'menu_title'  					  => esc_html__( 'Install Plugins', 'jobhunt' ),
					'installing'  					  => esc_html__( 'Installing Plugin: %s', 'jobhunt' ),
					'oops'        					  => esc_html__( 'Something went wrong with the plugin API.', 'jobhunt' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'jobhunt' ),
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'jobhunt' ),
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'jobhunt' ),
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'jobhunt' ),
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'jobhunt' ),
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'jobhunt' ),
					'notice_ask_to_update' 	          => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'jobhunt' ),
					'notice_cannot_update' 	          => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'jobhunt' ),
					'install_link' 			          => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'jobhunt'  ),
					'activate_link' 		          => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'jobhunt'  ),
					'return'				          => esc_html__( 'Return to Required Plugins Installer', 'jobhunt' ),
					'plugin_activated'		          => esc_html__( 'Plugin activated successfully.', 'jobhunt' ),
					'complete' 				          => esc_html__( 'All plugins installed and activated successfully. %s', 'jobhunt' ),
					'nag_type'				          => 'updated'
				)
			) );

			tgmpa( $plugins, $config );
		}
	}
endif;

return new Jobhunt();
