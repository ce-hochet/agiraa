<?php
$key_class = "text-" . esc_attr( $key );
$classes   = array( 'jmfe-text-field', 'jmfe-input-text', 'input-text' );
$classes[] = $key_class;
$maybe_required = ! empty( $field['required'] ) && get_option( 'jmfe_fields_html5_required', TRUE ) ? 'required' : '';
$value = job_manager_field_editor_get_template_value( $args );
$placeholder = array_key_exists( 'placeholder', $field ) ? esc_attr( $field['placeholder'] ) : '';
$text_field_attributes = apply_filters( 'field_editor_text_field_attributes', '', $key, $field, $value );
do_action( 'field_editor_before_output_template_text-field', $field, $key, $args );
?>
<input type="text" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>" id="<?php echo esc_attr( $key ); ?>" title="<?php echo isset($field['title']) ? esc_attr( $field['title'] ) : ''; ?>" <?php echo ! empty($field['pattern']) ? "pattern=\"" . esc_attr($field['pattern']) . "\"" : ''; ?> placeholder="<?php echo $placeholder; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo ! empty( $field['maxlength'] ) ? "maxlength=\"" . esc_attr( $field['maxlength'] ) . "\"" : ''; ?> <?php echo $maybe_required; ?> <?php echo $text_field_attributes; ?>/>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description <?php echo $key_class; ?>-description"><?php echo $field['description']; ?></small><?php endif; ?>
<?php do_action( 'field_editor_after_output_template_text-field', $field, $key, $args ); ?>