<?php
/**
 * Jobhunt Child
 *
 * @package jobhunt-child
 */

/**
 * Include all your custom code here
 */

/**** LANGUAGE DU THEME ENFANT ***/
// prise en compte du dossier de traduction du theme enfant à la place du parent
function my_child_theme_setup() {
 load_child_theme_textdomain( 'jobhunt', get_stylesheet_directory() . '/languages' ); // languages étant le chemin du dossier dans lequel se trouvent vos fichiers .po et .mo
}
add_action( 'after_setup_theme', 'my_child_theme_setup' );



/***** MODIFICATION DU FILTRE $catalog_orderby_options ***/
 if ( ! function_exists( 'jobhunt_no_jobs_found_info' ) ) {
     function jobhunt_no_jobs_found_info() {
         ?><p class="jobhunt-info no-jobs-found"><?php echo apply_filters( 'jobhunt_no_jobs_found_info', esc_html__( 'Aucune mission ne correspond à votre sélection', 'jobhunt' ) ); ?></p><?php
     }
 }

 if ( ! function_exists( 'jobhunt_wpjm_job_catalog_ordering' ) ) {
     function jobhunt_wpjm_job_catalog_ordering() {
         if ( ! jh_wpjm_get_loop_prop( 'is_paginated' ) || 0 >= jh_wpjm_get_loop_prop( 'total', 0 ) ) {
             return;
         }

         $catalog_orderby_options = apply_filters( 'jobhunt_jobs_catalog_orderby', array(
           'date'       => esc_html__( 'New Jobs', 'jobhunt' ),
        //   'featured'   => esc_html__( 'Featured', 'jobhunt' ),
        //   'menu_order' => esc_html__( 'Menu Order', 'jobhunt' ),
           'title-asc'  => esc_html__( 'Name: Ascending', 'jobhunt' ),
           'title-desc' => esc_html__( 'Name: Descending', 'jobhunt' ),
         ) );

         $default_orderby = jh_wpjm_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'jh_job_listing_default_catalog_orderby', 'date' );
         $orderby         = isset( $_GET['orderby'] ) ? jobhunt_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

         if ( jh_wpjm_get_loop_prop( 'is_search' ) ) {
             $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'jobhunt' ) ), $catalog_orderby_options );

             unset( $catalog_orderby_options['menu_order'] );
         }

         if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
             $orderby = current( array_keys( $catalog_orderby_options ) );
         }

         ?>
         <label><?php echo apply_filters( 'jobhunt_jobs_catalog_orderby_label', esc_html__( 'Trier par' , 'jobhunt' ) ); ?></label>
         <form method="get">
             <select name="orderby" class="orderby" onchange="this.form.submit();">
                 <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                     <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                 <?php endforeach; ?>
             </select>
             <input type="hidden" name="paged" value="1" />
         </form>
         <?php
     }
 }


