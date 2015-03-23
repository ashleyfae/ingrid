<?php
/**
 * Custom template tags for this theme.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * A custom pagination function that adds more functionality
 * than just next/previous page.
 *
 * @param string $before
 * @param string $after
 */
if ( ! function_exists( 'ng_theme_pagination' ) ) {
	function ng_theme_pagination() {
		if ( function_exists( 'wp_pagenavi' ) ) {
			wp_pagenavi();
		} elseif ( function_exists( 'page_navi' ) ) {
			page_navi();
		} else {
			?>
			<nav class="wp-prev-next">
				<ul class="clearfix">
					<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', "noah" ) ) ?></li>
					<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', "noah" ) ) ?></li>
				</ul>
			</nav>
		<?php
		}
	}
}

/**
 * Custom pagination function with more options. Displays page numbers.
 *
 * @param string $before
 * @param string $after
 */
if ( ! function_exists( 'page_navi' ) ) {
	function page_navi( $before = '', $after = '' ) {
		global $wpdb, $wp_query;
		$request        = $wp_query->request;
		$posts_per_page = intval( get_query_var( 'posts_per_page' ) );
		$paged          = intval( get_query_var( 'paged' ) );
		$numposts       = $wp_query->found_posts;
		$max_page       = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) {
			return;
		}
		if ( empty( $paged ) || $paged == 0 ) {
			$paged = 1;
		}
		$pages_to_show         = 7;
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start       = floor( $pages_to_show_minus_1 / 2 );
		$half_page_end         = ceil( $pages_to_show_minus_1 / 2 );
		$start_page            = $paged - $half_page_start;
		if ( $start_page <= 0 ) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if ( $end_page > $max_page ) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page   = $max_page;
		}
		if ( $start_page <= 0 ) {
			$start_page = 1;
		}

		echo $before . '<ul class="pagination clearfix">' . "";
		if ( $paged > 1 ) {
			$first_page_text = "&laquo";
			echo '<li class="prev"><a href="' . get_pagenum_link() . '" title="' . __( 'First', 'ingrid' ) . '">' . $first_page_text . '</a></li>';
		}

		echo '<li class="previous_posts_link">';
		previous_posts_link( __( 'Previous', 'ingrid' ) );
		echo '</li>';
		for (
			$i = $start_page;
			$i <= $end_page;
			$i ++
		) {
			if ( $i == $paged ) {
				echo '<li class="current"><a href="#">' . $i . '</a></li>';
			} else {
				echo '<li><a href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
			}
		}
		echo '<li class="next_posts_link">';
		next_posts_link( __( 'Next', 'ingrid' ) );
		echo '</li>';
		if ( $end_page < $max_page ) {
			$last_page_text = "&raquo;";
			echo '<li class="next"><a href="' . get_pagenum_link( $max_page ) . '" title="' . __( 'Last', 'ingrid' ) . '">' . $last_page_text . '</a></li>';
		}
		echo '</ul>' . $after . "";
	}
}

/**
 * Displays the meta information. This includes the
 * date the post was published and the list of categories.
 */
