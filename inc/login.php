<?php

/**
 * Determines if the user is trying to preview the logged-out
 * content for the homepage from a logged in state.
 */
function pve_113_home_preview() {
    if ( ! isset( $_GET['pve_preview'] ) )
        return false;

    return ('home' === $_GET['pve_preview'] && current_user_can( 'install_themes' ) );
}

/**
 * Adds a class of `not-logged-in` to the body if the user
 * isn't logged in
 */
function pve_113_logged_out_class($classes) {
    if ( ! is_user_logged_in() || pve_113_home_preview() ) {
        $classes[] = 'not-logged-in';
    }

    return $classes;
}
add_filter( 'body_class', 'pve_113_logged_out_class' );



/**
 * Enqueue some styles to make things prettier
 */
function pve_113_login_styles() {
    wp_enqueue_style( 'avenir', pve_113_settings('font-url') );
    wp_enqueue_style( 'pve_113-style', get_template_directory_uri() . '/css/login.css', array('avenir') );
}
add_action( 'login_init', 'pve_113_login_styles' );

function pve_113_login_init() {
    add_filter('style_loader_tag', 'pve_113_style_loader_tag', 1, 2);
    add_action('login_head', 'pve_113_force_login_styles');
}
add_action( 'login_init', 'pve_113_login_init' );

function pve_113_style_loader_tag($tag, $handle) {
    if ( in_array( $handle, array( 'login', 'buttons', 'open-sans', 'dashicons' ) ) ) {
        return '';
    }
    return $tag;
}

function pve_113_force_login_styles() {
    wp_print_styles('pve_113-style');
}

function pve_113_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'pve_113_login_logo_url' );

function pve_113_login_logo_url_title() {
    return get_bloginfo( 'name' );;
}
add_filter( 'login_headertitle', 'pve_113_login_logo_url_title' );

function pve_113_login_access() {
    if ( is_user_logged_in() ) return;

    $post_types = array( 'library', 'topics', 'presentations' );
    if ( is_singular( $post_types ) || is_post_type_archive( $post_types ) ||
            ( is_page() && get_field( 'pve_113_page_logged_in_only', $GLOBALS['post']->ID ) ) ) {
        wp_redirect( home_url( '/' ), 302 );
        exit;
    }
}
add_action( 'wp', 'pve_113_login_access' );

add_action( 'gform_encrypt_password', '__return_true' );