if ( ! function_exists( 'jobhunt_job_header_search_block' ) ) {
    /**
     * Display Job Header Search block
     */
    function jobhunt_job_header_search_block( $args = array() ) {

        $defaults =  apply_filters( 'jobhunt_job_header_search_block_args', array(
            'section_title'             => esc_html__( 'Explore Thousand Of Jobs With Just Simple Search...', 'jobhunt' ),
            'sub_title'                 => '',
            'search_placeholder_text'   => esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
            'location_placeholder_text' => esc_html__( 'City, province or region', 'jobhunt' ),
            'category_select_text'      => esc_html__( 'Choisissez une catégorie', 'jobhunt' ),
            'show_category_select'      => false,
            'search_button_icon'        => 'la la-search',
            'search_button_text'        => esc_html__( 'Rechercher', 'jobhunt' ),
            'show_browse_button'        => false,
            'browse_button_label'       => esc_html__( 'Or browse job offers by', 'jobhunt' ),
            'browse_button_text'        => esc_html__( 'Category', 'jobhunt' ),
            'browse_button_link'        => '#'
        ) );

        $args = wp_parse_args( $args, $defaults );

        extract( $args );

        $jobs_page_id = jh_wpjm_get_page_id( 'jobs' );
        $jobs_page_url = get_permalink( $jobs_page_id );

        ?><div class="job-search-block">

            <?php do_action( 'jobhunt_job_header_search_block_before' ); ?>

            <?php if ( ! empty( $section_title ) || ! empty( $sub_title ) ) : ?>
            <div class="section-header">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="section-sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="job-search-form">
                <form method="GET" action="<?php echo esc_url( $jobs_page_url ); ?>">
                  <div class="job-search-category">
                      <label class="sr-only" for="search_category"><?php echo esc_html__( 'Category', 'jobhunt' ); ?></label>
                      <select id="search_category" name="search_category">
                          <option value=""><?php echo esc_html( $category_select_text ); ?></option>
                          <?php foreach ( get_job_listing_categories() as $cat ) : ?>
                          <option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                    <?php if ( jobhunt_is_astoundify_job_manager_regions_activated() && get_option( 'job_manager_regions_filter' ) ) : ?>
                        <div class="job-search-location region-location">
                            <label class="sr-only" for="filter_job_listing_region"><?php echo esc_html__( 'Region', 'jobhunt' ); ?></label>
                            <?php wp_dropdown_categories( array('taxonomy' => 'job_listing_region', 'show_option_all' => ' Select Region','hierarchical' => 1, 'name' => 'filter_job_listing_region','id' => 'search_category','class' => 'jobhunt-job-region-select','value_field' => 'name','orderby' => 'name' ) ); ?>
                        </div>
                    <?php else : ?>
                        <div class="job-search-location">
                            <label class="sr-only" for="search_location"><?php echo esc_html__( 'Location', 'jobhunt' ); ?></label>
                            <input type="text" id="search_location" name="search_location" placeholder="<?php echo esc_attr( $location_placeholder_text ); ?>"/>
                        </div>
                    <?php endif; ?>

                    <div class="job-search-submit">
                        <button type="submit" value="<?php echo esc_attr( $search_button_text ); ?>"><i class="<?php echo esc_attr( $search_button_icon ); ?>"></i><span class="job-search-text"><?php echo esc_html( $search_button_text ); ?></span></button>
                    </div>
                    <input type="hidden" name="post_type" value="job_listing"/>
                </form>
                <?php if ( $show_browse_button ) : ?>
                    <div class="browse-jobs-by-category">
                        <span><?php echo esc_html( $browse_button_label ); ?></span>
                        <a href="<?php echo esc_url( $browse_button_link ); ?>" title="<?php echo esc_attr( $browse_button_text ); ?>"><?php echo esc_html( $browse_button_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <?php do_action( 'jobhunt_job_header_search_block_after' ); ?>

        </div><?php
    }
}

/**** Ajout du titre h3 : Description de la mission, sur la page singe mission ***/
if ( ! function_exists( 'jobhunt_single_job_listing_description' ) ) {
    function jobhunt_single_job_listing_description() {
        ?><div class="single-job-listing__description job-description">
          <h3><?php esc_html_e('Desciption de la mission' ); ?> </h3>
            <?php wpjm_the_job_description(); ?>
        </div><?php
    }
}

function wpse_58916_user_roles_by_id( $id )
{
    $user = new WP_User( $id );

    if ( empty ( $user->roles ) or ! is_array( $user->roles ) )
        return array ();

    $wp_roles = new WP_Roles;
    $names    = $wp_roles->get_names();
    $out      = array ();

    foreach ( $user->roles as $role )
    {
        if ( isset ( $names[ $role ] ) )
            $out[ $role ] = $names[ $role ];
    }

    return $out;
}

// WOOCOMMERCE - MON COMPTE - NAVIGATION
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){

	unset( $menu_links['edit-address'] ); // Addresses
  unset( $menu_links['payment-methods'] ); // Remove Payment Methods
 	unset( $menu_links['orders'] ); // Remove Orders
 	unset( $menu_links['downloads'] ); // Disable Downloads
  unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link

	return $menu_links;

}
/* RENOMMER LES LIENS DU MENU */
add_filter ( 'woocommerce_account_menu_items', 'misha_rename_downloads' );
function misha_rename_downloads( $menu_links ){

	// $menu_links['TAB ID HERE'] = 'NEW TAB NAME HERE';
	$menu_links['edit-account'] = 'Paramètres du compte';

	return $menu_links;
}

