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

/*
* 10/09/2020
* CEHOCHET
* TRADUCTION REGISTER ET LOGIN
* */

if ( ! function_exists( 'jobhunt_register_login_form' ) ) {
  function jobhunt_register_login_form() {

    $output = '';

    if( ! is_user_logged_in() ) {
      if(isset($_COOKIE["account_removed"]) && !empty($_COOKIE["account_removed"])) {
        wc_add_notice(__( 'Votre compte a bien été supprimé définitivement.', 'agiraa' ), 'success');
        unset($_COOKIE['account_removed']);
      }
      wc_print_notices();
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

/*
* 09/10/2020
* CEHOCHET
* Fonction pour modifier l'adresse email de l'expéditeur
* */
function wpm_email_from( $original_email_address ) {

  return 'contact@agiraa-benevolat.fr';

}
add_filter( 'wp_mail_from', 'wpm_email_from' );

// Fonction pour changer le nom de l'expéditeur de l'email
function wpm_expediteur( $original_email_from ) {

  return 'AGIRAA';

}
add_filter( 'wp_mail_from_name', 'wpm_expediteur' );

// Appel des fonction permettant de gérer la page profil pour les association
require_once( __DIR__ . '/includes/manage_association_profil.php');

// Appel des fonction permettant la gestion de la certification
require_once( __DIR__ . '/includes/manage_certification.php');


/*
* 09/10/2020
* CEHOCHET
* Supprimer tous les post du users lors de la suppression de l'utilisateur
* */
add_action('delete_user', 'my_delete_user');

function my_delete_user($user_id) {
  $args = array (
    'numberposts' => -1,
    'post_type' => 'any',
    'author' => $user_id
  );
  // get all posts by this user: posts, pages, attachments, etc..
  $user_posts = get_posts($args);

  if (empty($user_posts)) return;

  // delete all the user posts
  foreach ($user_posts as $user_post) {
    wp_delete_post($user_post->ID, true);
  }
}


add_action( 'template_redirect', 'redirect_after_remove', 5 );
// DELETE USER + SEND EMAIL
function redirect_after_remove() {
  $nonce_value = wc_get_var( $_REQUEST['remove-account-details-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.
  if ( ! wp_verify_nonce( $nonce_value, 'remove_account_details' ) ) {
    return;
  }
  if ( empty( $_POST['action'] ) || 'remove_account_details' !== $_POST['action'] ) {
    return;
  }
  wc_nocache_headers();
  $current_user = wp_get_current_user();
  require_once( ABSPATH.'wp-admin/includes/user.php' );
  wp_delete_user( $current_user->ID );
  setcookie("account_removed", "1", time()+45, "/");
  wp_safe_redirect( "/inscription-connexion");
  exit();
}  


function remove_html5_required_wp_editor($maybe_required, $field) {
  //On WP_EDITOR deactivate HTML5_required
  return false;
}

add_filter('field_editor_wp_editor_html5_required', 'remove_html5_required_wp_editor', 10, 2);