<?php

if ( ! function_exists( 'jobhunt_get_resume_sidebar' ) ) {
    function jobhunt_get_resume_sidebar() {
        jobhunt_get_sidebar( 'resume' );
    }
}

add_action( 'template_redirect', 'jh_wpjmr_template_redirect' );

function jh_wpjmr_template_redirect() {
    global $wp_query, $wp;

    if ( ! empty( $_GET['page_id'] ) && '' === get_option( 'permalink_structure' ) && jh_wpjmr_get_page_id( 'resume' ) === absint( $_GET['page_id'] ) && get_post_type_archive_link( 'resume' ) ) { // WPCS: input var ok, CSRF ok.

        // When default permalinks are enabled, redirect shop page to post type archive url.
        wp_safe_redirect( get_post_type_archive_link( 'resume' ) );
        exit;

    }
}

if ( ! function_exists( 'jobhunt_wpjmr_pagination' ) ) {
    function jobhunt_wpjmr_pagination() {
        global $wp_query;
        $total   = isset( $total ) ? $total : jh_wpjmr_get_loop_prop( 'total_pages' );
        $current = isset( $current ) ? $current : jh_wpjmr_get_loop_prop( 'current_page' );
        $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
        $format  = isset( $format ) ? $format : '';
        if ( $total <= 1 ) {
            return;
        }
        ?>
        <nav class="wpjmr-pagination">
            <?php
                echo paginate_links( apply_filters( 'jh_wpjmr_pagination_args', array( // WPCS: XSS ok.
                    'base'         => $base,
                    'format'       => $format,
                    'add_args'     => false,
                    'current'      => max( 1, $current ),
                    'total'        => $total,
                    'prev_text'    => is_rtl() ? '&rarr;' : '&larr;',
                    'next_text'    => is_rtl() ? '&larr;' : '&rarr;',
                    'type'         => 'list',
                    'end_size'     => 3,
                    'mid_size'     => 3,
                ) ) );
            ?>
        </nav><?php
    }
}

if ( ! function_exists( 'jobhunt_template_candidate_detail_start' ) ) {
    function jobhunt_template_candidate_detail_start() {
        echo '<div class="candidate-details">';
    }
}

if ( ! function_exists( 'jobhunt_template_candidate_detail_end' ) ) {
    function jobhunt_template_candidate_detail_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'single_resume_head_start' ) ) {
    function single_resume_head_start() {
        $bg_url = jobhunt_get_wpjmr_header_bg_img();
        $bg_img = ! empty( $bg_url ) ? 'background-image: url(' . esc_url( $bg_url ) . ');' : '';
        ?><div class="single-resume-head" <?php if ( ! empty( $bg_img ) ) : ?>style="<?php echo esc_attr( $bg_img );?>"<?php endif; ?>>
        <?php echo '<div class="single-resume-head-inner">';
    }
}

if ( ! function_exists( 'single_resume_head_end' ) ) {
    function single_resume_head_end() {
        echo '</div></div>';
    }
}

if ( ! function_exists( 'single_resume_head_left_start' ) ) {
    function single_resume_head_left_start() {
        echo '<div class="single-candidate-head-left">';
    }
}

if ( ! function_exists( 'single_resume_head_left_end' ) ) {
    function single_resume_head_left_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'single_resume_head_right_start' ) ) {
    function single_resume_head_right_start() {
        echo '<div class="single-candidate-head-right">';
    }
}

if ( ! function_exists( 'single_resume_head_right_end' ) ) {
    function single_resume_head_right_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'single_resume_head_center_start' ) ) {
    function single_resume_head_center_start() {
        echo '<div class="single-candidate-details">';
    }
}

