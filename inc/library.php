<?php
/**
 * Functions to manipulate library-specific stuff
 */

/**
 * Filter the permalinks for resources
 *
 * @param   string  $permalink  The current permalink
 * @param   WP_Post $post       The post we're looking at
 * @return  string  The filtered permalink
 */
function pve_113_resource_post_link( $permalink, $post ) {
    if ( 'library' !== $post->post_type )
        return $permalink;

    $type = get_field( 'pv_event_resource_doc_type', $post->ID );

    switch ( $type ) {
        case 'pdf':
            $file = get_field( 'pv_event_resource_file', $post->ID );
            return $file['url'];
        case 'slideshare':
        case 'link':
            return trim( get_field( 'pv_event_resource_url', $post->ID ) );
    }
    return $permalink;
}
add_filter( 'post_type_link', 'pve_113_resource_post_link', 10, 2 );


/**
 * Return a Font-awesome class based on resource type
 */
function pve_113_icon_class( $type ) {
    switch ($type) {
        case 'pdf':
            return 'fa-file-pdf-o';
        case 'video':
            return 'fa-film';
        case 'slideshare':
            return 'fa-slideshare';
        default:
            return 'fa-external-link';
    }
}


/**
 * Filter the Query so that we get all the resources back
 */
function pve_113_library_pre_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'library' ) )
        return;

    $query->set('posts_per_page', -1);
    $query->set('orderby', 'name');
    $query->set('order', 'ASC');
}
add_action('pre_get_posts', 'pve_113_library_pre_get_posts');

/**
 * A function to re-sort the library
 */
function pve_113_library_sort() {
    $sorted_list = array();

    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();

            $release = get_field( 'pv_event_resource_release' );
            $type = get_field( 'pv_event_resource_type' );

            $release = reset($release);
            $type = reset($type);

            if ( ! isset( $sorted_list[$release->name] ) ) {
                $sorted_list[$release->name] = array();
            }

            if ( ! isset( $sorted_list[$release->name][$type->name] ) ) {
                $sorted_list[$release->name][$type->name] = array();
            }

            $sorted_list[$release->name][$type->name][] = $GLOBALS['post'];
        }
    }

    uksort( $sorted_list, 'strcasecmp' );
    $sorted_list = array_reverse( $sorted_list );

    foreach ( $sorted_list as $release_name => $release_array ) {
        uksort( $release_array, 'strcasecmp' );
        $sorted_list[$release_name] = $release_array;
    }

    return $sorted_list;
}
