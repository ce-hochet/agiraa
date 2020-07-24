<?php
/**
 * Creates Mas Faq Post Type
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( ! class_exists( 'MasFaq' ) ) :

/**
 * MasFaq Class
 */
class Mas_Faq {
	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'init',								array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'after_switch_theme',				'flush_rewrite_rules' );
	}

	/**
	 * Register post types.
	 */
	public static function register_post_types() {

		/* Set up the arguments for the post type. */
		$args = array(
			'labels' => array(
				'name' 					=>	esc_html_x( 'FAQs', 'post type general name', 'jobhunt-extensions' ),
				'singular_name' 		=>	esc_html_x( 'FAQs', 'post type singular name', 'jobhunt-extensions' ),
				'add_new' 				=>	esc_html_x( 'Add New', 'block', 'jobhunt-extensions' ),
				'add_new_item' 			=>	esc_html__( 'Add New FAQ', 'jobhunt-extensions' ),
				'edit_item' 			=>	esc_html__( 'Edit FAQ', 'jobhunt-extensions' ),
				'new_item' 				=>	esc_html__( 'New FAQ', 'jobhunt-extensions' ),
				'all_items' 			=>	esc_html__( 'FAQs', 'jobhunt-extensions' ),
				'view_item' 			=>	esc_html__( 'View FAQ', 'jobhunt-extensions' ),
				'search_items' 			=>	esc_html__( 'Search', 'jobhunt-extensions' ),
				'not_found' 			=>	esc_html__( 'No blocks found', 'jobhunt-extensions' ),
				'not_found_in_trash' 	=>	esc_html__( 'No blocks found in Trash', 'jobhunt-extensions' ), 
				'parent_item_colon' 	=>	'',
				'menu_name' 			=>	esc_html__( 'FAQs', 'jobhunt-extensions' ), 
			),
			'menu_icon'           => 'dashicons-editor-ul',
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'public'              => true,
			'show_ui'             => true,
			'query_var'           => 'mas_faq',
			'rewrite'             => array( 'slug' => 'mas_faq' ),
			'supports'            => array( 'title', 'editor', 'revisions' ),
		);

		if ( ! post_type_exists('mas_faq') ) {
			/* Register the post type. */
			register_post_type(
				'mas_faq', // Post type name. Max of 20 characters. Uppercase and spaces not allowed.
				apply_filters( 'jobhunt_mas_faq_post_type_args', $args )      // Arguments for post type.
			);
		}

		register_taxonomy( 'faq_cat',
			apply_filters( 'mas_faq_taxonomy_objects_faq_cat', array( 'mas_faq' ) ),
			apply_filters( 'mas_faq_taxonomy_args_faq_cat', array(
				'hierarchical'          => true,
				'label'                 => esc_html__( 'FAQ Categories', 'jobhunt-extensions' ),
				'labels' => array(
						'name'              => esc_html__( 'FAQ categories', 'jobhunt-extensions' ),
						'singular_name'     => esc_html__( 'FAQ Category', 'jobhunt-extensions' ),
						'menu_name'         => esc_html_x( 'FAQ Categories', 'Admin menu name', 'jobhunt-extensions' ),
						'search_items'      => esc_html__( 'Search FAQ categories', 'jobhunt-extensions' ),
						'all_items'         => esc_html__( 'All FAQ categories', 'jobhunt-extensions' ),
						'parent_item'       => esc_html__( 'Parent FAQ category', 'jobhunt-extensions' ),
						'parent_item_colon' => esc_html__( 'Parent FAQ category:', 'jobhunt-extensions' ),
						'edit_item'         => esc_html__( 'Edit FAQ category', 'jobhunt-extensions' ),
						'update_item'       => esc_html__( 'Update FAQ category', 'jobhunt-extensions' ),
						'add_new_item'      => esc_html__( 'Add new FAQ category', 'jobhunt-extensions' ),
						'new_item_name'     => esc_html__( 'New FAQ category name', 'jobhunt-extensions' ),
						'not_found'         => esc_html__( 'No FAQ categories found', 'jobhunt-extensions' ),
					),
				'show_ui'               => true,
				'query_var'             => true,
			) )
		);
	}
}

endif;

/**
 * Initialize
 */
if( method_exists( 'Mas_Faq', 'init') ) {
	Mas_Faq::init();
}