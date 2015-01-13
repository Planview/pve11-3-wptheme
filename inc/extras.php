<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Planview Enterprise 11.3
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function pve_113_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'pve_113_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pve_113_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'pve_113_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function pve_113_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'pve_113' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'pve_113_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function pve_113_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'pve_113_setup_author' );

/**
 * Polyfills for IE8
 */
function pve_113_ie_polyfills() { ?>
<!--[if lte IE 8]>
    <style>.bg-size{-ms-behavior:url('<?php echo get_template_directory_uri() . '/bower_components/background-size-polyfill/backgroundsize.min.htc' ?>')}</style>
    <script src="<?php echo get_template_directory_uri() . '/bower_components/respond/dest/respond.min.js' ?>"></script>
<![endif]-->
<?php }
add_action( 'wp_head', 'pve_113_ie_polyfills', 60 );

/**
 * FontAwesome shortcode
 */
function pve_113_fa_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'class' => 'fa-circle'
    ), $atts );

    return sprintf('<span class="fa %s"></span>', $atts['class']);
}
add_shortcode( 'fa','pve_113_fa_shortcode' );

/**
 * Do shortcodes in nav menu titles
 */
function pve_113_nav_shortcodes( $title ) {
    return do_shortcode( $title );
}

/**
 * Vis classes on text in navbar
 */
function pve_113_bootstrap_visibility( $atts, $content ) {
    $atts = shortcode_atts( array(
        'show' => '',
        'hide' => ''
    ), $atts );

    $classes = array();

    foreach (explode(',', $atts['show']) as $size) {
        $size = trim($size);
        $classes[] = "visible-$size";
    }

    foreach (explode(',', $atts['hide']) as $size) {
        $size = trim($size);
        $classes[] = "hidden-$size";
    }

    return sprintf('<span class="%s">%s</span>', implode(' ', $classes), $content);
}
add_shortcode( 'bs-vis','pve_113_bootstrap_visibility' );

/**
 * Add the shortcodes filter at the beginning of the nav menu
 */
function pve_113_pre_wp_nav_menu( $val ) {
    add_filter( 'the_title', 'pve_113_nav_shortcodes', 1 );
    return $val;
}
add_filter( 'pre_wp_nav_menu', 'pve_113_pre_wp_nav_menu' );

/**
 * Remove the shortcodes filter after the menu
 */
function pve_113_wp_nav_menu( $val ) {
    remove_filter( 'the_title', 'pve_113_nav_shortcodes' );
    return $val;
}
add_filter( 'wp_nav_menu', 'pve_113_wp_nav_menu' );

function pve_113_make_img( $data, $classes = array(), $size = null, $title = null ) {
    if ( null !== $size ) {
        $src = $data['sizes'][ $size ];
        $height = $data['sizes'][ "$size-height" ];
        $width = $data['sizes'][ "$size-width" ];
    } else {
        $src = $data['url'];
        $height = $data['height'];
        $width = $data['width'];
    }

    $classes[] = "wp-img-{$data['id']}";

    return sprintf(
        '<img src="%s" height="%s" width="%s" alt="%s" title="%s" class="%s" >',
        $src,
        $height,
        $width,
        esc_attr( $data['alt'] ),
        esc_attr( $title ) ?: esc_attr( $data['description'] ),
        esc_attr( implode(' ', $classes) )
    );
}

function pve_113_blueimp_gallery_html( $tag, $handle ) {
    if ( ! in_array( $handle, array( 'blueimp-gallery', 'blueimp-gallery-jquery' ) ) )
        return $tag;

    $tag = '<div id="blueimp-gallery" class="blueimp-gallery">' .
        '<div class="slides"></div>' .
        '<h3 class="title"></h3>' .
        '<a class="prev">‹</a>' .
        '<a class="next">›</a>' .
        '<a class="close">×</a>' .
        '<a class="play-pause"></a>' .
        '<ol class="indicator"></ol>' .
    '</div>' . $tag;

    return $tag;
}
add_filter( 'script_loader_tag', 'pve_113_blueimp_gallery_html', 10, 2 );


function pve_113_marketo_home() {
    if (!is_front_page() || !is_user_logged_in()) return;

    add_action( 'wp_footer', function () {
        ?>
        <script>
        (function (global) {
            var munchkin = global.Munchkin;
            console.log(munchkin);
            if (typeof munchkin !== 'undefined') {
                munchkin.munchkinFunction('visitWebPage', {
                    url: global.location.href, params: 'loggedin'
                });
            }
        }(this));
        </script>
        <?php
    }, 9999 );
}
add_action( 'wp_head', 'pve_113_marketo_home' );
