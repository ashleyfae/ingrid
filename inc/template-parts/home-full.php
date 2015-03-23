<?php
/**
 * The full width widget area for the homepage.
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

// If none of these sidebars are active, bail straight away.
if ( ! is_active_sidebar( 'home_full' ) ) {
	return;
}
?>

<div id="homepage-full" class="widget-area">

	<?php dynamic_sidebar( 'home_full' ); ?>

</div>