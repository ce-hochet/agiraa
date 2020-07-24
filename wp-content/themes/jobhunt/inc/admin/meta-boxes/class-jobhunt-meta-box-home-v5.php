<?php
/**
 * Home v5 Metabox
 *
 * Displays the home v5 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Jobhunt_Meta_Box_Home_v5 Class.
 */
class Jobhunt_Meta_Box_Home_v5 {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output( $post ) {
        global $post, $thepostid;

        wp_nonce_field( 'jobhunt_save_data', 'jobhunt_meta_nonce' );

        $thepostid      = $post->ID;
        $template_file  = get_post_meta( $thepostid, '_wp_page_template', true );

        if ( $template_file !== 'template-homepage-v5.php' ) {
            return;
        }

        self::output_home_v5( $post );
    }

    private static function output_home_v5( $post ) {

        $home_v5 = jobhunt_get_home_v5_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs jh-tabs">
            <?php
                $product_data_tabs = apply_filters( 'jobhunt_home_v5_data_tabs', array(
                    'general' => array(
                        'label'  => esc_html__( 'General', 'jobhunt' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'job_categories_block' => array(
                        'label'  => esc_html__( 'Job Categories', 'jobhunt' ),
                        'target' => 'job_categories_block',
                        'class'  => array(),
                    ),
                    'job_with_summary' => array(
                        'label'  => esc_html__( 'Job With Summary', 'jobhunt' ),
                        'target' => 'job_with_summary',
                        'class'  => array(),
                    ),
                    'dual_banner' => array(
                        'label'  => esc_html__( 'Dual Banner', 'jobhunt' ),
                        'target' => 'dual_banner',
                        'class'  => array(),
                    ),
                    'how_it_works_block' => array(
                        'label'  => esc_html__( 'How It Works Block', 'jobhunt' ),
                        'target' => 'how_it_works_block',
                        'class'  => array(),
                    ),
                    'counters_block' => array(
                        'label'  => esc_html__( 'Counters Block', 'jobhunt' ),
                        'target' => 'counters_block',
                        'class'  => array(),
                    ),
                    'faq_with_testimonial_block' => array(
                        'label'  => esc_html__( 'Faq with Testimonials Block', 'jobhunt' ),
                        'target' => 'faq_with_testimonial_block',
                        'class'  => array(),
                    ),
                    'banner_with_image_block' => array(
                        'label'  => esc_html__( 'Banner with Image Block', 'jobhunt' ),
                        'target' => 'banner_with_image_block',
                        'class'  => array(),
                    ),
                ) );
                foreach ( $product_data_tabs as $key => $tab ) {
                    ?><li class="<?php echo esc_attr( $key ); ?>_options <?php echo esc_attr( $key ); ?>_tab <?php echo implode( ' ' , $tab['class'] ); ?>">
                        <a href="#<?php echo esc_attr( $tab['target'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
                    </li><?php
                }
                do_action( 'jobhunt_home_write_panel_tabs' );
            ?>
            </ul>
            
            <div id="general_block" class="panel jobhunt_options_panel">
                <div class="options_group">
                    <?php 
                        jobhunt_wp_select( array(
                            'id'        => '_home_v5_header_style',
                            'label'     => esc_html__( 'Header Style', 'jobhunt' ),
                            'name'      => '_home_v5[header_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Header v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Header v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Header v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Header v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Header v5', 'jobhunt' )
                            ),
                            'value'     => isset(  $home_v5['header_style'] ) ?  $home_v5['header_style'] : 'v5',
                        ) );
                    ?>
                </div>
                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][section_title]',
                        'value'         => isset( $home_v5['hsb']['section_title'] ) ? $home_v5['hsb']['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][sub_title]',
                        'value'         => isset( $home_v5['hsb']['sub_title'] ) ? $home_v5['hsb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_search_placeholder_text', 
                        'label'         => esc_html__( 'Search Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][search_placeholder_text]',
                        'value'         => isset( $home_v5['hsb']['search_placeholder_text'] ) ? $home_v5['hsb']['search_placeholder_text'] : esc_html__( 'Search Keywords', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_location_placeholder_text', 
                        'label'         => esc_html__( 'Location Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Location Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][location_placeholder_text]',
                        'value'         => isset( $home_v5['hsb']['location_placeholder_text'] ) ? $home_v5['hsb']['location_placeholder_text'] : esc_html__( 'Locations', 'jobhunt' ),
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v5_hsb_show_category_select',
                        'label'         => esc_html__( 'Show Categories Select', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][show_category_select]',
                        'value'         => isset( $home_v5['hsb']['show_category_select'] ) ? $home_v5['hsb']['show_category_select'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_category_select_text', 
                        'label'         => esc_html__( 'All Categories Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the All Categories Text here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][category_select_text]',
                        'value'         => isset( $home_v5['hsb']['category_select_text'] ) ? $home_v5['hsb']['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hsb_search_button_icon', 
                        'label'         => esc_html__( 'Search Button Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Button Icon here', 'jobhunt' ),
                        'name'          => '_home_v5[hsb][search_button_icon]',
                        'value'         => isset( $home_v5['hsb']['search_button_icon'] ) ? $home_v5['hsb']['search_button_icon'] : 'la la-search',
                    ) );

                ?>
                </div>
                <div class="options_group">
                    <?php 
                        $home_v5_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'jobhunt' ),
                            'jcb'   => esc_html__( 'Job Categories Block', 'jobhunt' ),
                            'jws'   => esc_html__( 'Job With Summary', 'jobhunt' ),
                            'db'    => esc_html__( 'Dual Banner', 'jobhunt' ),
                            'hiw'   => esc_html__( 'How It Works Block', 'jobhunt' ),
                            'cb'    => esc_html__( 'Counters Block', 'jobhunt' ),
                            'fwt'   => esc_html__( 'Faq with Testimonials Block', 'jobhunt' ),
                            'bwi'   => esc_html__( 'Banner with Image Block', 'jobhunt' ),
                        );
                    ?>
                    <table class="general-blocks-table widefat striped">
                        <thead>
                            <tr>
                                <th><?php echo esc_html__( 'Block', 'jobhunt' ); ?></th>
                                <th><?php echo esc_html__( 'Animation', 'jobhunt' ); ?></th>
                                <th><?php echo esc_html__( 'Priority', 'jobhunt' ); ?></th>
                                <th><?php echo esc_html__( 'Enabled ?', 'jobhunt' ); ?></th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php foreach( $home_v5_blocks as $key => $home_v5_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v5_block ); ?></td>
                                <td><?php jobhunt_wp_animation_dropdown( array(  'id' => '_home_v5_' . $key . '_animation', 'label'=> '', 'name' => '_home_v5[' . $key . '][animation]', 'value' => isset( $home_v5['' . $key . '']['animation'] ) ? $home_v5['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php jobhunt_wp_text_input( array(  'id' => '_home_v5_' . $key . '_priority', 'label'=> '', 'name' => '_home_v5[' . $key . '][priority]', 'value' => isset( $home_v5['' . $key . '']['priority'] ) ? $home_v5['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php jobhunt_wp_checkbox( array( 'id' => '_home_v5_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v5[' . $key . '][is_enabled]', 'value'=> isset( $home_v5['' . $key . '']['is_enabled'] ) ? $home_v5['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="options_group">
                    <?php
                        jobhunt_wp_select( array(
                            'id'        => '_home_v5_footer_style',
                            'label'     => esc_html__( 'Footer Style', 'jobhunt' ),
                            'name'      => '_home_v5[footer_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Footer v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Footer v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Footer v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Footer v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Footer v5', 'jobhunt' ),
                            ),
                            'value'     => isset(  $home_v5['footer_style'] ) ?  $home_v5['footer_style'] : 'v5',
                        ) );
                    ?>
                </div>
                <?php do_action( 'jobhunt_home_v5_after_general_block' ) ?>
            </div><!-- /#general_block -->

            <div id="job_categories_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job Categories', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jcb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][section_title]',
                        'value'         => isset( $home_v5['jcb']['section_title'] ) ? $home_v5['jcb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_jcb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][sub_title]',
                        'value'         => isset( $home_v5['jcb']['sub_title'] ) ? $home_v5['jcb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v5_jcb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                            'v4'            => esc_html__( 'v4', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v5['jcb']['type'] ) ? $home_v5['jcb']['type'] : 'v4',
                        'class'         => 'show_hide_select',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jcb_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][action_text]',
                        'value'         => isset( $home_v5['jcb']['action_text'] ) ? $home_v5['jcb']['action_text'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jcb_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][action_link]',
                        'value'         => isset( $home_v5['jcb']['action_link'] ) ? $home_v5['jcb']['action_link'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_home_v5_jcb_category_args',
                        'name'          => '_home_v5[jcb][category_args]',
                        'value'         => isset( $home_v5['jcb']['category_args'] ) ? $home_v5['jcb']['category_args'] : '',
                        'fields'        => array( 'number', 'orderby', 'order', 'hide_empty', 'slug' ),
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_jcb_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[jcb][section_class]',
                        'value'         => isset( $home_v5['jcb']['section_class'] ) ? $home_v5['jcb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v5_after_job_categories_block' ) ?>

            </div><!-- /#job_categories_block -->

            <div id="job_with_summary" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job With Summary', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Jobs', 'jobhunt' ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jws_jobs_1_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[jws][jobs][0][section_title]',
                        'value'         => isset( $home_v5['jws']['jobs'][0]['section_title'] ) ? $home_v5['jws']['jobs'][0]['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jws_jobs_1_shortcode',
                        'label'         => esc_html__( 'Job Shortcode', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the shorcode for your job here', 'jobhunt' ),
                        'name'          => '_home_v5[jws][jobs][0][shortcode]',
                        'value'         => isset( $home_v5['jws']['jobs'][0]['shortcode'] ) ? $home_v5['jws']['jobs'][0]['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]',
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Summary', 'jobhunt' ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jws_jobs_2_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[jws][jobs][1][section_title]',
                        'value'         => isset( $home_v5['jws']['jobs'][1]['section_title'] ) ? $home_v5['jws']['jobs'][1]['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_jws_jobs_2_shortcode',
                        'label'         => esc_html__( 'Job Shortcode', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the shorcode for your job here', 'jobhunt' ),
                        'name'          => '_home_v5[jws][jobs][1][shortcode]',
                        'value'         => isset( $home_v5['jws']['jobs'][1]['shortcode'] ) ? $home_v5['jws']['jobs'][1]['shortcode'] : '[job_summary][job_summary]',
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_jws_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[jws][section_class]',
                        'value'         => isset( $home_v5['jws']['section_class'] ) ? $home_v5['jws']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v5_after_job_with_summary' ) ?>

            </div><!-- /#job_with_summary -->

            <div id="dual_banner" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Dual Banner', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_select( array(
                        'id'            => '_home_v5_db_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v5[db][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v5['db']['bg_choice'] ) ? $home_v5['db']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v5_db_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v5[db][bg_image]',
                        'value'         => isset( $home_v5['db']['bg_image'] ) ? $home_v5['db']['bg_image'] : '',
                        'wrdbper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_db_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v5[db][bg_color]',
                        'value'         => isset( $home_v5['db']['bg_color'] ) ? $home_v5['db']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_db_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[db][section_class]',
                        'value'         => isset( $home_v5['db']['section_class'] ) ? $home_v5['db']['section_class'] : '',
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Banner 1', 'jobhunt' ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_1_title', 
                        'label'         => esc_html__( 'Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the title here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][0][title]',
                        'value'         => isset( $home_v5['db']['banners'][0]['title'] ) ? $home_v5['db']['banners'][0]['title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_db_banners_1_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the sub title here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][0][sub_title]',
                        'value'         => isset( $home_v5['db']['banners'][0]['sub_title'] ) ? $home_v5['db']['banners'][0]['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_1_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][0][action_text]',
                        'value'         => isset( $home_v5['db']['banners'][0]['action_text'] ) ? $home_v5['db']['banners'][0]['action_text'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_1_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][0][action_link]',
                        'value'         => isset( $home_v5['db']['banners'][0]['action_link'] ) ? $home_v5['db']['banners'][0]['action_link'] : '',
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Banner 2', 'jobhunt' ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_2_title', 
                        'label'         => esc_html__( 'Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the title here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][1][title]',
                        'value'         => isset( $home_v5['db']['banners'][1]['title'] ) ? $home_v5['db']['banners'][1]['title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_db_banners_2_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the sub title here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][1][sub_title]',
                        'value'         => isset( $home_v5['db']['banners'][1]['sub_title'] ) ? $home_v5['db']['banners'][1]['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_2_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][1][action_text]',
                        'value'         => isset( $home_v5['db']['banners'][1]['action_text'] ) ? $home_v5['db']['banners'][1]['action_text'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_db_banners_2_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v5[db][banners][1][action_link]',
                        'value'         => isset( $home_v5['db']['banners'][1]['action_link'] ) ? $home_v5['db']['banners'][1]['action_link'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v5_after_dual_banner' ) ?>

            </div><!-- /#dual_banner -->

            <div id="how_it_works_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'How It Works Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][section_title]',
                        'value'         => isset( $home_v5['hiw']['section_title'] ) ? $home_v5['hiw']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_hiw_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][sub_title]',
                        'value'         => isset( $home_v5['hiw']['sub_title'] ) ? $home_v5['hiw']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v5_hiw_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                            'v4'            => esc_html__( 'v4', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v5['hiw']['type'] ) ? $home_v5['hiw']['type'] : 'v4',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_hiw_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][section_class]',
                        'value'         => isset( $home_v5['hiw']['section_class'] ) ? $home_v5['hiw']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_1_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][0][icon]',
                        'value'         => isset( $home_v5['hiw']['steps'][0]['icon'] ) ? $home_v5['hiw']['steps'][0]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_1_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][0][step_title]',
                        'value'         => isset( $home_v5['hiw']['steps'][0]['step_title'] ) ? $home_v5['hiw']['steps'][0]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_hiw_step_1_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][0][step_desc]',
                        'value'         => isset( $home_v5['hiw']['steps'][0]['step_desc'] ) ? $home_v5['hiw']['steps'][0]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_2_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][1][icon]',
                        'value'         => isset( $home_v5['hiw']['steps'][1]['icon'] ) ? $home_v5['hiw']['steps'][1]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_2_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][1][step_title]',
                        'value'         => isset( $home_v5['hiw']['steps'][1]['step_title'] ) ? $home_v5['hiw']['steps'][1]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_hiw_step_2_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][1][step_desc]',
                        'value'         => isset( $home_v5['hiw']['steps'][1]['step_desc'] ) ? $home_v5['hiw']['steps'][1]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_3_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][2][icon]',
                        'value'         => isset( $home_v5['hiw']['steps'][2]['icon'] ) ? $home_v5['hiw']['steps'][2]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_hiw_step_3_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][2][step_title]',
                        'value'         => isset( $home_v5['hiw']['steps'][2]['step_title'] ) ? $home_v5['hiw']['steps'][2]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_hiw_step_2_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v5[hiw][steps][2][step_desc]',
                        'value'         => isset( $home_v5['hiw']['steps'][2]['step_desc'] ) ? $home_v5['hiw']['steps'][2]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'how_it_works_block' ) ?>

            </div><!-- /#how_it_works_block -->

            <div id="counters_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Counters Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][section_title]',
                        'value'         => isset( $home_v5['cb']['section_title'] ) ? $home_v5['cb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v5_cb_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][sub_title]',
                        'value'         => isset( $home_v5['cb']['sub_title'] ) ? $home_v5['cb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v5_cb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v5[cb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v5['cb']['type'] ) ? $home_v5['cb']['type'] : 'v2',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v5_cb_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v5[cb][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v5['cb']['bg_choice'] ) ? $home_v5['cb']['bg_choice'] : 'color',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v5_cb_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v5[cb][bg_image]',
                        'value'         => isset( $home_v5['cb']['bg_image'] ) ? $home_v5['cb']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v5[cb][bg_color]',
                        'value'         => isset( $home_v5['cb']['bg_color'] ) ? $home_v5['cb']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][section_class]',
                        'value'         => isset( $home_v5['cb']['section_class'] ) ? $home_v5['cb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_1_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][0][counter_title]',
                        'value'         => isset( $home_v5['cb']['counters'][0]['counter_title'] ) ? $home_v5['cb']['counters'][0]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_1_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][0][count_value]',
                        'value'         => isset( $home_v5['cb']['counters'][0]['count_value'] ) ? $home_v5['cb']['counters'][0]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_2_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][1][counter_title]',
                        'value'         => isset( $home_v5['cb']['counters'][1]['counter_title'] ) ? $home_v5['cb']['counters'][1]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_2_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][1][count_value]',
                        'value'         => isset( $home_v5['cb']['counters'][1]['count_value'] ) ? $home_v5['cb']['counters'][1]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_3_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][2][counter_title]',
                        'value'         => isset( $home_v5['cb']['counters'][2]['counter_title'] ) ? $home_v5['cb']['counters'][2]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_3_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][2][count_value]',
                        'value'         => isset( $home_v5['cb']['counters'][2]['count_value'] ) ? $home_v5['cb']['counters'][2]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 4', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_4_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][3][counter_title]',
                        'value'         => isset( $home_v5['cb']['counters'][3]['counter_title'] ) ? $home_v5['cb']['counters'][3]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_cb_counter_4_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v5[cb][counters][3][count_value]',
                        'value'         => isset( $home_v5['cb']['counters'][3]['count_value'] ) ? $home_v5['cb']['counters'][3]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'counters_block' ) ?>

            </div><!-- /#counters_block -->

            <div id="faq_with_testimonial_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Faq with Testimonial Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Faq', 'jobhunt' ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_fwt_faq_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[fwt][faq][section_title]',
                        'value'         => isset( $home_v5['fwt']['faq']['section_title'] ) ? $home_v5['fwt']['faq']['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_fwt_faq_shortcode',
                        'label'         => esc_html__( 'Faq Shortcode', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the shorcode for your faq here', 'jobhunt' ),
                        'name'          => '_home_v5[fwt][faq][shortcode]',
                        'value'         => isset( $home_v5['fwt']['faq']['shortcode'] ) ? $home_v5['fwt']['faq']['shortcode'] : '[mas_faq]',
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_legend( esc_html__( 'Testimonials', 'jobhunt' ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_fwt_ts_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v5[fwt][ts][section_title]',
                        'value'         => isset( $home_v5['fwt']['ts']['section_title'] ) ? $home_v5['fwt']['ts']['section_title'] : '',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array(
                        'id'            => '_home_v5_fwt_ts_query_args',
                        'name'          => '_home_v5[fwt][ts][query_args]',
                        'value'         => isset( $home_v5['fwt']['ts']['query_args'] ) ? $home_v5['fwt']['ts']['query_args'] : '',
                        'fields'        => array( 'limit', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array(
                        'id'            => '_home_v5_fwt_ts_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_home_v5[fwt][ts][carousel_args]',
                        'value'         => isset( $home_v5['fwt']['ts']['carousel_args'] ) ? $home_v5['fwt']['ts']['carousel_args'] : '',
                        'fields'        => array( 'autoplay' ),
                    ) );

                ?>

                </div>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_fwt_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[fwt][section_class]',
                        'value'         => isset( $home_v5['fwt']['section_class'] ) ? $home_v5['fwt']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v5_after_faq_with_testimonial_block' ) ?>

            </div><!-- /#faq_with_testimonial_block -->

            <div id="banner_with_image_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Banner with Image Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v5_bwi_title', 
                        'label'         => esc_html__( 'Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Title here', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][title]',
                        'value'         => isset( $home_v5['bwi']['title'] ) ? $home_v5['bwi']['title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v5_bwi_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][sub_title]',
                        'value'         => isset( $home_v5['bwi']['sub_title'] ) ? $home_v5['bwi']['sub_title'] : '',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v5_bwi_image',
                        'label'         => esc_html__( 'Image', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][image]',
                        'value'         => isset( $home_v5['bwi']['image'] ) ? $home_v5['bwi']['image'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v5_bwi_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v5['bwi']['bg_choice'] ) ? $home_v5['bwi']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v5_bwi_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][bg_image]',
                        'value'         => isset( $home_v5['bwi']['bg_image'] ) ? $home_v5['bwi']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_bwi_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][bg_color]',
                        'value'         => isset( $home_v5['bwi']['bg_color'] ) ? $home_v5['bwi']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v5_bwi_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v5[bwi][section_class]',
                        'value'         => isset( $home_v5['bwi']['section_class'] ) ? $home_v5['bwi']['section_class'] : '',
                    ) );

                ?>

                </div>
                <?php do_action( 'jobhunt_home_v5_after_banner_with_image_block' ) ?>

            </div><!-- /#banner_with_image_block -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v5'] ) ) {
            $clean_home_v5_options = jobhunt_clean_kses_post( $_POST['_home_v5'] );
            update_post_meta( $post_id, '_home_v5_options',  serialize( $clean_home_v5_options ) );
        }   
    }
}