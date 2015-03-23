<?php
/**
 * The sidebar containing the main widget area.
 * This is not used in this theme.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>
<div id="secondary" class="widget-area col-md-4" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->
