<?php
/**
 * Manage Certification
 * Ce fichier rassemble les fonctions permettant de gérer la certification.
 * Historique :
 * 18/10/2020 - BNORMAND - Création et rassemblement des fonctions. 
 * 
 * @package jobhunt-child
 */

 /*
  * Ajout du logo certifié sur la page des listes d'association
  */
if ( ! function_exists( 'jobhunt_template_company_title' ) ) {
    function jobhunt_template_company_title() {
        $post = get_post();
        $certified_label = empty(get_post_meta($post->ID, 'certified_label')) ? false : get_post_meta($post->ID, 'certified_label')[0];
        ?>
        <a class="company-name" href="<?php the_company_permalink(); ?>">
            <?php the_title();
            if($certified_label) { ?>
                <i class="lar la-check-circle"></i>
            <?php } ?>
        </a>
        <?php
    }
}

 /*
  * Ajout du logo certifié sur la page d'une association
  */
add_filter('jobhunt_company_name', 'add_certified_label');
function add_certified_label($name) {
    echo $name;
    $post = get_post();
    $certified_label = empty(get_post_meta($post->ID, 'certified_label')) ? false : get_post_meta($post->ID, 'certified_label')[0];
    if($certified_label) { ?>
        <i class="lar la-check-circle"></i>
    <?php }
}

/*
 * AJOUT DU LOGO PROFIL CERTIFIE DANS LES BONNES CONDITIONS
 */
if ( ! function_exists( 'jobhunt_template_job_listing_company_details' ) ) {
    function jobhunt_template_job_listing_company_details() {
        $job_id = get_the_ID();
        $company = '';
        if( $job_id ) {
            $post_title = get_post_meta( $job_id, '_company_name', true );
            if( ! empty( $post_title ) ) {
                $company = get_page_by_title( $post_title, OBJECT, 'company' );
            }
        }
        $certified_label = empty(get_post_meta($company->ID, 'certified_label')) ? false : get_post_meta($company->ID, 'certified_label')[0];
        ?><div class="job-listing-company company">
            <?php the_company_name( '<strong>', '</strong> ' );
            if($certified_label) {
            ?>
                <i class="lar la-check-circle"></i>
            <?php
            }
            the_company_tagline( '<span class="tagline">', '</span>' ); ?>
        </div><?php
    }
}

/*
 * Création d'une box supplémentaire rassemblant les informations pour gérer le certification
 */
add_action( 'add_meta_boxes', 'add_meta_boxes_company_certification' );
function add_meta_boxes_company_certification(){
    add_meta_box( 'certification', esc_html__( 'Certification', 'jobhunt-extensions' ),  'show_company_certification_data' , 'company', 'normal', 'high' );
}

/*
 * Création des champs de certification pour la nouvelle box 
 * - RNA Code
 * - Label certifié
 * - Fichier de déclaration
 */
function generate_company_certification_fields(){
    $default_field = array(
        'description'        => null,
        'priority'           => 10,
        'value'              => null,
        'default'            => null,
        'classes'            => array(),
        'show_in_admin'      => true,
        'show_in_rest'       => false,
        'auth_edit_callback' => array( WP_Job_Manager_Writepanels::class, 'auth_check_can_edit_job_listings' ),
        'auth_view_callback' => null,
        'sanitize_callback'  => array( WP_Job_Manager_Writepanels::class, 'sanitize_meta_field_based_on_input_type' ),
    );
    $fields = array(
        'rna_code' => array(
            'label' => "Code RNA",
            'placeholder' => "",
            'type' => "text",
            'data_type' => "string",
        ),
        'certified_label' => array(
            'label' => "Label certifié ?",
            'placeholder' => "",
            'type' => "checkbox",
            'data_type' => "boolean",
            'description' => "Une association certifié possède un signe distinctif."
        ),
        'declaration_file' => array(
            'label' => "Récépissé de déclaration",
            'placeholder' => 'Mettre en ligne le fichier',
            'description' => 'Ce fichier permet de valider que l\'association existe et que son code RNA correspond à celui rempli',
            'type' => 'file',
            'data_type' => 'string'
        )
        );
    foreach($fields as $key => $field) {
        $fields[$key] = array_merge($default_field, $field);
    }
    return $fields;
}

/*
 * Fonction permettant de gérer l'affichage des champs certification dans la partie admin.
 */ 
function show_company_certification_data($post) {
    global $post, $thepostid;
    include_once JOB_MANAGER_PLUGIN_DIR . "/includes/admin/class-wp-job-manager-writepanels.php";
    $wpjmwp = WP_Job_Manager_Writepanels::instance();
    $thepostid = $post->ID;

    $fields = generate_company_certification_fields();
    echo '<div class="wp_company_manager_meta_data wp_job_manager_meta_data">';

    wp_nonce_field( 'save_meta_data', 'company_manager_nonce' );

    do_action( 'company_manager_certification_start', $thepostid );
    foreach($fields as $key => $field){
        $type = ! empty( $field['type'] ) ? $field['type'] : 'text';
        if ( ! isset( $field['value'] ) && metadata_exists( 'post', $thepostid, $key ) ) {
            $field['value'] = get_post_meta( $thepostid, $key, true );
        }
        if ( ! isset( $field['value'] ) && isset( $field['default'] ) ) {
            $field['value'] = $field['default'];
        }
        if( has_action( 'company_manager_input_' . $type ) ) {
            do_action( 'company_manager_input_' . $type, $key, $field );
        } elseif( method_exists( $wpjmwp, 'input_' . $type ) ) {
            call_user_func( array( $wpjmwp, 'input_' . $type ), $key, $field );
        }
    }
    do_action( 'company_manager_certification_end', $thepostid );

    echo '</div>';
}

/*
 * Gestion de l'enregistrement des modification des champs de certification
 */
add_action( 'company_manager_save_company', 'save_company_certification_data' , 10, 2 );
function save_company_certification_data($post_id, $post) {
    $fields = generate_company_certification_fields();
    foreach($fields as $key => $field){
        $type = ! empty( $field['type'] ) ? $field['type'] : '';
        if($type === 'checkbox') {
            if ( isset( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, 1 );
            } else {
                update_post_meta( $post_id, $key, 0 );
            }
        } else {
            if ( is_array( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, array_filter( array_map( 'sanitize_text_field', $_POST[ $key ] ) ) );
            } else {
                update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
            }
        }
    }
}