<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="box">
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header>
		<!-- .page-header -->
	</div>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'inc/template-parts/content', get_post_format() ); ?>

	<?php endwhile; ?>

	<?php ng_theme_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'inc/template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>
