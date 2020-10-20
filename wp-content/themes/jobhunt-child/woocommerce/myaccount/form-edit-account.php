<?php
/**
* Edit account form [VERSION JOBHUNT-CHILD]
* OVERRIDE 02/08/2020
* BNORMAND
* Modification pour le champs RNA & le récépissé de déclaration.
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

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" enctype="multipart/form-data" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

  <?php do_action( 'woocommerce_edit_account_form_start' );
  $user = wp_get_current_user();
  if($user->roles[0] !== "employer"){
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
      <label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
      <label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
    </p>
  <?php } ?>
  <div class="clear"></div>

  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
  </p>
  <div class="clear"></div>

  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
  </p>

  <fieldset>
    <legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
      <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
      <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
      <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
    </p>
  </fieldset>

  <div class="clear"></div>

  <?php do_action( 'woocommerce_edit_account_form' ); ?>

  <p>
    <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
    <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
    <input type="hidden" name="action" value="save_account_details" />
  </p>


  <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>

<?php
/*
* 19/10/2020
* CEHOCHET
* Ajout bouton "supprimer mon compte"
* */
?>
<form class="woocommerce-EditAccountForm delete-account" action="" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend><?php esc_html_e( 'Suppression du compte', 'woocommerce' ); ?></legend>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <input type="checkbox" name="remove_account_checkbox" id="remove_account" minlength="10" maxlength="10" required class="required" >
      <label for="remove_account_user"> <?php esc_html_e( 'Je veux supprimer mon compte définitivement', 'woocommerce' ); ?></label>
    </p>
    <fieldset>
      <div class="clear"></div>
      <p>
        <?php wp_nonce_field( 'remove_account_details', 'remove_account_details-nonce' ); ?>
        <button type="submit" class="woocommerce-Button button" name="remove_account_details" value="<?php esc_attr_e( 'Valider la suppression', 'woocommerce' ); ?>"><?php esc_html_e( 'Valider la suppression', 'woocommerce' ); ?></button>
        <input type="hidden" name="action" value="remove_account_details" required class="required"/>
      </p>
    </form>
    <?php

    // DELETE USER + SEND EMAIL
    if (isset($_POST ['remove_account_details']) ) {
      $current_user = wp_get_current_user();
      require_once( ABSPATH.'wp-admin/includes/user.php' );
    //  wc_add_notice( __( 'Votre compte a bien été supprimé', 'woocommerce' ) );
      wp_delete_user( $current_user->ID );
      wp_redirect('http://dev.agiraa-benevolat.fr/');

    }
    ?>
