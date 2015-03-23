<?php
/**
 * This is the content for full posts and the individual post page.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php noah_featured_image(); ?>

	<header class="entry-header">
		<?php
		/*
		 * Individual Post
		 * Don't link the title
		 */
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} /*
		 * We're on the archive, so link the title.
		 */
		else {
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		}

		/*
		 * Include the top post meta.
		 */
		ng_theme_post_meta();
		?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php
		/*
		 * Post content
		 * translators: %s: Name of current post
		 */
		the_content( '<div class="readmore"><a href="' . get_permalink() . '" class="btn btn-primary btn-block">' . __( 'Continue Reading', 'noah' ) . '</a></div>' );
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<?php ng_theme_post_footer(); ?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->