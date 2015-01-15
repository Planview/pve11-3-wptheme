<?php


get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : the_post(); ?>
        <div class="jumbotron jumbo-header">
            <div class="container">
                <h1>
                    <?php the_title(); ?>
                </h1>
                    <?php the_content( ); ?>
            </div>
        </div>
        <div class="video">
            <div class="container">
                <div class="thumbnail limelight-video-respond">
                    <?php echo preg_replace('/<param[^>]*name="wmode"[^>]*>/', '<param name="wmode" value="transparent"/>', get_field( 'pv_event_topic_playlist' ) ); ?>
                </div>
                <script>
                  jQuery(document).ready(function ($) {
                    $('.pre-limelight-load').show();
                  });

                  function limelightPlayerCallback(playerId, eventName, data) {
                    'use strict';

                    var $ = window.jQuery,
                        id = $('.LimelightEmbeddedPlayerFlash').attr('id'),
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
        <div id="primary" class="content-area container">
            <div class="row">
                <div class="col-sm-9 experts">
                    <section>
                        <h3 class="section-title">Ask the Experts</h3>
                        <?php echo do_shortcode( get_field( 'pv_event_topic_qa_form' ) ); ?>
                    </section>
                    <?php if ( have_rows( 'pv_event_speakers' ) ) : ?>
                        <section>
                            <h3 class="section-title">Experts</h3>
                            <div class="row">
                                <?php while ( have_rows( 'pv_event_speakers' ) ) : the_row(); ?>
                                    <div class="col-md-4">
                                        <div class="thumbnail">
                                            <a data-toggle="modal" data-target="#<?php echo sanitize_title( get_sub_field('name') ); ?>" href="#<?php echo sanitize_title( get_sub_field('name') ); ?>">
                                                <?php echo pve_113_make_img(
                                                    get_sub_field('photo'),
                                                    array('center-block', 'img-responsive'),
                                                    'experts',
                                                    get_sub_field('tagline')
                                                ); ?>
                                            </a>
                                            <div class="caption">
                                                <h4><a data-toggle="modal" data-target="#<?php echo sanitize_title( get_sub_field('name') ); ?>" href="#<?php echo sanitize_title( get_sub_field('name') ); ?>"><?php the_sub_field('name') ?></a><br>
                                                <span class="text-muted"><?php the_sub_field('title') ?></span>
                                                </h4>

                                                <?php if ( get_sub_field('twitter') || get_sub_field('email')) : ?>
                                                    <ul class="fa-ul">
                                                        <?php if ( get_sub_field('twitter') ) : ?>
                                                            <li>
                                                                <a href="https://twitter.com/<?php the_sub_field('twitter') ?>" target="_blank">
                                                                    <span class="fa fa-twitter-square fa-li"></span>
                                                                    @<?php the_sub_field('twitter') ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if ( get_sub_field('email') ) : ?>
                                                            <li>
                                                                <a href="mailto:<?php the_sub_field('email') ?>">
                                                                    <span class="fa fa-envelope-square fa-li"></span>
                                                                    <?php the_sub_field('email') ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php pve_113_modal(
                                        sanitize_title( get_sub_field( 'name' ) ),
                                        get_sub_field( 'name' ),
                                        get_sub_field( 'bio' )
                                    ); ?>
                                <?php endwhile; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                <div class="col-sm-3">
                    <aside class="resource-list">
                        <h3 class="section-title">Resources</h3>
                        <?php pve_113_resource_list( get_field( 'pv_event_presentation_resources' ) ); ?>
                    </aside>
                </div>
            </div>
        </div><!-- #primary -->

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
