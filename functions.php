<?php
/**
 * Planview Enterprise 11.3 functions and definitions
 *
 * @package Planview Enterprise 11.3
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'pve_113_settings' ) ) :
/**
 * Gets any settings that shouldn't be included in VCS
 *
 * @return mixed The requested setting
 */
function pve_113_settings($setting) {
    static $settings;
    if ( !isset($settings) ) {
        $settings_doc = get_stylesheet_directory() . '/settings.php';
        if ( !file_exists($settings_doc) ) die('Settings File Required for theme');
        $settings = include get_stylesheet_directory() . '/settings.php';
    }
    return $settings[$setting];
}
endif;

if ( ! function_exists( 'pve_113_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pve_113_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Planview Enterprise 11.3, use a find and replace
     * to change 'pve_113' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'pve_113', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'pve_113' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link',
    ) );
}
endif; // pve_113_setup
add_action( 'after_setup_theme', 'pve_113_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pve_113_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'pve_113' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'pve_113_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pve_113_scripts() {
    if ( is_admin() ) {
        wp_enqueue_style( 'pve_113-style', get_stylesheet_uri() );
    } else {
        wp_register_style( 'avenir', pve_113_settings('font-url') );
        wp_enqueue_style( 'pve_113-style', get_stylesheet_directory_uri() .
            '/css/style.css', array('avenir') );
    }

    wp_register_script( 'stellar', get_stylesheet_directory_uri() .
            '/bower_components/stellar/jquery.stellar.min.js', array( 'jquery' ),
            '0.6.2', true );
    wp_enqueue_script( 'pve_113-scripts', get_stylesheet_directory_uri() .
            '/js/main.js', array( 'stellar', 'jquery' ) );
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() .
        '/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js',
        array('jquery'), '3.3.0' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pve_113_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions that change TinyMCE behavior
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Custom functions to keep people out of the admin area;
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Custom functions to control login functionalities
 */
require get_template_directory() . '/inc/login.php';

/**
 * Custom fields via ACF
 */
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Making modals easier
 */
require get_template_directory() . '/inc/modals.php';

/**
 * Navigational walking
 */
require get_template_directory() . '/inc/nav-walkers.php';

/**
 * Resource Library functions
 */
require get_template_directory() . '/inc/library.php';
