<?php
/**
 * Jobhunt Meta Box Functions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Output a text input box.
 *
 * @param array $field
 */
function jobhunt_wp_text_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['type']          = isset( $field['type'] ) ? $field['type'] : 'text';
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	switch ( $data_type ) {
		case 'url' :
			$field['class'] .= ' jobhunt_input_url';
			$field['value']  = esc_url( $field['value'] );
			break;

		default :
			break;
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo jobhunt_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a hidden input box.
 *
 * @param array $field
 */
function jobhunt_wp_hidden_input( $field ) {
	global $thepostid, $post;

	$thepostid = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']  = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value'] = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['class'] = isset( $field['class'] ) ? $field['class'] : '';

	echo '<input type="hidden" class="' . esc_attr( $field['class'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) .  '" /> ';
}

/**
 * Output a textarea input box.
 *
 * @param array $field
 */
function jobhunt_wp_textarea_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><textarea class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '"  name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="2" cols="20" ' . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $field['value'] ) . '</textarea> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo jobhunt_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a checkbox input box.
 *
 * @param array $field
 */
function jobhunt_wp_checkbox( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'checkbox';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['cbvalue']       = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 'yes';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="checkbox" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . '  ' . implode( ' ', $custom_attributes ) . '/> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo jobhunt_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</p>';
}

/**
 * Output a select input box.
 *
 * @param array $field
 */
