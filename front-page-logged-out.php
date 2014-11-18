<?php
/**
 * The template for displaying the public front page.
 *
 * This is the template that is used for displaying the front
 * page if the user is not logged in.
 *
 * @package Planview Enterprise 11.3
 */

get_header('head');

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="jumbotron">
            <div class="container text-center">
                <?php the_field('113_front_jumbotron_content'); ?>
            </div>
        </div>
        <div class="image-banner bg-size" data-stellar-background-ratio="0.5">
            <div class="container">
                <?php the_field('113_front_image_banner_content'); ?>
            </div>
        </div>
        <?php if ( get_field( '113_front_reg_modal_content' ) ) {
            pve_113_modal(
                'registration',
                __('Register for the Event', 'pve_113'),
                get_field( '113_front_reg_modal_content' )
            );
        } ?>
    <?php endwhile;
endif;

pve_113_modal(
    'login',
    __('Login', 'Modal title', 'pve_113'),
    pve_113_login_modal_body(),
    'modal-sm'
);

get_footer();
