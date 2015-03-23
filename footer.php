<?php
/**
 * The template for displaying the footer.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>

</main> <!-- #main -->
</div> <!-- .container -->

<?php
// Testimonials
get_template_part( 'inc/template-parts/home', 'testimonial' );
?>

<footer id="footer" class="site-footer" role="contentinfo">
	<div class="container">
		<?php get_template_part( 'inc/template-parts/footer', 'widgets' ); ?>
	</div>

	<div class="attribution">
		<div class="container">
			<div class="row">
				<div id="website-copyright" class="col-md-5">
					<?php printf( __( 'Copyright &copy; %s. All Rights Reserved.', 'noah' ), get_bloginfo( 'name' ) ); ?>
				</div>

				<div id="footer-heart" class="col-md-2 text-center">
					<i class="fa fa-heart-o"></i>
				</div>

				<div id="design-credits" class="col-md-5">
					<?php
					printf( '<a href="https://creativewhim.com/shop/noah-theme/" target="_blank">%1s</a> %2s <a href="http://annamariemoore.com/" target="_blank">%3s</a> + <a href="https://www.nosegraze.com" target="_blank">%4s</a>.',
						__( 'Noah Theme', 'noah' ),
						__( 'by', 'noah' ),
						__( 'Anna Moore', 'noah' ),
						__( 'Nose Graze', 'noah' )
					);
					?>
				</div>
			</div>
		</div>
	</div>
</footer>

</div> <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>