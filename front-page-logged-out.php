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
            <div class="image-banner" data-stellar-background-ratio="0.5">
              <div class="container">
                <?php the_field('113_front_image_banner_content'); ?>
              </div>
            </div>
        <?php endwhile;
    endif;
get_footer();
