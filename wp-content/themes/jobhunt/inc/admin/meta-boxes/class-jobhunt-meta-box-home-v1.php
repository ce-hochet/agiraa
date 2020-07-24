<?php
/**
 * Home v1 Metabox
 *
 * Displays the home v1 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Jobhunt_Meta_Box_Home_v1 Class.
 */
class Jobhunt_Meta_Box_Home_v1 {

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

        if ( $template_file !== 'template-homepage-v1.php' ) {
            return;
        }

        self::output_home_v1( $post );
    }

    private static function output_home_v1( $post ) {

        $home_v1 = jobhunt_get_home_v1_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs jh-tabs">
            <?php
                $product_data_tabs = apply_filters( 'jobhunt_home_v1_data_tabs', array(
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
                    'banner_v1' => array(
                        'label'  => esc_html__( 'Banner v1', 'jobhunt' ),
                        'target' => 'banner_v1',
                        'class'  => array(),
                    ),
                    'job_list_block' => array(
                        'label'  => esc_html__( 'Job List', 'jobhunt' ),
                        'target' => 'job_list_block',
                        'class'  => array(),
                    ),
                    'testimonial_block' => array(
                        'label'  => esc_html__( 'Testimonials', 'jobhunt' ),
                        'target' => 'testimonial_block',
                        'class'  => array(),
                    ),
                    'company_info_carousel' => array(
                        'label'  => esc_html__( 'Company Carousel', 'jobhunt' ),
                        'target' => 'company_info_carousel',
                        'class'  => array(),
                    ),
                    'recent_posts' => array(
                        'label'  => esc_html__( 'Recent Posts', 'jobhunt' ),
                        'target' => 'recent_posts',
                        'class'  => array(),
                    ),
                    'banner_v2' => array(
                        'label'  => esc_html__( 'Banner v2', 'jobhunt' ),
                        'target' => 'banner_v2',
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
                            'id'        => '_home_v1_header_style',
                            'label'     => esc_html__( 'Header Style', 'jobhunt' ),
                            'name'      => '_home_v1[header_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Header v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Header v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Header v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Header v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Header v5', 'jobhunt' )
                            ),
                            'value'     => isset(  $home_v1['header_style'] ) ?  $home_v1['header_style'] : '',
                        ) );
                    ?>
                </div>
                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][section_title]',
                        'value'         => isset( $home_v1['hsb']['section_title'] ) ? $home_v1['hsb']['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][sub_title]',
                        'value'         => isset( $home_v1['hsb']['sub_title'] ) ? $home_v1['hsb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_search_placeholder_text', 
                        'label'         => esc_html__( 'Search Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][search_placeholder_text]',
                        'value'         => isset( $home_v1['hsb']['search_placeholder_text'] ) ? $home_v1['hsb']['search_placeholder_text'] : esc_html__( 'Job title, keywords or company name', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_location_placeholder_text', 
                        'label'         => esc_html__( 'Location Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Location Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][location_placeholder_text]',
                        'value'         => isset( $home_v1['hsb']['location_placeholder_text'] ) ? $home_v1['hsb']['location_placeholder_text'] : esc_html__( 'City, province or region', 'jobhunt' ),
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v1_hsb_show_category_select',
                        'label'         => esc_html__( 'Show Categories Select', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][show_category_select]',
                        'value'         => isset( $home_v1['hsb']['show_category_select'] ) ? $home_v1['hsb']['show_category_select'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_category_select_text', 
                        'label'         => esc_html__( 'All Categories Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the All Categories Text here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][category_select_text]',
                        'value'         => isset( $home_v1['hsb']['category_select_text'] ) ? $home_v1['hsb']['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_search_button_icon', 
                        'label'         => esc_html__( 'Search Button Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Button Icon here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][search_button_icon]',
                        'value'         => isset( $home_v1['hsb']['search_button_icon'] ) ? $home_v1['hsb']['search_button_icon'] : 'la la-search',
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v1_hsb_show_browse_button',
                        'label'         => esc_html__( 'Show Browse Button', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][show_browse_button]',
                        'value'         => isset( $home_v1['hsb']['show_browse_button'] ) ? $home_v1['hsb']['show_browse_button'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_browse_button_label', 
                        'label'         => esc_html__( 'Browse Button Label', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the label here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][browse_button_label]',
                        'value'         => isset( $home_v1['hsb']['browse_button_label'] ) ? $home_v1['hsb']['browse_button_label'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_browse_button_text', 
                        'label'         => esc_html__( 'Browse Button Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the button text here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][browse_button_text]',
                        'value'         => isset( $home_v1['hsb']['browse_button_text'] ) ? $home_v1['hsb']['browse_button_text'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_hsb_browse_button_link', 
                        'label'         => esc_html__( 'Browse Button Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the button link here', 'jobhunt' ),
                        'name'          => '_home_v1[hsb][browse_button_link]',
                        'value'         => isset( $home_v1['hsb']['browse_button_link'] ) ? $home_v1['hsb']['browse_button_link'] : '',
                    ) );

                ?>
                </div>
                <div class="options_group">
                    <?php 
                        $home_v1_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'jobhunt' ),
                            'jcb'   => esc_html__( 'Job Categories Block', 'jobhunt' ),
                            'br1'   => esc_html__( 'Banner v1', 'jobhunt' ),
                            'jlb'   => esc_html__( 'Job List Block', 'jobhunt' ),
                            'ts'    => esc_html__( 'Testimonials Block', 'jobhunt' ),
                            'cic'   => esc_html__( 'Company Carousel', 'jobhunt' ),
                            'rp'    => esc_html__( 'Recent Posts', 'jobhunt' ),
                            'br2'   => esc_html__( 'Banner v2', 'jobhunt' ),
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
                            <?php foreach( $home_v1_blocks as $key => $home_v1_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v1_block ); ?></td>
                                <td><?php jobhunt_wp_animation_dropdown( array(  'id' => '_home_v1_' . $key . '_animation', 'label'=> '', 'name' => '_home_v1[' . $key . '][animation]', 'value' => isset( $home_v1['' . $key . '']['animation'] ) ? $home_v1['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php jobhunt_wp_text_input( array(  'id' => '_home_v1_' . $key . '_priority', 'label'=> '', 'name' => '_home_v1[' . $key . '][priority]', 'value' => isset( $home_v1['' . $key . '']['priority'] ) ? $home_v1['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php jobhunt_wp_checkbox( array( 'id' => '_home_v1_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v1[' . $key . '][is_enabled]', 'value'=> isset( $home_v1['' . $key . '']['is_enabled'] ) ? $home_v1['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="options_group">
                    <?php
                        jobhunt_wp_select( array(
                            'id'        => '_home_v1_footer_style',
                            'label'     => esc_html__( 'Footer Style', 'jobhunt' ),
                            'name'      => '_home_v1[footer_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Footer v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Footer v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Footer v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Footer v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Footer v5', 'jobhunt' ),
                            ),
                            'value'     => isset(  $home_v1['footer_style'] ) ?  $home_v1['footer_style'] : 'v1',
                        ) );
                    ?>
                </div>
                <?php do_action( 'jobhunt_home_v1_after_general_block' ) ?>
            </div><!-- /#general_block -->

            <div id="job_categories_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job Categories', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jcb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][section_title]',
                        'value'         => isset( $home_v1['jcb']['section_title'] ) ? $home_v1['jcb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_jcb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][sub_title]',
                        'value'         => isset( $home_v1['jcb']['sub_title'] ) ? $home_v1['jcb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v1_jcb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                            'v4'            => esc_html__( 'v4', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v1['jcb']['type'] ) ? $home_v1['jcb']['type'] : 'v1',
                        'class'         => 'show_hide_select',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jcb_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][action_text]',
                        'value'         => isset( $home_v1['jcb']['action_text'] ) ? $home_v1['jcb']['action_text'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jcb_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][action_link]',
                        'value'         => isset( $home_v1['jcb']['action_link'] ) ? $home_v1['jcb']['action_link'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_home_v1_jcb_category_args',
                        'name'          => '_home_v1[jcb][category_args]',
                        'value'         => isset( $home_v1['jcb']['category_args'] ) ? $home_v1['jcb']['category_args'] : '',
                        'fields'        => array( 'number', 'orderby', 'order', 'hide_empty', 'slug' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jcb_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[jcb][section_class]',
                        'value'         => isset( $home_v1['jcb']['section_class'] ) ? $home_v1['jcb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_job_categories_block' ) ?>

            </div><!-- /#job_categories_block -->

            <div id="banner_v1" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Banner v1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br1_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[br1][section_title]',
                        'value'         => isset( $home_v1['br1']['section_title'] ) ? $home_v1['br1']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_br1_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[br1][sub_title]',
                        'value'         => isset( $home_v1['br1']['sub_title'] ) ? $home_v1['br1']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v1_br1_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v1[br1][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v1['br1']['bg_choice'] ) ? $home_v1['br1']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v1_br1_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v1[br1][bg_image]',
                        'value'         => isset( $home_v1['br1']['bg_image'] ) ? $home_v1['br1']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v1_br1_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v1[br1][bg_color]',
                        'value'         => isset( $home_v1['br1']['bg_color'] ) ? $home_v1['br1']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br1_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v1[br1][action_text]',
                        'value'         => isset( $home_v1['br1']['action_text'] ) ? $home_v1['br1']['action_text'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br1_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v1[br1][action_link]',
                        'value'         => isset( $home_v1['br1']['action_link'] ) ? $home_v1['br1']['action_link'] : '',
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v1_br1_is_enable_action',
                        'label'         => esc_html__( 'Enable Action', 'jobhunt' ),
                        'name'          => '_home_v1[br1][is_enable_action]',
                        'value'         => isset( $home_v1['br1']['is_enable_action'] ) ? $home_v1['br1']['is_enable_action'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br1_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[br1][section_class]',
                        'value'         => isset( $home_v1['br1']['section_class'] ) ? $home_v1['br1']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_banner_v1' ) ?>

            </div><!-- /#banner_v1 -->

            <div id="job_list_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job List', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jlb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[jlb][section_title]',
                        'value'         => isset( $home_v1['jlb']['section_title'] ) ? $home_v1['jlb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_jlb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[jlb][sub_title]',
                        'value'         => isset( $home_v1['jlb']['sub_title'] ) ? $home_v1['jlb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jlb_shortcode',
                        'label'         => esc_html__( 'Job Shortcode', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the shorcode for your job here', 'jobhunt' ),
                        'name'          => '_home_v1[jlb][shortcode]',
                        'value'         => isset( $home_v1['jlb']['shortcode'] ) ? $home_v1['jlb']['shortcode'] : '[jobs featured="true" per_page="6" show_filters="false"]',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_jlb_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[jlb][section_class]',
                        'value'         => isset( $home_v1['jlb']['section_class'] ) ? $home_v1['jlb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_job_list_block' ) ?>

            </div><!-- /#job_list_block -->

            <div id="testimonial_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Testimonials', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_ts_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[ts][section_title]',
                        'value'         => isset( $home_v1['ts']['section_title'] ) ? $home_v1['ts']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_ts_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[ts][sub_title]',
                        'value'         => isset( $home_v1['ts']['sub_title'] ) ? $home_v1['ts']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v1_ts_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v1[ts][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v1['ts']['type'] ) ? $home_v1['ts']['type'] : 'v1',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v1_ts_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v1[ts][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v1['ts']['bg_choice'] ) ? $home_v1['ts']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v1_ts_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v1[ts][bg_image]',
                        'value'         => isset( $home_v1['ts']['bg_image'] ) ? $home_v1['ts']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v1_ts_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v1[ts][bg_color]',
                        'value'         => isset( $home_v1['ts']['bg_color'] ) ? $home_v1['ts']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_home_v1_ts_query_args',
                        'name'          => '_home_v1[ts][query_args]',
                        'value'         => isset( $home_v1['ts']['query_args'] ) ? $home_v1['ts']['query_args'] : '',
                        'fields'        => array( 'limit', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array( 
                        'id'            => '_home_v1_ts_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_home_v1[ts][carousel_args]',
                        'value'         => isset( $home_v1['ts']['carousel_args'] ) ? $home_v1['ts']['carousel_args'] : '',
                        'fields'        => array( 'autoplay' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_ts_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[ts][section_class]',
                        'value'         => isset( $home_v1['ts']['section_class'] ) ? $home_v1['ts']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_testimonial_block' ) ?>

            </div><!-- /#testimonial_block -->

            <div id="company_info_carousel" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Company Carousel', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_cic_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[cic][section_title]',
                        'value'         => isset( $home_v1['cic']['section_title'] ) ? $home_v1['cic']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_cic_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[cic][sub_title]',
                        'value'         => isset( $home_v1['cic']['sub_title'] ) ? $home_v1['cic']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v1_cic_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v1[cic][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v1['cic']['type'] ) ? $home_v1['cic']['type'] : 'v1',
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v1_cic_is_featured', 
                        'label'         =>  esc_html__( 'Show Featured', 'jobhunt' ),
                        'name'          => '_home_v1[cic][is_featured]',
                        'value'         => isset( $home_v1['cic']['is_featured'] ) ? $home_v1['cic']['is_featured'] : true,
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_home_v1_cic_query_args',
                        'name'          => '_home_v1[cic][query_args]',
                        'value'         => isset( $home_v1['cic']['query_args'] ) ? $home_v1['cic']['query_args'] : '',
                        'fields'        => array( 'per_page', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array( 
                        'id'            => '_home_v1_cic_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_home_v1[cic][carousel_args]',
                        'value'         => isset( $home_v1['cic']['carousel_args'] ) ? $home_v1['cic']['carousel_args'] : '',
                        'fields'        => array( 'slidesToShow', 'slidesToScroll', 'autoplay', 'arrows' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_cic_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[cic][section_class]',
                        'value'         => isset( $home_v1['cic']['section_class'] ) ? $home_v1['cic']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_company_info_carousel' ) ?>

            </div><!-- /#company_info_carousel -->

            <div id="recent_posts" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Recent Posts', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_rp_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[rp][section_title]',
                        'value'         => isset( $home_v1['rp']['section_title'] ) ? $home_v1['rp']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_rp_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[rp][sub_title]',
                        'value'         => isset( $home_v1['rp']['sub_title'] ) ? $home_v1['rp']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v1_rp_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v1[rp][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v1['rp']['type'] ) ? $home_v1['rp']['type'] : 'v1',
                    ) );

                    jobhunt_wp_post_args ( array( 
                        'id'            => '_home_v1_rp_post_args',
                        'name'          => '_home_v1[rp]',
                        'value'         => isset( $home_v1['rp'] ) ? $home_v1['rp'] : '',
                        'fields'        => array( 'limit', 'columns', 'post_choice' , 'post_ids', 'category__in' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_rp_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[rp][section_class]',
                        'value'         => isset( $home_v1['rp']['section_class'] ) ? $home_v1['rp']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_recent_posts' ) ?>

            </div><!-- /#recent_posts -->

            <div id="banner_v2" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Banner v2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br2_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v1[br2][section_title]',
                        'value'         => isset( $home_v1['br2']['section_title'] ) ? $home_v1['br2']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v1_br2_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v1[br2][sub_title]',
                        'value'         => isset( $home_v1['br2']['sub_title'] ) ? $home_v1['br2']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v1_br2_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v1[br2][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v1['br2']['bg_choice'] ) ? $home_v1['br2']['bg_choice'] : 'color',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v1_br2_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v1[br2][bg_image]',
                        'value'         => isset( $home_v1['br2']['bg_image'] ) ? $home_v1['br2']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v1_br2_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v1[br2][bg_color]',
                        'value'         => isset( $home_v1['br2']['bg_color'] ) ? $home_v1['br2']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br2_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v1[br2][action_text]',
                        'value'         => isset( $home_v1['br2']['action_text'] ) ? $home_v1['br2']['action_text'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br2_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v1[br2][action_link]',
                        'value'         => isset( $home_v1['br2']['action_link'] ) ? $home_v1['br2']['action_link'] : '',
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v1_br2_is_enable_action',
                        'label'         => esc_html__( 'Enable Action', 'jobhunt' ),
                        'name'          => '_home_v1[br2][is_enable_action]',
                        'value'         => isset( $home_v1['br2']['is_enable_action'] ) ? $home_v1['br2']['is_enable_action'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v1_br2_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v1[br2][section_class]',
                        'value'         => isset( $home_v1['br2']['section_class'] ) ? $home_v1['br2']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v1_after_banner_v2' ) ?>

            </div><!-- /#banner_v2 -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v1'] ) ) {
            $clean_home_v1_options = jobhunt_clean_kses_post( $_POST['_home_v1'] );
            update_post_meta( $post_id, '_home_v1_options',  serialize( $clean_home_v1_options ) );
        }   
    }
}