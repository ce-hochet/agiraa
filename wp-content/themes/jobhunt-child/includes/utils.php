<?php
/**
 * Manage Certification
 * Ce fichier rassemble les fonctions utilitaires permettant de répondre à un besoin.
 * Historique :
 * 18/10/2020 - BNORMAND - Création & création de la fonction checkCompanyFill. 
 * 
 * @package jobhunt-child
 */

/*
 * Fonction permettant de savoir si la company souhaité est remplie.
 * Return : True si remplie, False sinon.
 */
function checkCompanyFill($post) {
    //Récupération des champs "Company"
    include_once JOB_MANAGER_PLUGIN_DIR . "/includes/forms/class-wp-job-manager-form-submit-job.php";
    $wjmfsj = WP_Job_Manager_Form_Submit_Job::instance();
    $wjmfsj->init_fields();
    $company_fields = array_merge($wjmfsj->get_fields('company'), jobhunt_submit_job_form_fields());
    $company_fill = true;
    $post_id = $post->ID;
    //Vérification de chaque champs pour savoir si c'est ok.
    foreach($company_fields as $key => $field) {
        if(($key === "company_name" && $post->post_title === "")
            || ($key === "company_description" && $post->post_content === "")
            || ($key === "company_logo" && !has_post_thumbnail($post_id))
            || ($key === "company_specialite" && empty(wp_get_post_terms($post_id, 'company_specialite', [ 'fields' => 'ids' ])))
            || ($key !== "company_name" && $key !== "company_description"  && $key !== "company_logo" && $key !== "company_specialite" && $company_fields[$key]['required'] && empty(get_post_meta( $post_id, '_' . $key)[0]))) {
            $company_fill = false;
        }
    }
    return $company_fill;
}
