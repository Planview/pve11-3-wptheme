<?php

get_header(); ?>
    <div class="jumbotron jumbo-header">
        <div class="container">
            <h1>
                <?php the_title(); ?>
            </h1>
            <a href="<?php echo get_post_type_archive_link( 'library' ); ?>"><?php _e('&laquo; Back to the Resource Library', 'pve_113'); ?></a>
        </div>
    </div>
    <div id="primary" class="content-area container">
        <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : ?>
                <?php while( have_posts() ) : the_post(); ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="limelight-video-respond thumbnail">
                                <?php echo preg_replace('/<param[^>]*name="wmode"[^>]*>/', '<param name="wmode" value="transparent" />', get_field( 'pv_event_resource_video_code' ) ); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer();
