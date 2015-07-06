<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Adds a custom stylesheet to the visual editor
 */
function ingrid_theme_add_editor_styles() {
	add_editor_style();
}

add_action( 'after_setup_theme', 'ingrid_theme_add_editor_styles' );

/**
 * Creates a new navigation menu in the main_nav location.
 */
function ingrid_theme_navigation() {
	wp_nav_menu(
		array(
			'theme_location' => 'main_menu',
			'container'      => false,
			'depth'          => '2',
			'fallback_cb'    => 'ingrid_theme_navigation_fallback'
		)
	);
}

function ingrid_theme_navigation_fallback() {
	$args = array(
		'depth'       => 2,
		'sort_column' => 'menu_order, post_title',
		'menu_class'  => 'menu',
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'show_home'   => true,
		'link_before' => '',
		'link_after'  => ''
	);

	wp_page_menu( $args );
}

/**
 * Replaces the "current-menu-item" class with "active"
 * to make the menu compatible with Bootstrap.
 *
 * @param string $text
 *
 * @return string
 */
function ingrid_theme_current_to_active( $text ) {
	$replace = array(
		//List of menu item classes that should be changed to "active"
		'current_page_item'     => 'active',
		'current_page_parent'   => 'active',
		'current_page_ancestor' => 'active',
		'current-menu-item'     => 'active',
	);
	$text    = str_replace( array_keys( $replace ), $replace, $text );

	return $text;
}

add_filter( 'wp_nav_menu', 'ingrid_theme_current_to_active' );

/**
 * Filters the display of the search form.
 *
 * @param string $form The default search form HTML.
 *
 * @return string The filtered search form HTML.
 */
function ingrid_theme_search_form( $form ) {
	$form = '
	<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '">
		<i class="fa fa-angle-double-right"></i>
		<input type="search" class="search-field" placeholder="' . esc_attr_x( 'keyword + enter', 'placeholder', 'ingrid' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search the blog', 'placeholder', 'ingrid' ) . '">
	</form>
	';

	return $form;
}

add_filter( 'get_search_form', 'ingrid_theme_search_form' );

/**
 * Gets all of the social media URLs and puts them
 * into an unordered list with the appropriate icons.
 *
 * @return string
 */
function ingrid_social_media_links() {
	$li_array     = array();
	$social_sites = array(
		'twitter'   => array(
			'link' => get_theme_mod( 'ingrid_twitter' ),
			'icon' => 'twitter',
		),
		'facebook'  => array(
			'link' => get_theme_mod( 'ingrid_facebook' ),
			'icon' => 'facebook',
		),
		'pinterest' => array(
			'link' => get_theme_mod( 'ingrid_pinterest' ),
			'icon' => 'pinterest-p',
		),
		'instagram' => array(
			'link' => get_theme_mod( 'ingrid_instagram' ),
			'icon' => 'instagram',
		),
		'tumblr'    => array(
			'link' => get_theme_mod( 'ingrid_tumblr' ),
			'icon' => 'tumblr',
		),
		'google'    => array(
			'link' => get_theme_mod( 'ingrid_google' ),
			'icon' => 'google-plus',
		),
		'dribbble'  => array(
			'link' => get_theme_mod( 'ingrid_dribbble' ),
			'icon' => 'dribbble',
		),
		'lastfm'    => array(
			'link' => get_theme_mod( 'ingrid_lastfm' ),
			'icon' => 'lastfm',
		),
		'spotify'   => array(
			'link' => get_theme_mod( 'ingrid_spotify' ),
			'icon' => 'spotify',
		),
		'bloglovin' => array(
			'link' => get_theme_mod( 'ingrid_bloglovin' ),
			'icon' => 'heart-o',
		),
		'email'     => array(
			'link' => get_theme_mod( 'ingrid_email' ),
			'icon' => 'envelope-o',
		),
		'rss'       => array(
			'link' => get_theme_mod( 'ingrid_rss' ),
			'icon' => 'rss',
		),
	);

	// Loop through each social media site.
	foreach ( $social_sites as $name => $site ) {
		// If there is no link filled out, keep moving.
		if ( empty( $site['link'] ) ) {
			continue;
		}

		// If they entered an email address, prefix with mailto:
		if ( $name == 'email' && is_email( $site['link'] ) ) {
			$site['link'] = 'mailto:' . $site['link'];
		}

		$li_array[] = '<li><a href="' . esc_url( $site['link'] ) . '" target="_blank"><i class="fa fa-' . $site['icon'] . '"></i></a></li>';
	}

	return implode( '', $li_array );
}

/**
 * WordPress automatically adds inline "width" CSS to the <figure> tag
 * when inserting captions. This is so stupid and messes with the
 * responsive behavior. In this function we replace the width attribute
 * with max-width instead.
 *
 * @param $dummy
 * @param $attr
 * @param $content
 *
 * @return string
 */
function ingrid_img_caption_shortcode_filter( $dummy, $attr, $content ) {
	$atts = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

	if ( ! empty( $atts['id'] ) ) {
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	if ( current_theme_supports( 'html5', 'caption' ) ) {
		return '<figure ' . $atts['id'] . 'style="max-width: ' . (int) $atts['width'] . 'px;" class="' . esc_attr( $class ) . '">'
		       . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	}

// Return nothing to allow for default behaviour!!!
	return '';
}

add_filter( 'img_caption_shortcode', 'ingrid_img_caption_shortcode_filter', 10, 3 );