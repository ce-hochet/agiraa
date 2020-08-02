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
 * 31/07/2020
 * BNORMAND
 * EDITION DU CHAMPS RNA USER PROFILE 
 * */
add_action( 'show_user_profile', 'show_extra_profile_fields' );
add_action( 'edit_user_profile', 'show_extra_profile_fields' );

function show_extra_profile_fields( $user ) {
    if($user->roles[0] === "employer"){
        $rna = empty(get_user_meta( $user->ID, 'rna')) ? "" : get_user_meta( $user->ID, 'rna')[0];
        $declaration = empty(get_user_meta($user->ID, 'declaration_file_path')) ? "" : get_user_meta($user->ID, 'declaration_file_path')[0];
        ?>
        <h3><?php esc_html_e( 'Association Information', 'jobhunt' ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="rna"><?php esc_html_e( 'RNA Code', 'jobhunt' ); ?></label></th>
                <td>
                    <input type="text"
                    disabled
                    minlength="10" 
                    maxlength="10"
                    id="rna"
                    name="rna"
                    value="<?php echo $rna; ?>"
                    class="regular-text"
                    />
                </td>
            </tr>
            <tr>
                <th><label for="rna"><?php esc_html_e( 'Declaration', 'jobhunt' ); ?></label></th>
                <td>
                    <br><span>
                    <?php if($declaration !== "") {?> 
                        <a style="color: #b4c408;" target="_blank" href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . $declaration; ?>"> Consulter la déclaration enregistrée. </a></span><br>
                    <?php } else { ?>
                        <p style="color: #DF3F52;"> Aucune déclaration n'a été mise en ligne par l'association.</p>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?php
    }
}

/* 
 * 01/08/2020
 * BNORMAND
 * EDITION DU CHAMPS RNA USER PROFILE 
 * */
add_action( 'woocommerce_save_account_details', 'save_declaration_file_account_details', 12, 1 );
function save_declaration_file_account_details( $user_id ) {
    $declaration_file = $_FILES['declaration_file'];
    $target_file =  "/wp-content/uploads/declaration_file/" . $user_id . "_declaration_file.pdf";
    $target_full_path = $_SERVER['DOCUMENT_ROOT'] . $target_file;
    if(isset($declaration_file) && $declaration_file["type"] === "application/pdf"){
        empty(get_user_meta($user_id, 'declaration_file_path')) ? "" : delete_user_meta($user_id, 'declaration_file_path');
        if(file_exists($target_full_path)) {
            unlink($target_full_path);
        }

        if (move_uploaded_file($declaration_file["tmp_name"], $target_full_path)) {
            add_user_meta($user_id, 'declaration_file_path', $target_file);
        } else {
            jobhunt_form_errors()->add('error', esc_html__('Error while uploading file. Please try again.', 'jobhunt'));
        }
    } else {
        jobhunt_form_errors()->add('rna_empty', esc_html__('Declaration file must be a PDF file.', 'jobhunt'));
    }
}