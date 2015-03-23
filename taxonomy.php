<?php
/**
 * The taxonomy template file.
 * This is primarily used to customize the Ultimate Book Blogger
 * archives.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

get_header(); ?>

<header class="page-header">
	<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
</header>
<!-- .page-header -->

<?php
/*
 * UBB Custom Content
 */
if ( function_exists( 'ubb_get_values' ) && function_exists( 'get_tax_meta' ) ) {
	$term    = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$taxdesc = wpautop( $term->description );
	//author photo
	$author_image = get_tax_meta( $term->term_id, '_ubb_author_photo', true );
	if ( ! empty( $author_image ) ) {
		$attach_id  = $author_image['id'];
		$attach_img = wp_get_attachment_image( $attach_id, 'ubb-author-photo' );
		$authorpic  = '<div class="ubb-author-photo alignleft">' . $attach_img . '</div>';
	}
	//extra fields
	$author_fields = array();
	$author_web    = get_tax_meta( $term->term_id, '_ubb_author_website', true );
	$author_blog   = get_tax_meta( $term->term_id, '_ubb_author_blog', true );
	$author_twit   = get_tax_meta( $term->term_id, '_ubb_author_twitter', true );
	$author_face   = get_tax_meta( $term->term_id, '_ubb_author_facebook', true );
	$author_good   = get_tax_meta( $term->term_id, '_ubb_author_goodreads', true );

	if ( ! empty( $author_web ) ) {
		$author_fields['website'] = '<a href="' . $author_web . '" target="_blank">' . __( 'Website', 'noah' ) . '</a>';
	}
	if ( ! empty( $author_blog ) ) {
		$author_fields['blog'] = '<a href="' . $author_blog . '" target="_blank">' . __( 'Blog', 'noah' ) . '</a>';
	}
	if ( ! empty( $author_twit ) ) {
		$author_fields['twitter'] = '<a href="http://www.twitter.com/' . $author_twit . '" target="_blank">' . __( 'Twitter', 'noah' ) . '</a>';
	}
	if ( ! empty( $author_face ) ) {
		$author_fields['facebook'] = '<a href="' . $author_face . '" target="_blank">' . __( 'Facebook', 'noah' ) . '</a>';
	}
	if ( ! empty( $author_good ) ) {
		$author_fields['goodreads'] = '<a href="' . $author_good . '" target="_blank">' . __( 'Goodreads', 'noah' ) . '</a>';
	}
	$final_author_fields = '';
	if ( count( $author_fields ) > 0 ) {
		$final_author_fields = '<p class="author-links text-center">' . implode( ' &bull; ', $author_fields ) . '</p>';
	}
	if ( ! empty( $taxdesc ) ) {
		echo '<div class="cwb-databox"></div><div class="tax-description">' . $authorpic . $taxdesc . $final_author_fields . '</div>';
	}

	// Get the average rating for all posts in this term.
	$average_rating = ng_ubb_avg_rating( get_query_var( 'taxonomy' ), $term );
	if ( ! empty( $average_rating ) ) {
		echo '<h2 class="text-center">' . __( 'Average rating for these reviews: ', 'noah' ) . $average_rating . '</h2>';
	}

	echo '<hr>';
}
?>

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
