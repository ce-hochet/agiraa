<?php
/**
 * Template functions used in header
 */

if ( ! function_exists( 'jobhunt_site_branding' ) ) {
    /**
     * Site branding wrapper and display
     *
     * @since  1.0.0
     * @return void
     */
    function jobhunt_site_branding() {
        ?>
        <div class="site-branding">
            <?php jobhunt_site_title_or_logo(); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_site_title_or_logo' ) ) {
    /**
     * Display the site title or logo
     *
     * @since  1.0.0
     * @return void
     */
    function jobhunt_site_title_or_logo() {
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
        } elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
            jetpack_the_site_logo();
        } elseif ( apply_filters( 'jobhunt_site_logo_svg', false ) ) {
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">';
            jobhunt_get_svg_logo();
            echo '</a>';
        } else {
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">';
            ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
            <?php if ( '' != get_bloginfo( 'description' ) ) : ?>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php endif;
            echo '</a>';
        }
    }
}

if ( ! function_exists( 'jobhunt_get_svg_logo' ) ) {
    /**
     * Gets logo-svg.php template
     */
    function jobhunt_get_svg_logo() {
        jobhunt_get_template( 'global/logo-svg.php' );
    }
}

if ( ! function_exists( 'jobhunt_primary_nav' ) ) {
    function jobhunt_primary_nav() {
        if ( has_nav_menu( 'primary-nav' ) ) {
            wp_nav_menu(
                array(
                    'theme_location'    => 'primary-nav',
                    'container_class'   => 'primary-nav',
                    'menu_class'        => 'header-menu yamm'
                )
            );
        }
    }
}

