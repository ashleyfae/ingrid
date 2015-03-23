<?php
/**
 * Adds the image slider.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

$slides = get_posts( array(
	'post_type'      => 'ng_slider',
	'posts_per_page' => - 1,
	'nopaging'       => true
) );
if ( $slides ) {
	?>
	<div class="flexslider">
		<ul class="slides">
			<?php
			foreach ( $slides as $slide ) {
				if ( has_post_thumbnail( $slide->ID ) ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $slide->ID ), 'full' );
					$link      = get_post_meta( $slide->ID, 'ng_slider_link', true );
					$resized   = aq_resize( $thumbnail[0], 800, 300, true );
					if ( $resized === false ) {
						$resized = $thumbnail[0];
					}
					?>
					<li>
						<a href="<?php echo $link; ?>"><img src="<?php echo $resized; ?>" alt="Slider image"></a>
					</li>
				<?php
				}
			}
			?>
		</ul>
	</div>
<?php
}