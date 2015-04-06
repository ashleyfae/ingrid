<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license GPL2
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function ng_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'ng_theme_body_classes' );

/**
 * Adds a custom stylesheet to the visual editor
 */
function ingrid_theme_add_editor_styles() {
	add_editor_style();
}

add_action( 'after_setup_theme', 'ingrid_theme_add_editor_styles' );

/**
 * Fetches a value from the Customizer.
 *
 * @param string $key
 *
 * @return mixed
 */
function ng_option( $key ) {
	$options = thsp_cbp_get_options_values();
	return $options[ $key ];
}

/**
 * Creates a new navigation menu in the main_nav location.
 */
function ng_theme_navigation() {
	wp_nav_menu(
		array(
			'theme_location' => 'main_menu',
			'container'      => false,
			'depth'          => '2',
		)
	);
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
 * Customizes the comment layout
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function ng_theme_comment_layout( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>

	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<?php if ( $args['avatar_size'] != 0 ) {
		echo '<div class="avatar-wrap">';
		echo get_avatar( $comment, $args['avatar_size'], get_template_directory_uri() . '/assets/images/gravatar.png' );
		?>
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth']
			) ) ); ?>
		</div>
		<?php
		echo '</div>';
	} ?>

	<div class="comment-content-wrap">

		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php echo get_comment_date(); ?>
			</a>
			<?php edit_comment_link( __( '(Edit)', 'ingrid' ), '  ', '' );
			?>
		</div>

		<div class="comment-author vcard">
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">said:</span>' ), get_comment_author_link() ); ?>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<div class="comment-awaiting-moderation alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'ingrid' ); ?></div>
		<?php endif; ?>

		<?php comment_text(); ?>

	</div>

	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
<?php
}

/**
 * Gets all of the social media URLs and puts them
 * into an unordered list with the appropriate icons.
 *
 * @return string
 */
function ng_social_media_links() {
	$li_array     = array();
	$social_sites = array(
		'twitter'   => array(
			'link' => ng_option( 'twitter' ),
			'icon' => 'twitter',
		),
		'facebook'  => array(
			'link' => ng_option( 'facebook' ),
			'icon' => 'facebook',
		),
		'pinterest' => array(
			'link' => ng_option( 'pinterest' ),
			'icon' => 'pinterest-p',
		),
		'tumblr'    => array(
			'link' => ng_option( 'tumblr' ),
			'icon' => 'tumblr',
		),
		'google'    => array(
			'link' => ng_option( 'google' ),
			'icon' => 'google-plus',
		),
		'dribbble'  => array(
			'link' => ng_option( 'dribbble' ),
			'icon' => 'dribbble',
		),
		'lastfm'    => array(
			'link' => ng_option( 'lastfm' ),
			'icon' => 'lastfm',
		),
		'spotify'   => array(
			'link' => ng_option( 'spotify' ),
			'icon' => 'spotify',
		),
		'bloglovin' => array(
			'link' => ng_option( 'bloglovin' ),
			'icon' => 'heart-o',
		),
		'email'     => array(
			'link' => ng_option( 'email' ),
			'icon' => 'envelope-o',
		),
		'rss'       => array(
			'link' => ng_option( 'rss' ),
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

		$li_array[] = '<li><a href="' . $site['link'] . '" target="_blank"><i class="fa fa-' . $site['icon'] . '"></i></a></li>';
	}

	return implode( '', $li_array );
}

/**
 * Trims a string after a certain amount of characters.
 *
 * @param string $string
 * @param int    $length
 * @param string $append
 *
 * @return string
 */
function ng_truncate($string, $length=100, $append="&hellip;") {
	$string = trim($string);

	if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n", $string, 2);
		$string = $string[0] . $append;
	}

	return $string;
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
function ingrid_img_caption_shortcode_filter($dummy, $attr, $content) {
	$atts = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) )
		return $content;

	if ( ! empty( $atts['id'] ) )
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	if ( current_theme_supports( 'html5', 'caption' ) ) {
		return '<figure ' . $atts['id'] . 'style="max-width: ' . (int) $atts['width'] . 'px;" class="' . esc_attr( $class ) . '">'
		       . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	}

// Return nothing to allow for default behaviour!!!
	return '';
}

add_filter( 'img_caption_shortcode', 'ingrid_img_caption_shortcode_filter', 10, 3 );