function jobhunt_wp_select( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	if ( empty( $field['value'] ) && isset( $field['default'] ) ) {
		$field['value'] = $field['default'];
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';

	foreach ( $field['options'] as $key => $value ) {
		echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
	}

	echo '</select> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo jobhunt_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a radio input box.
 *
 * @param array $field
 */
function jobhunt_wp_radio( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	echo '<fieldset class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><legend>' . wp_kses_post( $field['label'] ) . '</legend><ul class="ec-radios">';

	foreach ( $field['options'] as $key => $value ) {

		echo '<li><label><input
				name="' . esc_attr( $field['name'] ) . '"
				value="' . esc_attr( $key ) . '"
				type="radio"
				class="' . esc_attr( $field['class'] ) . '"
				style="' . esc_attr( $field['style'] ) . '"
				' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
				/> ' . esc_html( $value ) . '</label>
		</li>';
	}
	echo '</ul>';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo jobhunt_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</fieldset>';
}

/**
 * Output input fields to choose a WooCommerce Shortcode
 */
function jobhunt_wp_wc_shortcode( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'per_page', 'columns' );

	echo '<div class="jobhunt-wc-shortcode">';

	jobhunt_wp_select( array(
		'id'		=> $field['name'],
		'label'		=> esc_html__( 'Products by', 'jobhunt' ),
		'default'	=> $field['default'],
		'options'	=> array(
			'recent_products'		=> esc_html__( 'Recent Products', 'jobhunt' ),
			'featured_products'		=> esc_html__( 'Featured Products', 'jobhunt' ),
			'sale_products'			=> esc_html__( 'Sale Products', 'jobhunt' ),
			'best_selling_products'	=> esc_html__( 'Best Selling Products', 'jobhunt' ),
			'top_rated_products'	=> esc_html__( 'Top Rated Products', 'jobhunt' ),
			'product_category'		=> esc_html__( 'Product Category', 'jobhunt' ),
			'products'				=> esc_html__( 'Products', 'jobhunt' ),
			'product_attribute'		=> esc_html__( 'Product Attribute', 'jobhunt' ),
		),
		'class'		=> 'wc_shortcode_select show_hide_select',
		'name'		=> $field['name'] . '[shortcode]',
		'value'		=> isset( $field['value']['shortcode'] ) ? $field['value']['shortcode'] : $field['default'],
	) );
	
	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_product_category_slug',
		'label'			=> esc_html__( 'Product Category Slug', 'jobhunt' ),
		'class'			=>'wc_shortcode_product_category_slug',
		'placeholder'	=> esc_html__( 'Enter slug spearate by comma(,).', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[product_category_slug]',
		'value'			=> isset( $field['value']['product_category_slug'] ) ? $field['value']['product_category_slug'] : '',
	) );

	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_cat_operator',
		'label'			=> esc_html__( 'Product Category Operator', 'jobhunt' ),
		'class'			=>'wc_shortcode_cat_operator',
		'placeholder'	=> esc_html__( 'Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[cat_operator]',
		'value'			=> isset( $field['value']['cat_operator'] ) ? $field['value']['cat_operator'] : 'IN',
	) );

	jobhunt_wp_select( array(
		'id'	=> $field['name'] . '_products_choice',
		'label'	=> esc_html__( 'Show Products by:', 'jobhunt' ),
		'options'	=> array(  
			'ids'	=> esc_html__( 'IDs', 'jobhunt' ),
			'skus'	=> esc_html__( 'SKUs', 'jobhunt' )
		),
		'wrapper_class'	=> 'show_if_products hide',
		'class'			=> 'skus_or_ids',
		'name'			=> $field['name'] . '[products_choice]',
		'value'			=> isset( $field['value']['products_choice'] ) ? $field['value']['products_choice'] : 'ids',
	) );

	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_products_ids_skus',
		'label'			=> esc_html__( 'Product IDs or SKUs', 'jobhunt' ),
		'placeholder'	=> esc_html__( 'Enter IDs or SKUs separated by comma', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_products hide',
		'name'			=> $field['name'] . '[products_ids_skus]',
		'value'			=> isset( $field['value']['products_ids_skus'] ) ? $field['value']['products_ids_skus'] : '',
	) );

	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_attribute',
		'label'			=> esc_html__( 'Attribute', 'jobhunt' ),
		'class'			=>'wc_shortcode_attribute',
		'placeholder'	=> esc_html__( 'Enter single attribute slug.', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[attribute]',
		'value'			=> isset( $field['value']['attribute'] ) ? $field['value']['attribute'] : '',
	) );

	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_terms',
		'label'			=> esc_html__( 'Terms', 'jobhunt' ),
		'class'			=>'wc_shortcode_terms',
		'placeholder'	=> esc_html__( 'Enter term slug spearate by comma(,).', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms]',
		'value'			=> isset( $field['value']['terms'] ) ? $field['value']['terms'] : '',
	) );

	jobhunt_wp_text_input( array(
		'id'			=> $field['name'] . '_terms_operator',
		'label'			=> esc_html__( 'Terms Operator', 'jobhunt' ),
		'class'			=>'wc_shortcode_terms_operator',
		'placeholder'	=> esc_html__( 'Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'jobhunt' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms_operator]',
		'value'			=> isset( $field['value']['terms_operator'] ) ? $field['value']['terms_operator'] : 'IN',
	) );

	echo '</div>';

	jobhunt_wp_wc_shortcode_atts( array( 
		'id'			=> $field['name'] . '_shortcode_atts',
		'label'			=> esc_html__( 'Shortcode Atts', 'jobhunt' ),
		'name'			=> $field['name'] . '[shortcode_atts]',
		'value'			=> isset( $field['value']['shortcode_atts'] ) ? $field['value']['shortcode_atts'] : '',
		'fields'		=> $field['fields']
	) );
}

/**
 * Output input fields to choose a WooCommerce Shortcode Atts
 */
