<?php
/**
 * The sidebar containing the main widget area.
 * This is not used in this theme.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

// If none of these sidebars are active, bail straight away.
if ( ! is_active_sidebar( 'footer_1' ) && ! is_active_sidebar( 'footer_2' ) ) {
	return;
}
?>

<div id="footer-widgets" class="row widget-area">

	<div id="footer_1">
		<?php dynamic_sidebar( 'footer_1' ); ?>
	</div>

	<div id="footer_2">
		<?php dynamic_sidebar( 'footer_2' ); ?>
	</div>

</div>