if ( ! function_exists( 'ng_theme_post_meta' ) ) {
	function ng_theme_post_meta() {
		// Format the date string.
		// The date format is taken from Settings > General.
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		// Compile the sentence with the date and category list.
		$posted_on = sprintf(
			_x( 'Posted on %1$s in %2$s', 'post date', 'ingrid' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>',
			get_the_category_list( ', ' )
		);
		?>
		<div class="post-meta">
			<?php echo $posted_on; ?>
		</div>
	<?php
	}
}

/**
 * Displays the post footer information.
 */
if ( ! function_exists( 'ng_theme_post_footer' ) ) {
	function ng_theme_post_footer() {
		?>
		<hr>

		<div class="row">
			<div class="col-sm-6 noah-social-share">
				<div class="share-links">
					<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><?php _e( 'Tweet', 'ingrid' ); ?></a>
					/
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank"><?php _e( 'Facebook', 'ingrid' ); ?></a>
					/
					<a href="javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" target="_blank"><?php _e( 'Pin', 'ingrid' ); ?></a>
				</div>

				<span><?php _e( 'Like this post? Let everyone know!', 'ingrid' ); ?></span>
			</div>

			<div class="col-sm-6 comment-link">
				<a href="<?php comments_link(); ?>"><?php comments_number( __( '0 Comments', 'ingrid' ), __( '1 Comment', 'ingrid' ), __( '% Comments', 'ingrid' ) ); ?></a>

				<span><?php _e( 'Join the conversation!', 'ingrid' ); ?></span>
			</div>
		</div>

		<?php if ( is_single() ) : ?>
			<hr>
		<?php endif; ?>
	<?php
	}
}


/**
 * Retrieves the thumbnail for a post.
 * If the featured image is set, then it uses that.
 * Otherwise, the UBB cover image is used.
 *
 * @param int    $width    Desired width of the thumbnail
 * @param int    $height   Desired height of the thumbnail
 * @param bool   $crop     Whether or not the thumbnail should be cropped to specific dimensions
 * @param object $post_obj The post object to retrive the thumbnail from
 *
 * @return bool|string
 */
if ( ! function_exists( 'ng_theme_get_thumbnail' ) ) {
	function ng_theme_get_thumbnail( $width = 200, $height = 200, $crop = true, $class = '', $post_obj = null ) {
		if ( $post_obj == null ) {
			global $post;
		} else {
			$post = $post_obj;
		}

		// Testing for UBB compatibility & population
		$ubb_test = false;
		if ( function_exists( 'ubb_get_values' ) ) {
			//check for UBB version
			$ubb_version = get_option( 'ubb_version' );
			if ( ! empty( $ubb_version ) && $ubb_version >= 2.0 ) {

				$bk_meta = ubb_get_values( $post );
				if ( ! empty( $bk_meta['bk_cover_img']['value'] ) ) {
					$ubb_test = true;
				}
			} else {
				$bk_meta = ubb_get_values();
				if ( ! empty( $bk_meta['bk_cover_img'] ) ) {
					$ubb_test = true;
				}
			}
		}

		// Has featured image
		if ( has_post_thumbnail( $post->ID ) ) {
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$img      = $featured[0];
			if ( ! empty( $img ) ) {
				return '<a href="' . get_permalink( $post ) . '" title="' . the_title_attribute( 'echo=0' ) . '"><img src="' . aq_resize( $img, $width, $height, $crop ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="ubb-archive ' . $class . '"></a>';
			}
		} // Has UBB cover image
		elseif ( $ubb_test == true ) {
			//check for UBB version
			$ubb_version = get_option( 'ubb_version' );
			if ( ! empty( $ubb_version ) && $ubb_version >= 2.0 ) {

				$bk_meta = ubb_get_values( $post );
				$orig    = $bk_meta['bk_cover_img']['value'];
			} else {
				$bk_meta = ubb_get_values();
				$orig    = $bk_meta['bk_cover_img'];
			}
			if ( ! empty( $orig ) ) {
				// Resize the image.
				$resized = aq_resize( $orig, $width, $height, $crop );

				if ( $resized != false ) {
					return '<a href="' . get_permalink( $post ) . '" title="' . the_title_attribute( 'echo=0' ) . '"><img src="' . $resized . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="ubb-cover-image ubb-archive ' . $class . '" width="' . $width . '" height="' . $height . '"></a>';
				} else {
					return '<a href="' . get_permalink( $post ) . '" title="' . the_title_attribute( 'echo=0' ) . '"><img src="' . $orig . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="ubb-cover-image ubb-archive ' . $class . '" width="' . $width . '"></a>';
				}
			}
		} // First image
		elseif ( preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $matches ) ) {
			$first_img = $matches[1][0];

			// First image is empty, return false
			if ( empty( $first_img ) ) {
				return false;
			}

			// Resize the image.
			$resized = aq_resize( $first_img, $width, $height, $crop );

			if ( $resized != false ) {
				return '<a href="' . get_permalink( $post ) . '" title="' . the_title_attribute( 'echo=0' ) . '"><img src="' . $resized . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="ubb-cover-image ubb-archive ' . $class . '"></a>';
			} else {
				return '<a href="' . get_permalink( $post ) . '" title="' . the_title_attribute( 'echo=0' ) . '"><img src="' . $first_img . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="ubb-cover-image ubb-archive ' . $class . '" width="' . $width . '"></a>';
			}
		}

		return false;
	}
}

/**
 * Display's the current post's featured image.
 */
if ( ! function_exists( 'noah_featured_image' ) ) {
	function noah_featured_image() {
		// Auto adding featured images is disabled.
		$auto_add = ng_option( 'auto_add_featured' );
		if ( $auto_add === false ) {
			return;
		}

		// The post has no featured image.
		if ( ! has_post_thumbnail() ) {
			return;
		}

		$class = 'featured-image';

		$disable_featured_image_effect = ng_option( 'featured_arrow' );
		if ( $disable_featured_image_effect !== true ) {
			$class .= ' with-effect';
		}

		echo '<div class="' . $class . '">';
		the_post_thumbnail( 'full' );
		echo '</div>';
	}
}

/**
 * Displays the current post's thumbnail.
 */
if ( ! function_exists( 'noah_thumbnail' ) ) {
	function noah_thumbnail() {
		$thumbnail = ng_theme_get_thumbnail( 180, 120, true );
		if ( ! empty( $thumbnail ) ) {
			$class                         = 'thumbnail-wrap alignleft';
			$disable_featured_image_effect = ng_option( 'featured_arrow' );
			if ( $disable_featured_image_effect !== true ) {
				$class .= ' with-effect';
			}
			echo '<div class="' . $class . '">' . $thumbnail . '</div>';
		}
	}
}

/**
 * Gets the latest post in a specified category.
 * Outputs thumbnail, category name, and post title.
 *
 * @param int $cat_id
 *
 * @return bool|string
 */
if ( ! function_exists( 'ng_get_latest' ) ) {
	function ng_get_latest( $cat_id ) {
		$output = '';
		// Category isn't valid, bail
		if ( empty( $cat_id ) || ! is_numeric( $cat_id ) ) {
			return false;
		}
		// Query for latest post in this category
		$latest_posts = get_posts( array(
			'cat'            => $cat_id,
			'posts_per_page' => 1
		) );
		// No posts found, bail
		if ( empty( $latest_posts ) || ! is_array( $latest_posts ) ) {
			return false;
		}
		foreach ( $latest_posts as $latest_post ) {
			$output .= ng_theme_get_thumbnail( 194, 102, true, 'aligncenter', $latest_post ) . '
		<h2>' . get_cat_name( $cat_id ) . '</h2>
		<h3><a href="' . get_permalink( $latest_post ) . '">' . get_the_title( $latest_post ) . '</a></h3>';
		}

		return $output;
	}
}

/**
 * Adds the pagination on a single post page.
 * Displays links to the next post and the previous
 * post.
 */
if ( ! function_exists( 'noah_post_pagination' ) ) {
	function noah_post_pagination() {
		?>
		<div id="post-pagination" class="row">
			<div class="row-same-height row-full-height">
				<div class="col-sm-6 col-sm-height previous-post">
					<?php previous_post_link( '<span>' . __( 'Previous Post', 'ingrid' ) . '</span> %link' ); ?>
				</div>
				<div class="col-sm-6 col-sm-height next-post">
					<?php next_post_link( '<span>' . __( 'Next Post', 'ingrid' ) . '</span> %link' ); ?>
				</div>
			</div>
		</div>
	<?php
	}
}