function jobhunt_wp_wc_shortcode_atts( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'per_page', 'columns' );

	echo '<div class="jobhunt-wc-shortcode-atts">';

	if( isset( $field['fields'] ) && in_array( 'per_page', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_per_page',
			'label'			=> esc_html__( 'per_page', 'jobhunt' ),
			'name'			=> $field['name'] . '[per_page]',
			'value'			=> isset( $field['value']['per_page'] ) ? $field['value']['per_page'] : '3',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'columns', $field['fields'] )  ) {
		jobhunt_wp_select( array(
			'id'			=> $field['id'] . '_columns',
			'label'			=> esc_html__( 'columns', 'jobhunt' ),
			'name'			=> $field['name'] . '[columns]',
			'options'       => array(
                '1'          => esc_html__( '1', 'jobhunt' ),
                '2'          => esc_html__( '2', 'jobhunt' ),
                '3'          => esc_html__( '3', 'jobhunt' ),
                '4'          => esc_html__( '4', 'jobhunt' ),
                '5'          => esc_html__( '5', 'jobhunt' ),
                '6'          => esc_html__( '6', 'jobhunt' ),
                
            ),
			'value'			=> isset( $field['value']['columns'] ) ? $field['value']['columns'] : '3',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'orderby', $field['fields'] )  ) {
		jobhunt_wp_select( array(
			'id'			=> $field['id'] . '_orderby',
			'label'			=> esc_html__( 'orderby', 'jobhunt' ),
			'name'			=> $field['name'] . '[orderby]',
			'options'   => array(
                'date'           => esc_html__( 'Date', 'jobhunt' ),
                'id'           => esc_html__( 'Id', 'jobhunt' ),
                'menu_order'     => esc_html__( 'Menu Order', 'jobhunt' ),
                'popularity'		 => esc_html__( 'Popularity', 'jobhunt' ),
                'rand'             => esc_html__( 'Rand', 'jobhunt' ),
                'rating'    => esc_html__( 'Rating', 'jobhunt' ),
                'title'         => esc_html__( 'Title', 'jobhunt' ),
            ),
			'value'			=> isset( $field['value']['orderby'] ) ? $field['value']['orderby'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'order', $field['fields'] )  ) {
		jobhunt_wp_select( array(
			'id'			=> $field['id'] . '_order',
			'label'			=> esc_html__( 'order', 'jobhunt' ),
			'name'			=> $field['name'] . '[order]',
			'options'       => array(
                'ASC'           => esc_html__( 'ASC', 'jobhunt' ),
                'DESC'          => esc_html__( 'DESC', 'jobhunt' ),
                
            ),
			'value'			=> isset( $field['value']['order'] ) ? $field['value']['order'] : '',
		) );
	}

	echo '</div>';
}

/**
 * Output input fields to choose a WooCommerce Category Shortcode Atts
 */
function jobhunt_wp_wc_cat_shortcode_atts( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'orderby' , 'order' , 'hide_empty', 'slug');

	if( isset( $field['fields'] ) && in_array( 'limit', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_limit',
			'label'			=> esc_html__( 'limit', 'jobhunt' ),
			'name'			=> $field['name'] . '[limit]',
			'value'			=> isset( $field['value']['limit'] ) ? $field['value']['limit'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'per_page', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_per_page',
			'label'			=> esc_html__( 'per_page', 'jobhunt' ),
			'name'			=> $field['name'] . '[per_page]',
			'value'			=> isset( $field['value']['per_page'] ) ? $field['value']['per_page'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'number', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_number',
			'label'			=> esc_html__( 'number', 'jobhunt' ),
			'name'			=> $field['name'] . '[number]',
			'value'			=> isset( $field['value']['number'] ) ? $field['value']['number'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'hide_empty', $field['fields'] )  ) {
		jobhunt_wp_checkbox( array(
			'id'			=> $field['id'] . '_hide_empty',
			'label'			=> esc_html__( 'hide_empty', 'jobhunt' ),
			'name'			=> $field['name'] . '[hide_empty]',
			'value'			=> isset( $field['value']['hide_empty'] ) ? $field['value']['hide_empty'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'orderby', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_orderby',
			'label'			=> esc_html__( 'orderby', 'jobhunt' ),
			'name'			=> $field['name'] . '[orderby]',
			'value'			=> isset( $field['value']['orderby'] ) ? $field['value']['orderby'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'order', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_order',
			'label'			=> esc_html__( 'order', 'jobhunt' ),
			'name'			=> $field['name'] . '[order]',
			'value'			=> isset( $field['value']['order'] ) ? $field['value']['order'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'slug', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_slug',
			'label'			=> esc_html__( 'slug', 'jobhunt' ),
			'name'			=> $field['name'] . '[slug]',
			'value'			=> isset( $field['value']['slug'] ) ? $field['value']['slug'] : '',
		) );
	}
}

/**
 * Outputs Legend for Fieldsets
 */
function jobhunt_wp_legend( $title ) {
	?>
	<h4 class="jh-legend"><?php echo wp_kses_post( $title ); ?></h4>
	<?php
}

/**
 * Outputs Legend for Fieldsets
 */
function jobhunt_wp_legend_sub( $title ) {
	?>
	<h6 class="jh-legend-sub"><?php echo wp_kses_post( $title ); ?></h6>
	<?php
}

function jobhunt_wp_upload_image( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      	= isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['placeholder']	= isset( $field['placeholder'] ) ? $field['placeholder'] : false;

	$placeholder_src = function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : '';
	if ( absint( $field['value'] ) ) {
		$image = wp_get_attachment_thumb_url( $field['value'] );
	} elseif ( $field['placeholder'] ) {
		$image = $placeholder_src;
	} else {
		$image = '';
	}

	echo '<p id="' . esc_attr( $field['id'] ) . '_field" class="form-field media-option ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	?>
		<?php if ( isset ( $image ) ) : ?>
		<img src="<?php echo esc_attr( $image ); ?>" class="upload_image_preview" data-placeholder-src="<?php echo esc_attr( $placeholder_src ); ?>" alt="<?php echo esc_attr__( 'Image', 'jobhunt' ); ?>" />
		<?php endif; ?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>" class="upload_image_id" value="<?php echo esc_attr( $field['value'] ); ?>" />
		<a href="#" class="button jh_upload_image_button tips"><?php echo esc_html__( 'Upload/Add image', 'jobhunt' ); ?></a>
		<a href="#" class="button jh_remove_image_button tips"><?php echo esc_html__( 'Remove this image', 'jobhunt' ); ?></a>
	</p>
	<?php
}

function jobhunt_wp_animation_dropdown( $field ) {
	
	jobhunt_wp_select( array(
		'id'		=> $field['id'] . '_products_choice',
		'label'		=> '',
		'class'		=> 'animation_dropdown',
		'name'		=> isset( $field['name'] ) ? $field['name'] : $field['id'],
		'value'		=> isset( $field['value'] ) ? $field['value'] : '',
		'options'	=> array(
			'' => esc_html__( 'No Animation', 'jobhunt' ),
			'bounce' => 'bounce',
			'flash' => 'flash',
			'pulse' => 'pulse',
			'rubberBand' => 'rubberBand',
			'shake' => 'shake',
			'swing' => 'swing',
			'tada' => 'tada',
			'wobble' => 'wobble',
			'jello' => 'jello',
			'bounceIn' => 'bounceIn',
			'bounceInDown' => 'bounceInDown',
			'bounceInLeft' => 'bounceInLeft',
			'bounceInRight' => 'bounceInRight',
			'bounceInUp' => 'bounceInUp',
			'bounceOut' => 'bounceOut',
			'bounceOutDown' => 'bounceOutDown',
			'bounceOutLeft' => 'bounceOutLeft',
			'bounceOutRight' => 'bounceOutRight',
			'bounceOutUp' => 'bounceOutUp',
			'fadeIn' => 'fadeIn',
			'fadeInDown' => 'fadeInDown',
			'fadeInDownBig' => 'fadeInDownBig',
			'fadeInLeft' => 'fadeInLeft',
			'fadeInLeftBig' => 'fadeInLeftBig',
			'fadeInRight' => 'fadeInRight',
			'fadeInRightBig' => 'fadeInRightBig',
			'fadeInUp' => 'fadeInUp',
			'fadeInUpBig' => 'fadeInUpBig',
			'fadeOut' => 'fadeOut',
			'fadeOutDown' => 'fadeOutDown',
			'fadeOutDownBig' => 'fadeOutDownBig',
			'fadeOutLeft' => 'fadeOutLeft',
			'fadeOutLeftBig' => 'fadeOutLeftBig',
			'fadeOutRight' => 'fadeOutRight',
			'fadeOutRightBig' => 'fadeOutRightBig',
			'fadeOutUp' => 'fadeOutUp',
			'fadeOutUpBig' => 'fadeOutUpBig',
			'flip' => 'flip',
			'flipInX' => 'flipInX',
			'flipInY' => 'flipInY',
			'flipOutX' => 'flipOutX',
			'flipOutY' => 'flipOutY',
			'lightSpeedIn' => 'lightSpeedIn',
			'lightSpeedOut' => 'lightSpeedOut',
			'rotateIn' => 'rotateIn',
			'rotateInDownLeft' => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft' => 'rotateInUpLeft',
			'rotateInUpRight' => 'rotateInUpRight',
			'rotateOut' => 'rotateOut',
			'rotateOutDownLeft' => 'rotateOutDownLeft',
			'rotateOutDownRight' => 'rotateOutDownRight',
			'rotateOutUpLeft' => 'rotateOutUpLeft',
			'rotateOutUpRight' => 'rotateOutUpRight',
			'slideInUp' => 'slideInUp',
			'slideInDown' => 'slideInDown',
			'slideInLeft' => 'slideInLeft',
			'slideInRight' => 'slideInRight',
			'slideOutUp' => 'slideOutUp',
			'slideOutDown' => 'slideOutDown',
			'slideOutLeft' => 'slideOutLeft',
			'slideOutRight' => 'slideOutRight',
			'zoomIn' => 'zoomIn',
			'zoomInDown' => 'zoomInDown',
			'zoomInLeft' => 'zoomInLeft',
			'zoomInRight' => 'zoomInRight',
			'zoomInUp' => 'zoomInUp',
			'zoomOut' => 'zoomOut',
			'zoomOutDown' => 'zoomOutDown',
			'zoomOutLeft' => 'zoomOutLeft',
			'zoomOutRight' => 'zoomOutRight',
			'zoomOutUp' => 'zoomOutUp',
			'hinge' => 'hinge',
			'rollIn' => 'rollIn',
			'rollOut' => 'rollOut',
		),
	) );
}

/**
 * Output input fields to choose a Slick Carousel Options
 */
function jobhunt_wp_slick_carousel_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'slidesPerRow', 'slidesToShow', 'slidesToScroll' );

	echo '<div class="jobhunt-slick-carousel-options">';

	if( isset( $field['label'] ) ) {
		jobhunt_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesPerRow', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesPerRow',
			'label'			=> esc_html__( 'slidesPerRow', 'jobhunt' ),
			'name'			=> $field['name'] . '[slidesPerRow]',
			'value'			=> isset( $field['value']['slidesPerRow'] ) ? $field['value']['slidesPerRow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesToShow', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesToShow',
			'label'			=> esc_html__( 'slidesToShow', 'jobhunt' ),
			'name'			=> $field['name'] . '[slidesToShow]',
			'value'			=> isset( $field['value']['slidesToShow'] ) ? $field['value']['slidesToShow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesToScroll', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesToScroll',
			'label'			=> esc_html__( 'slidesToScroll', 'jobhunt' ),
			'name'			=> $field['name'] . '[slidesToScroll]',
			'value'			=> isset( $field['value']['slidesToScroll'] ) ? $field['value']['slidesToScroll'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'rows', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_rows',
			'label'			=> esc_html__( 'rows', 'jobhunt' ),
			'name'			=> $field['name'] . '[rows]',
			'value'			=> isset( $field['value']['rows'] ) ? $field['value']['rows'] : '',
		) );
	}

	
	if( isset( $field['fields'] ) && in_array( 'dots', $field['fields'] )  ) {
		jobhunt_wp_checkbox( array(
			'id'			=> $field['id'] . '_dots',
			'label'			=> esc_html__( 'dots', 'jobhunt' ),
			'name'			=> $field['name'] . '[dots]',
			'value'			=> isset( $field['value']['dots'] ) ? $field['value']['dots'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'arrows', $field['fields'] )  ) {
		jobhunt_wp_checkbox( array(
			'id'			=> $field['id'] . '_arrows',
			'label'			=> esc_html__( 'arrows', 'jobhunt' ),
			'name'			=> $field['name'] . '[arrows]',
			'value'			=> isset( $field['value']['arrows'] ) ? $field['value']['arrows'] : '',
			
		) );
	}
	
	if( isset( $field['fields'] ) && in_array( 'prevArrow', $field['fields'] )  ) {
		jobhunt_wp_textarea_input( array(
			'id'			=> $field['id'] . '_prevArrow',
			'label'			=> esc_html__( 'prevArrow', 'jobhunt' ),
			'name'			=> $field['name'] . '[prevArrow]',
			'value'			=> isset( $field['value']['prevArrow'] ) ? $field['value']['prevArrow' ] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'nextArrow', $field['fields'] )  ) {
		jobhunt_wp_textarea_input( array(
			'id'			=> $field['id'] . '_nextArrow',
			'label'			=> esc_html__( 'nextArrow', 'jobhunt' ),
			'name'			=> $field['name'] . '[nextArrow]',
			'value'			=> isset( $field['value']['nextArrow'] ) ? $field['value']['nextArrow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'autoplay', $field['fields'] )  ) {
		jobhunt_wp_checkbox( array(
			'id'			=> $field['id'] . '_autoplay',
			'label'			=> esc_html__( 'autoplay', 'jobhunt' ),
			'name'			=> $field['name'] . '[autoplay]',
			'value'			=> isset( $field['value']['autoplay'] ) ? $field['value']['autoplay'] : '',
			
		) );
	}


	echo '</div>';
}

/**
 * Output input fields to choose a Banner Options
 */
function jobhunt_wp_banner_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array('title','action_text', 'action_link', 'image_choice', 'image', 'bg_color', 'bg_image' ,'is_fullwidth','button_type');

	echo '<div class="jobhunt-banner-options">';

	if( isset( $field['fields'] ) && in_array( 'title', $field['fields'] )  ) {
		jobhunt_wp_textarea_input( array(
			'id'			=> $field['id'] . '_title',
			'label'			=> esc_html__( 'Title', 'jobhunt' ),
			'name'			=> $field['name'] . '[title]',
			'value'			=> isset( $field['value']['title'] ) ? $field['value']['title'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'action_text', $field['fields'] )  ) {
		jobhunt_wp_textarea_input( array(
			'id'			=> $field['id'] . '_action_text',
			'label'			=> esc_html__( 'Action Text', 'jobhunt' ),
			'name'			=> $field['name'] . '[action_text]',
			'value'			=> isset( $field['value']['action_text'] ) ? $field['value']['action_text'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'action_link', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_action_link',
			'label'			=> esc_html__( 'Action Link', 'jobhunt' ),
			'name'			=> $field['name'] . '[action_link]',
			'value'			=> isset( $field['value']['action_link'] ) ? $field['value']['action_link'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'image_choice', $field['fields'] )  ) {
		jobhunt_wp_select( array(
			'id'			=> $field['id'] . '_image_choice',
			'label'			=> esc_html__( 'Image Choice', 'jobhunt' ),
			'name'			=> $field['name'] . '[image_choice]',
			'options'		=> array(
				'image'		=> esc_html__( 'Image', 'jobhunt' ),
				'bg_image'	=> esc_html__( 'Background Image', 'jobhunt' ),
			),
			'class'			=> 'show_hide_select',
			'value'			=> isset( $field['value']['image_choice'] ) ? $field['value']['image_choice'] : 'image',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'image', $field['fields'] )  ) {
		jobhunt_wp_upload_image( array(
			'id'			=> $field['id'] . '_image',
			'label'			=> esc_html__( 'Image', 'jobhunt' ),
			'name'			=> $field['name'] . '[image]',
			'value'			=> isset( $field['value']['image'] ) ? $field['value']['image'] : '',
			'wrapper_class'	=> 'show_if_image hide',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'bg_image', $field['fields'] )  ) {
		jobhunt_wp_upload_image( array(
			'id'			=> $field['id'] . '_bg_image',
			'label'			=> esc_html__( 'Background Image', 'jobhunt' ),
			'wrapper_class'	=> 'show_if_bg_image hide',
			'name'			=> $field['name'] . '[bg_image]',
			'value'			=> isset( $field['value']['bg_image'] ) ? $field['value']['bg_image'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'bg_color', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_bg_color',
			'label'			=> esc_html__( 'Background Color', 'jobhunt' ),
			'name'			=> $field['name'] . '[bg_color]',
			'value'			=> isset( $field['value']['bg_color'] ) ? $field['value']['bg_color'] : '',
			'wrapper_class'	=> 'show_if_image hide',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'is_fullwidth', $field['fields'] )  ) {
		jobhunt_wp_checkbox( array(
			'id'			=> $field['id'] . '_is_fullwidth',
			'label'			=> esc_html__( 'Full Width', 'jobhunt' ),
			'name'			=> $field['name'] . '[is_fullwidth]',
			'value'			=> isset( $field['value']['is_fullwidth'] ) ? $field['value']['is_fullwidth'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'button_type', $field['fields'] )  ) {
		jobhunt_wp_select( array(
			'id'			=> $field['id'] . '_button_type',
			'label'			=> esc_html__( 'Button Type', 'jobhunt' ),
			'name'			=> $field['name'] . '[button_type]',
			'options'		=> array(
				'primary'	=> esc_html__( 'Primary', 'jobhunt' ),
				'secondary'	=> esc_html__( 'Secondary', 'jobhunt' ),
			),
			'value'			=> isset( $field['value']['button_type'] ) ? $field['value']['button_type'] : 'primary',
		) );
	}

	echo '</div>';
}

/**
 * Output input fields to choose a Woocommerce Action List Options
 */

function jobhunt_wp_woocommerce_action_list_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'step_value', 'pre_title', 'title', 'caption');

	echo '<div class="jobhunt-slick-carousel-options">';

	if( isset( $field['label'] ) ) {
		jobhunt_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['fields'] ) && in_array( 'step_value', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_step_value',
			'label'			=> esc_html__( 'Step Value', 'jobhunt' ),
			'name'			=> $field['name'] . '[step_value]',
			'value'			=> isset( $field['value']['step_value'] ) ? $field['value']['step_value'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'pre_title', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_pre_title',
			'label'			=> esc_html__( 'Pre Title', 'jobhunt' ),
			'name'			=> $field['name'] . '[pre_title]',
			'value'			=> isset( $field['value']['pre_title'] ) ? $field['value']['pre_title'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'title', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_title',
			'label'			=> esc_html__( 'Title', 'jobhunt' ),
			'name'			=> $field['name'] . '[title]',
			'value'			=> isset( $field['value']['title'] ) ? $field['value']['title'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'caption', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_caption',
			'label'			=> esc_html__( 'Caption', 'jobhunt' ),
			'name'			=> $field['name'] . '[caption]',
			'value'			=> isset( $field['value']['caption'] ) ? $field['value']['caption'] : '',
		) );
	}
	echo '</div>';
}

function jobhunt_wp_post_args( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'limit', 'columns', 'post_choice' , 'post_ids' );

	if( isset( $field['fields'] ) && in_array( 'limit', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_limit',
			'label'			=> esc_html__( 'limit', 'jobhunt' ),
			'name'			=> $field['name'] . '[limit]',
			'value'			=> isset( $field['value']['limit'] ) ? $field['value']['limit'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'columns', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_columns',
			'label'			=> esc_html__( 'columns', 'jobhunt' ),
			'name'			=> $field['name'] . '[columns]',
			'value'			=> isset( $field['value']['columns'] ) ? $field['value']['columns'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'post_choice', $field['fields'] )  ) {
		jobhunt_wp_select( array(
            'id'            => $field['id'] . '_post_choice',
            'label'         => esc_html__( 'Post Choice', 'jobhunt' ),
            'options'       => array(
            	'recent'    => esc_html__( 'Most Recent Posts', 'jobhunt' ),
                'random'    => esc_html__( 'Random Posts', 'jobhunt' ),
                'specific'  => esc_html__( 'Specify by ID', 'jobhunt' ),
                'category'	=> esc_html__( 'Category by ID', 'jobhunt' ),
            ),
            'class'         => 'show_hide_select',
            'name'          => $field['name'] . '[post_choice]',
            'value'         => isset( $field['value']['post_choice'] ) ? $field['value']['post_choice'] : '',
        ) );
	}

	if( isset( $field['fields'] ) && in_array( 'post_ids', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_post_ids',
			'label'			=> esc_html__( 'Post ids', 'jobhunt' ),
			'name'			=> $field['name'] . '[post_ids]',
			'value'			=> isset( $field['value']['post_ids'] ) ? $field['value']['post_ids'] : '',
			'description'	=> esc_html__( 'Enter post id spearate by comma(,) Note: Only works with specific by id choice.', 'jobhunt' ),
			'wrapper_class'	=> 'show_if_specific hide',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'category__in', $field['fields'] )  ) {
		jobhunt_wp_text_input( array(
			'id'			=> $field['id'] . '_category__in',
			'label'			=> esc_html__( 'Category ids', 'jobhunt' ),
			'name'			=> $field['name'] . '[category__in]',
			'value'			=> isset( $field['value']['category__in'] ) ? $field['value']['category__in'] : '',
			'description'	=> esc_html__( 'Enter category id spearate by comma(,) Note: Only works with category by id choice.', 'jobhunt' ),
			'wrapper_class'	=> 'show_if_category hide',
		) );
	}
}