<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

$args = array(
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="widget-title text-left">',
	'after_title'   => '</h3>',
);

get_header(); ?>

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'noah' ); ?></h1>

		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'noah' ); ?></p>

		<?php get_search_form(); ?>
	</header>
	<!-- .page-header -->

	<div class="page-content">

		<?php the_widget( 'WP_Widget_Recent_Posts', array(), $args ); ?>

		<div class="widget widget_categories">
			<h2 class="widget-title"><?php _e( 'Most Used Categories', 'noah' ); ?></h2>
			<ul>
				<?php
				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );
				?>
			</ul>
		</div>
		<!-- .widget -->

		<?php
		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'noah' ), convert_smilies( ':)' ) ) . '</p>';
		$args_archive    = array(
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title text-left">',
			'after_title'   => '</h3>' . $archive_content,
		);
		the_widget( 'WP_Widget_Archives', 'dropdown=1', $args_archive );
		?>

		<?php the_widget( 'WP_Widget_Tag_Cloud', array(), $args ); ?>

	</div>
	<!-- .page-content -->
</section><!-- .error-404 -->

<?php get_footer(); ?>