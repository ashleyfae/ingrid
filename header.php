<?php
/**
 * The header for the theme.
 *
 * Displays all of the <head> section, the logo, and the navigation menu.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'ingrid' ); ?></a>

	<nav id="site-navigation" role="navigation">
		<div class="container">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'ingrid' ); ?></button>
			<?php ingrid_theme_navigation(); ?>

			<ul id="social-media">
				<?php echo ingrid_social_media_links(); ?>
			</ul>
		</div>
	</nav>
	<!-- #site-navigation -->

	<div class="container">

		<header id="masthead" class="site-header" role="banner">

			<!--<img src="" alt="<?php _e( 'Flowers', 'ingrid' ); ?>" class="flowers">-->

			<div class="site-branding text-center">
				<?php if ( get_header_image() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
				<?php else : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; // End header image check. ?>
			</div>
			<!-- .site-branding -->

		</header>
		<!-- #masthead -->

		<main id="main" class="site-main" role="main">
