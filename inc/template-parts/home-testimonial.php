<?php
/**
 * Displays a random testimonial.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

// If this feature is not activated, bail.
$activate_testimonials = ng_option( 'testimonials' );
if ( $activate_testimonials === 'none' ) {
	return;
}

// If this is set to only static homepage, but we're not there, bail.
if ( ( $activate_testimonials == 'home' && ! is_front_page() ) || 'page' != get_option( 'show_on_front' ) ) {
	return;
}

// If this is set to all pages, but we're not on a page, bail.
if ( $activate_testimonials == 'pages' && ! is_page() ) {
	return;
}

// Fetch one random testimonial.
$testimonials = get_posts( array(
	'orderby'        => 'rand',
	'posts_per_page' => 1,
	'post_type'      => 'testimonial',
	'meta_query'     => array(
		array(
			'meta_value'   => 'testimonial_text',
			'meta_compare' => 'EXISTS'
		)
	)
) );

// If there are no results, let's show a dummy testimonial.
if ( empty( $testimonials ) || ! is_array( $testimonials ) ) {
	?>
	<div id="testimonial">
		<div class="container">
			<blockquote>
				<span class="inner-text"><?php _e( 'Thank you for choosing the Noah theme! Start setting up your testimonials in the admin panel. You\'ll find a new "Testimonials" tab in the left-hand menu.', 'noah' ); ?></span>

				<cite>
					<?php _e( 'Anna Moore &amp; Nose Graze', 'noah' ); ?>
					<span id="company-name">| <a href="https://creativewhim.com/shop/noah-theme/" target="_blank"><?php _e( 'noah theme', 'noah' ); ?></a></span>
				</cite>
			</blockquote>
		</div>
	</div>
	<?php

	return;
}

$testimonial = $testimonials[0];

// Gather all the variables.
$text         = get_post_meta( $testimonial->ID, 'testimonial_text', true );
$client_name  = get_post_meta( $testimonial->ID, 'testimonial_name', true );
$company_name = get_post_meta( $testimonial->ID, 'company_name', true );
$company_url  = get_post_meta( $testimonial->ID, 'client_url', true );

?>

<div id="testimonial">
	<div class="container">
		<blockquote>
			<?php echo '<span class="inner-text">' . $text . '</span>'; ?>

			<cite>
				<?php
				// Client name
				echo $client_name;

				// Only add this if the company name is filled out.
				if ( ! empty( $company_name ) ) {
					echo '<span id="company-name"> | ';

					// Only add a link if the URL is filled out.
					if ( ! empty( $company_url ) ) {
						echo '<a href="' . $company_url . '" target="_blank">';
					}

					echo $company_name;

					// Only close the link if the URL is filled out.
					if ( ! empty( $company_url ) ) {
						echo '</a>';
					}

					echo '</span>';
				}
				?>
			</cite>
		</blockquote>
	</div>
</div>