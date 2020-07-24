<?php

if( ! function_exists( 'jobhunt_author_info' ) ) {
    /**
     * Display Author Info
     */
    function jobhunt_author_info() {
        if( apply_filters( 'jobhunt_show_author_info', true ) ) :
            ?>
            <div class="post-author-info">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 160 ); ?>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></h4>
                    </div>
                </div>
            </div>
            <?php
        endif;
    }
}
