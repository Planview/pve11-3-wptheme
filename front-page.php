<?php
/**
 * The controller for displaying the front page.
 *
 * This is the controller that is used for displaying the front
 * page. It is used to split the front- and back-end portions
 * of the application
 *
 * Template Name: Front Page
 *
 * @package Planview Enterprise 11.3
 */

if ( !is_user_logged_in() || pve_113_home_preview() ) {
    get_template_part( 'front-page', 'logged-out' );
} else {
    get_template_part( 'front-page', 'logged-in' );
}
