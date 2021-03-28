<?php
/**
 * Manage Association Profile
 * Ce fichier rassemble les fonctions permettant de gérer la page profil des association.
 * Historique :
 * 18/10/2020 - BNORMAND - Création et rassemblement des fonctions. 
 * 
 * @package jobhunt-child
 */

define('DECLARATION_FILE_MSG', "Bonjour, \n\nUn nouveau récépissé de déclaration d'association à été déposé. \n\n Agiraa,");

include_once get_stylesheet_directory() . "/includes/utils.php";

/*
 * Ajout du lien dans le menu latéral de gauche
 */
add_filter( 'woocommerce_account_menu_items', function($items) {
    $user_role = wp_get_current_user()->roles[0];
    if($user_role === "employer" || $user_role === "administrator") {
        $my_items = array(
                'profil' => __( 'Mon profil', 'jobhunt' ),
            );
            $my_items = array_slice( $items, 0, 1, true ) +
                $my_items +
                array_slice( $items, 1, count( $items ), true );

            return $my_items;
    }
    return $items;
}, 99, 1 );

/*
 * Création de l'endpoint pour la page
 */
add_action( 'init', function() {
    add_rewrite_endpoint( 'profil', EP_ROOT | EP_PAGES );
} );

/*
 * Solution temporaire afin de pouvoir avoir le CSS du champs multiselect dans le bon ordres. Celui-ci devant être déclaré avant le autres.
 * */
add_action('wp_head', function() {
    echo '<link rel="stylesheet" href="'. JOB_MANAGER_PLUGIN_URL . '/assets/css/chosen.css" type="text/css" media="all">';
    return;
}, 1);

/*
 * Ajout des fichier JS nécéssaire et appel de la template.
 */
add_action( 'woocommerce_account_profil_endpoint', function() {
    wp_register_script( 'chosen', JOB_MANAGER_PLUGIN_URL . '/assets/js/jquery-chosen/chosen.jquery.min.js', [ 'jquery' ], '1.1.0', true , 0);
    wp_enqueue_script('remove-file-js', JOB_MANAGER_PLUGIN_URL . '/assets/js/job-submission.min.js');
    wc_get_template_part('myaccount/profil');
});





/*
 * Mise en place de la fonction appelé lors de la validation du formulaire du profil publique. .
 */
add_action( 'template_redirect', 'save_profil_details');

