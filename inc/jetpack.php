<?php
/**
 * Jetpack Compatibility File
 * @see       http://jetpack.me/
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Add theme support for Infinite Scroll.
 * @see   http://jetpack.me/support/infinite-scroll/
 *
 * @since 1.0
 * @return void
 */
function ingrid_theme_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'render'         => 'ingrid_theme_infinite_scroll_render',
		'footer'         => 'page',
		'footer_widgets' => array( 'footer_1', 'footer_2' )
	) );
}

add_action( 'after_setup_theme', 'ingrid_theme_jetpack_setup' );

/**
 * Customizes the callback for Infinite Scroll.
 *
 * @since 1.0
 * @return void
 */
function ingrid_theme_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();
		get_template_part( 'inc/template-parts/content', get_post_format() );
	}
}