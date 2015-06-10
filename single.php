<?php
/**
 * The template for displaying all single posts.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'inc/template-parts/content', get_post_format() ); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>

	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'inc/template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>
