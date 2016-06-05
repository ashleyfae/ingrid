<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'ingrid' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'ingrid' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->