/* Ajouter des liens du menu Mon compte avec des URL personnalisées*/
add_filter ( 'woocommerce_account_menu_items', 'misha_one_more_link' );
function misha_one_more_link( $menu_links ){

	// we will hook "anyuniquetext123" later
  if ( current_user_can('employer') || current_user_can('administrator') ){
	$new = array( 'tableau-de-bord-des-postes' => 'Mes missions' ); // tableau-de-bord-des-postes ==> correspond à la page de gestion des missions associations

	// or in case you need 2 links
	// $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );

	// array_slice() is good when you want to add an element between the other ones
	$menu_links = $new + array_slice( $menu_links, 0, 1, true )	+ array_slice( $menu_links, 1, NULL, true );
}

  if ( current_user_can('candidate') || current_user_can('administrator') ){
$new = array( 'tableau-de-bord-citoyen' => 'Mon profil' ); // tableau-de-bord-des-postes ==> correspond à la page de gestion des missions associations

// or in case you need 2 links
// $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );

// array_slice() is good when you want to add an element between the other ones
$menu_links = $new +array_slice( $menu_links, 0, 1, true )	+  array_slice( $menu_links, 1, NULL, true );
}

	return $menu_links;

}

/*** INFORMATION COMPANY ***/

if ( ! function_exists( 'jobhunt_submit_job_form_fields' ) ) {
    function jobhunt_submit_job_form_fields() {
        $fields = array(
            'company_description' => array(
                'label'       => esc_html__( 'Description', 'jobhunt' ),
                'type'        => 'wp-editor',
                'required'    => true,
                'priority'    => 5,
            ),
            /*  'company_team_size' => array(
                'label'       => esc_html__( 'Team size', 'jobhunt' ),
                'type'        => 'term-select',
                'required'    => false,
                'placeholder' => esc_html__( 'Choose Team Size&hellip;', 'jobhunt' ),
                'priority'    => 5,
                'default'     => '',
                'taxonomy'    => 'company_team_size',
            ),*/
            'company_specialite' => array(
                'label'       => esc_html__( 'Spécialité', 'jobhunt' ),
                'type'        => 'term-multiselect',
                'required'    => true,
                'placeholder' => '',
                'priority'    => 5,
                'default'     => '',
                'taxonomy'    => 'company_specialite',
            ),
            'company_location' => array(
                'label'       => esc_html__( 'Localisation', 'jobhunt' ),
              //  'description' => esc_html__( 'Leave this blank if the location is not important', 'jobhunt' ),
                'type'        => 'text',
                'required'    => true,
                'placeholder' => esc_html__( 'Entrer la ville ou l\'adresse', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_email' => array(
                'label'       => esc_html__( 'Email', 'jobhunt' ),
                'type'        => 'text',
                'required'    => true,
              //  'placeholder' => esc_html__( 'you@yourdomain.com', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_phone' => array(
                'label'       => esc_html__( 'Téléphone', 'jobhunt' ),
                'type'        => 'text',
                'required'    => true,
              //  'placeholder' => esc_html__( 'Phone Number', 'jobhunt' ),
                'priority'    => 5,
            ),
            'company_facebook' => array(
                'label'       => esc_html__( 'Facebook', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'URL Facebook', 'jobhunt' ),
                'priority'    => 5,
            ),
        /*    'company_googleplus' => array(
                'label'       => esc_html__( 'Google+', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'Google+ url', 'jobhunt' ),
                'priority'    => 5,
            ),*/
        /*    'company_linkedin' => array(
                'label'       => esc_html__( 'LinkedIn', 'jobhunt' ),
                'type'        => 'text',
                'required'    => false,
                'placeholder' => esc_html__( 'LinkedIn url', 'jobhunt' ),
                'priority'    => 5,
            ),*/
          /*  'company_since' => array(
                'label'       => esc_html__( 'Date de création', 'jobhunt' ),
                'type'        => 'date',
                'required'    => false,
                'placeholder' => esc_html__( 'Insérer la date approximative de la création de votre association', 'jobhunt' ),
                'priority'    => 6,
            )*/
        );

        return apply_filters( 'jobhunt_submit_job_form_company_fields' , $fields );
    }
}

if ( ! function_exists( 'jobhunt_submit_company_form_required_fields' ) ) {
    function jobhunt_submit_company_form_required_fields() {
        $required_fields = array(
            'post_fields'  => array( 'company_name', 'company_logo', 'company_description' ),
            'tax_fields'   => array( 'company_specialite' ),
            'meta_fields'  => array( 'company_website', 'company_tagline', 'company_video', 'company_twitter', 'company_location', 'company_email', 'company_phone', 'company_facebook', 'company_googleplus', 'company_linkedin' )
        );

        return apply_filters( 'jobhunt_submit_company_form_required_fields' , $required_fields );
    }
}


/**
 * Output the company_specialite
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_specialite' ) ) {
    function the_company_specialite( $post = null ) {
        $specialite = get_the_company_specialite( $post );
        if ( $specialite ) {
            $names = wp_list_pluck( $specialite, 'name' );

            echo esc_html( implode( ', ', $names ) );
        }
    }
}

/**
 * Get the company_specialite
 * @param WP_Post|int $post (default: null)
 * @return  string
 */
if ( ! function_exists( 'get_the_company_specialite' ) ) {
    function get_the_company_specialite( $post = null ) {
        global $post;
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return '';

        $specialite = wp_get_object_terms( $post->ID, 'company_specialite');

        if ( is_wp_error( $specialite ) ) {
            return '';
        }

        return apply_filters( 'the_company_specialite', $specialite, $post );
    }
}

if ( ! function_exists( 'jobhunt_company_specialite' ) ) {
    function jobhunt_company_specialite() {
        if( ! empty(get_the_company_specialite())) :  ?>
        <div class="single-company-specialite">
            <i class="la la-paw"></i>
            <div class="single-company-specialite-inner">
                <label><?php echo apply_filters( 'jobhunt_company_specialite_label', esc_html__( 'Spécialité', 'jobhunt' ) ); ?></label>
                <div class="company-specialite value"><?php the_company_specialite();?></div>
            </div>
        </div>
        <?php endif;
    }
}
add_action( 'wp_head', 'remove_my_action' );
function remove_my_action() {
    remove_action( 'jobhunt_get_company_overview', 'jobhunt_company_since' ,40);
}

add_action( 'jobhunt_get_company_overview', 'jobhunt_company_specialite', 50 );

if ( ! function_exists( 'jobhunt_candidate_experience' ) ) {
    function jobhunt_candidate_experience() {
        global $post;
        if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
            <div id="candidate-experience" class="candidate-experience">
                <h2><?php esc_html_e( 'Work & Experience', 'jobhunt' ); ?></h2>
                <dl class="resume-manager-experience">
                <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                            <div class="timeline-title"><?php printf( '%s %s', '<strong class="job_title">' . esc_html( $item['job_title'] ) . '</strong>', '<span class="employer">' . esc_html( $item['employer'] ) . '</span>' ); ?></div>
                            <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                ?>
                </dl>
            </div>
        <?php endif;
    }
}


/**
 * Remove the preview step when submitting resumes. Code goes in theme functions.php or custom plugin.
 * @param  array $steps
 * @return array
 */

add_filter( 'submit_resume_steps', function( $steps ) {
	unset( $steps['preview'] );
	return $steps;
} );

/**
 * Change button text.
 */
add_filter( 'submit_resume_form_submit_button_text', function() {
	return __( 'Submit Resume', 'wp-job-manager-resumes' );
} );

/**
 * Since we removed the preview step and it's handler, we need to manually publish resumes.
 * @param  int $resume_id
 */
add_action( 'resume_manager_update_resume_data', function( $resume_id ) {
	$resume = get_post( $resume_id );
	if ( in_array( $resume->post_status, array( 'preview', 'expired' ), true ) ) {
		// Reset expirey.
		delete_post_meta( $resume->ID, '_resume_expires' );

		// Update resume listing.
		$update_resume                  = array();
		$update_resume['ID']            = $resume->ID;
		$update_resume['post_status']   = get_option( 'resume_manager_submission_requires_approval' ) ? 'pending' : 'publish';
		$update_resume['post_date']     = current_time( 'mysql' );
		$update_resume['post_date_gmt'] = current_time( 'mysql', 1 );
		wp_update_post( $update_resume );
	}
} );


/*
 * 27/07/2020
 * BNORMAND
 * AJOUT SCRIPT JS CHILD EXTERNE
 * */
add_action( 'wp_enqueue_scripts', 'enqueue_mon_script' );
function enqueue_mon_script() {
    wp_enqueue_script( 'script-perso', get_stylesheet_directory_uri() . '/custom-js/jobhunt-child.js', array( 'jquery' ) );
}

require_once get_stylesheet_directory() . '/inc/functions/my-account.php';

/*
 * 06/08/2020
 * BNORMAND
 * AJOUT DU LOGO PROFIL CERTIFIE DANS LES BONNES CONDITIONS
 * */
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
 * 07/08/2020
 * BNORMAND
 * Retrait du caractère obligatoire des champs "First Name" & "Last Name" pour les employeurs.
 * */
add_filter( 'woocommerce_save_account_details_required_fields','remove_names_fields_for_employers' );
function remove_names_fields_for_employers( $required_fields ) {
    $user = wp_get_current_user();
    if($user->roles[0] === "employer"){
        unset($required_fields["account_first_name"]);
        unset($required_fields["account_last_name"]);
    }
    return $required_fields;
}


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
}, 99, 1 );

