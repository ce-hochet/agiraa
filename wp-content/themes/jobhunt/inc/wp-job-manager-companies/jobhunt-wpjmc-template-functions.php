<?php

if ( ! function_exists( 'jobhunt_company_posts_first_character_where_filter' ) ) {
    function jobhunt_company_posts_first_character_where_filter( $where, $query ) {
        global $wpdb;

        if ( $query->query_vars['post_type'] == 'company' ) {
            $alpha_filter = isset( $_GET['alpha'] ) ? jobhunt_clean( (string) wp_unslash( $_GET['alpha'] ) ) : jobhunt_clean( get_query_var( 'alpha' ) ); // WPCS: sanitization ok, input var ok, CSRF ok.

            if( ! empty( $alpha_filter ) ) {
                $where .= $wpdb->prepare( " AND $wpdb->posts.post_title REGEXP %s",'^'.$alpha_filter );
            }
        }

        return $where;
    }
}

if ( ! function_exists( 'jobhunt_get_company_sidebar' ) ) {
    function jobhunt_get_company_sidebar() {
        jobhunt_get_sidebar( 'company' );
    }
}

if ( ! function_exists( 'jh_wpjmc_template_redirect' ) ) {
    function jh_wpjmc_template_redirect() {
        global $wp_query, $wp;

        if ( ! empty( $_GET['page_id'] ) && '' === get_option( 'permalink_structure' ) && jh_wpjmc_get_page_id( 'companies' ) === absint( $_GET['page_id'] ) && get_post_type_archive_link( 'company' ) ) { // WPCS: input var ok, CSRF ok.

            // When default permalinks are enabled, redirect shop page to post type archive url.
            wp_safe_redirect( get_post_type_archive_link( 'company' ) );
            exit;

        }
    }
}

