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
                            <script>
                              jQuery(document).ready(function ($) {
                                if ($('object[id^="limelight"]').length > 0) {
                                  $('.pre-limelight-load').show();
                                }
                              });

                              function limelightPlayerCallback(playerId, eventName, data) {
                                'use strict';

                                var $ = window.jQuery,
                                    id = $('object[id^="limelight"]').attr('id'),
                                    spoofMunchkin = function spoofer(queryString) {
                                      if ('undefined' !== typeof window.Munchkin) {
                                        window.Munchkin.munchkinFunction('visitWebPage', {
                                          url: global.location.href, params: queryString
                                        });
                                      } else {
                                        setTimeout(function () {
                                          spoofer(queryString);
                                        }, 1000);
                                      }
                                    };


                                if (eventName == 'onPlayerLoad' && (LimelightPlayer.getPlayers() == null || LimelightPlayer.getPlayers().length == 0)) {
                                  LimelightPlayer.registerPlayer(id);
                                }

                                if (eventName === 'onPlayerLoad') {
                                  $('.pre-limelight-load').remove();
                                  spoofMunchkin('playerload');
                                }
                              }
                            </script>
                            <p class="pre-limelight-load">This video uses streaming video over Limelight Networks. If the player does not load, please contact your company&rsquo;s IT department.</p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer();
