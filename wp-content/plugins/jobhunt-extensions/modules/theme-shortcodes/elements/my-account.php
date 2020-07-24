<?php

if ( ! function_exists( 'jobhunt_registration_form' ) ) {
    function jobhunt_registration_form() {

        $output = '';

        // only show the registration form to non-logged-in members
        if( ! is_user_logged_in() ) {

            // check to make sure user registration is enabled
            $registration_enabled = get_option( 'users_can_register' );

            // only show the registration form if allowed
            if( $registration_enabled && function_exists( 'jobhunt_registration_form_fields' ) ) {
                $output = jobhunt_registration_form_fields();
            } else {
                $output = esc_html__( 'User registration is not enabled', 'jobhunt-extensions' );
            }

        }

        return $output;
    }
}

add_shortcode( 'jobhunt_register_form', 'jobhunt_registration_form' );

if ( ! function_exists( 'jobhunt_login_form' ) ) {
    function jobhunt_login_form() {

        $output = '';

        if( ! is_user_logged_in() && function_exists( 'jobhunt_login_form_fields' ) ) {
            $output = jobhunt_login_form_fields();
        }

        return $output;
    }
}

add_shortcode( 'jobhunt_login_form', 'jobhunt_login_form' );

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
                            <a class="nav-link active" id="jh-register-tab" data-toggle="pill" href="#jh-register-tab-content" role="tab" aria-controls="jh-register-tab-content" aria-selected="true"><?php echo apply_filters( 'jobhunt_register_form_tab_title', esc_html__( 'Register', 'jobhunt-extensions') ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="jh-login-tab" data-toggle="pill" href="#jh-login-tab-content" role="tab" aria-controls="jh-login-tab-content" aria-selected="false"><?php echo apply_filters( 'jobhunt_login_form_tab_title', esc_html__( 'Login', 'jobhunt-extensions') ); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="jh-register-tab-content" role="tabpanel" aria-labelledby="jh-register-tab"><?php echo jobhunt_registration_form(); ?></div>
                        <div class="tab-pane fade" id="jh-login-tab-content" role="tabpanel" aria-labelledby="jh-login-tab"><?php echo jobhunt_login_form(); ?></div>
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

add_shortcode( 'jobhunt_register_login_form', 'jobhunt_register_login_form' );
