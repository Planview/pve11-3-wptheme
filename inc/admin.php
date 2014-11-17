<?php

function pve_113_show_admin_bar( $setting ) {
    if ( ! current_user_can( 'edit_posts' ) ) return false;

    return $setting;
}
add_filter( 'show_admin_bar', 'pve_113_show_admin_bar' );

function pve_113_hide_admin () {
    if ( is_admin() && ! current_user_can( 'edit_posts' ) ) {
        wp_safe_redirect( home_url() );
    }
}
add_action('init', 'pve_113_hide_admin');
