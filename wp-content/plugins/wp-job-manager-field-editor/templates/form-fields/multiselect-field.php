<?php
$disable_chosen = WP_Job_Manager_Field_Editor::disable_chosen();

if( $disable_chosen ){
	wp_enqueue_script( 'wp-job-manager-multiselect' );
} else {
	wp_enqueue_script( 'wp-job-manager-multiselect-legacy' );
}
$key_class = "multiselect-" . esc_attr( $key );
$classes = array( 'jmfe-multiselect-field-check-max', 'jmfe-chosen-select-field' );
$classes[] = $key_class;
// Chosen.JS has issues with HTML5 required attributes, so only use if filter used to return true value
// @see https://github.com/harvesthq/chosen/issues/515
$maybe_required = ! empty( $field['required'] ) && apply_filters( 'job_manager_field_editor_select_use_html5_required', get_option( 'jmfe_fields_html5_required', true ) ) ? 'required' : '';
$placeholder = array_key_exists( 'placeholder', $field ) && ! empty( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : __( 'Select Some Options', 'wp-job-manager-field-editor' );

if( ! empty( $maybe_required ) ) $classes[] = 'jmfe-required-chosen';

// Check for custom configurations (that require separate jQuery initalization)
if ( array_key_exists( 'max_selected', $field ) && ! empty( $field[ 'max_selected' ] ) && ! $disable_chosen ) {

	$max_selected    = $field[ 'max_selected' ];
	$esc_key         = esc_attr( $key );

	// Generate custom jQuery code to initialize chosen element
	$multi_script    = "var {$esc_key}_max = {$max_selected}; jQuery(function($){ jQuery('#{$esc_key}').chosen({ max_selected_options: {$max_selected}, search_contains: true }); });";
	wp_add_inline_script( 'wp-job-manager-multiselect-legacy', $multi_script );
	wp_enqueue_script( 'jmfe-compatibility' );

	if ( empty( $field[ 'description' ] ) ) {
		$field[ 'description' ] = sprintf( __( 'Maximum selections: %s', 'wp-job-manager-field-editor' ), $max_selected );
	}

} else {
	// Add default chosen init class if this isn't a custom init field
	$classes[] = 'job-manager-multiselect';
}
do_action('field_editor_before_output_template_multiselect-field', $field, $key, $args );
?>
<select multiple="multiple" name="<?php echo esc_attr( isset($field['name']) ? $field['name'] : $key ); ?>[]" id="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-no_results_text="<?php _e( 'No results match', 'wp-job-manager-field-editor' ); ?>" data-placeholder="<?php echo $placeholder; ?>" <?php echo $maybe_required; ?>>
	<?php
	$no_values = isset( $field['value'] ) ? false : true;
	foreach ( $field['options'] as $key => $value ) :
		$key = str_replace( '*', '', $key, $replace_default );
		$key = str_replace( '~', '', $key, $replace_disabled );
		$field_value = isset( $field['value'] ) ? $field['value'] : array();

		if( $no_values && $replace_default > 0) $field[ 'value' ][ ] = $key;

		$disabled_option = $replace_disabled > 0 ? 'disabled="disabled"' : '';
	?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php if ( ! empty( $field['value'] ) && is_array( $field['value'] ) ) selected( in_array( $key, $field['value'] ), true ); ?> <?php echo $disabled_option; ?>><?php echo esc_html( $value ); ?></option>
	<?php endforeach; ?>
</select>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description <?php echo $key_class; ?>-description"><?php echo $field['description']; ?></small><?php endif; ?>
<?php do_action( 'field_editor_after_output_template_multiselect-field', $field, $key, $args ); ?>
