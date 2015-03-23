<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		/* We figure out which display option is selected in the Customizer, then
		 * include the correct template file based on that.
		 */

		$layout_setting = ng_option( 'post_content' );
		$post_layout    = ( empty( $layout_setting ) ) ? 'single' : $layout_setting;
		if ( $post_layout != 'single' && ! empty( $post_layout ) ) {
			$post_layout = get_post_format();
		}

		get_template_part( 'inc/template-parts/content', $post_layout );
		?>

	<?php endwhile; ?>

	<?php ng_theme_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'inc/template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>
