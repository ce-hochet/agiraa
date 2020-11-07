<?php

if ( ! function_exists( 'jobhunt_wpjmc_page_title' ) ) {
    function jobhunt_wpjmc_page_title( $title ) {
        if( is_post_type_archive( 'company' ) ) {
            $title = esc_html__( 'Companies', 'jobhunt' );
        } elseif ( is_singular( 'company' ) ) {
            $title = single_post_title( '', false );
        } elseif ( is_tax( get_object_taxonomies( 'company' ) ) ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }
}

if ( ! function_exists( 'jobhunt_wpjmc_page_subtitle' ) ) {
    function jobhunt_wpjmc_page_subtitle( $subtitle ) {
        if( is_post_type_archive( 'company' ) ) {
            $subtitle = '';
        } elseif ( is_singular( 'company' ) ) {
            $subtitle = '';
        }

        return $subtitle;
    }
}

/**
 * Output the class
 *
 * @param string $class (default: '')
 * @param mixed $post_id (default: null)
 * @return void
 */
if ( ! function_exists( 'company_class' ) ) {
    function company_class( $class = '', $post_id = null ) {
        echo 'class="' . join( ' ', get_company_class( $class, $post_id ) ) . '"';
    }
}

/**
 * Get the class
 *
 * @access public
 * @return array
 */
if ( ! function_exists( 'get_company_class' ) ) {
    function get_company_class( $class = '', $post_id = null ) {
        $post = get_post( $post_id );
        if ( $post->post_type !== 'company' )
            return array();

        $classes = array();

        if ( empty( $post ) ) {
            return $classes;
        }

        $classes[] = 'company';

        if ( is_company_featured( $post ) ) {
            $classes[] = 'company_featured';
        }

        return get_post_class( $classes, $post->ID );
    }
}

/**
 * Echo the location for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_location' ) ) {
    function the_company_location( $map_link = true, $post = null ) {
        $location = get_the_company_location( $post );

        if ( $location ) {
            if ( $map_link )
                echo apply_filters( 'the_company_location_map_link', '<a class="google_map_link company-location" href="http://maps.google.com/maps?q=' . urlencode( $location ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false">' . $location . '</a>', $location, $post );
            else
                echo '<span class="company-location">' . $location . '</span>';
        }
    }
}

/**
 * Get the location for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_location' ) ) {
    function get_the_company_location( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        return apply_filters( 'the_company_location', $post->_company_location, $post );
    }
}


/**
 * Output the company permalinks
 *
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_permalink' ) ) {
    function the_company_permalink( $post = null ) {
        echo esc_url( get_the_company_permalink( $post ) );
    }
}

/**
 * Get the company permalinks
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_permalink' ) ) {
    function get_the_company_permalink( $post = null ) {
        $post = get_post( $post );
        $link = get_permalink( $post );

        return apply_filters( 'the_company_permalink', $link, $post );
    }
}

/**
 * Output the category
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_category' ) ) {
    function the_company_category( $post = null ) {
        $categories = get_the_company_category( $post );
        if( ! empty( $categories )) {
            echo '<ul class="categories">';
            foreach( $categories as $category ) {
                echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
            }
            echo '</ul>';
        }
    }
}

/**
 * Get the category
 * @param WP_Post|int $post (default: null)
 * @return  string
 */
if ( ! function_exists( 'get_the_company_category' ) ) {
    function get_the_company_category( $post = null ) {
        global $post;
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return '';

        $categories = wp_get_object_terms( $post->ID, 'company_category');

        if ( is_wp_error( $categories ) ) {
            return '';
        }

        return apply_filters( 'the_company_category', $categories, $post );
    }
}

/**
 * Output the company_team_size
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_team_size' ) ) {
    function the_company_team_size( $post = null ) {
        $teams = get_the_company_team_size( $post );
        if ( $teams ) {
            $names = wp_list_pluck( $teams, 'name' );

            echo esc_html( implode( ', ', $names ) );
        }
    }
}

/**
 * Get the company_team_size
 * @param WP_Post|int $post (default: null)
 * @return  string
 */
if ( ! function_exists( 'get_the_company_team_size' ) ) {
    function get_the_company_team_size( $post = null ) {
        global $post;
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return '';

        $teams = wp_get_object_terms( $post->ID, 'company_team_size');

        if ( is_wp_error( $teams ) ) {
            return '';
        }

        return apply_filters( 'the_company_team_size', $teams, $post );
    }
}

/**
 * Echo the website for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_website' ) ) {
    function the_company_website( $post = null ) {
        echo get_the_company_website_link( $post );
    }
}

/**
 * Displays the company video.
 *
 * @since 1.14.0
 * @param int|WP_Post $post
 */
if ( ! function_exists( 'jobhunt_the_company_video' ) ) {
    function jobhunt_the_company_video( $post = null ) {
        $video_embed = false;
        $video       = jobhunt_get_the_company_video( $post );
        $filetype    = wp_check_filetype( $video );

        if ( ! empty( $video ) ) {
            // FV WordPress Flowplayer Support for advanced video formats.
            if ( shortcode_exists( 'flowplayer' ) ) {
                $video_embed = '[flowplayer src="' . esc_url( $video ) . '"]';
            } elseif ( ! empty( $filetype['ext'] ) ) {
                $video_embed = wp_video_shortcode( array( 'src' => $video ) );
            } else {
                $video_embed = wp_oembed_get( $video );
            }
        }

        $video_embed = apply_filters( 'the_company_video_embed', $video_embed, $post );

        if ( $video_embed ) {
            echo '<div class="company_video">' . $video_embed . '</div>'; // WPCS: XSS ok.
        }
    }
}

/**
 * Gets the company video URL.
 *
 * @since 1.14.0
 * @param int|WP_Post $post (default: null).
 * @return string|null
 */
if ( ! function_exists( 'jobhunt_get_the_company_video' ) ) {
    function jobhunt_get_the_company_video( $post = null ) {
        $post = get_post( $post );
        if ( ! $post || 'company' !== $post->post_type ) {
            return null;
        }
        return apply_filters( 'jobhunt_the_company_video', $post->_company_video, $post );
    }
}

/**
 * Get the website for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_website_link' ) ) {
    function get_the_company_website_link( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        $website = $post->_company_website;

        if ( $website && ! strstr( $website, 'http:' ) && ! strstr( $website, 'https:' ) ) {
            $website = 'http://' . $website;
        }

        return apply_filters( 'the_company_website_link', $website, $post );
    }
}

/**
 * Echo the phone for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_phone' ) ) {
    function the_company_phone( $post = null ) {
        echo get_the_company_phone( $post );
    }
}

/**
 * Get the phone for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_phone' ) ) {
    function get_the_company_phone( $post = null , $post_type = 'company' ) {
        $post = get_post( $post );
        if ( $post->post_type !== $post_type )
            return;

        return apply_filters( 'the_company_phone', $post->_company_phone, $post );
    }
}

/**
 * Echo the email for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_email' ) ) {
    function the_company_email( $post = null ) {
        echo get_the_company_email( $post );
    }
}

/**
 * Get the email for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_email' ) ) {
    function get_the_company_email( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        return apply_filters( 'the_company_email', $post->_company_email, $post );
    }
}

/**
 * Echo the twitter page for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_twitter_page' ) ) {
    function the_company_twitter_page( $post = null ) {
        if ( ! empty( get_the_company_twitter_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_company_twitter_page( $post ) ) . '" class="company-twitter"><i class="fab fa-twitter"></i></a>';
        }
    }
}

/**
 * Get the twitter page for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_twitter_page' ) ) {
    function get_the_company_twitter_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        if ( $post->_company_twitter && ! strstr( $post->_company_twitter, 'http:' ) && ! strstr( $post->_company_twitter, 'https:' ) ) {
            $post->_company_twitter = 'https://' . $post->_company_twitter;
        }

        return apply_filters( 'the_company_twitter_page', $post->_company_twitter, $post );
    }
}

/**
 * Echo the facebook page for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_facebook_page' ) ) {
    function the_company_facebook_page( $post = null ) {
        if ( ! empty( get_the_company_facebook_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_company_facebook_page( $post ) ) . '" class="company-facebook"><i class="fab fa-facebook-f"></i></a>';
        }
    }
}

/**
 * Get the facebook page for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_facebook_page' ) ) {
    function get_the_company_facebook_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        if ( $post->_company_facebook && ! strstr( $post->_company_facebook, 'http:' ) && ! strstr( $post->_company_facebook, 'https:' ) ) {
            $post->_company_facebook = 'https://' . $post->_company_facebook;
        }

        return apply_filters( 'the_company_facebook_page', $post->_company_facebook, $post );
    }
}

/**
 * Echo the googleplus page for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_googleplus_page' ) ) {
    function the_company_googleplus_page( $post = null ) {
        if ( ! empty( get_the_company_googleplus_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_company_googleplus_page( $post ) ) . '" class="company-google-plus"><i class="fab fa-google"></i></a>';
        }
    }
}

/**
 * Get the googleplus page for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_googleplus_page' ) ) {
    function get_the_company_googleplus_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        if ( $post->_company_googleplus && ! strstr( $post->_company_googleplus, 'http:' ) && ! strstr( $post->_company_googleplus, 'https:' ) ) {
            $post->_company_googleplus = 'https://' . $post->_company_googleplus;
        }

        return apply_filters( 'the_company_googleplus_page', $post->_company_googleplus, $post );
    }
}

/**
 * Echo the linkedin page for a company
 * @param  boolean $map_link whether or not to link to the map on google maps
 * @param WP_Post|int $post (default: null)
 */
if ( ! function_exists( 'the_company_linkedin_page' ) ) {
    function the_company_linkedin_page( $post = null ) {
        if ( ! empty( get_the_company_linkedin_page( $post ) ) ) {
            echo '<a href="' . esc_url( get_the_company_linkedin_page( $post ) ) . '" class="company-linkedin"><i class="fab fa-linkedin-in"></i></a>';
        }
    }
}

/**
 * Get the linkedin page for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'get_the_company_linkedin_page' ) ) {
    function get_the_company_linkedin_page( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        if ( $post->_company_linkedin && ! strstr( $post->_company_linkedin, 'http:' ) && ! strstr( $post->_company_linkedin, 'https:' ) ) {
            $post->_company_linkedin = 'https://' . $post->_company_linkedin;
        }

        return apply_filters( 'the_company_linkedin_page', $post->_company_linkedin, $post );
    }
}

/**
 * Get the since for a company
 *
 * @param WP_Post|int $post (default: null)
 * @return string
 */
if ( ! function_exists( 'jobhunt_get_company_since' ) ) {
    function jobhunt_get_company_since( $post = null ) {
        $post = get_post( $post );
        if ( $post->post_type !== 'company' )
            return;

        return apply_filters( 'jobhunt_get_company_since', $post->_company_since, $post );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmc_style' ) ) {
    function jobhunt_get_wpjmc_style() {
        $style = get_option( 'job_manager_companies_listing_style' );
        return apply_filters( 'jobhunt_get_wpjmc_companies_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmc_sidebar_style' ) ) {
    function jobhunt_get_wpjmc_sidebar_style() {
        $layout = get_option( 'job_manager_companies_listing_sidebar' );
        return apply_filters( 'jobhunt_get_wpjmc_companies_layout', $layout );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmc_single_style' ) ) {
    function jobhunt_get_wpjmc_single_style() {
        $style = get_option( 'job_manager_single_company_style' );
        return apply_filters( 'jobhunt_get_wpjmc_company_single_style', $style );
    }
}

if ( ! function_exists( 'jobhunt_get_wpjmc_header_bg_img' ) ) {
    function jobhunt_get_wpjmc_header_bg_img() {
        $bg_url = '';
        $companies_page_id = jh_wpjmc_get_page_id( 'companies' );
        if( has_post_thumbnail( $companies_page_id ) ) {
            $bg_url = get_the_post_thumbnail_url( $companies_page_id, 'full' );
        }

        return apply_filters( 'jobhunt_get_wpjmc_header_bg_img', $bg_url );
    }
}
