<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Planview Enterprise 11.3
 */

get_header(); ?>

    <div class="jumbotron jumbo-header">
        <div class="container">
            <h1>
                <?php echo get_field( 'pv_event_resources_archive_title', 'option' ) ?: __( 'Resource Library', 'pve_113' ); ?>
            </h1>
            <?php echo get_field( 'pv_event_resources_archive_intro', 'option' ) ?: ''; ?>
        </div>
    </div>
    <?php if ( have_posts() ) : $sorted_posts = pve_113_library_sort_by_product(); $activeParentSet = false; $activeReleaseSet = false; ?>
        <nav class="resources-tabs">
            <div class="container">
                <ul class="nav nav-pills nav-justified">
                    <?php $parentID = 0;?>
                    <?php foreach ( $sorted_posts as $release => $release_posts ) : ?>
                        <?php
                            if ( $release_posts['__object']->parent != $parentID ) {
                                if ( $parentID != 0 ) {
                                    // if we've already set parentID, so close it
                                    echo '</ul></li>';
                                } else {
                        ?>
                        <li<?php echo $activeProductSet ? ' class="dropdown"' : ' class="active dropdown"'; $activeProductSet = true; ?>><a class="dropdown-toggle" href="#" role="tab" data-toggle="dropdown"><?php echo $release_posts['__object']->parent_name; ?> <span class="caret" style="display: inline-block;"></span></a><ul class="dropdown-menu" role="menu">
                        <?php
                                }
                            }
                        ?>
                        <li<?php echo $activeReleaseSet ? '' : ' class="active"'; $activeReleaseSet = true; ?>><a href="#<?php echo $release_posts['__object']->slug; ?>" data-toggle="tab"><?php echo $release; ?></a></li>
                        <?php

                            $parentID = $release_posts['__object']->parent;

                        endforeach; 

                        if ( $parentID != 0 ) { 
                            $parentID = 0;
                            echo '</ul></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    <?php endif; ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : $sorted_posts = pve_113_library_sort_by_product(); $activeSet = false; // var_dump($sorted_posts) ?>
                <div class="tab-content">
                <?php foreach ($sorted_posts as $release => $release_posts) : ?>
                    <div class="release tab-pane<?php echo $activeSet ? '' : ' active'; $activeSet = true; ?>" id="<?php echo $release_posts['__object']->slug; ?>">
                        <?php if ( isset( $release_posts['__featured'] ) ) :
                            $post = $release_posts['__featured'];
                            setup_postdata( $post ); ?>
                            <div class="featured-resource">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <a href="<?php the_permalink(); ?>"<?php echo pve_113_resource_target( get_field( 'pv_event_resource_doc_type' ) ) ?>>
                                                <?php pve_113_featured_image( 'library-featured', 'img-responsive' ); ?>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2><span class="small"><?php _e('Featured:', 'pve_113') ?></span><br /> <?php the_title(); ?></h2>
                                            <p class="hidden-sm hidden-xs"><?php echo get_the_excerpt(); ?></p>
                                            <p><a href="<?php the_permalink(); ?>" class="btn btn-success pop-up-video"><?php _e('View it Now!'.the_title( '<span class="sr-only"> ', '</span>'), 'pve_113') ?></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="resource-listing">
                            <div class="container">
                                <div class="row"><?php $post_counter = 0; ?>
                                    <?php foreach ( $release_posts as $key => $post ) :
                                        if ('__object' === $key || '__featured' === $key ) continue;
                                        $post_counter += 1;
                                        setup_postdata( $post ); ?>
                                        <div class="col-sm-4 resource-pane">
                                            <div class="panel">
                                                <div class="panel-body">
                                                <a href="<?php the_permalink(); ?>"<?php echo pve_113_resource_target( get_field( 'pv_event_resource_doc_type' ) ) ?>>
                                                    <?php pve_113_featured_image( 'library', 'img-responsive center-block hidden-xs' ); ?>
                                                </a>
                                                <h4>
                                                    <a href="<?php the_permalink(); ?>"<?php echo pve_113_resource_target( get_field( 'pv_event_resource_doc_type' ) ) ?>>
                                                        <span class="fa <?php echo pve_113_icon_class( get_field( 'pv_event_resource_doc_type' ) ) ?>"></span>
                                                        <?php the_title(); ?>
                                                    </a>
                                                    <br><small><?php $types = get_field('pv_event_resource_type'); $type = reset($types); echo $type->name; ?></small>
                                                </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (( 0 === $post_counter % 3 ) && ( $post_counter !== count($release_posts) - (isset($release_posts['__featured']) ? 2 : 1) ) ) : ?>
                                </div><div class="row">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
