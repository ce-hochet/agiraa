<?php


echo wp_kses_post( $args['before_widget'] );

?>
<div class="footer-logo">
<?php

    if ( ! empty( $instance['logo'] ) ) {
        $img_src = wp_get_attachment_url( $instance['logo'] );
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">';
            ?><img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php
        echo '</a>';
    }else (
        jobhunt_site_title_or_logo()
    )

 ?>
</div>
<?php

echo wp_kses_post( $args['after_widget'] );
