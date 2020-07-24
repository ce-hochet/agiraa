<?php
/**
 * Home v2 Metabox
 *
 * Displays the home v2 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Jobhunt_Meta_Box_Home_v2 Class.
 */
class Jobhunt_Meta_Box_Home_v2 {

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

        if ( $template_file !== 'template-homepage-v2.php' ) {
            return;
        }

        self::output_home_v2( $post );
    }

    private static function output_home_v2( $post ) {

        $home_v2 = jobhunt_get_home_v2_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs jh-tabs">
            <?php
                $product_data_tabs = apply_filters( 'jobhunt_home_v2_data_tabs', array(
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
                    'job_list_block' => array(
                        'label'  => esc_html__( 'Job List', 'jobhunt' ),
                        'target' => 'job_list_block',
                        'class'  => array(),
                    ),
                    'how_it_works_block' => array(
                        'label'  => esc_html__( 'How It Works Block', 'jobhunt' ),
                        'target' => 'how_it_works_block',
                        'class'  => array(),
                    ),
                    'company_info_carousel' => array(
                        'label'  => esc_html__( 'Company Carousel', 'jobhunt' ),
                        'target' => 'company_info_carousel',
                        'class'  => array(),
                    ),
                    'counters_block' => array(
                        'label'  => esc_html__( 'Counters Block', 'jobhunt' ),
                        'target' => 'counters_block',
                        'class'  => array(),
                    ),
                    'testimonial_block' => array(
                        'label'  => esc_html__( 'Testimonials', 'jobhunt' ),
                        'target' => 'testimonial_block',
                        'class'  => array(),
                    ),
                    'recent_posts' => array(
                        'label'  => esc_html__( 'Recent Posts', 'jobhunt' ),
                        'target' => 'recent_posts',
                        'class'  => array(),
                    ),
                    'job_pricing' => array(
                        'label'  => esc_html__( 'Job Pricing Block', 'jobhunt' ),
                        'target' => 'job_pricing',
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
                            'id'        => '_home_v2_header_style',
                            'label'     => esc_html__( 'Header Style', 'jobhunt' ),
                            'name'      => '_home_v2[header_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Header v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Header v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Header v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Header v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Header v5', 'jobhunt' )
                            ),
                            'value'     => isset(  $home_v2['header_style'] ) ?  $home_v2['header_style'] : 'v2',
                        ) );
                    ?>
                </div>
                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][section_title]',
                        'value'         => isset( $home_v2['hsb']['section_title'] ) ? $home_v2['hsb']['section_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][sub_title]',
                        'value'         => isset( $home_v2['hsb']['sub_title'] ) ? $home_v2['hsb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_search_placeholder_text', 
                        'label'         => esc_html__( 'Search Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][search_placeholder_text]',
                        'value'         => isset( $home_v2['hsb']['search_placeholder_text'] ) ? $home_v2['hsb']['search_placeholder_text'] : esc_html__( 'Keywords', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_location_placeholder_text', 
                        'label'         => esc_html__( 'Location Placeholder Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Location Placeholder Text here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][location_placeholder_text]',
                        'value'         => isset( $home_v2['hsb']['location_placeholder_text'] ) ? $home_v2['hsb']['location_placeholder_text'] : esc_html__( 'All Regions', 'jobhunt' ),
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v2_hsb_show_category_select',
                        'label'         => esc_html__( 'Show Categories Select', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][show_category_select]',
                        'value'         => isset( $home_v2['hsb']['show_category_select'] ) ? $home_v2['hsb']['show_category_select'] : '',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_category_select_text', 
                        'label'         => esc_html__( 'All Categories Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the All Categories Text here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][category_select_text]',
                        'value'         => isset( $home_v2['hsb']['category_select_text'] ) ? $home_v2['hsb']['category_select_text'] : esc_html__( 'Any Category', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_search_button_text', 
                        'label'         => esc_html__( 'Search Button Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Button Text here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][search_button_text]',
                        'value'         => isset( $home_v2['hsb']['search_button_text'] ) ? $home_v2['hsb']['search_button_text'] : esc_html__( 'Search', 'jobhunt' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hsb_search_button_icon', 
                        'label'         => esc_html__( 'Search Button Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Search Button Icon here', 'jobhunt' ),
                        'name'          => '_home_v2[hsb][search_button_icon]',
                        'value'         => isset( $home_v2['hsb']['search_button_icon'] ) ? $home_v2['hsb']['search_button_icon'] : 'la la-search',
                    ) );

                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v2_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'jobhunt' ),
                            'jcb'   => esc_html__( 'Job Categories Block', 'jobhunt' ),
                            'jlb'   => esc_html__( 'Job List Block', 'jobhunt' ),
                            'hiw'   => esc_html__( 'How It Works Block', 'jobhunt' ),
                            'cic'   => esc_html__( 'Company Carousel', 'jobhunt' ),
                            'cb'    => esc_html__( 'Counters Block', 'jobhunt' ),
                            'ts'    => esc_html__( 'Testimonials Block', 'jobhunt' ),
                            'rp'    => esc_html__( 'Recent Posts', 'jobhunt' ),
                            'jp'    => esc_html__( 'Job Pricing', 'jobhunt' ),
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
                            <?php foreach( $home_v2_blocks as $key => $home_v2_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v2_block ); ?></td>
                                <td><?php jobhunt_wp_animation_dropdown( array(  'id' => '_home_v2_' . $key . '_animation', 'label'=> '', 'name' => '_home_v2[' . $key . '][animation]', 'value' => isset( $home_v2['' . $key . '']['animation'] ) ? $home_v2['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php isset( $key ) && $key == 'jcb' ? '' : jobhunt_wp_text_input( array(  'id' => '_home_v2_' . $key . '_priority', 'label'=> '', 'name' => '_home_v2[' . $key . '][priority]', 'value' => isset( $home_v2['' . $key . '']['priority'] ) ? $home_v2['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php jobhunt_wp_checkbox( array( 'id' => '_home_v2_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v2[' . $key . '][is_enabled]', 'value'=> isset( $home_v2['' . $key . '']['is_enabled'] ) ? $home_v2['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="options_group">
                    <?php
                        jobhunt_wp_select( array(
                            'id'        => '_home_v2_footer_style',
                            'label'     => esc_html__( 'Footer Style', 'jobhunt' ),
                            'name'      => '_home_v2[footer_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Footer v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Footer v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Footer v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Footer v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Footer v5', 'jobhunt' ),
                            ),
                            'value'     => isset(  $home_v2['footer_style'] ) ?  $home_v2['footer_style'] : 'v2',
                        ) );
                    ?>
                </div>
                <?php do_action( 'jobhunt_home_v2_after_general_block' ) ?>
            </div><!-- /#general_block -->

            <div id="job_categories_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job Categories', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_jcb_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][section_title]',
                        'value'         => isset( $home_v2['jcb']['section_title'] ) ? $home_v2['jcb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_jcb_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][sub_title]',
                        'value'         => isset( $home_v2['jcb']['sub_title'] ) ? $home_v2['jcb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_jcb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                            'v4'            => esc_html__( 'v4', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['jcb']['type'] ) ? $home_v2['jcb']['type'] : 'v2',
                        'class'         => 'show_hide_select',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_jcb_action_text', 
                        'label'         => esc_html__( 'Action Text', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action text here', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][action_text]',
                        'value'         => isset( $home_v2['jcb']['action_text'] ) ? $home_v2['jcb']['action_text'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_jcb_action_link', 
                        'label'         => esc_html__( 'Action Link', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the action link here', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][action_link]',
                        'value'         => isset( $home_v2['jcb']['action_link'] ) ? $home_v2['jcb']['action_link'] : '',
                        'wrapper_class' => 'show_if_v1 show_if_v3 hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array(
                        'id'            => '_home_v2_jcb_category_args',
                        'name'          => '_home_v2[jcb][category_args]',
                        'value'         => isset( $home_v2['jcb']['category_args'] ) ? $home_v2['jcb']['category_args'] : '',
                        'fields'        => array( 'number', 'orderby', 'order', 'hide_empty', 'slug' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_jcb_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[jcb][section_class]',
                        'value'         => isset( $home_v2['jcb']['section_class'] ) ? $home_v2['jcb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_job_categories_block' ) ?>

            </div><!-- /#job_categories_block -->

            <div id="job_list_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job List', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_jlb_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jlb][section_title]',
                        'value'         => isset( $home_v2['jlb']['section_title'] ) ? $home_v2['jlb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_jlb_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jlb][sub_title]',
                        'value'         => isset( $home_v2['jlb']['sub_title'] ) ? $home_v2['jlb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_jlb_shortcode',
                        'label'         => esc_html__( 'Job Shortcode', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the shorcode for your job here', 'jobhunt' ),
                        'name'          => '_home_v2[jlb][shortcode]',
                        'value'         => isset( $home_v2['jlb']['shortcode'] ) ? $home_v2['jlb']['shortcode'] : '[jobs view="grid" per_page="6" show_filters="false" orderby="date" order="DESC"]',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_jlb_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[jlb][section_class]',
                        'value'         => isset( $home_v2['jlb']['section_class'] ) ? $home_v2['jlb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_job_list_block' ) ?>

            </div><!-- /#job_list_block -->

            <div id="how_it_works_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'How It Works Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][section_title]',
                        'value'         => isset( $home_v2['hiw']['section_title'] ) ? $home_v2['hiw']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_hiw_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][sub_title]',
                        'value'         => isset( $home_v2['hiw']['sub_title'] ) ? $home_v2['hiw']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_hiw_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                            'v4'            => esc_html__( 'v4', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['hiw']['type'] ) ? $home_v2['hiw']['type'] : 'v1',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_hiw_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][section_class]',
                        'value'         => isset( $home_v2['hiw']['section_class'] ) ? $home_v2['hiw']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_1_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][0][icon]',
                        'value'         => isset( $home_v2['hiw']['steps'][0]['icon'] ) ? $home_v2['hiw']['steps'][0]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_1_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][0][step_title]',
                        'value'         => isset( $home_v2['hiw']['steps'][0]['step_title'] ) ? $home_v2['hiw']['steps'][0]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_hiw_step_1_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][0][step_desc]',
                        'value'         => isset( $home_v2['hiw']['steps'][0]['step_desc'] ) ? $home_v2['hiw']['steps'][0]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_2_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][1][icon]',
                        'value'         => isset( $home_v2['hiw']['steps'][1]['icon'] ) ? $home_v2['hiw']['steps'][1]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_2_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][1][step_title]',
                        'value'         => isset( $home_v2['hiw']['steps'][1]['step_title'] ) ? $home_v2['hiw']['steps'][1]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_hiw_step_2_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][1][step_desc]',
                        'value'         => isset( $home_v2['hiw']['steps'][1]['step_desc'] ) ? $home_v2['hiw']['steps'][1]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Step 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_3_icon',
                        'label'         => esc_html__( 'Icon', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the icon for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][2][icon]',
                        'value'         => isset( $home_v2['hiw']['steps'][2]['icon'] ) ? $home_v2['hiw']['steps'][2]['icon'] : '',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_hiw_step_3_step_title',
                        'label'         => esc_html__( 'Step Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step title for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][2][step_title]',
                        'value'         => isset( $home_v2['hiw']['steps'][2]['step_title'] ) ? $home_v2['hiw']['steps'][2]['step_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_hiw_step_2_step_desc',
                        'label'         => esc_html__( 'Step Description', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the step description for your steps here', 'jobhunt' ),
                        'name'          => '_home_v2[hiw][steps][2][step_desc]',
                        'value'         => isset( $home_v2['hiw']['steps'][2]['step_desc'] ) ? $home_v2['hiw']['steps'][2]['step_desc'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'jobhunt_home_v2_after_how_it_works_block' ) ?>

            </div><!-- /#how_it_works_block -->

            <div id="company_info_carousel" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Company Carousel', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_cic_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[cic][section_title]',
                        'value'         => isset( $home_v2['cic']['section_title'] ) ? $home_v2['cic']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_home_v2_cic_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[cic][sub_title]',
                        'value'         => isset( $home_v2['cic']['sub_title'] ) ? $home_v2['cic']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_home_v2_cic_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[cic][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['cic']['type'] ) ? $home_v2['cic']['type'] : 'v2',
                    ) );

                    jobhunt_wp_checkbox( array(
                        'id'            => '_home_v2_cic_is_featured', 
                        'label'         =>  esc_html__( 'Show Featured', 'jobhunt' ),
                        'name'          => '_home_v2[cic][is_featured]',
                        'value'         => isset( $home_v2['cic']['is_featured'] ) ? $home_v2['cic']['is_featured'] : true,
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_home_v2_cic_query_args',
                        'name'          => '_home_v2[cic][query_args]',
                        'value'         => isset( $home_v2['cic']['query_args'] ) ? $home_v2['cic']['query_args'] : '',
                        'fields'        => array( 'per_page', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array( 
                        'id'            => '_home_v2_cic_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_home_v2[cic][carousel_args]',
                        'value'         => isset( $home_v2['cic']['carousel_args'] ) ? $home_v2['cic']['carousel_args'] : '',
                        'fields'        => array( 'slidesToShow', 'slidesToScroll', 'autoplay', 'arrows' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_cic_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[cic][section_class]',
                        'value'         => isset( $home_v2['cic']['section_class'] ) ? $home_v2['cic']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_company_info_carousel' ) ?>

            </div><!-- /#company_info_carousel -->

            <div id="counters_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Counters Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][section_title]',
                        'value'         => isset( $home_v2['cb']['section_title'] ) ? $home_v2['cb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_cb_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][sub_title]',
                        'value'         => isset( $home_v2['cb']['sub_title'] ) ? $home_v2['cb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_cb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[cb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['cb']['type'] ) ? $home_v2['cb']['type'] : 'v1',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_cb_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v2[cb][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v2['cb']['bg_choice'] ) ? $home_v2['cb']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v2_cb_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v2[cb][bg_image]',
                        'value'         => isset( $home_v2['cb']['bg_image'] ) ? $home_v2['cb']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v2[cb][bg_color]',
                        'value'         => isset( $home_v2['cb']['bg_color'] ) ? $home_v2['cb']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_cb_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][section_class]',
                        'value'         => isset( $home_v2['cb']['section_class'] ) ? $home_v2['cb']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_1_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][0][counter_title]',
                        'value'         => isset( $home_v2['cb']['counters'][0]['counter_title'] ) ? $home_v2['cb']['counters'][0]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_1_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][0][count_value]',
                        'value'         => isset( $home_v2['cb']['counters'][0]['count_value'] ) ? $home_v2['cb']['counters'][0]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_2_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][1][counter_title]',
                        'value'         => isset( $home_v2['cb']['counters'][1]['counter_title'] ) ? $home_v2['cb']['counters'][1]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_2_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][1][count_value]',
                        'value'         => isset( $home_v2['cb']['counters'][1]['count_value'] ) ? $home_v2['cb']['counters'][1]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_3_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][2][counter_title]',
                        'value'         => isset( $home_v2['cb']['counters'][2]['counter_title'] ) ? $home_v2['cb']['counters'][2]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_3_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][2][count_value]',
                        'value'         => isset( $home_v2['cb']['counters'][2]['count_value'] ) ? $home_v2['cb']['counters'][2]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 4', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_4_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][3][counter_title]',
                        'value'         => isset( $home_v2['cb']['counters'][3]['counter_title'] ) ? $home_v2['cb']['counters'][3]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_cb_counter_4_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_home_v2[cb][counters][3][count_value]',
                        'value'         => isset( $home_v2['cb']['counters'][3]['count_value'] ) ? $home_v2['cb']['counters'][3]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'jobhunt_home_v2_after_counters_block' ) ?>

            </div><!-- /#counters_block -->

            <div id="testimonial_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Testimonials', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_ts_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[ts][section_title]',
                        'value'         => isset( $home_v2['ts']['section_title'] ) ? $home_v2['ts']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_ts_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[ts][sub_title]',
                        'value'         => isset( $home_v2['ts']['sub_title'] ) ? $home_v2['ts']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_ts_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[ts][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['ts']['type'] ) ? $home_v2['ts']['type'] : 'v2',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_ts_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_home_v2[ts][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $home_v2['ts']['bg_choice'] ) ? $home_v2['ts']['bg_choice'] : 'color',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_home_v2_ts_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_home_v2[ts][bg_image]',
                        'value'         => isset( $home_v2['ts']['bg_image'] ) ? $home_v2['ts']['bg_image'] : '',
                        'wrapper_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_ts_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_home_v2[ts][bg_color]',
                        'value'         => isset( $home_v2['ts']['bg_color'] ) ? $home_v2['ts']['bg_color'] : '',
                        'wrapper_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array(
                        'id'            => '_home_v2_ts_query_args',
                        'name'          => '_home_v2[ts][query_args]',
                        'value'         => isset( $home_v2['ts']['query_args'] ) ? $home_v2['ts']['query_args'] : '',
                        'fields'        => array( 'limit', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array(
                        'id'            => '_home_v2_ts_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_home_v2[ts][carousel_args]',
                        'value'         => isset( $home_v2['ts']['carousel_args'] ) ? $home_v2['ts']['carousel_args'] : '',
                        'fields'        => array( 'autoplay' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_ts_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[ts][section_class]',
                        'value'         => isset( $home_v2['ts']['section_class'] ) ? $home_v2['ts']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_testimonial_block' ) ?>

            </div><!-- /#testimonial_block -->

            <div id="recent_posts" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Recent Posts', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_rp_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[rp][section_title]',
                        'value'         => isset( $home_v2['rp']['section_title'] ) ? $home_v2['rp']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_rp_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[rp][sub_title]',
                        'value'         => isset( $home_v2['rp']['sub_title'] ) ? $home_v2['rp']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_home_v2_rp_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_home_v2[rp][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $home_v2['rp']['type'] ) ? $home_v2['rp']['type'] : 'v2',
                    ) );

                    jobhunt_wp_post_args ( array(
                        'id'            => '_home_v2_rp_post_args',
                        'name'          => '_home_v2[rp]',
                        'value'         => isset( $home_v2['rp'] ) ? $home_v2['rp'] : '',
                        'fields'        => array( 'limit', 'columns', 'post_choice' , 'post_ids', 'category__in' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_rp_section_class', 
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[rp][section_class]',
                        'value'         => isset( $home_v2['rp']['section_class'] ) ? $home_v2['rp']['section_class'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_recent_posts' ) ?>

            </div><!-- /#recent_posts -->

            <div id="job_pricing" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Job Pricing Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_home_v2_jp_section_title',
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jp][section_title]',
                        'value'         => isset( $home_v2['jp']['section_title'] ) ? $home_v2['jp']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_home_v2_jp_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_home_v2[jp][sub_title]',
                        'value'         => isset( $home_v2['jp']['sub_title'] ) ? $home_v2['jp']['sub_title'] : '',
                    ) );

                    jobhunt_wp_wc_shortcode( array(
                        'id'            => '_home_v2_jp_shortcode_atts',
                        'name'          => '_home_v2[jp][shortcode_content]',
                        'value'         => isset( $home_v2['jp']['shortcode_content'] ) ? $home_v2['jp']['shortcode_content'] : '',
                        'fields'        => array( 'per_page', 'columns', 'orderby' , 'order' ),
                    ) );

                    jobhunt_wp_text_input( array( 
                        'id'            => '_home_v2_jp_section_class',
                        'label'         => esc_html__( 'Extra Class', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the extra here', 'jobhunt' ),
                        'name'          => '_home_v2[jp][section_class]',
                        'value'         => isset( $home_v2['jp']['section_class'] ) ? $home_v2['jp']['section_class'] : '',
                    ) );
                ?>

                </div>

                <?php do_action( 'jobhunt_home_v2_after_job_pricing' ) ?>

            </div><!-- /#job_pricing -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v2'] ) ) {
            $clean_home_v2_options = jobhunt_clean_kses_post( $_POST['_home_v2'] );
            update_post_meta( $post_id, '_home_v2_options',  serialize( $clean_home_v2_options ) );
        }
    }
}
