<?php
/**
 * The header for the theme.
 *
 * Displays all of the <head> section, the logo, and the navigation menu.
 *
 * @package   noah
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

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'noah' ); ?></a>

	<?php
	// Bring in the slide out area.
	get_template_part( 'inc/template-parts/slide-out' );
	?>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding text-center">
			<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			<?php else : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; // End header image check. ?>
		</div>
		<!-- .site-branding -->

	</header>
	<!-- #masthead -->

	<nav id="site-navigation" class="navbar navbar-noah" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'noah' ); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<?php ng_theme_navigation(); ?>
			</div>
		</div>
	</nav>
	<!-- #site-navigation -->

	<div class="container">

		<main id="main" class="site-main" role="main">
