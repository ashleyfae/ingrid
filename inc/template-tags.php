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
		} else {
			?>
			<nav class="wp-prev-next">
				<ul class="clearfix">
					<li class="next-link"><?php previous_posts_link( __( '&#x2190; Newer Entries', 'ingrid' ) ) ?></li>
					<li class="prev-link"><?php next_posts_link( __( 'Older Entries &#x2192;', 'ingrid' ) ) ?></li>
				</ul>
			</nav>
		<?php
		}
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
			'<span>' . get_the_time( 'm' ) . '</span><span>' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'y' ) . '</span>'
		);
		?>
		<div class="post-meta">
			<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'; ?>
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
		<div class="tagged">
			<?php
			printf(
				__( 'categories: %1$s %2$s', 'ingrid' ),
				get_the_category_list( ', ' ),
				get_the_tag_list( ' / ' . __( 'tagged: ', 'ingrid' ), ', ', '' )
			);
			?>
		</div>

		<div class="clear">
			<div class="ingrid-social-share">
				<div class="share-links">
					<?php _e( 'Share:', 'ingrid' ); ?>
					<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><?php _e( 'Twitter', 'ingrid' ); ?></a>
					/
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank"><?php _e( 'Facebook', 'ingrid' ); ?></a>
					/
					<a href="javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" target="_blank"><?php _e( 'Pinterest', 'ingrid' ); ?></a>
					/
					<a href="<?php the_permalink(); ?>"><?php _e( 'Post Link', 'ingrid' ); ?></a>
				</div>
			</div>

			<div class="comment-link">
				<a href="<?php comments_link(); ?>"><?php comments_number( __( '0 Comments', 'ingrid' ), __( '1 Comment', 'ingrid' ), __( '% Comments', 'ingrid' ) ); ?></a>
			</div>
		</div>
	<?php
	}
}

/**
 * Display's the current post's featured image.
 */
if ( ! function_exists( 'ingrid_featured_image' ) ) {
	function ingrid_featured_image() {
		// The post has no featured image.
		if ( ! has_post_thumbnail() ) {
			return;
		}

		echo '<div class="featured-image-wrap">';
		the_post_thumbnail( 'full', array('class' => 'featured-image aligncenter') );
		echo '</div>';
	}
}

/**
 * Adds the pagination on a single post page.
 * Displays links to the next post and the previous
 * post.
 */
if ( ! function_exists( 'ingrid_post_pagination' ) ) {
	function ingrid_post_pagination() {
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