<?php
/**
 * Creates a date filter widget
 *
 * @class       JH_WPJMR_Widget_Date_Filter
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
    class JH_WPJMR_Widget_Date_Filter extends WP_Widget {

        public function __construct() {
            $widget_ops = array( 'description' => esc_html__( 'Add resume date filter widgets to your sidebar.', 'jobhunt' ) );
            parent::__construct( 'jobhunt_wpjmr_date_filter', esc_html__( 'Jobhunt Resume Date Filter', 'jobhunt' ), $widget_ops );
        }

        public function widget($args, $instance) {
            if ( ! ( is_post_type_archive( 'resume' ) || is_page( jh_wpjmr_get_page_id( 'resume' ) ) ) && ! is_resume_taxonomy() ) {
                return;
            }

            $instance['title'] = apply_filters( 'jobhunt_wpjmr_date_filter_widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            echo wp_kses_post( $args['before_widget'] );

            if ( ! empty($instance['title']) ) {
                echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );
            }

            echo '<ul class="jobhunt-wpjmr-date-filter">';

            $date_filters = jh_wpjmr_get_all_date_filters();

            foreach ( $date_filters as $key => $value ) {
                $option_is_set = false;
                $link = remove_query_arg( array( 'posted_before' ), Jobhunt_WPJMR::get_current_page_url() );

                if( $key != 'all' ) {
                    if ( isset( $_GET['posted_before'] ) && jobhunt_clean( wp_unslash( $_GET['posted_before'] ) ) == $key ) {
                        $option_is_set = true;
                    }
                    $link = add_query_arg( 'posted_before', $key, $link );
                } elseif( $key == 'all' && ! isset( $_GET['posted_before'] ) ) {
                    $option_is_set = true;
                }

                $link       = esc_url( apply_filters( 'jh_wpjmr_date_filter_link', $link, $key, $value ) );
                $link_html  = '<a rel="nofollow" href="' . esc_url( $link ) . '">' . esc_html( $value ) . '</a>';
                echo '<li class="jobhunt-wpjmr-date-filter-list__item ' . ( $option_is_set ? 'jobhunt-wpjmr-date-filter-list__item--chosen chosen' : '' ) . '">';
                echo wp_kses_post( apply_filters( 'jh_wpjmr_date_filter_link_html', $link_html, $link, $key, $value ) );
                echo '</li>';
            }

            echo '</ul>';

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
    }
endif;