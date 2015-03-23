<?php
/**
 * Theme functions and definitions
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Sets up the theme defaults and registers support for various WordPress features.
 */
function ng_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CW Theme, use a find and replace
	 * to change 'netgalley' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ingrid', get_template_directory() . '/languages' );

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
		'main_menu' => __( 'Main Menu', 'ingrid' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ng_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'ng_custom_header_args', array(
		'default-text-color' => '000000',
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'ng_theme_header_style'
	) ) );

	// Adds support for <title> tags, so we don't have to add them to the header.
	add_theme_support( 'title-tag' );

	/*
	 * Remove unnecessary elements from the header
	 */
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Category Feeds
	remove_action( 'wp_head', 'rsd_link' ); // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' ); // WP version
}

add_action( 'after_setup_theme', 'ng_theme_setup' );

// Specify the content width.
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ng_theme_widgets_init() {

	// Register the footer widgets.
	register_sidebar( array(
		'name'          => __( 'Footer - Column #1', 'ingrid' ),
		'id'            => 'footer_1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer - Column #2', 'ingrid' ),
		'id'            => 'footer_2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}

add_action( 'widgets_init', 'ng_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ng_theme_scripts() {
	//wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	wp_enqueue_style( 'droid-serif', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,700' );

	wp_enqueue_style( 'ingrid', get_stylesheet_uri(), array(), '1.0.0' );
	wp_add_inline_style( 'ingrid', ng_theme_generate_custom_styles() );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	//wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ng_theme_scripts' );

/**
 * Customizer additions.
 */
function ng_theme_customizer_uri( $uri ) {
	return get_template_directory_uri() . '/inc/customizer';
}

add_filter( 'thsp_cbp_directory_uri', 'ng_theme_customizer_uri' );
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * aq_resizer script
 */
require get_template_directory() . '/inc/aq_resizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load UBB integration file.
 */
require get_template_directory() . '/inc/ubb.php';