add_action( 'init', function() {
    add_rewrite_endpoint( 'profil', EP_ROOT | EP_PAGES );
} );

/*
 * 16/08/2020
 * BNORMAND
 * Solution temporaire afin de pouvoir avoir le CSS du champs multiselect dans le bon ordres. Celui-ci devant être déclaré avant le autres.
 * */
add_action('wp_head', function() {
    echo '<link rel="stylesheet" href="'. JOB_MANAGER_PLUGIN_URL . '/assets/css/chosen.css" type="text/css" media="all">';
    return;
}, 1);

add_action( 'woocommerce_account_profil_endpoint', function() {
    wp_register_script( 'chosen', JOB_MANAGER_PLUGIN_URL . '/assets/js/jquery-chosen/chosen.jquery.min.js', [ 'jquery' ], '1.1.0', true , 0);
    wp_enqueue_script('remove-file-js', JOB_MANAGER_PLUGIN_URL . '/assets/js/job-submission.min.js');
    wc_get_template_part('myaccount/profil');
});



/*
 * 16/08/2020
 * BNORMAND
 * Mise en place de la fonction appelé lors de la validation du formulaire du profil publique. .
 * */
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
        //Vérification de l'existence d'une company.
        $posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company' ));
        $posts_id;
        if(empty($posts)){
            //CREATION de la company (Post WP).
            $company = array(
                'post_title'    => $company_infos['company_name'],
                'post_content'  => $company_infos['company_description'],
                'post_author'   => $user_id,
                'post_type'     => 'company'
                );
            $post_id = wp_insert_post($company);
        } else {
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
        }
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

        update_post_meta($post_id, 'declaration_file', $movefile['url']);
        //Message pour indiquer à l'utilisateur que les changements sont OK.
        wc_add_notice( __( 'Account details changed successfully.', 'woocommerce' ) );
        do_action( 'woocommerce_profil_details', $user_id );
        wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
}

