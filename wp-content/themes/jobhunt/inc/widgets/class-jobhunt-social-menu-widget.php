<?php
/*-----------------------------------------------------------------------------------*/
/*  Social Menu Widget Class
/*-----------------------------------------------------------------------------------*/

class Social_Menu_Widget extends WP_Widget {
    /**
     * Sets up a new Navigation Menu widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'description'                 => esc_html__( 'Add a social menu to your sidebar/footer.', 'jobhunt' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'social_links_menu', esc_html__( 'Jobhunt Social Links Menu', 'jobhunt' ), $widget_ops );
    }
    /**
     * Outputs the content for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Navigation Menu widget instance.
     */
    public function widget( $args, $instance ) {
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        if ( ! $nav_menu ) {
            return;
        }
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        echo '<div class="widget widget_nav_menu social-menu-widget">';
        if ( $title ) {
            echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
        }
        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu,
        );
        /**
         * Filters the arguments for the Navigation Menu widget.
         *
         * @since 4.2.0
         * @since 4.4.0 Added the `$instance` parameter.
         *
         * @param array    $nav_menu_args {
         *     An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
         *
         *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
         *     @type mixed         $menu        Menu ID, slug, or name.
         * }
         * @param WP_Term  $nav_menu      Nav menu object for the current menu.
         * @param array    $args          Display arguments for the current widget.
         * @param array    $instance      Array of settings for the current widget.
         */

        ?>
        <div class="social-links">
            <?php wp_nav_menu( $nav_menu_args ); ?>
        </div>

        <?php 
        echo '</div>';
    }
    /**
     * Handles updating settings for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if ( ! empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if ( ! empty( $new_instance['nav_menu'] ) ) {
            $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        }
        return $instance;
    }
    /**
     * Outputs the settings form for the Navigation Menu widget.
     *
     * @since 3.0.0
     *
     * @param array $instance Current settings.
     * @global WP_Customize_Manager $wp_customize
     */
    public function form( $instance ) {
        global $wp_customize;
        $title    = isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        // Get menus
        $menus = wp_get_nav_menus();
        $empty_menus_style = $not_empty_menus_style = '';
        if ( empty( $menus ) ) {
            $empty_menus_style = ' style="display:none" ';
        } else {
            $not_empty_menus_style = ' style="display:none" ';
        }
        $nav_menu_style = '';
        if ( ! $nav_menu ) {
            $nav_menu_style = 'display: none;';
        }
        // If no menus exists, direct the user to go and create some.
        ?>
        <p class="nav-menu-widget-no-menus-message" <?php echo esc_attr( $not_empty_menus_style ); ?>>
            <?php
            if ( $wp_customize instanceof WP_Customize_Manager ) {
                $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
            } else {
                $url = admin_url( 'nav-menus.php' );
            }
            ?>
            <?php echo sprintf( '%1$s <a href="%2$s">%3$s</a>.', esc_html__( 'No menus have been created yet.', 'jobhunt' ), esc_url( $url ), esc_html__( 'Create some', 'jobhunt' ) ); ?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php echo esc_attr( $empty_menus_style ); ?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'jobhunt' ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Select Menu:', 'jobhunt' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
                    <option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'jobhunt' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
                <p class="edit-selected-nav-menu" style="<?php echo esc_attr( $nav_menu_style ); ?>">
                    <button type="button" class="button"><?php esc_html_e( 'Edit Menu', 'jobhunt' ); ?></button>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }
}