<?php
/**
 * Jobhunt functions used in content such as post, page, etc.
 *
 * @package jobhunt
 */
if ( ! function_exists( 'jobhunt_archive_page_header' ) ) {
    function jobhunt_archive_page_header() {
        ?><header class="page-header">
            <div class="page-header-inner">
                <div class="page-title-outer">
                    
                    <div class="page-title-aside"><?php 
                        do_action( 'jobhunt_page_header_aside' ); 
                    ?></div>
                </div>
            </div>
        </header><!-- .entry-header --><?php
    }
}

if ( ! function_exists( 'jobhunt_post_thumbnail' ) ) {
    /**
     * Display post thumbnail
     *
     * @var $size thumbnail size. thumbnail|medium|large|full|$custom
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @param string $size the post thumbnail size.
     * @since 1.5.0
     */
    function jobhunt_post_thumbnail( $size = 'thumbnail', $should_link = false ) {

        global $post;

        $post_thumbnail = '';

        if ( has_post_thumbnail() ) {
            $post_thumbnail = apply_filters( 'jobhunt_post_thumbnail', get_the_post_thumbnail( $post->ID, $size ) );
        } else {
            jobhunt_post_icon();
        }

        if ( ! empty( $post_thumbnail ) ) {

            if ( $should_link ) {
                $post_thumbnail = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink() ), $post_thumbnail );
            }

            echo wp_kses_post( sprintf( '<div class="post-thumbnail">%s</div>', $post_thumbnail ) );
        }
    }
}

if ( ! function_exists( 'jobhunt_post_icon' ) ) {
    function jobhunt_post_icon() {
        $enable_placeholder = apply_filters( 'jobhunt_post_placeholder_icon', false );

        if( $enable_placeholder ) {
            $post_format = get_post_format();
            $post_icon = jobhunt_get_post_icon( $post_format );
            ?><div class="post-icon"><i class="<?php echo esc_attr( $post_icon ); ?>"></i></div><?php
        }
    }
}

if( ! function_exists( 'jobhunt_post_loop_media' ) ) {
    function jobhunt_post_loop_media() {
        $blog_style = jobhunt_get_blog_style();

        if( $blog_style != 'blog-list' && $blog_style != 'blog-grid' ) {
            jobhunt_post_media_attachment();
        } else {
            $image_size = jobhunt_get_post_thumbnail_size();
            $should_link = is_single() ? false : true ;

            echo '<div class="media-attachment">';
            jobhunt_post_thumbnail( $image_size, $should_link );
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'jobhunt_post_inner' ) ) {
    function jobhunt_post_inner() {
        ?>
        <div class="post-inner">
        <?php
    }
}

if ( ! function_exists( 'jobhunt_post_inner_end' ) ) {
    function jobhunt_post_inner_end() {
        ?>
        </div>
        <?php
    }
}

if( ! function_exists( 'jobhunt_post_media_attachment' ) ) {
    /**
     * Displays the media attachment of the post
     * @since 1.0.0
     */
    function jobhunt_post_media_attachment() {

        $id = get_the_ID();
        $image_size = jobhunt_get_post_thumbnail_size();
        $should_link = is_single() ? false : true ;

        ob_start();
        jobhunt_post_thumbnail( $image_size, $should_link );
        $media_attachment = ob_get_clean();

        if( ! empty( $media_attachment ) ) {
            echo '<div class="media-attachment">' . $media_attachment . '</div>';
        }

    }
}

if ( ! function_exists( 'jobhunt_get_post_thumbnail_size' ) ) {
    /**
     * Returns post thumbnail size
     *
     * @since 1.0.0
     */
    function jobhunt_get_post_thumbnail_size() {
        $blog_style = jobhunt_get_blog_style();
        $blog_layout = jobhunt_get_blog_layout();

        if ( is_single() ) {

            $image_size = '836x340-crop';

            if( $blog_layout == 'full-width' ) {
                $image_size = 'full';
            }

        } elseif( $blog_style == 'blog-grid' ) {

            $image_size = '390x280-crop';

        } elseif( $blog_style == 'blog-list' ) {

            $image_size = '256x276-crop';

            if( $blog_layout == 'full-width' ) {
                $image_size = '390x280-crop';
            }

        } elseif( $blog_style == 'blog-default' && $blog_layout == 'full-width' ) {

            $image_size = 'full';

        } else {

            $image_size = '836x340-crop';

        }

        return $image_size;
    }
}

if ( ! function_exists( 'jobhunt_post_body_wrap_start' ) ) {
    function jobhunt_post_body_wrap_start() {
        ?>
        <div class="content-body">
        <?php
    }
}

if ( ! function_exists( 'jobhunt_post_body_wrap_end' ) ) {
    function jobhunt_post_body_wrap_end() {
        ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_comment_meta' ) ) {
    /**
     * Display the comment meta
     *
     * @since 1.0.0
     */
    function jobhunt_comment_meta() {
        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
            <span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'jobhunt' ), esc_html__( '1 comment', 'jobhunt' ), esc_html__( '% comments', 'jobhunt' ) ); ?></span>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_posted_on' ) ) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function jobhunt_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( '%s', 'post date', 'jobhunt' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo wp_kses( apply_filters( 'jobhunt_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
            'span' => array(
                'class'  => array(),
            ),
            'a'    => array(
                'href'  => array(),
                'title' => array(),
                'rel'   => array(),
            ),
            'time' => array(
                'datetime' => array(),
                'class'    => array(),
            ),
        ) );
    }
}

