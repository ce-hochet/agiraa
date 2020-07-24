<?php
/**
 * About Metabox
 *
 * Displays the about meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Jobhunt_Meta_Box_About Class.
 */
class Jobhunt_Meta_Box_About {

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

        if ( $template_file !== 'template-aboutpage.php' ) {
            return;
        }

        self::output_about( $post );
    }

    private static function output_about( $post ) {

        $about = jobhunt_get_about_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs jh-tabs">
            <?php
                $product_data_tabs = apply_filters( 'jobhunt_about_data_tabs', array(
                    'general' => array(
                        'label'  => esc_html__( 'General', 'jobhunt' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'about_content_block' => array(
                        'label'  => esc_html__( 'About Content Block', 'jobhunt' ),
                        'target' => 'about_content_block',
                        'class'  => array(),
                    ),
                    'feature_list_block' => array(
                        'label'  => esc_html__( 'Fearture List Block', 'jobhunt' ),
                        'target' => 'feature_list_block',
                        'class'  => array(),
                    ),
                    'testimonial_block' => array(
                        'label'  => esc_html__( 'Testimonials', 'jobhunt' ),
                        'target' => 'testimonial_block',
                        'class'  => array(),
                    ),
                    'counters_block' => array(
                        'label'  => esc_html__( 'Counters Block', 'jobhunt' ),
                        'target' => 'counters_block',
                        'class'  => array(),
                    ),
                    'recent_posts' => array(
                        'label'  => esc_html__( 'Recent Posts', 'jobhunt' ),
                        'target' => 'recent_posts',
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
                            'id'        => '_about_header_style',
                            'label'     => esc_html__( 'Header Style', 'jobhunt' ),
                            'name'      => '_about[header_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Header v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Header v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Header v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Header v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Header v5', 'jobhunt' )
                            ),
                            'value'     => isset(  $about['header_style'] ) ?  $about['header_style'] : 'v1',
                        ) );
                    ?>
                </div>
                <div class="options_group">
                    <?php 
                        $about_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'jobhunt' ),
                            'ac'    => esc_html__( 'About Content Block', 'jobhunt' ),
                            'fl'    => esc_html__( 'Feature List Block', 'jobhunt' ),
                            'ts'    => esc_html__( 'Testimonials Block', 'jobhunt' ),
                            'cb'    => esc_html__( 'Counters Block', 'jobhunt' ),
                            'rp'    => esc_html__( 'Recent Posts', 'jobhunt' ),
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
                            <?php foreach( $about_blocks as $key => $about_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $about_block ); ?></td>
                                <td><?php jobhunt_wp_animation_dropdown( array(  'id' => '_about_' . $key . '_animation', 'label'=> '', 'name' => '_about[' . $key . '][animation]', 'value' => isset( $about['' . $key . '']['animation'] ) ? $about['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php jobhunt_wp_text_input( array(  'id' => '_about_' . $key . '_priority', 'label'=> '', 'name' => '_about[' . $key . '][priority]', 'value' => isset( $about['' . $key . '']['priority'] ) ? $about['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php jobhunt_wp_checkbox( array( 'id' => '_about_' . $key . '_is_enabled', 'label' => '', 'name' => '_about[' . $key . '][is_enabled]', 'value'=> isset( $about['' . $key . '']['is_enabled'] ) ? $about['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="options_group">
                    <?php
                        jobhunt_wp_select( array(
                            'id'        => '_about_footer_style',
                            'label'     => esc_html__( 'Footer Style', 'jobhunt' ),
                            'name'      => '_about[footer_style]',
                            'options'   => array(
                                'v1'    => esc_html__( 'Footer v1', 'jobhunt' ),
                                'v2'    => esc_html__( 'Footer v2', 'jobhunt' ),
                                'v3'    => esc_html__( 'Footer v3', 'jobhunt' ),
                                'v4'    => esc_html__( 'Footer v4', 'jobhunt' ),
                                'v5'    => esc_html__( 'Footer v5', 'jobhunt' ),
                            ),
                            'value'     => isset(  $about['footer_style'] ) ?  $about['footer_style'] : 'v1',
                        ) );
                    ?>
                </div>
                <?php do_action( 'jobhunt_about_after_general_block' ) ?>
            </div><!-- /#general_block -->

            <div id="about_content_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'About Content Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_ac_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_about[ac][section_title]',
                        'value'         => isset( $about['ac']['section_title'] ) ? $about['ac']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_ac_about_content', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_about[ac][about_content]',
                        'value'         => isset( $about['ac']['about_content'] ) ? $about['ac']['about_content'] : '',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_about_ac_image',
                        'label'         => esc_html__( 'Image', 'jobhunt' ),
                        'name'          => '_about[ac][image]',
                        'value'         => isset( $about['ac']['image'] ) ? $about['ac']['image'] : '',
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_about_after_about_content_block' ) ?>

            </div><!-- /#about_content_block -->

            <div id="feature_list_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Feature List Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_about[fl][section_title]',
                        'value'         => isset( $about['fl']['section_title'] ) ? $about['fl']['section_title'] : '',
                    ) );
                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_1_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][0][feature_title]',
                        'value'         => isset( $about['fl']['features'][0]['feature_title'] ) ? $about['fl']['features'][0]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_1_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][0][feature_desc]',
                        'value'         => isset( $about['fl']['features'][0]['feature_desc'] ) ? $about['fl']['features'][0]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_1_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][0][icon]',
                        'value'         => isset( $about['fl']['features'][0]['icon'] ) ? $about['fl']['features'][0]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_2_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][1][feature_title]',
                        'value'         => isset( $about['fl']['features'][1]['feature_title'] ) ? $about['fl']['features'][1]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_2_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][1][feature_desc]',
                        'value'         => isset( $about['fl']['features'][1]['feature_desc'] ) ? $about['fl']['features'][1]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_2_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][1][icon]',
                        'value'         => isset( $about['fl']['features'][1]['icon'] ) ? $about['fl']['features'][1]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_3_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][2][feature_title]',
                        'value'         => isset( $about['fl']['features'][2]['feature_title'] ) ? $about['fl']['features'][2]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_3_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][2][feature_desc]',
                        'value'         => isset( $about['fl']['features'][2]['feature_desc'] ) ? $about['fl']['features'][2]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_3_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][2][icon]',
                        'value'         => isset( $about['fl']['features'][2]['icon'] ) ? $about['fl']['features'][2]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 4', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_4_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][3][feature_title]',
                        'value'         => isset( $about['fl']['features'][3]['feature_title'] ) ? $about['fl']['features'][3]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_4_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][3][feature_desc]',
                        'value'         => isset( $about['fl']['features'][3]['feature_desc'] ) ? $about['fl']['features'][3]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_4_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][3][icon]',
                        'value'         => isset( $about['fl']['features'][3]['icon'] ) ? $about['fl']['features'][3]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 5', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_5_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][4][feature_title]',
                        'value'         => isset( $about['fl']['features'][4]['feature_title'] ) ? $about['fl']['features'][4]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_5_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][4][feature_desc]',
                        'value'         => isset( $about['fl']['features'][4]['feature_desc'] ) ? $about['fl']['features'][4]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_5_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][4][icon]',
                        'value'         => isset( $about['fl']['features'][4]['icon'] ) ? $about['fl']['features'][4]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Feature 6', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_6_feature_title',
                        'label'         => esc_html__( 'Feature Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature title for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][5][feature_title]',
                        'value'         => isset( $about['fl']['features'][5]['feature_title'] ) ? $about['fl']['features'][5]['feature_title'] : '',
                    ) );
                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_fl_feature_6_feature_desc',
                        'label'         => esc_html__( 'Feature Description', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature description for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][5][feature_desc]',
                        'value'         => isset( $about['fl']['features'][5]['feature_desc'] ) ? $about['fl']['features'][5]['feature_desc'] : '',
                    ) );
                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_fl_feature_6_icon',
                        'label'         => esc_html__( 'Feature Icon', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the feature icon for your features here', 'jobhunt' ),
                        'name'          => '_about[fl][features][5][icon]',
                        'value'         => isset( $about['fl']['features'][5]['icon'] ) ? $about['fl']['features'][5]['icon'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'jobhunt_about_after_feature_list_block' ) ?>

            </div><!-- /#feature_list_block -->

            <div id="testimonial_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Testimonials', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_ts_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_about[ts][section_title]',
                        'value'         => isset( $about['ts']['section_title'] ) ? $about['ts']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_ts_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_about[ts][sub_title]',
                        'value'         => isset( $about['ts']['sub_title'] ) ? $about['ts']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_about_ts_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_about[ts][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $about['ts']['type'] ) ? $about['ts']['type'] : 'v1',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_about_ts_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_about[ts][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $about['ts']['bg_choice'] ) ? $about['ts']['bg_choice'] : 'image',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_about_ts_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_about[ts][bg_image]',
                        'value'         => isset( $about['ts']['bg_image'] ) ? $about['ts']['bg_image'] : '',
                        'wrfeatureer_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_about_ts_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_about[ts][bg_color]',
                        'value'         => isset( $about['ts']['bg_color'] ) ? $about['ts']['bg_color'] : '',
                        'wrfeatureer_class' => 'show_if_color hide',
                    ) );

                    jobhunt_wp_wc_cat_shortcode_atts ( array( 
                        'id'            => '_about_ts_query_args',
                        'name'          => '_about[ts][query_args]',
                        'value'         => isset( $about['ts']['query_args'] ) ? $about['ts']['query_args'] : '',
                        'fields'        => array( 'limit', 'orderby', 'order' ),
                    ) );

                    jobhunt_wp_slick_carousel_options( array( 
                        'id'            => '_about_ts_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'jobhunt' ),
                        'name'          => '_about[ts][carousel_args]',
                        'value'         => isset( $about['ts']['carousel_args'] ) ? $about['ts']['carousel_args'] : '',
                        'fields'        => array( 'slidesToShow', 'slidesToScroll', 'autoplay' ),
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_about_after_testimonial_block' ) ?>

            </div><!-- /#testimonial_block -->

            <div id="counters_block" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Counters Block', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php

                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_about[cb][section_title]',
                        'value'         => isset( $about['cb']['section_title'] ) ? $about['cb']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array(
                        'id'            => '_about_cb_sub_title',
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_about[cb][sub_title]',
                        'value'         => isset( $about['cb']['sub_title'] ) ? $about['cb']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_about_cb_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_about[cb][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                        ),
                        'value'         => isset( $about['cb']['type'] ) ? $about['cb']['type'] : 'v2',
                    ) );

                    jobhunt_wp_select( array(
                        'id'            => '_about_cb_bg_choice',
                        'label'         => esc_html__( 'Background Choice', 'jobhunt' ),
                        'name'          => '_about[cb][bg_choice]',
                        'options'       => array(
                            'image'     => esc_html__( 'Image', 'jobhunt' ),
                            'color'     => esc_html__( 'Color', 'jobhunt' ),
                        ),
                        'class'         => 'show_hide_select',
                        'value'         => isset( $about['cb']['bg_choice'] ) ? $about['cb']['bg_choice'] : 'color',
                    ) );

                    jobhunt_wp_upload_image( array(
                        'id'            => '_about_cb_bg_image',
                        'label'         => esc_html__( 'Background Image', 'jobhunt' ),
                        'name'          => '_about[cb][bg_image]',
                        'value'         => isset( $about['cb']['bg_image'] ) ? $about['cb']['bg_image'] : '',
                        'wrfeatureer_class' => 'show_if_image hide',
                    ) );

                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_bg_color',
                        'label'         => esc_html__( 'Background Color', 'jobhunt' ),
                        'name'          => '_about[cb][bg_color]',
                        'value'         => isset( $about['cb']['bg_color'] ) ? $about['cb']['bg_color'] : '',
                        'wrfeatureer_class' => 'show_if_color hide',
                    ) );

                ?>

                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 1', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_1_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][0][counter_title]',
                        'value'         => isset( $about['cb']['counters'][0]['counter_title'] ) ? $about['cb']['counters'][0]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_1_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][0][count_value]',
                        'value'         => isset( $about['cb']['counters'][0]['count_value'] ) ? $about['cb']['counters'][0]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 2', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_2_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][1][counter_title]',
                        'value'         => isset( $about['cb']['counters'][1]['counter_title'] ) ? $about['cb']['counters'][1]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_2_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][1][count_value]',
                        'value'         => isset( $about['cb']['counters'][1]['count_value'] ) ? $about['cb']['counters'][1]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 3', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_3_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][2][counter_title]',
                        'value'         => isset( $about['cb']['counters'][2]['counter_title'] ) ? $about['cb']['counters'][2]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_3_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][2][count_value]',
                        'value'         => isset( $about['cb']['counters'][2]['count_value'] ) ? $about['cb']['counters'][2]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php jobhunt_wp_legend( esc_html__( 'Counter 4', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_4_counter_title',
                        'label'         => esc_html__( 'Counter Title', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the counter title for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][3][counter_title]',
                        'value'         => isset( $about['cb']['counters'][3]['counter_title'] ) ? $about['cb']['counters'][3]['counter_title'] : '',
                    ) );
                    jobhunt_wp_text_input( array(
                        'id'            => '_about_cb_counter_4_count_value',
                        'label'         => esc_html__( 'Count Value', 'jobhunt' ),
                        'placeholder'   => esc_html__( 'Enter the count value for your counters here', 'jobhunt' ),
                        'name'          => '_about[cb][counters][3][count_value]',
                        'value'         => isset( $about['cb']['counters'][3]['count_value'] ) ? $about['cb']['counters'][3]['count_value'] : '',
                    ) );
                ?>
                </div>

                <?php do_action( 'counters_block' ) ?>

            </div><!-- /#counters_block -->

            <div id="recent_posts" class="panel jobhunt_options_panel">

                <?php jobhunt_wp_legend( esc_html__( 'Recent Posts', 'jobhunt' ) ); ?>

                <div class="options_group">
                <?php 

                    jobhunt_wp_text_input( array( 
                        'id'            => '_about_rp_section_title', 
                        'label'         => esc_html__( 'Section Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Section Title here', 'jobhunt' ),
                        'name'          => '_about[rp][section_title]',
                        'value'         => isset( $about['rp']['section_title'] ) ? $about['rp']['section_title'] : '',
                    ) );

                    jobhunt_wp_textarea_input( array( 
                        'id'            => '_about_rp_sub_title', 
                        'label'         => esc_html__( 'Sub Title', 'jobhunt' ), 
                        'placeholder'   => esc_html__( 'Enter the Sub Title here', 'jobhunt' ),
                        'name'          => '_about[rp][sub_title]',
                        'value'         => isset( $about['rp']['sub_title'] ) ? $about['rp']['sub_title'] : '',
                    ) );

                    jobhunt_wp_select( array( 
                        'id'            => '_about_rp_type',
                        'label'         =>  esc_html__( 'Select Version', 'jobhunt' ),
                        'name'          => '_about[rp][type]',
                        'options'       => array(
                            'v1'            => esc_html__( 'v1', 'jobhunt' ),
                            'v2'            => esc_html__( 'v2', 'jobhunt' ),
                            'v3'            => esc_html__( 'v3', 'jobhunt' ),
                        ),
                        'value'         => isset( $about['rp']['type'] ) ? $about['rp']['type'] : 'v1',
                    ) );

                    jobhunt_wp_post_args ( array( 
                        'id'            => '_about_rp_post_args',
                        'name'          => '_about[rp]',
                        'value'         => isset( $about['rp'] ) ? $about['rp'] : '',
                        'fields'        => array( 'limit', 'columns', 'post_choice' , 'post_ids', 'category__in' ),
                    ) );

                ?>

                </div>

                <?php do_action( 'jobhunt_about_after_recent_posts' ) ?>

            </div><!-- /#recent_posts -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_about'] ) ) {
            $clean_about_options = jobhunt_clean_kses_post( $_POST['_about'] );
            update_post_meta( $post_id, '_about_options',  serialize( $clean_about_options ) );
        }   
    }
}