<?php
/**
 * The three columns of widgets for the homepage.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

// If none of these sidebars are active, bail straight away.
if ( ! is_active_sidebar( 'home_third_1' ) && ! is_active_sidebar( 'home_third_2' ) && ! is_active_sidebar( 'home_third_3' ) ) {
	return;
}
?>

<div id="homepage-three-columns" class="row widget-area">

	<div class="col-md-4">
		<?php dynamic_sidebar( 'home_third_1' ); ?>
	</div>

	<div class="col-md-4">
		<?php dynamic_sidebar( 'home_third_2' ); ?>
	</div>

	<div class="col-md-4">
		<?php dynamic_sidebar( 'home_third_3' ); ?>
	</div>

</div>