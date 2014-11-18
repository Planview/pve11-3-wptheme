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
