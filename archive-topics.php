<?php

get_header(); ?>
    <header class="jumbotron jumbo-header">
        <div class="container">
            <h1>
                <?php _e('Enhancements &amp; Services', 'pve_113'); ?>
            </h1>
        </div>
    </header>
    <main class="content-area container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php if ( have_posts() ) : $counter = 0; ?>
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); $counter += 1; ?>
                            <article class="col-sm-4">
                                <div class="panel panel-topics">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-center"><a href="<?php the_permalink() ?>" class="btn btn-default">View</a></p>
                                    </div>
                                </div>
                            </article>
                            <?php if ( 0 === $counter % 3 && $counter !== count($GLOBALS['posts'] ) ) : ?>
                                </div><div class="row">
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php get_footer();
