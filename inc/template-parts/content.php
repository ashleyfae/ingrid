<?php
/**
 * This is the main content template.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt-view' ); ?>>
	<?php noah_thumbnail(); ?>

	<header class="entry-header">
		<?php
		the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );

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
		the_excerpt();
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<div class="readmore">
			<a href="<?php get_permalink(); ?>" class="btn btn-primary btn-block"><?php _e( 'Continue Reading', 'noah' ); ?></a>
		</div>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->