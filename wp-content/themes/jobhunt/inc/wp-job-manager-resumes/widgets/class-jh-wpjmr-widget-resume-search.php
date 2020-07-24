<?php
/**
 * Creates a resume search widget
 *
 * @class       JH_WPJMR_Widget_Resume_Search
 * @version     1.0.0
 * @package     Widgets
 * @category    Class
 * @author      MadrasThemes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( class_exists( 'WP_Widget' ) ) :
    /**
     * Jobhunt resume search widget class
     *
     * @since 1.0.0
     */
    class JH_WPJMR_Widget_Resume_Search extends WP_Widget {

        public function __construct() {
            $widget_ops = array( 'description' => esc_html__( 'Add resume search widgets to your sidebar.', 'jobhunt' ) );
            parent::__construct( 'jobhunt_wpjmr_search', esc_html__( 'Jobhunt Resume Search', 'jobhunt' ), $widget_ops );
        }

        public function widget($args, $instance) {

            $instance['title'] = apply_filters( 'jobhunt_wpjmr_search_widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            echo wp_kses_post( $args['before_widget'] );

            if ( ! empty($instance['title']) ) {
                echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );
            }

            $link = $this->get_current_page_url();
            $query_vars = Jobhunt_WPJMR::get_current_page_query_args();
            ?>
            <form method="get" class="jobhunt-wpjmr-search" action="<?php echo esc_url( $link ); ?>">
                <label class="sr-only" for="<?php echo esc_attr( $args['widget_id'] ); ?>-search-field"><?php echo esc_html__( 'Keywords', 'jobhunt' ); ?></label>
                <input type="search" id="<?php echo esc_attr( $args['widget_id'] ); ?>-search-field" class="search-field" placeholder="<?php echo esc_attr__( 'By Name', 'jobhunt' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'jobhunt' ); ?>"><i class="la la-search"></i><span class="resume-search-text"><?php echo esc_html__( 'Search', 'jobhunt' ); ?></span></button>
                <input type="hidden" name="post_type" value="resume"/>
                <?php foreach( $query_vars as $key => $value ) {
                    if( $key !== 's' ) {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '"/>';
                    }
                } ?>
            </form>
            <?php

            echo wp_kses_post( $args['after_widget'] );
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            if ( ! empty( $new_instance['title'] ) ) {
                $instance['title'] = strip_tags( stripslashes($new_instance['title']) );
            }
            return $instance;
        }

        public function form( $instance ) {
            global $wp_registered_sidebars;

            $title = isset( $instance['title'] ) ? $instance['title'] : '';

            // If no sidebars exists.
            if ( !$wp_registered_sidebars ) {
                echo '<p>'. esc_html__('No sidebars are available.', 'jobhunt' ) .'</p>';
                return;
            }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'jobhunt' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
        }

        /**
         * Get current page URL.
         *
         * @return string
         * @since  3.3.0
         */
        protected function get_current_page_url() {
            if ( defined( 'RESUMES_IS_ON_FRONT' ) ) {
                $link = home_url( '/' );
            } elseif( is_resume_taxonomy() ) {
                $queried_object = get_queried_object();
                $link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
            } else {
                $link = get_permalink( jh_wpjmr_get_page_id( 'resume' ) );
            }

            return $link;
        }
    }
endif;