if ( ! function_exists( 'jobhunt_comment' ) ) {
    /**
     * jobhunt comment template
     * @since 1.0.0
     */
    function jobhunt_comment( $comment, $args, $depth ) {
        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment-meta';
        }
        ?>
        <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
            <div class="comment_container">

                <?php echo get_avatar( $comment, 100 ); ?>


                <div class="comment-text">

                    <div class="meta">

                        <strong class="woocommerce-review__author"><?php printf( '%s', get_comment_author_link() ); ?></strong>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'jobhunt' ); ?></em>

                        <?php endif; ?>

                        <?php echo '<time class="woocommerce-review__published-date" datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>

                    </div>

                    <div id="div-comment-meta-<?php comment_ID() ?>" class="comment-content">
                        <?php if ( 'div' != $args['style'] ) : ?>
                        <div class="description">
                            <?php endif; ?>

                                <?php comment_text(); ?>

                            <?php if ( 'div' != $args['style'] ) : ?>
                        </div>
                        <?php endif; ?>
                        <div class="reply">
                            <?php edit_comment_link( esc_html__( 'Edit', 'jobhunt' ), '  ', '' ); ?>
                            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                        </div>

                    </div>

                </div><!-- /.comment-text -->
            </div><!-- /.comment_container -->

    <?php
    }
}

if ( ! function_exists( 'jobhunt_post_meta' ) ) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function jobhunt_post_meta() {
        ?>
        <div class="entry-meta">
            <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search.

            jobhunt_author_info();

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'jobhunt' ) );
            if ( $tags_list && apply_filters( 'jobhunt_is_single_post_tags_list', false ) ) : ?>
                <span class="tags-links">
                    <?php
                    echo wp_kses_post( $tags_list );
                    ?>
                </span>
            <?php endif; // End if $tags_list. ?>

            <?php jobhunt_posted_on(); ?>

            <?php endif; // End if 'post' == get_post_type(). ?>

            <?php jobhunt_comment_meta(); ?>

            <?php jobhunt_post_categories(); ?>

        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_post_header' ) ) {
    /**
     * Display the post header with a link to the single post
     * @since 1.0.0
     */
    function jobhunt_post_header() { ?>
        <header class="entry-header">
        <?php
        if ( is_single() ) {
            $comments_link = '';
            ob_start();
            $comments_link = ob_get_clean();
            jobhunt_post_meta();
            the_title( '<h1 class="entry-title">', sprintf( '%s</h1>', $comments_link ) );

        } else {
            if ( 'post' == get_post_type() ) {
                jobhunt_post_meta();
            }

            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        
        }
        ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if ( ! function_exists( 'jobhunt_post_excerpt' ) ) {
    /**
     * Display the post excerpt with a link to the single post
     * @since 1.0.0
     */
    function jobhunt_post_excerpt() {
        ?>
        <div class="entry-content">

        <?php
        the_excerpt();
        wp_link_pages( array(
            'before' => '<p class="page-links"><span class="page-links-label">' . esc_html__( 'Pages:', 'jobhunt' ) . '</span>',
            'pagelink' => '<span>%</span>',
            'after'  => '</p>',
        ) );
        ?>

        </div><!-- .post-excerpt -->
        <?php
    }
}

if( ! function_exists( 'jobhunt_post_readmore' ) ) {
    /**
     * Display the loop post read more link
     * @since 1.0.0
     */
    function jobhunt_post_readmore() {
        ?>
        <div class="post-readmore"><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo apply_filters( 'jobhunt_blog_post_readmore_text', esc_html__( 'Read More', 'jobhunt' ) ); ?></a></div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_post_content' ) ) {
    /**
     * Display the post content with a link to the single post
     *
     * @since 1.0.0
     */
    function jobhunt_post_content() {
        ?>
        <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses_post( __( 'Continue reading %s', 'jobhunt' ) ),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            )
        );
        wp_link_pages( array(
            'before' => '<p class="page-links"><span class="page-links-label">' . esc_html__( 'Pages:', 'jobhunt' ) . '</span>',
            'pagelink' => '<span>%</span>',
            'after'  => '</p>',
        ) );
        ?>
        </div><!-- .entry-content -->
        <?php
    }
}


if( ! function_exists( 'jobhunt_post_loop_content' ) ) {
    function jobhunt_post_loop_content() {
        if( apply_filters( 'jobhunt_loop_post_force_excerpt', true ) ) {
            jobhunt_post_excerpt();
            jobhunt_post_readmore();
        } else {
            jobhunt_post_content();
        }
    }
}

if ( ! function_exists( 'jobhunt_post_tag_and_sharing' ) ) {
    function jobhunt_post_tag_and_sharing() {

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list();

        ob_start();
        do_action( 'jobhunt_share' );
        $share_html = ob_get_clean();
        
        if( ! empty( $tags_list ) || ! empty( $share_html ) ) {
            ?>
            <div class="tag-share">
                <?php
                if ( $tags_list && apply_filters( 'jobhunt_is_single_post_tags_list', true ) ) : ?>
                    <div class="tags-links">
                        <span class="tags-label">Tags</span>
                        <?php
                        echo wp_kses_post( $tags_list );
                        ?>
                    </div>
                <?php endif; // End if $tags_list.
                    echo wp_kses_post( $share_html );
                ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_post_categories' ) ) {
    function jobhunt_post_categories() {

        $categories_list = get_the_category_list( esc_html__( ', ', 'jobhunt' ) );
            if ( $categories_list ) : ?>
                <span class="cat-links">
                    <?php
                    echo wp_kses_post( $categories_list );
                    ?>
                </span>
            <?php endif; // End if categories. ?>
        <?php
    }
}
