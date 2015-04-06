<?php
/**
 * The template for displaying search results.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="box">
		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ingrid' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>
		<section class="search-description">
			<p><?php _e('Not what you\'re looking for? You can search again!', 'ingrid'); ?></p>
			<?php get_search_form(); ?>
		</section>
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
