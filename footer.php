<?php
/**
 * The template for displaying the footer.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>

</main> <!-- #main -->
</div> <!-- .container -->

<footer id="footer" class="site-footer" role="contentinfo">
	<div class="container">
		<?php get_sidebar(); ?>
	</div>
</footer>

<div class="attribution text-center">

	<img src="<?php echo get_template_directory_uri(); ?>/assets/images/flower-footer.png" id="footer-flower" alt="<?php _e( 'A flower with leaves', 'ingrid' ); ?>">

	<div id="website-copyright">
		<?php printf( __( 'Copyright &copy; %s. All Rights Reserved.', 'ingrid' ), get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ); ?>
	</div>

	<div id="design-credits">
		<?php
		printf(
			__( '<a href="%s" target="_blank" rel="nofollow">Ingrid Theme</a> by Anna Moore and Nose Graze.', 'ingrid' ),
			'https://shop.nosegraze.com/product/ingrid-theme/'
		);
		?>
	</div>

</div>

</div> <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>