<?php
/**
 * Profil Public form 
 * 09/08/2020
 * BNORMAND
 * Création du formulaire du profil public.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
$jmfe = WP_Job_Manager_Field_Editor_Fields::get_instance();
$company_fields = $jmfe->get_fields('company');
do_action('woocommerce_before_profil_public_form');
?>
<form class="woocommerce-ProfilPublicForm profil-public" action="save_profil_public_details" method="post" enctype="multipart/form-data">

    <legend><?php esc_html_e( 'Information de l\'association', 'woocommerce' ); ?></legend>

    <?php foreach ( $company_fields as $key => $field ) : ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'wp-job-manager' ) . '</small>', $field ) ); ?></label>
            <input type="<?php echo esc_attr( $field['type'] ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />
        </p>
        <div class="clear"></div>
    <?php endforeach; ?>

    <p>
        <?php wp_nonce_field( 'save_profil_public_details', 'save-profil-public-details-nonce' ); ?>
        <button type="submit" class="woocommerce-Button button" name="save_profil_public_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
        <input type="hidden" name="action" value="save_profil_public_details" />
    </p>

</form>
<? do_action('woocommerce_after_profil_public_form'); ?>