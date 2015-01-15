<?php

if ( ! defined('ACF_LITE') ) {
    define('ACF_LITE', true);
}

include_once get_template_directory() . '/vendor/advanced-custom-fields/acf.php';
if ( ! class_exists('acf_field_wp_wysiwyg') ) {
    include_once get_template_directory() . '/submodules/acf-wordpress-wysiwyg-field/acf-wp_wysiwyg.php';
}

/**
 * Shortcut function for the pathnames for custom fields files
 */
function pve_113_custom_fields($filename) {
    return get_template_directory() . "/custom-fields/$filename";
}

include_once pve_113_custom_fields('front-page.php');
include_once pve_113_custom_fields('pages.php');
include_once pve_113_custom_fields('library-sort.php');
include_once pve_113_custom_fields('presentations.php');