if ( ! function_exists( 'jobhunt_wpjmc_pagination' ) ) {
    function jobhunt_wpjmc_pagination() {
        global $wp_query;
        $total   = isset( $total ) ? $total : jh_wpjmc_get_loop_prop( 'total_pages' );
        $current = isset( $current ) ? $current : jh_wpjmc_get_loop_prop( 'current_page' );
        $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
        $format  = isset( $format ) ? $format : '';
        if ( $total <= 1 ) {
            return;
        }
        ?>
        <nav class="wpjmc-pagination">
            <?php
                echo paginate_links( apply_filters( 'jh_wpjmc_pagination_args', array( // WPCS: XSS ok.
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

if ( ! function_exists( 'jobhunt_company_listing_control_bar' ) ) {
    function jobhunt_company_listing_control_bar() {
        $style = jobhunt_get_wpjmc_style();
        if( ( $style == 'v2' ) || ( $style == 'v3' ) ) {
            do_action( 'get_jobhunt_company_listing_control_bar' );
        }
    }
}

if ( ! function_exists( 'jobhunt_template_company_modified_open_postions' ) ) {
    function jobhunt_template_company_modified_open_postions() {
        $count = get_the_company_job_listing_count();
        ?>
        <span class="open-positions">
            <?php
                echo apply_filters( 'jobhunt_template_company_modified_open_postions', esc_html( sprintf( _n( '%s Job', '%s Jobs', $count, 'jobhunt' ), $count ) ) );
            ?>
        </span>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_company_listing_control_bar_start' ) ) {
    function jobhunt_company_listing_control_bar_start() {
        echo '<div class="jh-companies-control-bar">';
    }
}

if ( ! function_exists( 'jobhunt_company_listing_control_bar_end' ) ) {
    function jobhunt_company_listing_control_bar_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_company_listing_count' ) ) {
    function jobhunt_company_listing_count() {
        $count = wp_count_posts( 'company' )->publish;
        ?><span class="total-companies-count"><?php echo apply_filters( 'jobhunt_wpjmc_listing_count', wp_kses_post( sprintf( _n( 'Total of %s Employer', 'Total of %s Employers', $count, 'jobhunt' ), $count ) ) ); ?></span><?php
    }
}

if ( ! function_exists( 'jobhunt_company_catalog_ordering' ) ) {
    function jobhunt_company_catalog_ordering() {
        if ( ! jh_wpjmc_get_loop_prop( 'is_paginated' ) || 0 >= jh_wpjmc_get_loop_prop( 'total', 0 ) ) {
            return;
        }

        $catalog_orderby_options = apply_filters( 'jobhunt_company_catalog_orderby', array(
            'date'       => esc_html__( 'New Employer', 'jobhunt' ),
            'menu_order' => esc_html__( 'Menu Order', 'jobhunt' ),
            'title-asc'  => esc_html__( 'Name: Ascending', 'jobhunt' ),
            'title-desc' => esc_html__( 'Name: Descending', 'jobhunt' ),
        ) );

        $default_orderby = jh_wpjmc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'jh_companies_default_catalog_orderby', 'date' );
        $orderby         = isset( $_GET['orderby'] ) ? jobhunt_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

        if ( jh_wpjmc_get_loop_prop( 'is_search' ) ) {
            $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'jobhunt' ) ), $catalog_orderby_options );

            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
            $orderby = current( array_keys( $catalog_orderby_options ) );
        }

        ?>
        <div class="companies-sorting">
            <label><?php echo apply_filters( 'jobhunt_companies_catalog_orderby_label', esc_html__( 'Sort by' , 'jobhunt' ) ); ?></label>
            <form method="get">
                <select name="orderby" class="orderby" onchange="this.form.submit();">
                    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                        <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="paged" value="1" />
            </form>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_company_catalog_letter_filters' ) ) {
    function jobhunt_company_catalog_letter_filters() {
        if ( ! ( is_post_type_archive( 'company' ) || is_page( jh_wpjmc_get_page_id( 'companies' ) ) ) && ! is_company_taxonomy() ) {
            return;
        }

        if ( ! jh_wpjmc_get_loop_prop( 'is_paginated' ) || 0 >= jh_wpjmc_get_loop_prop( 'total', 0 ) ) {
            return;
        }

        if( ! apply_filters( 'jobhunt_company_catalog_letter_filters_enable', jobhunt_get_wpjmc_style() == 'v2' ) ) {
            return;
        }

        if ( defined( 'COMPANIES_IS_ON_FRONT' ) ) {
            $link = home_url( '/' );
        } elseif ( is_post_type_archive( 'company' ) || is_page( jh_wpjmc_get_page_id( 'companies' ) ) ) {
            $link = get_permalink( jh_wpjmc_get_page_id( 'companies' ) );
        } else {
            $queried_object = get_queried_object();
            $link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
        }

        $link = remove_query_arg( 'alpha', $link );
        $current_value = isset( $_GET['alpha'] ) ? jobhunt_clean( wp_unslash( $_GET['alpha'] ) ) : '';

        ?>
        <div class="company-letters">
            <ul>
                <li><a href="<?php echo esc_url( $link ); ?>" class="all<?php echo esc_attr( $current_value == '' ? ' chosen' : '' ); ?>"><?php echo apply_filters( 'jobhunt_company_catalog_letter_filters_all_title', esc_html__( 'All', 'jobhunt' ) ); ?></a></li>
                <?php if( apply_filters( 'jobhunt_company_catalog_letter_filters_include_numbers', false ) ) {
                    foreach ( range( '0', '9' ) as $letter ) {
                        $link = add_query_arg( 'alpha', $letter, $link );
                        echo '<li><a href="' . esc_url( $link ) . '" class="' . esc_attr( $current_value == $letter ? 'chosen' : '' ) . '">' . esc_html( $letter ) . '</a></li>';
                    }
                } ?>
                <?php foreach ( range( 'A', 'Z' ) as $letter ) {
                    $link = add_query_arg( 'alpha', $letter, $link );
                    echo '<li><a href="' . esc_url( $link ) . '" class="' . esc_attr( $current_value == $letter ? 'chosen' : '' ) . '">' . esc_html( $letter ) . '</a></li>';
                } ?>
            </ul>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_template_company_detail_start' ) ) {
    function jobhunt_template_company_detail_start() {
        echo '<div class="company-details">';
    }
}

if ( ! function_exists( 'jobhunt_template_company_detail_end' ) ) {
    function jobhunt_template_company_detail_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_template_company_title_position_start' ) ) {
    function jobhunt_template_company_title_position_start() {
        echo '<div class="company-title-position">';
    }
}

if ( ! function_exists( 'jobhunt_template_company_title_position_end' ) ) {
    function jobhunt_template_company_title_position_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_template_company_logo' ) ) {
    function jobhunt_template_company_logo() {
        ?>
        <div class="company-logo">
            <a href="<?php the_company_permalink(); ?>">
                <?php the_company_logo(); ?>
            </a>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_template_company_title' ) ) {
    function jobhunt_template_company_title() {
        ?>
        <a class="company-name" href="<?php the_company_permalink(); ?>">
            <?php the_title(); ?>
        </a>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_template_company_open_postions' ) ) {
    function jobhunt_template_company_open_postions() {
        $style = jobhunt_get_wpjmc_style();
        $count = get_the_company_job_listing_count();
        $text = sprintf( _n( '%s Open Position', '%s Open Positions', $count, 'jobhunt' ), $count );

        if ( $style == 'v2' || $style == 'v3' ) {
            $text = sprintf( _n( '%s Job', '%s Jobs', $count, 'jobhunt' ), $count );
        }
        ?>
        <span class="open-positions">
            <?php echo apply_filters( 'jobhunt_template_company_open_postions', wp_kses_post( $text ) ); ?>
        </span>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_template_company_meta' ) ) {
    function jobhunt_template_company_meta() {
        if( ! empty(get_the_company_category())) :  ?>
            <div class="company-category"><?php the_company_category(); ?></div>
        <?php endif;
        if( ! empty(get_the_company_location())) :  ?>
            <div class="company-location-map"><i class="la la-map-marker"></i><?php the_company_location( true ); ?></div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_template_company_desc' ) ) {
    function jobhunt_template_company_desc() {
        $style  = jobhunt_get_wpjmc_style();
        if ( $style != 'v3' ) {
            if( ! empty(get_the_content())) : ?>
            <div class="company-desc">
                <?php echo wp_trim_words( get_the_content() , 24, '....' ); ?>
            </div>
            <?php endif;
        }
    }
}

if ( ! function_exists( 'jobhunt_company_video' ) ) {
    function jobhunt_company_video() {
        jobhunt_the_company_video();
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_start' ) ) {
    function jobhunt_company_details_head_start() {
        echo '<div class="single-company__head">';
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_end' ) ) {
    function jobhunt_company_details_head_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_left_start' ) ) {
    function jobhunt_company_details_head_left_start() {
        echo '<div class="company-single-head__left">';
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_left_end' ) ) {
    function jobhunt_company_details_head_left_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_right_start' ) ) {
    function jobhunt_company_details_head_right_start() {
        echo '<div class="company-single-head__right">';
    }
}

if ( ! function_exists( 'jobhunt_company_details_head_right_end' ) ) {
    function jobhunt_company_details_head_right_end() {
        echo '</div>';
    }
}

if ( ! function_exists( 'jobhunt_company_socail_network' ) ) {
    function jobhunt_company_socail_network() {
        if( ! empty( get_the_company_twitter_page() || get_the_company_facebook_page() || get_the_company_googleplus_page() || get_the_company_linkedin_page() ) ) :
            echo '<div class="social-network-pages">';
                the_company_twitter_page();
                the_company_facebook_page();
                the_company_googleplus_page();
                the_company_linkedin_page();
            echo '</div>';
        endif;
    }
}

if ( ! function_exists( 'jobhunt_company_info' ) ) {
    function jobhunt_company_info() {
        ?>
        <div class="company-logo">
            <?php the_company_logo(); ?>
        </div>
        <div class="company-info">
            <h4 class="company-name"><?php echo apply_filters( 'jobhunt_company_name', get_the_title() ); ?></h4>
            <?php if( ! empty(get_the_company_location())) :  ?>
                <div class="company-location"><i class="la la-map-marker"></i><?php the_company_location( true ); ?></div>
            <?php endif; ?>
            <?php if( ! empty(get_the_company_website_link())) :  ?>
                <span class="company-website"><i class="la la-link"></i><a href="<?php esc_url( the_company_website()); ?>" target="_blank"><?php the_company_website(); ?></a></span>
            <?php endif; ?>
            <?php if( ! empty(get_the_company_phone())) :  ?>
                <span class="company-phone"><i class="la la-phone"></i><?php the_company_phone(); ?></span>
            <?php endif; ?>
            <?php if( ! empty(get_the_company_email())) :  ?>
                <span class="company-email"><i class="la la-envelope"></i><a href="mailto:<?php esc_url( the_company_email()); ?>"><?php the_company_email(); ?></a></span>
            <?php endif;?>
            <div class="open-positions"><?php echo apply_filters( 'jobhunt_wpjmc_open_positions_info', esc_html( sprintf( _n( '%s Open Position', '%s Open Positions', get_the_company_job_listing_count(), 'jobhunt' ), get_the_company_job_listing_count() ) ) ); ?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_company_location_link' ) ) {
    function jobhunt_company_location_link() {
        $location = get_the_company_location();
        if( ! empty( $location ) ) :  ?>
            <div class="company-location-map"><i class="la la-map-marker"></i><?php echo '<a class="google_map_link company-location" href="http://maps.google.com/maps?q=' . urlencode( $location ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false">' . esc_html__( 'See On Map', 'jobhunt' ) . '</a>'; ?></div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_description' ) ) {
    function jobhunt_company_description() {
        if( ! empty( get_the_content() ) ) :  ?>
        <div id="company_description" class="company_description">
            <h2><?php echo apply_filters( 'jobhunt_company_description_title', esc_html__( 'About Business Network', 'jobhunt' ) ); ?></h2>
            <?php
                the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobhunt' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_overview' ) ) {
    function jobhunt_company_overview() {
        ?><div class="company-overview">
            <h2><?php echo apply_filters( 'jobhunt_company_overview_title', esc_html__( 'Company Information', 'jobhunt' ) ); ?></h2>
            <div class="company-overview-inner">
                <?php do_action( 'jobhunt_get_company_overview' );?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jobhunt_company_location' ) ) {
    function jobhunt_company_location() {
        if( ! empty(get_the_company_location())) :  ?>
            <div class="single-company-location">
                <i class="la la-map-marker"></i>
                <div class="single-company-location-inner">
                    <label><?php echo apply_filters( 'jobhunt_company_location_label', esc_html__( 'Locations', 'jobhunt' ) ); ?></label>
                    <div class="value"><?php the_company_location(); ?></div>
                </div>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_category' ) ) {
    function jobhunt_company_category() {
        if( ! empty(get_the_company_category())) :  ?>
            <div class="single-company-category">
                <i class="la la-files-o"></i>
                <div class="single-company-category-inner">
                    <label><?php echo apply_filters( 'jobhunt_company_category_label', esc_html__( 'Categories', 'jobhunt' ) ); ?></label>
                    <div class="company-category value"><?php the_company_category(); ?></div>
                </div>
            </div>

        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_since' ) ) {
    function jobhunt_company_since() {
        $company_since = jobhunt_get_company_since();
        if( ! empty($company_since) || apply_filters( 'jobhunt_company_show_company_publish_date_as_since', true ) ) {
            ?>
            <div class="single-company-since">
                <i class="la la-history"></i>
                <div class="single-company-since-inner">
                    <label><?php echo apply_filters( 'jobhunt_company_since_label', esc_html__( 'Since', 'jobhunt' ) ); ?></label>
                    <div class="company-publish value">
                        <?php if( $company_since ) {
                            echo wp_kses_post( $company_since );
                        } else {
                            the_date();
                        } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'jobhunt_company_teamsize' ) ) {
    function jobhunt_company_teamsize() {
        if( ! empty(get_the_company_team_size())) :  ?>
        <div class="single-company-team-size">
            <i class="la la-users"></i>
            <div class="single-company-team-size-inner">
                <label><?php echo apply_filters( 'jobhunt_company_teamsize_label', esc_html__( 'Team Size', 'jobhunt' ) ); ?></label>
                <div class="company-team-size value"><?php the_company_team_size(); ?></div>
            </div>
        </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_posted_jobs' ) ) {
    function jobhunt_company_posted_jobs() {
        if( ! empty(get_the_company_job_listing_count())) :  ?>
        <div class="single-company-posted-jobs">
            <i class="la la-file-text"></i>
            <div class="single-company-posted-jobs-inner">
                <label><?php echo apply_filters( 'jobhunt_company_posted_jobs_label', esc_html__( 'Posted Jobs', 'jobhunt' ) ); ?></label>
                <div class="company-posted-jobs value"><?php echo get_the_company_job_listing_count(); ?></div>
            </div>
        </div>
        <?php endif;
    }
}

if ( ! function_exists( 'jobhunt_company_job_listing' ) ) {
    function jobhunt_company_job_listing() {
        global $post;
        $posts = get_the_company_job_listing( $post );

        if( count( $posts ) > 0 ) {
            ?><div id="company-job_listings" class="company-job_listings"><h2><?php echo apply_filters( 'jobhunt_company_job_listing_title', esc_html__( 'Jobs From Business Network', 'jobhunt' ) ); ?></h2><ul class="job_listings list"><?php
            foreach ( $posts as $post ) :
                setup_postdata( $post );
                get_job_manager_template_part( 'content', 'job_listing' );
            endforeach;
            ?></ul></div><?php
            wp_reset_postdata();
        }
    }
}

if ( ! function_exists( 'jobhunt_no_companies_found_info' ) ) {
    function jobhunt_no_companies_found_info() {
        ?><p class="jobhunt-info no-companies-found"><?php echo apply_filters( 'jobhunt_no_companies_found_info', esc_html__( 'No companies were found matching your selection.', 'jobhunt' ) ); ?></p><?php
    }
}

if ( ! function_exists( 'jobhunt_company_contact_form' ) ) {
    function jobhunt_company_contact_form() {
        $style = jobhunt_get_wpjmc_single_style();
        if ( $style == 'v1' ) {
            $form_id = get_option( 'job_manager_single_company_contact_form' );
            if ( ! empty( $form_id ) ) {
                $shortcode = sprintf( '[contact-form-7 id="%1$d" title="%2$s"]', $form_id, get_the_title( $form_id ) );
                echo '<div class="contact-form contact-employer">';
                echo '<h5 class="contact-form-title">' . apply_filters( 'jobhunt_company_contact_form_title', esc_html__( 'Contact Business Network' , 'jobhunt' ) ) . '</h5>';
                echo '<div class="contact-employer-inner">';
                echo do_shortcode( $shortcode );
                echo '</div>';
                echo '</div>';
            }
        }
    }
}
