<?php
/**
 * Used for inserting the footer widget area.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

// If none of these sidebars are active, bail straight away.
if ( ! is_active_sidebar( 'footer_1' ) && ! is_active_sidebar( 'footer_2' ) && ! is_active_sidebar( 'footer_3' ) ) {
	return;
}
?>

<div id="footer-widgets" class="row widget-area">

	<div class="col-md-4">
		<?php dynamic_sidebar( 'footer_1' ); ?>
	</div>

	<div class="col-md-4">
		<?php dynamic_sidebar( 'footer_2' ); ?>
	</div>

	<div class="col-md-4">
		<?php dynamic_sidebar( 'footer_3' ); ?>
	</div>

</div>