/*
 * 10/09/2020
 * CEHOCHET
 * TRADUCTION REGISTER ET LOGIN
 * */

if ( ! function_exists( 'jobhunt_register_login_form' ) ) {
    function jobhunt_register_login_form() {

        $output = '';

        if( ! is_user_logged_in() ) {
            ob_start();
            ?>
            <div class="jobhunt-register-login-form">
                <div class="jobhunt-register-login-form-inner">
                    <ul class="nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="jh-register-tab" data-toggle="pill" href="#jh-register-tab-content" role="tab" aria-controls="jh-register-tab-content" aria-selected="false"><?php echo apply_filters( 'jobhunt_register_form_tab_title', esc_html__( 'S\'inscrire', 'jobhunt-extensions') ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="jh-login-tab" data-toggle="pill" href="#jh-login-tab-content" role="tab" aria-controls="jh-login-tab-content" aria-selected="true"><?php echo apply_filters( 'jobhunt_login_form_tab_title', esc_html__( 'Se connecter', 'jobhunt-extensions') ); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="jh-register-tab-content" role="tabpanel" aria-labelledby="jh-register-tab"><?php echo jobhunt_registration_form(); ?></div>
                        <div class="tab-pane fade show active" id="jh-login-tab-content" role="tabpanel" aria-labelledby="jh-login-tab"><?php echo jobhunt_login_form(); ?></div>
                    </div>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
        } elseif( function_exists( 'jobhunt_wpjm_wc_account_dashboard' ) ) {
            ob_start();
            jobhunt_wpjm_wc_account_dashboard();
            $output = ob_get_clean();
        }

        return $output;
    }
}

