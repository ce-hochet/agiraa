<?php

class JH_WPJM_Company_Manager {

    public function __construct() {

        add_shortcode( 'jobhunt_companies_list', array( $this, 'output_companies' ) );

        include_once( dirname( __FILE__ ) . '/class-wp-job-manager-company-cpt.php' );

        if( is_admin() ) {
            include_once( dirname( __FILE__ ) . '/class-wp-job-manager-company-writepanels.php' );
        }
    }

    public function output_companies( $atts ) {
        extract( $atts = shortcode_atts( array(
            'show_letters' => true,
            'all_title'    => esc_html__( 'All', 'jobhunt-extensions' )
        ), $atts ) );

        $output = '';

        $companies = get_posts( array(
            'numberposts' => -1,
            'post_type' => 'company',
            'post_status' => 'publish'
        ) );

        $_companies = array();
        foreach ( $companies as $company ) {
            $_companies[ strtoupper( $company->post_title[0] ) ][] = $company;
        }

        $output = '<div class="companies-listing-a-z">';
        $show_letters = $this->string_to_bool( $show_letters );
        if ( $show_letters ) {
            $output .= '<div class="company-letters"><ul>';
            $output .= '<li><a href="#all"  data-target="#all" class="all chosen">' . $all_title . '</a></li>';
            foreach ( range( 'A', 'Z' ) as $letter ) {
                if ( ! isset( $_companies[ $letter ] ) ) {
                    $output .= '<li><span>' . $letter . '</span></li>';
                } else {
                    $output .= '<li><a href="#' . $letter . '"  data-target="#' . $letter . '">' . $letter . '</a></li>';
                }
            }
            $output .= '</ul></div>';
        }

        $output .= '<ul class="companies-overview">';
        foreach ( range( 'A', 'Z' ) as $letter ) {
            if ( ! isset( $_companies[ $letter ] ) ) {
                continue;
            }

            $output .= '<li class="company-group"><div class="company-group-inner">';
            $output .= '<div id="' . $letter . '" class="company-letter">' . $letter . '</div>';
            $output .= '<ul>';

            foreach ( $_companies[ $letter ] as $company ) {
                $output .= '<li class="company-name"><a href="' . get_permalink( $company ) . '">' . esc_attr( $company->post_title ) . '</a></li>';
            }

            $output .= '</ul>';
            $output .= '</div></li>';
        }

        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    /**
     * Gets string as a bool.
     *
     * @param  string $value
     * @return bool
     */
    public function string_to_bool( $value ) {
        return ( is_bool( $value ) && $value ) || in_array( $value, array( '1', 'true', 'yes' ) ) ? true : false;
    }
}

global $jh_wpjm_company_manager;
$jh_wpjm_company_manager = new JH_WPJM_Company_Manager();
