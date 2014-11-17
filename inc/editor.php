<?php
/**
 * Functions for making TinyMCE play nice
 */

function pve_113_tinymce_styles() {
    add_editor_style( pve_113_settings('font-url') );
    add_editor_style( 'css/editor.css' );
}
add_action( 'after_setup_theme', 'pve_113_tinymce_styles' );

/**
 * Make the editor respect empty `<span>` elements
 */
function pve_113_tinymce_settings_filter ( $settings ) {
    $opts = 'span[*],i[*],.fa';
    if ( ! isset( $settings['valid_elements'] ) ) {
        $settings['valid_elements'] = $opts;
    } else {
        $settings['valid_elements'] .= ',' . $opts;
    }
    error_log( print_r($settings, true) );
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'pve_113_tinymce_settings_filter' );