function save_profil_details() {
    $nonce_value = wc_get_var( $_REQUEST['save-profil-details-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.
    if ( ! wp_verify_nonce( $nonce_value, 'save_profil_details' ) ) {
        return;
    }

    if ( empty( $_POST['action'] ) || 'save_profil_details' !== $_POST['action'] ) {
        return;
    }
    wc_nocache_headers();
    $user_id = get_current_user_id();
    if ( $user_id <= 0 ) {
        return;
    }

    $posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company', 'post_status' => array('publish', 'pending')));

    include_once JOB_MANAGER_PLUGIN_DIR . "/includes/forms/class-wp-job-manager-form-submit-job.php";

    $company_infos = [];
    $file_fields = [];

    $wjmfsj = WP_Job_Manager_Form_Submit_Job::instance();
    $wjmfsj->init_fields();
    $company_fields = array_merge($wjmfsj->get_fields('company'), jobhunt_submit_job_form_fields());
    //Récupération des champs.
    foreach ( $company_fields as $key => $field ) :
        if($key === 'company_logo') {
            $company_infos[$key] = $_POST['current_company_logo'];
        } else {
            $company_infos[$key] = ! empty( $_POST[$key] ) ? wc_clean( wp_unslash( $_POST[$key] ) ) : '';
        }
    endforeach;

    //Validation des champs
    foreach ( $company_fields as $key => $field ) :
        if($field['required'] && empty($company_infos[$key]))
            wc_add_notice(__( 'Le champs '. $field['label'] . ' est obligatoire. Veuillez le renseigner', 'agiraa' ), 'error');
    endforeach;

    //Validation du fichier de déclaration :
    //TODO Vérifier pour faire un attachment ou une gestion de fichier WP.
    $fileok = false;
    $declaration_file = $_FILES['declaration_file'];
    if($declaration_file['size'] > 0) {
        if($declaration_file["type"] !== "application/pdf"){
            wc_add_notice(__( 'Le récépissé de déclaration doit être au format PDF.', 'agiraa' ), 'error');
        } else {
            if ( ! function_exists( 'wp_handle_upload' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }
            $movefile = wp_handle_upload( $declaration_file, array('test_form' => false) );
            if ( $movefile && ! isset( $movefile['error'] ) ) {
                $fileok = true;
            } else {
                wc_add_notice(__( 'Une erreur est survenue lors de la mise en ligne.', 'agiraa' ), 'error');
            }
        }
    }
    // Allow plugins to return their own errors.
    $errors = new WP_Error();
    do_action_ref_array( 'woocommerce_profil_details_errors', array( &$errors, &$user ) );
    if ( $errors->get_error_messages() ) {
        foreach ( $errors->get_error_messages() as $error ) {
            wc_add_notice( $error, 'error' );
        }
    }
    if ( wc_notice_count( 'error' ) === 0 ) {
        $post_id = $posts[0]->ID;
        //Vérification de l'existence d'une company.
        //Dans le cas ou le nom de la company a été changé, il faut également changer les noms présents sur tous les jobs.
        //Pour ce faire on requete tous les post_meta "_company_name" correspondant à l'ancien titre et on les modifie.
        if($posts[0]->post_title !== $company_infos['company_name']){
            global $wpdb;
            $all_company_name = $wpdb->get_results('SELECT * from wp_postmeta where meta_key = "_company_name" and meta_value = "' . $posts[0]->post_title . '"');
            foreach ($all_company_name as $key => $company_name) {
                update_post_meta($company_name->post_id, $company_name->meta_key, $company_infos['company_name']);
            }
        }
        //MISE A JOUR
        $company = array(
            'ID'            => $posts[0]->ID,
            'post_title'    => $company_infos['company_name'],
            'post_content'  => $company_infos['company_description'],
            );
        $post_id = wp_update_post($company);
        
        //Ajout des taxonomies pour la company.
        if ( is_array( $company_infos['company_specialite'] ) ) {
            wp_set_post_terms( $post_id, $company_infos['company_specialite'], 'company_specialite', false );
        } else {
            wp_set_post_terms( $post_id, [ $company_infos['company_specialite'] ], 'company_specialite', false );
        }
        //Gestion du logo
        $wp_filetype = wp_check_filetype($company_infos['company_logo'], null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_parent'    => $post_id,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($company_infos['company_logo']) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attachment_id = wp_insert_attachment( $attachment, $company_infos['company_logo'], $post_id );
        if ( ! is_wp_error( $attachment_id ) ) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            if(has_post_thumbnail($post_id)){
                delete_post_thumbnail($post_id);
            }
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $company_infos['company_logo'] );
            wp_update_attachment_metadata( $attachment_id,  $attachment_data );
            set_post_thumbnail( $post_id, $attachment_id );
            update_user_meta( get_current_user_id(), '_company_logo', $attachment_id );
        }
        //Ajout des autres informations
        update_post_meta($post_id, '_company_facebook', $company_infos['company_facebook']);
        update_post_meta($post_id, '_company_email', $company_infos['company_email']);
        update_post_meta($post_id, '_company_phone', $company_infos['company_phone']);
        update_post_meta($post_id, '_company_location', $company_infos['company_location']);
        update_post_meta($post_id, '_company_website', $company_infos['company_website']);

        //Sauvegarde au niveau utilisateur car utilisé comme tel. (Save time for future)
        update_user_meta( get_current_user_id(), '_company_name', isset( $company_infos['company_name'] ) ? $company_infos['company_name'] : '' );
        update_user_meta( get_current_user_id(), '_company_website', isset( $company_infos['company_website'] ) ? $company_infos['company_website'] : '' );
    
        if($fileok) {
            update_post_meta($post_id, 'declaration_file', $movefile['url']);
            agiraa_send_notification_admin("Récépissé déposé par ". $company_infos['company_name'] . ".", DECLARATION_FILE_MSG);
        }
        //Message pour indiquer à l'utilisateur que les changements sont OK.
        wc_add_notice( __( 'Account details changed successfully.', 'woocommerce' ) );
        do_action( 'woocommerce_profil_details', $user_id );
        wp_safe_redirect( "/mon-compte/profil/" );
        exit;
    }
}


/*
 * Fonction permettant d'ajouter une condition pour accéder au bouton "Post a mission" dans le tableau de bord.
 */
add_action("agiraa_display_post_mission_button", "agiraa_control_display_post_mission_button");
function agiraa_control_display_post_mission_button($post_a_job_page_id) {
    $user_id = get_current_user_id();
    $posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company', 'post_status' => array('publish', 'pending')));

    $company_fill = checkCompanyFill($posts[0]);
    if(!$company_fill){ ?>
            <p> Pour poster une mission veuillez remplir les informations de votre association sur votre profil. </p>
    <?php } else if( $posts[0]->post_status === "pending") { ?>
        <p> Votre association est en attente de validation auprès des administrateurs.  </p>
    <?php } else { ?>
        <a href="<?php echo esc_url( get_permalink( $post_a_job_page_id ) ); ?>"><?php echo apply_filters( 'jobhunt_wpjm_job_dashboard_post_a_job_button_text', esc_html__( 'Post A Job', 'jobhunt' ) ); ?></a>
    <?php }
}

/*
 * Surcharge de la fonction pour récupéer les champs et leurs valeur.
 */
if ( ! function_exists( 'jobhunt_add_custom_job_company_fields' ) ) {
    function jobhunt_add_custom_job_company_fields() {
        $company_fields = jobhunt_submit_job_form_fields();
        $user_id = get_current_user_id();
        $posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company' ));
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
        } ?>
        <?php  foreach($company_fields as $key => $field) { ?>
        <fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
            <label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . esc_html__( '(optional)', 'jobhunt' ) . '</small>', $field ) ); ?></label>
            <div class="field <?php echo esc_attr( $field['required'] ? 'required-field' : '' ); ?>">
                <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
            </div>
        </fieldset>
    <?php }
    }
}