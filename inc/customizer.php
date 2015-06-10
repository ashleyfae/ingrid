<?php
/**
 * customizer-api.php
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015, Ashley Evans
 * @license   GPL2+
 */

function ingrid_customize_register( $wp_customize ) {
	/*
	 * Social Media Section
	 */
	$wp_customize->add_section( 'ingrid_social_media', array(
		'title'       => __( 'Social Media', 'ingrid' ),
		'description' => __( 'Enter the URLs for your social media profiles. These may be used in the layout and/or in a custom widget.', 'ingrid' ),
		'priority'    => 200,
	) );

	// Twitter
	$wp_customize->add_setting( 'ingrid_twitter', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_twitter_control', array(
		'label'    => __( 'Twitter URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_twitter'
	) );

	// Facebook
	$wp_customize->add_setting( 'ingrid_facebook', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_facebook_control', array(
		'label'    => __( 'Facebook URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_facebook'
	) );

	// Pinterest
	$wp_customize->add_setting( 'ingrid_pinterest', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_pinterest_control', array(
		'label'    => __( 'Pinterest URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_pinterest'
	) );

	// Instagram
	$wp_customize->add_setting( 'ingrid_instagram', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_instagram_control', array(
		'label'    => __( 'Instagram URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_instagram'
	) );

	// Tumblr
	$wp_customize->add_setting( 'ingrid_tumblr', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_tumblr_control', array(
		'label'    => __( 'Tumblr URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_tumblr'
	) );

	// Google+
	$wp_customize->add_setting( 'ingrid_google', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_google_control', array(
		'label'    => __( 'Google+ URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_google'
	) );

	// Dribbble
	$wp_customize->add_setting( 'ingrid_dribbble', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_dribbble_control', array(
		'label'    => __( 'Dribbble URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_dribbble'
	) );

	// Last.fm
	$wp_customize->add_setting( 'ingrid_lastfm', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_lastfm_control', array(
		'label'    => __( 'Last.fm URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_lastfm'
	) );

	// Spotify
	$wp_customize->add_setting( 'ingrid_spotify', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_spotify_control', array(
		'label'    => __( 'Spotify URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_spotify'
	) );

	// Bloglovin
	$wp_customize->add_setting( 'ingrid_bloglovin', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_bloglovin_control', array(
		'label'    => __( 'Bloglovin\' URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_bloglovin'
	) );

	// Email
	$wp_customize->add_setting( 'ingrid_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'ingrid_email_control', array(
		'label'    => __( 'Email Address or Contact Page URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_email'
	) );

	// RSS
	$wp_customize->add_setting( 'ingrid_rss', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'ingrid_rss_control', array(
		'label'    => __( 'RSS URL', 'ingrid' ),
		'section'  => 'ingrid_social_media',
		'settings' => 'ingrid_rss'
	) );

	/*
	 * Colours
	 */

	// Body Text
	$wp_customize->add_setting( 'ingrid_body_text', array(
		'default'           => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'ingrid_body_text_control',
		array(
			'label'    => __( 'Paragraph Text', 'ingrid' ),
			'section'  => 'colors',
			'settings' => 'ingrid_body_text',
			'priority' => 1
		)
	) );

	// Links
	$wp_customize->add_setting( 'ingrid_links', array(
		'default'           => '#fba99c',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'ingrid_links_control',
		array(
			'label'    => __( 'Link Colour', 'ingrid' ),
			'section'  => 'colors',
			'settings' => 'ingrid_links',
			'priority' => 2
		)
	) );

	// Links - Hover
	$wp_customize->add_setting( 'ingrid_links_hover', array(
		'default'           => '#fba99c',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'ingrid_links_hover_control',
		array(
			'label'    => __( 'Link Colour - Hover', 'ingrid' ),
			'section'  => 'colors',
			'settings' => 'ingrid_links_hover',
			'priority' => 3
		)
	) );
}

add_action( 'customize_register', 'ingrid_customize_register' );

/**
 * Styles the header image and text displayed on the blog.
 */
function ingrid_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == $header_text_color ) :
		?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}

		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
		.site-title a,
		.site-title a:hover {
			color: # <?php echo esc_attr( $header_text_color ); ?>;
		}

		<?php endif; ?>
	</style>
<?php
}

/**
 * Generates the custom CSS rules based on the customizer settings.
 *
 * @return string
 */
function ingrid_generate_custom_styles() {
	$css = '
		body {
			color: ' . esc_attr( get_theme_mod( 'ingrid_body_text' ) ) . ';
		}

		a {
			color: ' . esc_attr( get_theme_mod( 'ingrid_links' ) ) . ';
		}
		a:hover {
			color: ' . esc_attr( get_theme_mod( 'ingrid_links_hover' ) ) . ';
		}
	';

	return $css;
}