if ( ! function_exists ( 'jh_child_custom_header_register_page_url' ) ) {
    function jh_child_custom_header_register_page_url( $url ) {
        $custom_userpage = jobhunt_get_register_login_form_page();

        if( !empty( $custom_userpage ) ) {
            $url = get_permalink( $custom_userpage ) . '#jh-register-tab-content';
        }

        return $url;
    }
}
add_filter( 'jobhunt_header_register_page_url', 'jh_child_custom_header_register_page_url' );

/*
 * 10/09/2020
 * CEHOCHET
 * EXIGENCE MOT DE PASSE
 * */

/**
 * Change the strength requirement on the woocommerce password
 *
 * Strength Settings
 * 4 = Strong
 * 3 = Medium (default)
 * 2 = Also Weak but a little stronger
 * 1 = Password should be at least Weak
 * 0 = Very Weak / Anything
 */
 add_filter( 'woocommerce_get_script_data', 'misha_strength_meter_settings', 20, 2 );

 function misha_strength_meter_settings( $params, $handle  ) {

 	if( $handle === 'wc-password-strength-meter' ) {
 		$params = array_merge( $params, array(
 			'min_password_strength' => 2,
 			'i18n_password_error' => 'Ne veux-tu pas être protégé(e) ? Insère un mot de passe plus fort !',
 			'i18n_password_hint' => 'Pour la sécurité de votre compte, veuillez définir votre mot de passe avec <strong>au moins 7 caractères </strong> et utilisez un mélange de lettres <strong>MAJUSCULE</strong> et <strong>minuscule</strong>, <strong>de nombres </strong>, et <strong> de symboles : </strong> (e.g., <strong> ! " ? $ % ^ & </strong>).'
 		) );
 	}
 	return $params;

}

/*
 * 10/09/2020
 * BNORMAND
 * Modification du formulaire de login lors de l'appel à la page de login woocommerce. 
 * */
add_action('woocommerce_before_customer_login_form', 'redirect_jobhunt_login_form');

function redirect_jobhunt_login_form(){
    echo do_shortcode( '[jobhunt_register_login_form]' );
    exit();
}


add_action( 'add_meta_boxes', 'add_meta_boxes_company_certification' );

function add_meta_boxes_company_certification(){
    add_meta_box( 'certification', esc_html__( 'Certification', 'jobhunt-extensions' ),  'show_company_certification_data' , 'company', 'normal', 'high' );
}

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

if ( ! function_exists( 'jobhunt_add_custom_job_company_fields' ) ) {
    function jobhunt_add_custom_job_company_fields() {
        $company_fields = jobhunt_submit_job_form_fields();


        $user_id = get_current_user_id();
        $posts = get_posts(array( 'author' => $user_id, 'post_type' => 'company' ));
        if(!empty($posts)){
            $post_id = $posts[0]->ID;
            foreach($company_fields as $key => $field) {
                $company_fields[$key]['disabled'] = true;
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