<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function ng_theme_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ng_theme_infinite_scroll_render',
		'footer'    => 'page',
	) );
}

add_action( 'after_setup_theme', 'ng_theme_jetpack_setup' );

/**
 * Customizes the callback for Infinite Scroll.
 */
function ng_theme_infinite_scroll_render() {
	/* We figure out which display option is selected in the Customizer, then
	 * include the correct template file based on that.
	 */

	$layout_setting = ng_option( 'post_content' );
	$post_layout    = ( empty( $layout_setting ) ) ? 'single' : $layout_setting;
	if ( $post_layout != 'single' && ! empty( $post_layout ) ) {
		$post_layout = get_post_format();
	}

	get_template_part( 'inc/template-parts/content', $post_layout );
}