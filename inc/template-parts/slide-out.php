<?php
/**
 * The template for the slide out area in the header.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

$visibility = ng_option( 'slide_out_visibility' );

// It's disabled, bail immediately.
if ( $visibility == 'disabled' ) {
	return;
}
?>

<div id="slide-out" class="slide-out-<?php echo $visibility; ?>">
	<?php
	// Include a widget area.
	if ( $visibility == 'widget' ) {
		?>
		<div id="widget-area-wrap">
			<div class="container">
				<div class="row">
					<div class="row-same-height row-full-height widget-area">
						<div class="col-md-4 col-md-height">
							<?php
							if ( is_active_sidebar( 'slide_out_1' ) ) {
								dynamic_sidebar( 'slide_out_1' );
							}
							?>
						</div>
						<div class="col-md-4 col-md-height">
							<?php
							if ( is_active_sidebar( 'slide_out_2' ) ) {
								dynamic_sidebar( 'slide_out_2' );
							}
							?>
						</div>
						<div class="col-md-4 col-md-height">
							<?php
							if ( is_active_sidebar( 'slide_out_3' ) ) {
								dynamic_sidebar( 'slide_out_3' );
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="#" id="slide-out-toggle"><i class="fa fa-angle-double-down"></i></a>
	<?php
	} // Show the social media and search bar.
	else {
		?>
		<div class="container">
			<div class="row widget-area">
				<div class="col-sm-4">
					<?php the_widget( 'Noah_Social_Media' ); ?>
				</div>

				<div class="col-sm-4 col-sm-offset-4">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>

		<div id="slide-out-heart">
			<i class="fa fa-heart-o"></i>
		</div>
	<?php
	}
	?>
</div>