if ( ! function_exists( 'single_resume_head_center_end' ) ) {
    function single_resume_head_center_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_navbar_start' ) ) {
    function jobhunt_single_candidate_content_navbar_start() {
        echo '<div id="single-resume-content-navbar-tabs" class="single-resume-content-navbar"><div class="single-resume-content-navbar-inner jobhunt-stick-this">';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_navbar_end' ) ) {
    function jobhunt_single_candidate_content_navbar_end() {
        echo '</div></div>';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_area_start' ) ) {
    function jobhunt_single_candidate_content_area_start() {
        echo '<div class="single-resume__content-area">';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_area_end' ) ) {
    function jobhunt_single_candidate_content_area_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_sidebar_area_start' ) ) {
    function jobhunt_single_candidate_sidebar_area_start() {
        echo '<div class="single-resume__sidebar-area">';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_sidebar_area_end' ) ) {
    function jobhunt_single_candidate_sidebar_area_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jh_wpjmr_single_modify_head_hook' ) ) {
    function jh_wpjmr_single_modify_head_hook() {

        $style  = jobhunt_get_wpjmr_single_style();

        if ( $style == 'v2' ) {
            remove_action( 'single_resume_head', 'jobhunt_resume_category', 20 );
            remove_action( 'single_resume_head', 'jobhunt_candidate_location_published_start', 90 );
            remove_action( 'single_resume_head', 'jobhunt_candidate_profle_published', 110 );
            remove_action( 'single_resume_head', 'jobhunt_candidate_location_published_end', 120 );
            remove_action( 'single_resume_sidebar', 'jobhunt_single_candidate_contact_form', 30 );
            add_action( 'single_resume_head', 'jobhunt_candidate_profle_published', 60 );
            add_action( 'single_resume_head', 'jobhunt_resume_category', 60 );
            add_action( 'single_resume_content_navbar', 'jobhunt_single_candidate_content_navbar_contact', 20);
        }

        if ( jobhunt_is_wp_job_manager_bookmark_activated() ) {
            global $job_manager_bookmarks;
            remove_action( 'single_resume_start', array( $job_manager_bookmarks, 'bookmark_form' ) );

            if ( $style == 'v1' ) {
                add_action( 'single_resume_sidebar', array( $job_manager_bookmarks, 'bookmark_form' ), 15 );
            } elseif ( $style == 'v2' ) {
                add_action( 'single_resume_content_navbar', array( $job_manager_bookmarks, 'bookmark_form' ), 15);
            }
        }

    }
}

if ( ! function_exists( 'jobhunt_template_candidate_image' ) ) {
    function jobhunt_template_candidate_image() {
        ?>
        <div class="candidate-image">
            <a href="<?php the_resume_permalink(); ?>">
                <?php the_candidate_photo(); ?>
            </a>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_template_candidate_info' ) ) {
    function jobhunt_template_candidate_info() {
        ?>
        <a href="<?php the_resume_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
        <div class="candidate-title">
            <?php the_candidate_title( '<strong>', '</strong> ' ); ?>
        </div>
        <?php if( ! empty( get_the_candidate_location() ) ) :  ?>
            <div class="location"><i class="la la-map-marker"></i><?php the_candidate_location(); ?></div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_template_candidate_view' ) ) {
    function jobhunt_template_candidate_view() {
        global $post;
        $post = get_post( $post );
        ?>
        <div class="view-resume-action">
            <a href="<?php the_resume_permalink(); ?>"><?php echo esc_html__( 'View Resume', 'jobhunt' ); ?><i class="fas fa-file-alt"></i></a>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_candidate_socail_network' ) ) {
    function jobhunt_candidate_socail_network() {
        if( ! empty( get_the_candidate_twitter_page() || get_the_candidate_facebook_page() || get_the_candidate_googleplus_page() || get_the_candidate_linkedin_page() || get_the_candidate_instagram_page() || get_the_candidate_youtube_page() || get_the_candidate_behance_page() || get_the_candidate_pinterest_page() || get_the_candidate_github_page() ) ) :
            echo '<div class="social-network-pages">';
                do_action( 'get_jobhunt_candidate_socail_network' );
            echo '</div>';
        endif;
    }
}

if ( ! function_exists( 'jobhunt_resume_category' ) ) {
    function jobhunt_resume_category() {
        global $post;
        $post = get_post( $post );
        if ( $post->post_type !== 'resume' )
            return '';

        if ( ! get_option( 'resume_manager_enable_categories' ) )
            return '';

        $categories = wp_get_object_terms( $post->ID, 'resume_category');

        if ( is_wp_error( $categories ) ) {
            return '';
        }

        echo '<ul class="categories">';
        foreach ( $categories as $category ) {
            echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
        }
        echo '</ul>';
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_navbar_links' ) ) {
    function jobhunt_single_candidate_content_navbar_links() {
        global $post;
        if( ! empty( get_the_content() || get_post_meta( $post->ID, '_candidate_education', true ) || get_post_meta( $post->ID, '_candidate_experience', true ) || get_post_meta( $post->ID, '_candidate_awards', true ) || (( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills )) || get_the_candidate_video() ) ) {
            echo '<ul class="nav navbar-links">';
                if( ! empty( get_the_content() ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-description"><i class="la la-briefcase"></i><?php esc_html_e( 'Candidate About', 'jobhunt' ); ?></a></li>
                <?php endif;
                if( ! empty( get_post_meta( $post->ID, '_candidate_education', true ) ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-qualification"><i class="la la-graduation-cap"></i><?php esc_html_e( 'Education', 'jobhunt' ); ?></a></li>
                <?php endif;
                if( ! empty( get_post_meta( $post->ID, '_candidate_experience', true ) ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-experience"><i class="la la-area-chart"></i><?php esc_html_e( 'Work Experience', 'jobhunt' ); ?></a></li>
                <?php endif;
                if( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-skills"><i class="la la-lightbulb-o"></i><?php esc_html_e( 'Professional Skills', 'jobhunt' ); ?></a></li>
                <?php endif;
                if( ! empty( get_post_meta( $post->ID, '_candidate_awards', true ) ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-awards"><i class="la la-certificate"></i><?php esc_html_e( 'Awards', 'jobhunt' ); ?></a></li>
                <?php endif;
                if( ! empty( get_the_candidate_video() ) ) :  ?>
                    <li class="nav-item navbar-link"><a class="nav-link" href="#candidate-video"><i class="la la-file-movie-o"></i><?php esc_html_e( 'Candidate Video', 'jobhunt' ); ?></a></li>
                <?php endif;
            echo '</ul>';
        }
    }
}

if ( ! function_exists( 'jobhunt_candidate_info' ) ) {
    function jobhunt_candidate_info() {
        global $post;
        ?>
        <div class="candidate-info">
            <div class="candidate-image">
                <?php the_candidate_photo(); ?>
            </div>
            <h4 class="candidate-name"><?php echo apply_filters( 'jobhunt_candidate_name', get_the_title() ); ?></h4>
            <p class="job-title"><?php echo apply_filters( 'jobhunt_candidate_title', get_the_candidate_title() ); ?></p>
            <?php if( get_post_meta( $post->ID, '_candidate_email', true ) ) : ?>
                <p class="candidate-e-mail"><a href="mailto:<?php echo get_post_meta( $post->ID, '_candidate_email', true ); ?>"><i class="la la-envelope"></i><?php echo get_post_meta( $post->ID, '_candidate_email', true ); ?></a></p>
            <?php endif;
            jobhunt_the_resume_links(); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_candidate_location_published_start' ) ) {
    function jobhunt_candidate_location_published_start() {
        global $post;
        if( ! empty( get_the_candidate_location() ) ) :
            echo '<div class="candidate-location-published">';
        endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_location' ) ) {
    function jobhunt_candidate_location() {
        global $post;
        if( ! empty( get_the_candidate_location() ) ) : ?>
            <div class="location"><i class="la la-map-marker"></i><?php the_candidate_location(); ?></div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_profle_published' ) ) {
    function jobhunt_candidate_profle_published() {
        global $post;
        ?>
        <div class="published-date"><i class="la la-history"></i><?php  printf( '%s %s', esc_html__( 'Member Since ', 'jobhunt' ) , get_the_date('Y')); ?></div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_candidate_location_published_end' ) ) {
    function jobhunt_candidate_location_published_end() {
        global $post;
        if( ! empty( get_the_candidate_location() ) ) :
            echo '</div>';
        endif;
    }
}

if ( ! function_exists( 'jobhunt_the_resume_file' ) ) {
    function jobhunt_the_resume_file() {
        global $post;
        $resume_files = get_post_meta( $post->ID, '_resume_file', true );
        if ( ! empty( $resume_files ) && apply_filters( 'resume_manager_user_can_download_resume_file', true, $post->ID ) ) {
            echo '<div class="candidate-resume">';
            $resume_files = is_array( $resume_files ) ? $resume_files : array( $resume_files );
            foreach ( $resume_files as $key => $resume_file ) : ?>
                <a rel="nofollow" target="_blank" href="<?php echo esc_url( get_resume_file_download_url( null, $key ) ); ?>"><?php echo esc_html__( 'Download CV', 'jobhunt' ); ?><i class="la la-download"></i></a>
            <?php endforeach;
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'jobhunt_the_resume_links' ) ) {
    function jobhunt_the_resume_links() {
        global $post;
        if ( resume_has_links() ) : ?>
            <ul class="resume-links">
                <?php foreach( get_resume_links() as $link ) : ?>
                    <?php get_job_manager_template( 'content-resume-link.php', array( 'post' => $post, 'link' => $link ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_description' ) ) {
    function jobhunt_candidate_description() {
        if( ! empty( get_the_content() ) ) :  ?>
            <div id="candidate-description" class="candidate-description">
                <h2><?php esc_html_e( 'Candidates About', 'jobhunt' ); ?></h2>
                <?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_qualification' ) ) {
    function jobhunt_candidate_qualification() {
        global $post;
        if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
            <div id="candidate-qualification" class="candidate-qualification">
                <h2><?php esc_html_e( 'Education', 'jobhunt' ); ?></h2>
                <dl class="resume-manager-education">
                <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                            <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
                            <div class="timeline-title"><?php printf( '%s %s', '<strong class="location">' . esc_html( $item['location'] ) . '</strong>', '<span class="qualification">' . esc_html( $item['qualification'] ) . '</span>' ); ?></div>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                ?>
                </dl>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_experience' ) ) {
    function jobhunt_candidate_experience() {
        global $post;
        if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
            <div id="candidate-experience" class="candidate-experience">
                <h2><?php esc_html_e( 'Work & Experience', 'jobhunt' ); ?></h2>
                <dl class="resume-manager-experience">
                <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                            <div class="timeline-title"><?php printf( '%s %s', '<strong class="job_title">' . esc_html( $item['job_title'] ) . '</strong>', '<span class="employer">' . esc_html( $item['employer'] ) . '</span>' ); ?></div>
                            <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                ?>
                </dl>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_awards' ) ) {
    function jobhunt_candidate_awards() {
        global $post;
        if ( $items = get_post_meta( $post->ID, '_candidate_awards', true ) ) : ?>
            <div id="candidate-awards" class="candidate-awards">
                <h2><?php esc_html_e( 'Awards', 'jobhunt' ); ?></h2>
                <dl class="resume-manager-awards">
                <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                            <div class="timeline-title"><?php echo '<strong class="award-title">' . esc_html( $item['award_title'] ) . '</strong>' ; ?></div>
                            <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                ?>
                </dl>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_skill' ) ) {
    function jobhunt_candidate_skill() {
        global $post;
        if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills ) ) : ?>
            <div id="candidate-skills" class="candidate-skills">
                <h2><?php esc_html_e( 'Professional Skills', 'jobhunt' ); ?></h2>
                <ul class="resume-manager-skills">
                    <?php echo '<li>' . implode( '</li><li>', $skills ) . '</li>'; ?>
                </ul>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_candidate_contact' ) ) {
    function jobhunt_candidate_contact() {
        global $post;
        get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );
    }
}

if ( ! function_exists( 'jobhunt_candidate_video' ) ) {
    function jobhunt_candidate_video() {
        if( ! empty( get_the_candidate_video() ) ) :  ?>
            <div id="candidate-video" class="candidate-video">
                <h2><?php esc_html_e( 'Candidates Video', 'jobhunt' ); ?></h2>
                <?php echo apply_filters( 'the_candidate_video', the_candidate_video() ); ?>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_overview' ) ) {
    function jobhunt_single_candidate_overview() {
        get_job_manager_template( 'resume-overview.php', array(), 'wp-job-manager-resumes' );
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_contact_form' ) ) {
    function jobhunt_single_candidate_contact_form() {
        $form_id = get_option ( 'resume_manager_single_resume_contact_form' );
        if ( ! empty( $form_id ) ) {
            if ( function_exists( 'wpforms' ) ) {
                $shortcode = sprintf( '[wpforms id="%1$d" title="%2$s" description="false"]', $form_id, get_the_title( $form_id ) );
                echo '<div class="contact-form contact-candidate">';
                echo '<h5 class="contact-form-title">' . esc_html__( 'Contact' , 'jobhunt' ) . '</h5>';
                echo '<div class="contact-candidate-inner">';
                echo do_shortcode( $shortcode );
                echo '</div>';
                echo '</div>';
            } elseif ( function_exists( 'wpcf7' ) ) {
                $shortcode = sprintf( '[contact-form-7 id="%1$d" title="%2$s"]', $form_id, get_the_title( $form_id ) );
                echo '<div class="contact-form contact-candidate">';
                echo '<h5 class="contact-form-title">' . esc_html__( 'Contact' , 'jobhunt' ) . '</h5>';
                echo '<div class="contact-candidate-inner">';
                echo do_shortcode( $shortcode );
                echo '</div>';
                echo '</div>';
            }
        }
    }
}

if ( ! function_exists( 'jobhunt_form_preview_resume_remove_contact_form' ) ) {
    function jobhunt_form_preview_resume_remove_contact_form() {
        remove_action( 'single_resume_sidebar', 'jobhunt_single_candidate_contact_form', 30 );
    }
}

if ( ! function_exists( 'jobhunt_single_candidate_content_navbar_contact' ) ) {
    function jobhunt_single_candidate_content_navbar_contact() {
        global $post;
        $post = get_post( $post );
        $email = get_post_meta( $post->ID, '_candidate_email', true );
        $style = jobhunt_get_wpjmr_single_style();
        if ( $style == 'v2' && $email ) {
            ?>
            <div class="contact-candidate-email">
                <a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><i class="la la-envelope"></i><?php echo esc_html__( 'Contact ' , 'jobhunt' ) . get_the_title(); ?></a>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_no_resumes_found_info' ) ) {
    function jobhunt_no_resumes_found_info() {
        ?><p class="jobhunt-info no-resumes-found"><?php echo apply_filters( 'jobhunt_no_resumes_found_info', esc_html__( 'No resumes were found matching your selection.', 'jobhunt' ) ); ?></p><?php
    }
}
