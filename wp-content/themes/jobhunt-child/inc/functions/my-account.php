<?php
/*
* 28/07/2020
* BNORMAND
* Modification du formulaire d'inscription, Ajout du RNA si ASSO & verif du RNA.
* */


if ( ! function_exists( 'jobhunt_registration_form_fields' ) ) {


  function jobhunt_registration_form_fields() {

    ob_start();
    ?>
    <div class="entry-header">
      <h3 class="headline"><?php echo apply_filters( 'jobhunt_register_form_header_title', esc_html__( 'Register','jobhunt' ) ); ?></h3>
    </div>

    <?php
    // show any error messages after form submission
    jobhunt_show_error_messages();

    // show any success messages after form submission
    jobhunt_show_success_messages();



      do_action( 'jobhunt_registration_form_before' ); 
      ?>

      <form id="jobhunt_registration_form" class="jobhunt_registration_form" action="#" method="POST">
      <p class="status"></p>
      <fieldset>
      <?php do_action( 'jobhunt_registration_form_fields_before' ); ?>
      <?php if( apply_filters( 'jobhunt_register_user_login_enabled', true ) ) : ?>
      <p>
      <label for="jobhunt_register_user_login"><?php esc_html_e( 'Username', 'jobhunt' ); ?>
      <input name="jobhunt_user_login" id="jobhunt_register_user_login" class="required" type="text"/>
      </label>
      </p>
      <?php endif; ?>
      <p>
      <label for="jobhunt_register_user_email"><?php esc_html_e( 'Email', 'jobhunt' ); ?>
      <input name="jobhunt_user_email" id="jobhunt_register_user_email" class="required" type="email"/>
      </label>
      </p>
      <p class="hidden">
      <label for="confirm_email"><?php echo esc_html__( 'Please leave this field empty', 'jobhunt' ); ?></label>
      <input type="text" name="confirm_email" id="confirm_email" class="input" value="">
      </p>

      <?php if( apply_filters( 'jobhunt_register_user_password_enabled', false ) ) : ?>
      <p>
      <label for="jobhunt_register_user_password"><?php esc_html_e( 'Password', 'jobhunt' ); ?>
      <input name="jobhunt_user_pass" id="jobhunt_register_user_password" minlength="8" required class="required" type="password"/>
      </label>
      </p>
      <?php endif; ?>
      <?php if( apply_filters( 'jobhunt_register_user_role_enabled', true ) && jobhunt_is_wp_job_manager_activated() ) : ?>
      <p>
      <label for="jobhunt_register_user_role"><?php echo esc_html__( 'I want to register as', 'jobhunt' ); ?></label>
      <select name="jobhunt_user_role" id="jobhunt_register_user_role" class="input chosen-select">
      <option value="candidate"><?php echo esc_html__( 'Candidate', 'jobhunt' ); ?></option>
      <option value="employer"><?php echo esc_html__( 'Employer', 'jobhunt' ); ?></option>
      </select>
      </p>
      <?php endif; ?>
      <p id="jobhunt_register_user_rna_block">
      <label for="jobhunt_register_user_rna"><?php echo esc_html__('Code RNA', 'jobhunt'); ?>
      <input name="jobhunt_user_rna" id="jobhunt_register_user_rna" minlength="10" maxlength="10" required class="required" type="text"/>
      </label>
      <span id="jobhunt_register_user_rna_error">
      </span>
      </p>
      <p id="jobhunt_register_user_cgu_block">
      <label for="jobhunt_register_user_cgu"> J’ai lu et j’accepte les conditions d'utilisation (<a href="http://dev.agiraa-benevolat.fr/cgu/">voir</a>)
        <input type="checkbox" name="jobhunt_user_cgu" id="jobhunt_register_user_cgu_block" minlength="10" maxlength="10" required class="required">
        <span id="jobhunt_register_user_cgu_error">          </span>
        </label>
        </p>
        <?php do_action( 'jobhunt_registration_form_fields_after' ); ?>
        <p>
        <input type="hidden" name="jobhunt_register_nonce" value="<?php echo wp_create_nonce('jobhunt-register-nonce'); ?>"/>
        <input type="hidden" name="jobhunt_register_check" value="1"/>
        <?php  wp_nonce_field( 'ajax-register-nonce', 'register-security' );  ?>
        <input id="register_b" type="submit" value="<?php echo esc_attr__( 'Register', 'jobhunt' ); ?>"/>
        </p>
        </fieldset>
        </form>

        <?php do_action( 'jobhunt_registration_form_after' );

        return ob_get_clean();
      }
    }

    if ( ! function_exists( 'jobhunt_login_form_fields' ) ) {
      function jobhunt_login_form_fields() {

        ob_start();
        ?>
        <div class="entry-header">
        <h3 class="headline"><?php echo apply_filters( 'jobhunt_login_form_header_title', esc_html__( 'Login', 'jobhunt') ); ?></h3>
        </div>

        <?php
        // show any error messages after form submission
        jobhunt_show_error_messages();

        // show any success messages after form submission
        jobhunt_show_success_messages();

        do_action( 'jobhunt_login_form_before' ); ?>

        <form id="jobhunt_login_form"  class="jobhunt_login_form" action="#" method="post">
        <p class="status"></p>
        <fieldset>
        <p>
        <label for="jobhunt_user_login"><?php echo esc_html__( 'Username or email address', 'jobhunt' ); ?>
        <input name="jobhunt_user_login" id="jobhunt_user_login" class="required" type="text"/>
        </label>
        </p>
        <p>
        <label for="jobhunt_user_pass"><?php echo esc_html__( 'Password', 'jobhunt' ); ?>
        <input name="jobhunt_user_pass" id="jobhunt_user_pass" class="required" type="password"/>
        </label>
        </p>
        <p>
        <input type="hidden" id="jobhunt_login_nonce" name="jobhunt_login_nonce" value="<?php echo wp_create_nonce('jobhunt-login-nonce'); ?>"/>
        <input type="hidden" name="jobhunt_login_check" value="1"/>
        <?php  wp_nonce_field( 'ajax-login-nonce', 'login-security' );  ?>
        <input id="jobhunt_login_submit" type="submit" value="<?php echo esc_attr__( 'Login','jobhunt' ); ?>"/>
        </p>
        <p><a href="<?php echo esc_url( wp_lostpassword_url( home_url( '/' ) ) ); ?>" title="<?php echo esc_attr__( 'Lost Password?', 'jobhunt' ); ?>"><?php echo esc_html__( 'Lost Password?', 'jobhunt' ); ?></a></p>
        </fieldset>
        </form>

        <?php do_action( 'jobhunt_login_form_after' );

        return ob_get_clean();
      }
    }

    // register a new user
    if ( ! function_exists( 'jobhunt_add_new_member' ) ) {
      function jobhunt_add_new_member() {
        if ( isset( $_POST["jobhunt_register_check"] ) && wp_verify_nonce( $_POST['jobhunt_register_nonce'], 'jobhunt-register-nonce' ) ) {
          if ( ! isset( $_POST['confirm_email'] ) || $_POST['confirm_email'] !== '' ) {
            home_url( '/' );
            exit;
          }

          $default_role = 'subscriber';
          $available_roles = array( 'subscriber' );

          if ( jobhunt_is_woocommerce_activated() ) {
            $available_roles[] = 'customer';
            $default_role = 'customer';
          }

          if ( jobhunt_is_wp_job_manager_activated() ) {
            $available_roles[] = 'employer';
          }

          if ( jobhunt_is_wp_resume_manager_activated() ) {
            $available_roles[] = 'candidate';
            $default_role = 'candidate';
          }

          $user_email     = sanitize_email( $_POST["jobhunt_user_email"] );
          $user_role      = ! empty( $_POST["jobhunt_user_role"] ) && in_array( $_POST["jobhunt_user_role"], $available_roles ) ? sanitize_text_field( $_POST["jobhunt_user_role"] ) : $default_role;

          if ( ! empty( $_POST["jobhunt_user_login"] ) ) {
            $user_login = sanitize_user( $_POST["jobhunt_user_login"] );
          } else {
            $user_login = sanitize_user( current( explode( '@', $user_email ) ), true );

            // Ensure username is unique.
            $append     = 1;
            $o_user_login = $user_login;

            while ( username_exists( $user_login ) ) {
              $user_login = $o_user_login . $append;
              $append++;
            }
          }


          // Ajout de la partie RNA.
          if($user_role === "employer") {
            $rna_code = $_POST["jobhunt_user_rna"];
          }

          if( username_exists( $user_login ) && apply_filters( 'jobhunt_register_user_login_enabled', true ) ) {
            // Username already registered
            jobhunt_form_errors()->add('username_unavailable', esc_html__('Username already taken','jobhunt'));
          }
          if( ! validate_username( $user_login ) && apply_filters( 'jobhunt_register_user_login_enabled', true ) ) {
            // invalid username
            jobhunt_form_errors()->add('username_invalid', esc_html__('Invalid username','jobhunt'));
          }
          if( $user_login == '' && apply_filters( 'jobhunt_register_user_login_enabled', true ) ) {
            // empty username
            jobhunt_form_errors()->add('username_empty', esc_html__('Please enter a username','jobhunt'));
          }
          if( ! is_email( $user_email ) ) {
            //invalid email
            jobhunt_form_errors()->add('email_invalid', esc_html__('Invalid email','jobhunt'));
          }
          if( email_exists( $user_email ) ) {
            //Email address already registered
            jobhunt_form_errors()->add('email_used', esc_html__('Email already registered','jobhunt'));
          }
          //Check si RNA non vide et OK.
          if($user_role === "employer" && $rna_code == ''){
            jobhunt_form_errors()->add('rna_empty', esc_html__('Please enter your RNA code', 'jobhunt'));
          }
          //Check si CGU existe et est coché
          if (!isset($_POST['jobhunt_user_cgu']))
          {
            jobhunt_form_errors()->add('cgu_empty', esc_html__('Veuillez cocher la case', 'jobhunt'));
          }



          $password = wp_generate_password();
          $password_generated = true;

          if ( apply_filters( 'jobhunt_register_user_password_enabled', false ) && !empty( $_POST['jobhunt_user_pass'] ) ) {
            $password = $_POST['jobhunt_user_pass'];
            $password_generated = false;
          }

          do_action( 'jobhunt_register_form_custom_field_validation' );

          $errors = jobhunt_form_errors()->get_error_messages();

          // only create the user in if there are no errors
          if( empty( $errors ) ) {

            $new_user_data = array(
              'user_login'        => $user_login,
              'user_pass'         => $password,
              'user_email'        => $user_email,
              'role'              => $user_role,
            );

            $new_user_id = wp_insert_user( $new_user_data );

            if( $new_user_id ) {
              // send an email to the admin alerting them of the registration
              if( apply_filters( 'jobhunt_wc_new_user_notification', false ) && jobhunt_is_woocommerce_activated() ) {
                wc()->mailer()->customer_new_account( $new_user_id, $new_user_data, $password_generated );
              } else {
                wp_new_user_notification( $new_user_id, null, 'both' );
              }
              //Insertion du code RNA en BDD.
              if($user_role === "employer") {
                $company = array(
                  'post_title'    => $user_login,
                  'post_author'   => $new_user_id,
                  'post_type'     => 'company',
                  'post_status'   => 'pending'
                );
                $post_id = wp_insert_post($company);
                update_post_meta($post_id, 'rna_code', $rna_code);
                update_post_meta($post_id, 'user_cgu', $user_cgu);
              }
              // log the new user in
              $creds = array();
              $creds['user_login'] = $user_login;
              $creds['user_password'] = $password;
              $creds['remember'] = true;

              if( $password_generated ) {
                jobhunt_form_success()->add('verify_user', esc_html__('Account created successfully. Please check your email to create your account password','jobhunt'));
              } else {
                $user = wp_signon( $creds, false );
                // send the newly created user to the home page after logging them in
                if ( is_wp_error( $user ) ) {
                  echo wp_kses_post( $user->get_error_message() );
                } else {
                  $oUser = get_user_by( 'login', $creds['user_login'] );
                  $aUser = get_object_vars( $oUser );
                  $sRole = $aUser['roles'][0];
                  if( get_option( 'job_manager_job_dashboard_page_id' ) ) {
                    $job_url = get_permalink( get_option( 'job_manager_job_dashboard_page_id' ) );
                  } else {
                    $job_url = home_url( '/' );
                  }

                  if( get_option( 'resume_manager_candidate_dashboard_page_id' ) ) {
                    $resume_url = get_permalink( get_option( 'resume_manager_candidate_dashboard_page_id' ) );
                  } else {
                    $resume_url= home_url( '/' );
                  }

                  switch( $sRole ) {
                    case 'candidate':
                    $redirect_url = $resume_url;
                    break;
                    case 'employer':
                    $redirect_url = $job_url;
                    break;

                    default:
                    $redirect_url = home_url( '/' );
                    break;
                  }

                  wp_safe_redirect( apply_filters( 'jobhunt_redirect_link_after_register', $redirect_url, $user ) );
                  exit;
                }
              }
            }
          }
        }
      }
    }

    add_action( 'wp_loaded', 'jobhunt_add_new_member' );

    // logs a member in after submitting a form
    if ( ! function_exists( 'jobhunt_login_member' ) ) {
      function jobhunt_login_member() {
        if( isset( $_POST['jobhunt_login_check'] )  && wp_verify_nonce( $_POST['jobhunt_login_nonce'], 'jobhunt-login-nonce') ) {

          // this returns the user ID and other info from the user name
          if ( is_email( $_POST['jobhunt_user_login'] ) ) {
            $user =  get_user_by( 'email', $_POST['jobhunt_user_login'] );
          } else {
            $user =  get_user_by( 'login', $_POST['jobhunt_user_login'] );
          }

          if( ! $user ) {
            // if the user name doesn't exist
            jobhunt_form_errors()->add('empty_username', esc_html__('Invalid username or email address','jobhunt'));
          }

          if( ! isset($_POST['jobhunt_user_pass']) || $_POST['jobhunt_user_pass'] == '' ) {
            // if no password was entered
            jobhunt_form_errors()->add('empty_password', esc_html__('Please enter a password','jobhunt'));
          }

          if( isset( $_POST['jobhunt_user_pass'] ) && ! empty( $_POST['jobhunt_user_pass'] ) ){
            // check the user's login with their password
            if( ! wp_check_password( $_POST['jobhunt_user_pass'], $user->user_pass, $user->ID ) ) {
              // if the password is incorrect for the specified user
              jobhunt_form_errors()->add('empty_password', esc_html__('Incorrect password','jobhunt'));
            }
          }

          // retrieve all error messages
          $errors = jobhunt_form_errors()->get_error_messages();

          // only log the user in if there are no errors
          if( empty( $errors ) ) {

            $creds = array();
            $creds['user_login'] = $user->user_login;
            $creds['user_password'] = $_POST['jobhunt_user_pass'];
            $creds['remember'] = true;

            $user = wp_signon( $creds, false );
            // send the newly created user to the home page after logging them in
            if ( is_wp_error($user) ){
              echo wp_kses_post( $user->get_error_message() );
            } else {
              $oUser = get_user_by( 'login', $creds['user_login'] );
              $aUser = get_object_vars( $oUser );
              $sRole = $aUser['roles'][0];

              if( get_option( 'job_manager_job_dashboard_page_id' ) ) {
                $job_url = get_permalink( get_option( 'job_manager_job_dashboard_page_id' ) );
              } else {
                $job_url = home_url( '/' );
              }

              if( get_option( 'resume_manager_candidate_dashboard_page_id' ) ) {
                $resume_url = get_permalink( get_option( 'resume_manager_candidate_dashboard_page_id' ) );
              } else {
                $resume_url= home_url( '/' );
              }

              switch( $sRole ) {
                case 'candidate':
                $redirect_url = $resume_url;
                break;
                case 'employer':
                $redirect_url = $job_url;
                break;

                default:
                $redirect_url = home_url( '/' );
                break;
              }

              wp_safe_redirect( apply_filters( 'jobhunt_redirect_link_after_login', $redirect_url, $user ) );
            }
            exit;
          }
        }
      }
    }

    add_action( 'wp_loaded', 'jobhunt_login_member' );
