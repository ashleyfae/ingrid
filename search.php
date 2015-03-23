<?php
/**
 * The template for displaying search results.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'noah' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

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
