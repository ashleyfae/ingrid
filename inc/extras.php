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
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 *
 * @return string The filtered title.
 */
function ng_theme_wp_title( $title, $sep ) {
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
		$title .= " $sep " . sprintf( __( 'Page %s', 'noah' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'ng_theme_wp_title', 10, 2 );

/**
 * Adds a custom stylesheet to the visual editor
 */
function ng_theme_add_editor_styles() {
	add_editor_style();
}

add_action( 'after_setup_theme', 'ng_theme_add_editor_styles' );

/**
 * Adds custom highlighting based on post status
 */
function ng_theme_color_code_post_status() {
	?>
	<style>
		.status-draft {
			background: #fad8d8 !important;
		}

		.status-future {
			background: #CCFF99 !important;
		}

		.status-pending {
			background: #FFFF99 !important;
		}

		.status-private {
			background: #FFCC99;
		}
	</style>
<?php
}

add_action( 'admin_head', 'ng_theme_color_code_post_status' );

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
			'menu'           => 'main_menu',
			'menu_class'     => 'nav navbar-nav',
			'theme_location' => 'main_menu',
			'container'      => false,
			'depth'          => '2',
			'walker'         => new main_navigation_walker()
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
function ng_theme_current_to_active( $text ) {
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

add_filter( 'wp_nav_menu', 'ng_theme_current_to_active' );

/**
 * Prevents the "Blog" item from always being shown as active
 * even if you're not on the blog page.
 *
 * @param $classes
 * @param $item
 *
 * @return mixed
 */
function ng_theme_fix_blog_tab( $classes, $item ) {
	if ( ! is_singular( 'post' ) && ! is_category() && ! is_tag() ) {
		$blog_page_id = intval( get_option( 'page_for_posts' ) );
		if ( $blog_page_id != 0 ) {
			if ( $item->object_id == $blog_page_id ) {
				unset( $classes[ array_search( 'current_page_parent', $classes ) ] );
			}
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'ng_theme_fix_blog_tab', 10, 3 );

/**
 * Class main_navigation_walker
 *
 * This modifies the layout of the navigation menu to make it
 * more compatible with Bootstrap.
 */
class main_navigation_walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

		// if the item has children, add the class "dropdown"
		if ( $args->has_children ) {
			$extra_class = ' dropdown';
		} else {
			$extra_class = '';
		}
		$class_names = ' class="' . esc_attr( $class_names ) . $extra_class . '"';

		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		// if the item has children add these two attributes to the anchor tag
		if ( $args->has_children ) {
			$attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
		}

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		// if the item has children add the caret just before closing the anchor tag
		if ( $args->has_children ) {
			$item_output .= ' <span class="caret"></span>';
		}
		$item_output .= '</a>' . $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent</ul>\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

/**
 * Filters the display of the search form.
 *
 * @param string $form The default search form HTML.
 *
 * @return string The filtered search form HTML.
 */
function ng_theme_search_form( $form ) {
	$form = '
	<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '">
		<i class="fa fa-angle-double-right"></i>
		<input type="search" class="search-field" placeholder="' . esc_attr_x( 'keyword + enter', 'placeholder', 'noah' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search the blog', 'placeholder', 'noah' ) . '">
	</form>
	';

	return $form;
}

add_filter( 'get_search_form', 'ng_theme_search_form' );


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
			<?php edit_comment_link( __( '(Edit)', 'noah' ), '  ', '' );
			?>
		</div>

		<div class="comment-author vcard">
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">said:</span>' ), get_comment_author_link() ); ?>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<div class="comment-awaiting-moderation alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'noah' ); ?></div>
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
function ng_img_caption_shortcode_filter($dummy, $attr, $content) {
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

add_filter( 'img_caption_shortcode', 'ng_img_caption_shortcode_filter', 10, 3 );