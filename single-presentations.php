<?php


get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : the_post(); ?>
        <div class="jumbotron jumbo-header">
            <div class="container">
                <h1>
                    <?php the_title(); ?>
                    <?php the_field( 'pv_event_presentation_abstract' ); ?>
                </h1>
            </div>
        </div>
        <div class="video">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="thumbnail limelight-video-respond">
                            <?php echo preg_replace('/<param[^>]*name="wmode"[^>]*>/', '<param name="wmode" value="transparent"/>', get_field( 'pv_event_presentation_video' ) ); ?>
                        </div>
                        <div class="qa-form"><?php echo do_shortcode( get_field('pv_event_presentation_qa_form') ); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="primary" class="content-area container">
            <div class="row">
                <div class="col-sm-9 comments">
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                </div>
                <div class="col-sm-3">
                    <aside class="resource-list">
                        <h3>Resources</h3>
                            <ul class="fa-ul">
                                <li><span class="fa fa-li fa-file-o"></span> Lorem ipsum dolor sit.</li>
                                <li><span class="fa fa-li fa-file-o"></span> Lorem ipsum dolor sit.</li>
                                <li><span class="fa fa-li fa-file-o"></span> Lorem ipsum dolor sit.</li>
                                <li><span class="fa fa-li fa-file-o"></span> Lorem ipsum dolor sit.</li>
                            </ul>
                    </aside>
                </div>
            </div>
            <main id="main" class="site-main" role="main">
            </main><!-- #main -->
        </div><!-- #primary -->

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
