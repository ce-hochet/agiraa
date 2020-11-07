<?php
/**
 * Jobhunt Newsletter Widget
 *
 * @class       Jobhunt_Newsletter_Widget
 * @version     1.0.0
 * @package     Widgets
 * @category    Class
 * @author      Transvelo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( class_exists( 'WP_Widget' ) ) :
class Jobhunt_Newsletter_Widget extends WP_Widget {

	public $defaults;

	public function __construct() {

		$widget_ops = array(
			'classname' 	=> 'jobhunt_newsletter_widget',
			'description' 	=> esc_html__( 'Your site&#8217;s newsletter block.', 'jobhunt' )
		);

		parent::__construct( 'jobhunt_newsletter_widget', esc_html__('Jobhunt Newsletter', 'jobhunt'), $widget_ops );

		$defaults = apply_filters( 'jobhunt_newsletter_widget_default_args', array(
			'newsletter_title'		=> '',
			'newsletter_description'=> '',
		) );
		$this->defaults = $defaults;
	}

	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo wp_kses_post( $args['before_widget'] );

		?>
		<div class="newsletter-widget">
			<div class="newsletter">
				<div class="newsletter-caption">
					<?php if ( ! empty( $instance['newsletter_title'] ) ) : ?>
						<span class="widget-title newsletter-title"><?php echo esc_html( $instance['newsletter_title'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $instance['newsletter_description'] ) ) : ?>
						<p class="widget-description newsletter-description"><?php echo esc_html( $instance['newsletter_description'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php jobhunt_newsletter_form(); ?>
			</div>
		</div>
		<?php

		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['newsletter_title']		= strip_tags( $new_instance['newsletter_title'] );
		$instance['newsletter_description']	= strip_tags( $new_instance['newsletter_description'] );


		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newsletter_title' ) ); ?>"><?php esc_html_e('Newsletter Title', 'jobhunt'); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'newsletter_title' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'newsletter_title' ) ); ?>" value="<?php echo esc_attr( $instance['newsletter_title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newsletter_description' ) ); ?>"><?php esc_html_e('Newsletter Description', 'jobhunt'); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'newsletter_description' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'newsletter_description' ) ); ?>" value="<?php echo esc_attr( $instance['newsletter_description'] ); ?>" class="widefat" />
		</p>

		<?php
		do_action( 'jobhunt_newsletter_widget_add_opts', $this, $instance);
	}

}
endif;