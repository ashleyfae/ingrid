<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
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
 */
function ingrid_theme_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();
		get_template_part( 'inc/template-parts/content', get_post_format() );
	}
}