if ( ! function_exists( 'jobhunt_secondary_nav' ) ) {
    function jobhunt_secondary_nav() {
        if( apply_filters( 'jobhunt_secondary_nav_menu', true ) ) {
            $menu_titles = apply_filters( 'jobhunt_secondary_nav_menu_titles', array(
                'register_text'     => esc_html__( 'Register', 'jobhunt' ),
                'register_icon'     => 'la la-key',
                'register_icon_ho'  => 'fas fa-key',
                'login_text'        => esc_html__( 'Login', 'jobhunt' ),
                'login_icon'        => 'la la-sign-in',
                'login_icon_ho'     => 'fas fa-sign-in-alt',
                'user_page_text'    => esc_html__( 'User Page', 'jobhunt' ),
                'user_page_icon'    => 'la la-user',
                'user_page_icon_ho' => 'fas fa-user',
                'logout_text'       => esc_html__( 'Log Out', 'jobhunt' ),
                'logout_icon'       => 'la la-sign-out',
                'logout_icon_ho'    => 'fas fa-sign-out-alt',
            ) );
            $custom_userpage = jobhunt_get_register_login_form_page();
            ?>
            <ul class="header-menu">
                <?php do_action( 'jobhunt_secondary_nav_before' );

                if ( is_user_logged_in() ) {
                    $userpage_link = get_edit_user_link();
                    $user = wp_get_current_user();
                    if ( in_array( 'employer', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) {
                        $employer_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
                        $userpage_link = ! empty( $employer_dashboard_page_id ) ? get_permalink( $employer_dashboard_page_id ) : $userpage_link;
                    } elseif ( in_array( 'candidate', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) {
                        $candidate_dashboard_page_id = get_option( 'resume_manager_candidate_dashboard_page_id' );
                        $userpage_link = ! empty( $candidate_dashboard_page_id ) ? get_permalink( $candidate_dashboard_page_id ) : $userpage_link;
                    } elseif ( jobhunt_is_woocommerce_activated() ) {
                        $myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
                        $userpage_link = ! empty( $myaccount_page ) ? get_permalink( $myaccount_page ) : $userpage_link;
                    }
                    $userpage_link = apply_filters( 'jobhunt_header_user_page_url', $userpage_link );
                    $logout_link = apply_filters( 'jobhunt_header_logout_url', wp_logout_url( get_permalink( $custom_userpage ) ) );

                    if ( apply_filters( 'jobhunt_enable_header_user_login_dropdown', false ) ) : ?>

                        <li class="menu-item menu-item-user-page <?php if ( has_nav_menu( 'user_dropdown_menu' ) ) { echo 'menu-item-has-children'; } ?>">
                            <a href="<?php echo esc_url( $userpage_link ); ?>" class="user-image"><?php echo get_avatar( $user->ID, 30 ); ?></a>
                            <?php 
                                if ( has_nav_menu( 'user_dropdown_menu' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'  => 'user_dropdown_menu',
                                        'container'       => false,
                                        'menu_class'      => 'sub-menu'
                                    ) );
                                }
                            ?>
                        </li>
                    <?php else : ?>
                        <li class="menu-item menu-item-user-page">
                            <a href="<?php echo esc_url( $userpage_link ); ?>">
                                <i class="<?php echo esc_attr( $menu_titles['user_page_icon'] ); ?> desktop-only"></i>
                                <i class="<?php echo esc_attr( $menu_titles['user_page_icon_ho'] ); ?> handheld-only"></i>
                                <span class="secondary-menu-text"><?php echo esc_html( $menu_titles['user_page_text'] ); ?></span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-logout">
                            <a href="<?php echo esc_url( $logout_link ); ?>">
                                <i class="<?php echo esc_attr( $menu_titles['logout_icon'] ); ?> desktop-only"></i>
                                <i class="<?php echo esc_attr( $menu_titles['logout_icon_ho'] ); ?> handheld-only"></i>
                                <span class="secondary-menu-text"><?php echo esc_html( $menu_titles['logout_text'] ); ?></span>
                            </a>
                        </li>
                    <?php endif;
                } else {
                    $register_page_url = ! empty( $custom_userpage ) ?  get_permalink( $custom_userpage ) : wp_registration_url();
                    $login_page_url = ! empty( $custom_userpage ) ?  get_permalink( $custom_userpage ) . '#jh-login-tab-content' : wp_login_url( get_permalink() );
                    $register_page_url = apply_filters( 'jobhunt_header_register_page_url', $register_page_url );
                    $login_page_url =apply_filters( 'jobhunt_header_login_page_url', $login_page_url );
                    ?>
                    <li class="menu-item menu-item-register">
                        <a href="<?php echo esc_url( $register_page_url ); ?>" <?php echo jobhunt_is_header_register_login_modal_form() ? 'data-toggle="modal" data-target="#modal-register-login"' : ''?>>
                            <i class="<?php echo esc_attr( $menu_titles['register_icon'] ); ?> desktop-only"></i>
                            <i class="<?php echo esc_attr( $menu_titles['register_icon_ho'] ); ?> handheld-only"></i>
                            <span class="secondary-menu-text"><?php echo esc_html( $menu_titles['register_text'] ); ?></span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-login">
                        <a href="<?php echo esc_url( $login_page_url ); ?>" <?php echo jobhunt_is_header_register_login_modal_form() ? 'data-toggle="modal" data-target="#modal-register-login"' : ''?>>
                            <i class="<?php echo esc_attr( $menu_titles['login_icon'] ); ?> desktop-only"></i>
                            <i class="<?php echo esc_attr( $menu_titles['login_icon_ho'] ); ?> handheld-only "></i>
                            <span class="secondary-menu-text"><?php echo esc_html( $menu_titles['login_text'] ); ?></span>
                        </a>
                    </li>
                    <?php
                }

                do_action( 'jobhunt_secondary_nav_after' );

                ?>
            </ul>
            <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_header_register_login_modal_form' ) ) {
    /**
    * Modal Register/Login Form
    *
    * @return void
    * @since  1.0.0
    */
    function jobhunt_header_register_login_modal_form() {
        if ( jobhunt_is_header_register_login_modal_form() && ! is_user_logged_in() ) {
            ?>
            <div class="modal-register-login-wrapper">
                <div class="modal fade modal-register-login" id="modal-register-login" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <?php echo do_shortcode( '[jobhunt_register_login_form]' ); ?>
                                <a class="close-button" data-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'jobhunt' ) ?>"><i class="la la-close"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_post_a_job' ) ) {
    function jobhunt_post_a_job() {
        if ( apply_filters( 'jobhunt_header_post_a_job_button', true ) && jobhunt_is_wp_job_manager_activated() ) :
            $post_a_job_url = apply_filters( 'jobhunt_header_post_a_job_button_url', get_permalink( get_option( 'job_manager_submit_job_form_page_id' ) ) );
            $post_a_job_icon = apply_filters( 'jobhunt_header_post_a_job_button_icon', 'la la-plus' );
            $post_a_job_text = apply_filters( 'jobhunt_header_post_a_job_button_text', esc_html__( 'Post A Job', 'jobhunt' ) );
            ?>
            <div class="post-a-job">
                <a href="<?php echo esc_url( $post_a_job_url ); ?>">
                    <i class="<?php echo esc_attr( $post_a_job_icon ); ?>"></i><?php echo esc_html( $post_a_job_text ); ?>
                </a>
            </div><?php
        endif;
    }
}

if ( ! function_exists( 'jobhunt_top_bar' ) ) {
    function jobhunt_top_bar() {
        if ( apply_filters( 'jobhunt_enable_top_bar', true ) ) : ?>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-inner"><?php
                    jobhunt_top_bar_left_menu();
                    jobhunt_top_bar_right_menu();
                ?></div><!-- /.top-bar-inner -->
            </div>
        </div><!-- /.top-bar --><?php endif;
    }
}

if ( ! function_exists( 'jobhunt_top_bar_left_menu' ) ) {
    function jobhunt_top_bar_left_menu() {
        if ( has_nav_menu( 'top_bar_left' ) ) {
            wp_nav_menu( array(
                'theme_location'  => 'top_bar_left',
                'container_class' => 'top-bar-left',
                'menu_class'      => 'nav nav-inline'
            ) );
        }
    }
}

if ( ! function_exists( 'jobhunt_top_bar_right_menu' ) ) {
    function jobhunt_top_bar_right_menu() {
        if ( has_nav_menu( 'top_bar_right' ) ) {
            wp_nav_menu( array(
                'theme_location'  => 'top_bar_right',
                'container_class' => 'top-bar-right',
                'menu_class'      => 'nav nav-inline'
            ) );
        }
    }
}

if ( ! function_exists( 'jobhunt_has_sticky_header' ) ) {
    /**
     * Load sticky header
     */
    function jobhunt_has_sticky_header() {
        return apply_filters( 'jobhunt_has_sticky_header', false );
    }
}

if ( ! function_exists( 'jobhunt_has_handheld_header' ) ) {
    /**
     * Load Different Header for handheld devices
     */
    function jobhunt_has_handheld_header() {
        return apply_filters( 'jobhunt_has_handheld_header', true );
    }
}

if ( ! function_exists( 'jobhunt_header_handheld' ) ) {
    /**
     * Displays HandHeld Header
     */
    function jobhunt_header_handheld() {

        if( jobhunt_has_handheld_header() ) : ?>
            <div class="handheld-only <?php echo jobhunt_has_sticky_header() ? 'jobhunt-stick-this' : ''; ?>">
                <div class="container">
                    <div class="handheld-header">
                        <?php
                        /**
                         * @hooked jobhunt_site_branding - 10
                         * @hooked jobhunt_off_canvas_nav - 20
                         * @hooked jobhunt_post_a_job - 40
                         * @hooked jobhunt_secondary_nav - 50
                         */
                        do_action( 'jobhunt_header_handheld' ); ?>
                    </div>
                </div>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_off_canvas_nav' ) ) {
    /**
     * Displays Off Canvas Navigation
     */
    function jobhunt_off_canvas_nav() {
        if ( has_nav_menu( 'handheld' ) ) {
        ?>
            <div class="off-canvas-navigation-wrapper">
                <div class="off-canvas-navbar-toggle-buttons clearfix">
                    <button class="navbar-toggler navbar-toggle-hamburger " type="button">
                        <i class="la la-bars"></i>
                    </button>
                    <button class="navbar-toggler navbar-toggle-close " type="button">
                        <i class="la la-close"></i>
                    </button>
                </div>
                <div class="off-canvas-navigation" id="default-oc-header">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'handheld',
                            'container_class'   => 'handheld',
                            'menu_class'        => 'handheld-header-menu header-menu yamm'
                        ) );
                    ?>
                </div>
            </div>
            <?php
        }
    }
}
