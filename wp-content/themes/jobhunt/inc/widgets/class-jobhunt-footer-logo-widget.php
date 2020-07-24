<?php
/*-----------------------------------------------------------------------------------*/
/*  Footer Logo Widget Class
/*-----------------------------------------------------------------------------------*/
class Jobhunt_Footer_Logo_Widget extends WP_Widget {

    public $defaults;

    public function __construct() {

        $widget_ops = array(
            'classname'     => 'footer-logo-widget',
            'description'   => esc_html__( 'Your site&#8217;s most footer logo.', 'jobhunt' )
        );

        parent::__construct( 'jobhunt_footer_logo_widget', esc_html__('Jobhunt Footer Logo', 'jobhunt'), $widget_ops );

        $defaults = apply_filters( 'jobhunt_footer_logo_widget_default_args', array(
            'logo'     => '',
        ) );
        $this->defaults = $defaults;
    }

    public function widget( $args, $instance ) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $instance = wp_parse_args( (array) $instance, $this->defaults );

        jobhunt_get_template( 'widgets/footer-logo-widget.php', array( 'args' => $args,'instance' => $instance ) );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        if ( ! empty( $new_instance['logo'] ) ) {
            $instance['logo'] = strip_tags( stripslashes($new_instance['logo']) );
        }

        return $instance;
    }

    public function form( $instance ) {

        $logo = isset( $instance['logo'] ) ? $instance['logo'] : 0;
        ?>
        <p id="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>_field" class="form-field media-option">
            <label for="<?php echo esc_attr( $this->get_field_name( 'logo' ) ); ?>"><?php esc_html_e( 'Logo:', 'jobhunt' ); ?></label>
            <?php $img_src = ( $logo && absint( $logo ) ) ? wp_get_attachment_thumb_url( $logo ) : ''; ?>
            <?php if ( ! empty( $img_src ) ) : ?>
                <img src="<?php echo esc_attr( $img_src ); ?>" class="upload_image_preview" data-placeholder-src="" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="150" height="150" style="display: block; margin-bottom: 5px;" />
            <?php endif; ?>
            <input name="<?php echo esc_attr( $this->get_field_name( 'logo' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>" class="widefat upload_image_id" type="hidden" value="<?php echo esc_attr( $logo ); ?>" />
            <a href="#" class="button jh_upload_image_button tips"><?php echo esc_html__( 'Upload/Add image', 'jobhunt' ); ?></a>
            <a href="#" class="button jh_remove_image_button tips"><?php echo esc_html__( 'Remove this image', 'jobhunt' ); ?></a>
        </p>
        <?php
    }

}
