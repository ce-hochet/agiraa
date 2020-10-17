<?php
/**
 * Profil form 
 * 09/08/2020
 * BNORMAND
 * Création du formulaire du profil.
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

include_once JOB_MANAGER_PLUGIN_DIR . "/includes/forms/class-wp-job-manager-form-submit-job.php";


$user_id = get_current_user_id();
$wjmfsj = WP_Job_Manager_Form_Submit_Job::instance();
$wjmfsj->init_fields();
$company_fields = array_merge($wjmfsj->get_fields('company'), jobhunt_submit_job_form_fields());

$posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company', 'post_status' => array('publish', 'pending')));
//TODO Taxonomy & Files
if(!empty($posts)){
    $post_id = $posts[0]->ID;
    foreach($company_fields as $key => $field) {
        if($key === "company_name") {
            $company_fields[$key]['value'] = $posts[0]->post_title;
        } else if ($key === "company_description"){
            $company_fields[$key]['value'] = $posts[0]->post_content;
        } else if($key === "company_logo") {
            $company_fields[$key]['value'] = has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id) : '';
        } else if($key === "company_specialite") {
            $company_fields[$key]['value'] = wp_get_post_terms($post_id, 'company_specialite', [ 'fields' => 'ids' ]);
        } else {
            $company_fields[$key]['value'] = empty(get_post_meta( $post_id, '_' . $key)[0]) ? '' : get_post_meta( $post_id, '_' . $key)[0];
        }
    }
}
do_action('woocommerce_before_profil_form');
?>
<?php if($posts[0]->post_status === 'pending') { ?>
<div class="woocommerce">
    <ul class="woocommerce-message" role="alert">
		<li>Votre association est en attente de validation auprès des administrateurs.</li>
	</ul>
</div>
<?php } ?>
<form class="job-manager-form" action="save_profil_details" method="post" enctype="multipart/form-data">
    <h2><?php esc_html_e( 'Informations Publiques', 'jobhunt' ); ?></h2>

    <?php do_action( 'submit_job_form_company_fields_start' ); ?>

    <?php foreach ( $company_fields as $key => $field ) : ?>
        <fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
            <label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . esc_html__( '(optional)', 'jobhunt' ) . '</small>', $field ) ); ?></label>
            <div class="field <?php echo esc_attr( $field['required'] ? 'required-field' : '' ); ?>">
                <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
            </div>
        </fieldset>
    <?php endforeach; ?>
    <?php 
    $rna = empty(get_post_meta( $post_id, 'rna_code')) ? "" : get_post_meta( $post_id, 'rna_code')[0];
    $declaration = empty(get_post_meta($post_id, 'declaration_file')) ? "" : get_post_meta($post_id, 'declaration_file')[0];
    ?>
    
    <h2><?php esc_html_e( 'Informations Privées', 'jobhunt' ); ?></h2>
    <fieldset>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="rna"><?php _e( 'RNA Code', 'jobhunt' ); ?></label>
            <input disabled type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="rna" id="rna" value="<?php echo esc_attr( $rna ); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="declaration_file"><?php _e( 'Declaration file', 'jobhunt' ); ?></label>
            <br><span>
            <?php if($declaration !== "") {?> 
                <a style="color: #b4c408;" target="_blank" href="<?php echo $declaration; ?>"> Consulter la déclaration enregistrée. </a></span><br>
            <?php } else { ?>
                <p style="color: #DF3F52;"> Aucune déclaration n'a été mise en ligne.</p>
            <?php } ?>
            <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" name="declaration_file" id="declaration_file"/>
            <span> <em> Veuillez charger le "Récépissé de déclaration" de votre association pour obtenir le statut "Compte certifié" et attesté de la bonne existence de votre association. </em> </span>
        </p>
    </fieldset>
    

    <p>
        <?php wp_nonce_field( 'save_profil_details', 'save-profil-details-nonce' ); ?>
        <button type="submit" class="woocommerce-Button button" name="save_profil_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
        <input type="hidden" name="action" value="save_profil_details" />
    </p>

</form>
<? do_action('woocommerce_after_profil_form'); ?>