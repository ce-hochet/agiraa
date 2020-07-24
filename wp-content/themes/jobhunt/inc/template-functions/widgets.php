<?php
/**
 * Template functions used in Widgets
 */

if ( ! function_exists( 'jobhunt_modify_widget_pages_args' ) ) {
    function jobhunt_modify_widget_pages_args( $args, $instance ) {
        require_once get_template_directory() . '/inc/classes/class-jobhunt-walker-page.php';
        $args['walker'] = new Jobhunt_Walker_Page;
        return $args;
    }
}

if ( ! function_exists( 'jobhunt_modify_widget_categories_args' ) ) {
    function jobhunt_modify_widget_categories_args( $args, $instance ) {
        require_once get_template_directory() . '/inc/classes/class-jobhunt-walker-category.php';
        $args['walker'] = new Jobhunt_Walker_Category;
        return $args;
    }
}

if ( ! function_exists( 'jobhunt_modify_widget_nav_menu_args' ) ) {
    function jobhunt_modify_widget_nav_menu_args( $nav_menu_args, $nav_menu, $args, $instance ) {
        require_once get_template_directory() . '/inc/classes/class-jobhunt-walker-nav-menu.php';
        $nav_menu_args['walker'] = new Jobhunt_Walker_Nav_Menu;
        return $nav_menu_args;
    }
}
