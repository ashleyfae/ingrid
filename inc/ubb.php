<?php
/**
 * For use with the Ultimate Book Blogger plugin.
 * Functions in this file are used on the taxonomy.php
 * archive page.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Determines the average rating for all reviews with a
 * specific taxonomy term.
 *
 * @param string $taxonomy
 * @param object $term
 *
 * @return bool|float
 */
function ng_ubb_avg_rating( $taxonomy, $term ) {
	$tax_posts   = get_posts( array(
		'post_type'      => 'post',
		'posts_per_page' => - 1,
		'tax_query'      => array(
			array(
				'taxonomy' => $taxonomy,
				'terms'    => $term->term_id
			)
		)
	) );
	$num_results = 0;
	$ratings     = 0;

	$poss_ratings = array(
		'five-stars'       => 5,
		'four-half-stars'  => 4.5,
		'four-stars'       => 4,
		'three-half-stars' => 3.5,
		'three-stars'      => 3,
		'two-half-stars'   => 2.5,
		'two-stars'        => 2,
		'one-half-stars'   => 1.5,
		'one-star'         => 1,
		'half-star'        => 0.5
	);

	if ( $tax_posts ) {
		foreach ( $tax_posts as $tax_post ) {
			$rating = get_post_meta( $tax_post->ID, '_ubb_book_rating', true );
			$rating = $poss_ratings[ $rating ];
			$ratings += $rating;
			$num_results ++;
		}
		$average_rating = $ratings / $num_results;
		$average_rating = round( $average_rating, 2 );

		return $average_rating;
	}

	return false;
}