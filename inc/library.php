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

            if ( ! $release ) continue;

            $release = reset($release);

            if ( ! isset( $sorted_list[$release->name] ) ) {
                $sorted_list[$release->name] = array();
                $sorted_list[$release->name]['__object'] = $release;
            }

            if ( get_field( 'pv_event_resource_featured' ) &&
                    ! isset( $sorted_list[$release->name]['__featured'] ) ) {
                $sorted_list[$release->name]['__featured'] = $GLOBALS['post'];
            } else {
                $sorted_list[$release->name][] = $GLOBALS['post'];
            }
        }
    }

    uasort( $sorted_list, function ($a, $b) {
        $a_val = get_field( 'pve_113_library_sort_order',
            "{$a['__object']->taxonomy}_{$a['__object']->term_id}" );
        $b_val = get_field( 'pve_113_library_sort_order',
            "{$b['__object']->taxonomy}_{$b['__object']->term_id}" );
        return $a_val - $b_val;
    } );

    return $sorted_list;
}

/**
 * Return `target="_blank"` if it should open in a new window
 */
function pve_113_resource_target($type) {
    switch ($type) {
        case 'pdf':
        case 'slideshare':
        case 'link':
            return ' target="_blank"';
        case 'video':
        default:
            return '';
    }
}

function pve_113_resource_list( $resources, $echo = true ) {
    global $post;
    if ( empty($resources) ) return false;

    $list = '<ul class="fa-ul">';

    foreach ( $resources as $post ) {
        setup_postdata( $post );

        $type = get_field('pv_event_resource_doc_type');

        $list .= sprintf(
            '<li>' .
                '<a href="%s" title="%s"%s>' .
                    '<span class="fa fa-li %s"></span> %s' .
                '</a>' .
            '</li>',
            get_permalink(),
            esc_attr( get_the_title() ),
            pve_113_resource_target( $type ),
            pve_113_icon_class( $type ),
            get_the_title()
        );
    }

    $list .= '</ul>';

    if ($echo) {
        echo $list;
        return true;
    } else {
        return $list;
    }
    wp_reset_postdata();
}
