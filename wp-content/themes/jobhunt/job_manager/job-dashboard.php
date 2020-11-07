<?php
/**
 * Job dashboard shortcode content.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-dashboard.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$post_a_job_page_id = get_option( 'job_manager_submit_job_form_page_id' );
?>
<div id="job-manager-job-dashboard">
    <div class="job-manager-job-dashboard-inner">
        <?php if( jobhunt_is_woocommerce_activated() ) {
            do_action( 'woocommerce_account_navigation' );
        } ?>
        <div class="job-manager-job-dashboard-content">
            <p><?php esc_html_e( 'Your listings are shown in the table below.', 'jobhunt' ); ?></p>
            <table class="job-manager-jobs">
                <thead>
                    <tr>
                        <?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
                            <th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( ! $jobs ) : ?>
                        <tr>
                            <td colspan="<?php echo intval( count( $job_dashboard_columns ) ); ?>"><?php esc_html_e( 'You do not have any active listings.', 'jobhunt' ); ?></td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $jobs as $job ) : ?>
                            <tr>
                                <?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
                                    <td class="<?php echo esc_attr( $key ); ?>">
                                        <?php if ('job_title' === $key ) : ?>
                                            <?php if ( $job->post_status == 'publish' ) : ?>
                                                <a href="<?php echo esc_url( get_permalink( $job->ID ) ); ?>"><?php wpjm_the_job_title( $job ); ?></a>
                                            <?php else : ?>
                                                <?php wpjm_the_job_title( $job ); ?> <small>(<?php the_job_status( $job ); ?>)</small>
                                            <?php endif; ?>
                                            <?php echo is_position_featured( $job ) ? '<span class="featured-job-icon" title="' . esc_attr__( 'Featured Job', 'jobhunt' ) . '"></span>' : ''; ?>
                                            <ul class="job-dashboard-actions">
                                                <?php
                                                    $actions = array();

                                                    switch ( $job->post_status ) {
                                                        case 'publish' :
                                                            if ( wpjm_user_can_edit_published_submissions() ) {
                                                                $actions[ 'edit' ] = array( 'label' => __( 'Edit', 'jobhunt' ), 'nonce' => false );
                                                            }
                                                            if ( is_position_filled( $job ) ) {
                                                                $actions['mark_not_filled'] = array( 'label' => __( 'Mark not filled', 'jobhunt' ), 'nonce' => true );
                                                            } else {
                                                                $actions['mark_filled'] = array( 'label' => __( 'Mark filled', 'jobhunt' ), 'nonce' => true );
                                                            }
                                                            $actions['duplicate'] = array( 'label' => __( 'Duplicate', 'jobhunt' ), 'nonce' => true );
                                                            break;
                                                        case 'expired' :
                                                            if ( job_manager_get_permalink( 'submit_job_form' ) ) {
                                                                $actions['relist'] = array( 'label' => __( 'Relist', 'jobhunt' ), 'nonce' => true );
                                                            }
                                                            break;
                                                        case 'pending_payment' :
                                                        case 'pending' :
                                                            if ( job_manager_user_can_edit_pending_submissions() ) {
                                                                $actions['edit'] = array( 'label' => __( 'Edit', 'jobhunt' ), 'nonce' => false );
                                                            }
                                                        break;
                                                        case 'draft' :
                                                        case 'preview' :
                                                            $actions['continue'] = array( 'label' => __( 'Continue Submission', 'jobhunt' ), 'nonce' => true );
                                                            break;
                                                    }

                                                    $actions['delete'] = array( 'label' => esc_html__( 'Delete', 'jobhunt' ), 'nonce' => true );
                                                    $actions           = apply_filters( 'job_manager_my_job_actions', $actions, $job );

                                                    foreach ( $actions as $action => $value ) {
                                                        $action_url = add_query_arg( array( 'action' => $action, 'job_id' => $job->ID ) );
                                                        if ( $value['nonce'] ) {
                                                            $action_url = wp_nonce_url( $action_url, 'job_manager_my_job_actions' );
                                                        }
                                                        echo '<li><a href="' . esc_url( $action_url ) . '" class="job-dashboard-action-' . esc_attr( $action ) . '">' . esc_html( $value['label'] ) . '</a></li>';
                                                    }
                                                ?>
                                            </ul>
                                        <?php elseif ('date' === $key ) : ?>
                                            <?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $job->post_date ) ) ); ?>
                                        <?php elseif ('expires' === $key ) : ?>
                                            <?php echo esc_html( $job->_job_expires ? date_i18n( get_option( 'date_format' ), strtotime( $job->_job_expires ) ) : '&ndash;' ); ?>
                                        <?php elseif ('filled' === $key ) : ?>
                                            <?php echo is_position_filled( $job ) ? '&#10004;' : '&ndash;'; ?>
                                        <?php else : ?>
                                            <?php do_action( 'job_manager_job_dashboard_column_' . $key, $job ); ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <?php if ( ! empty( $post_a_job_page_id ) ) : ?>
                    <tfoot>
                        <tr>
                            <td colspan="<?php echo sizeof( $job_dashboard_columns ); ?>">
                                <a href="<?php echo esc_url( get_permalink( $post_a_job_page_id ) ); ?>"><?php echo apply_filters( 'jobhunt_wpjm_job_dashboard_post_a_job_button_text', esc_html__( 'Post A Job', 'jobhunt' ) ); ?></a>
                            </td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
            <?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
        </div>
    </div>
</div>