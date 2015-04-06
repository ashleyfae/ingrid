<?php
/**
 * Settings for the WordPress Customizer.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Adds new settings to the WordPress Customizer.
 *
 * @param $options
 *
 * @return array
 */
function ng_theme_customizer_settings( $options ) {
	/*
	 * Using helper function to get default required capability
	 */
	$thsp_cbp_capability = thsp_cbp_capability();

	$options = array(
		/**
		 * Social Media
		 */
		'social_media'       => array(
			'existing_section' => false,
			'args'             => array(
				'title'       => __( 'Social Media', 'ingrid' ),
				'description' => __( 'Enter the URLs for your social media profiles. These may be used in the layout and/or in a custom widget.', 'ingrid' ),
				'priority'    => 200
			),
			'fields'           => array(
				// Social Media - Twitter
				'twitter'   => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Twitter URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 2
					)
				),
				// Social Media - Facebook
				'facebook'  => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Facebook URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 3
					)
				),
				// Social Media - Pinterest
				'pinterest' => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Pinterest URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 4
					)
				),
				// Social Media - Tumblr
				'tumblr'    => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Tumblr URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 5
					)
				),
				// Social Media - Google Plus
				'google'    => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Google+ URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 6
					)
				),
				// Social Media - Dribble
				'dribbble'  => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Dribbble URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 7
					)
				),
				// Social Media - Last.fm
				'lastfm'    => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Last.fm URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 8
					)
				),
				// Social Media - Spotify
				'spotify'   => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Spotify URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 9
					)
				),
				// Social Media - Bloglovin'
				'bloglovin' => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Bloglovin\' URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 10
					)
				),
				// Social Media - Email
				'email'     => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Email Address or Contact Page URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 11
					)
				),
				// Social Media - RSS
				'rss'       => array(
					'setting_args' => array(
						'default'    => home_url( '/rss/' ),
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'RSS URL', 'ingrid' ),
						'type'     => 'text',
						'priority' => 12
					)
				),
			)
		),
		/**
		 * Colours
		 */
		'colors'             => array(
			'existing_section' => true,
			'fields'           => array(
				// Body text
				'body_color'         => array(
					'setting_args' => array(
						'default'    => '#888888',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Paragraph Text', 'ingrid' ),
						'type'     => 'color',
						'priority' => 1
					)
				),
				// Links
				'links'              => array(
					'setting_args' => array(
						'default'    => '#fba99c',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Link Colour', 'ingrid' ),
						'type'     => 'color',
						'priority' => 2
					)
				),
				// Link Hover
				'links_hover'        => array(
					'setting_args' => array(
						'default'    => '#fba99c',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Link Colour - Hover', 'ingrid' ),
						'type'     => 'color',
						'priority' => 3
					)
				),
			)
		),


	);

	return $options;
}

add_filter( 'thsp_cbp_options_array', 'ng_theme_customizer_settings' );

/**
 * Styles the header image and text displayed on the blog.
 */
function ng_theme_header_style() {
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
function ng_theme_generate_custom_styles() {
	$css = '
		body {
			color: ' . esc_attr( ng_option( 'body_color' ) ) . ';
		}

		a {
			color: ' . esc_attr( ng_option( 'links' ) ) . ';
		}
		a:hover {
			color: ' . esc_attr( ng_option( 'links_hover' ) ) . ';
		}
	';

	return $css;
}