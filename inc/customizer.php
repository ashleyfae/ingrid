<?php
/**
 * Settings for the WordPress Customizer.
 *
 * @package   noah
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
		 * Slide Out panel
		 */
		'slide_out'          => array(

			'existing_section' => false,
			/*
			 * Section related arguments
			 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
			 */
			'args'             => array(
				'title'       => __( 'Slide Out Panel', 'noah' ),
				'description' => __( 'Modify the slide panel at the top of the page.', 'noah' ),
				'priority'    => 100
			),
			'fields'           => array(

				// Slide out style and visibility
				'slide_out_visibility' => array(
					'setting_args' => array(
						'default'    => 'widget',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Panel Content &amp; Visibility', 'noah' ),
						'type'     => 'select',
						'choices'  => array(
							'widget'   => array(
								'label' => __( 'Widget Area (toggle)', 'noah' ),
							),
							'inactive' => array(
								'label' => __( 'Social Media &amp; Search (no toggle)', 'noah' ),
							),
							'disabled' => array(
								'label' => __( 'Disabled (hidden)', 'noah' ),
							)
						),
						'priority' => 1
					)
				),
				// Slide Out background colour
				'slide_out_bg'         => array(
					'setting_args' => array(
						'default'    => '#f48e9e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Slide Out Background Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 4
					)
				),
				// Slide Out border colour
				'slide_out_border'     => array(
					'setting_args' => array(
						'default'    => '#db808e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Slide Out Border Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 5
					)
				),
				// Slide Out text colour
				'slide_out_text'       => array(
					'setting_args' => array(
						'default'    => '#ffffff',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Slide Out Text Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 6
					)
				),
				// Slide Out link colour
				'slide_out_links'      => array(
					'setting_args' => array(
						'default'    => '#a23647',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Slide Out Link Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 7
					)
				),
				// Input box background
				'slide_out_input'      => array(
					'setting_args' => array(
						'default'    => '#d66e7e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Slide Out Text Box Background Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 8
					)
				),

			),

		),
		/**
		 * Blog Posts
		 */
		'blog_layout'        => array(
			'existing_section' => false,
			'args'             => array(
				'title'       => __( 'Blog Layout', 'noah' ),
				'description' => __( 'Configure the blog layout.', 'noah' ),
				'priority'    => 101
			),
			'fields'           => array(
				'post_content'         => array(
					'setting_args' => array(
						'default'    => 'single',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Archive Post Display', 'noah' ),
						'type'     => 'radio',
						'choices'  => array(
							'excerpts' => array(
								'label' => __( 'Excerpts', 'noah' ),
							),
							'single'   => array(
								'label' => __( 'Full Posts', 'noah' )
							)
						),
						'priority' => 1
					)
				),
				'auto_add_featured'    => array(
					'setting_args' => array(
						'default'    => true,
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Automatically Add Featured Image', 'noah' ),
						'type'     => 'checkbox',
						'priority' => 2
					)
				),
				'featured_arrow'       => array(
					'setting_args' => array(
						'default'    => false,
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Disable Featured Image Effect', 'noah' ),
						'type'     => 'checkbox',
						'priority' => 3
					)
				),
				'comment_notes_before' => array(
					'setting_args' => array(
						'default'    => __( 'Some HTML allowed, please do not include links to your site in comments', 'noah' ),
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Notes Before the Comment Form', 'noah' ),
						'type'     => 'text',
						'priority' => 10
					)
				),
				'comment_notes_after'  => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Notes After the Comment Form', 'noah' ),
						'type'     => 'text',
						'priority' => 11
					)
				)
			)
		),
		/**
		 * Social Media
		 */
		'testimonials'       => array(
			'existing_section' => false,
			'args'             => array(
				'title'       => __( 'Testimonials', 'noah' ),
				'description' => __( 'You can use the testimonials feature to showcase quotes from your clients/customers.', 'noah' ),
				'priority'    => 190
			),
			'fields'           => array(
				'testimonials' => array(
					'setting_args' => array(
						'default'    => 'pages',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Display Testimonials On:', 'noah' ),
						'type'     => 'select',
						'choices'  => array(
							'pages' => array(
								'label' => __( 'All Pages', 'noah' )
							),
							'home'  => array(
								'label' => __( 'Static Homepage Only', 'noah' )
							),
							'none'  => array(
								'label' => __( 'None (Disabled)', 'noah' )
							)
						),
						'priority' => 90
					)
				),
			)
		),
		/**
		 * Social Media
		 */
		'social_media'       => array(
			'existing_section' => false,
			'args'             => array(
				'title'       => __( 'Social Media', 'noah' ),
				'description' => __( 'Enter the URLs for your social media profiles. These may be used in the layout and/or in a custom widget.', 'noah' ),
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
						'label'    => __( 'Twitter URL', 'noah' ),
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
						'label'    => __( 'Facebook URL', 'noah' ),
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
						'label'    => __( 'Pinterest URL', 'noah' ),
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
						'label'    => __( 'Tumblr URL', 'noah' ),
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
						'label'    => __( 'Google+ URL', 'noah' ),
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
						'label'    => __( 'Dribbble URL', 'noah' ),
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
						'label'    => __( 'Last.fm URL', 'noah' ),
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
						'label'    => __( 'Spotify URL', 'noah' ),
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
						'label'    => __( 'Bloglovin\' URL', 'noah' ),
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
						'label'    => __( 'Email Address or Contact Page URL', 'noah' ),
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
						'label'    => __( 'RSS URL', 'noah' ),
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
						'default'    => '#a0a0a0',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Paragraph Text', 'noah' ),
						'type'     => 'color',
						'priority' => 1
					)
				),
				// Links
				'links'              => array(
					'setting_args' => array(
						'default'    => '#f48e9e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Link Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 2
					)
				),
				// Link Hover
				'links_hover'        => array(
					'setting_args' => array(
						'default'    => '#f48e9e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Link Colour - Hover', 'noah' ),
						'type'     => 'color',
						'priority' => 3
					)
				),
				// Footer background colour
				'footer_bg'          => array(
					'setting_args' => array(
						'default'    => '#f48e9e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Background Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 4
					)
				),
				// Footer border colour
				'footer_border'      => array(
					'setting_args' => array(
						'default'    => '#db808e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Border Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 5
					)
				),
				// Slide Out text colour
				'footer_text'        => array(
					'setting_args' => array(
						'default'    => '#ffffff',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Text Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 6
					)
				),
				// Footer link colour
				'footer_links'       => array(
					'setting_args' => array(
						'default'    => '#ffffff',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Link Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 7
					)
				),
				// Input box background
				'footer_input'       => array(
					'setting_args' => array(
						'default'    => '#d66e7e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Text Box Background Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 8
					)
				),
				// Attribution background
				'footer_attribution' => array(
					'setting_args' => array(
						'default'    => '#db808e',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Footer Credits Background Colour', 'noah' ),
						'type'     => 'color',
						'priority' => 9
					)
				),
			)
		),
		/**
		 * Static Front Page
		 */
		'static_front_page'  => array(
			'existing_section' => true,
			'fields'           => array(
				'image_slider' => array(
					'setting_args' => array(
						'default'    => true,
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Display image slider on Static Homepage', 'noah' ),
						'type'     => 'checkbox',
						'priority' => 20
					)
				),
			)
		),
		/**
		 * Custom CSS
		 */
		'custom_css_section' => array(

			'existing_section' => false,
			'args'             => array(
				'title'       => __( 'Custom CSS', 'noah' ),
				'description' => __( 'Use this space to insert custom CSS into the theme.', 'noah' ),
				'priority'    => 201
			),
			'fields'           => array(
				// Custom CSS box.
				'custom_css' => array(
					'setting_args' => array(
						'default'    => '',
						'type'       => 'option',
						'capability' => $thsp_cbp_capability,
						'transport'  => 'refresh',
					),
					'control_args' => array(
						'label'    => __( 'Enter your CSS', 'noah' ),
						'type'     => 'textarea', // Textarea control
						'priority' => 1
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

		a,
		.pagination > li > a {
			color: ' . esc_attr( ng_option( 'links' ) ) . ';
		}
		a:hover,
		.pagination > li > a:hover,
		.pagination > li > a:active,
		.pagination > li > a:focus {
			color: ' . esc_attr( ng_option( 'links_hover' ) ) . ';
		}

		#commentform #submit, input[type="submit"] {
			background: ' . esc_attr( ng_option( 'links' ) ) . ';
			border: 1px solid ' . esc_attr( ng_option( 'links' ) ) . ';
		}

		#commentform #submit, input[type="submit"]:hover {
			background: ' . esc_attr( ng_option( 'links_hover' ) ) . ';
			border: 1px solid ' . esc_attr( ng_option( 'links_hover' ) ) . ';
		}

		#slide-out {
			background: ' . esc_attr( ng_option( 'slide_out_bg' ) ) . ';
			border-bottom-color: ' . esc_attr( ng_option( 'slide_out_border' ) ) . ';
		}
		#slide-out:after {
			border-color: ' . esc_attr( ng_option( 'slide_out_bg' ) ) . ' transparent transparent transparent;
		}
		#slide-out:before {
			border-color: ' . esc_attr( ng_option( 'slide_out_border' ) ) . ' transparent transparent transparent;
		}
		#slide-out .widget-area,
		#slide-out .widget-title,
		#slide-out .widget.widget_noah_social_media ul li a {
			color: ' . esc_attr( ng_option( 'slide_out_text' ) ) . ';
		}
		#slide-out .widget a,
		#slide-out .widget.widget_noah_social_media ul li a:hover {
			color: ' . esc_attr( ng_option( 'slide_out_links' ) ) . ';
		}
		#slide-out input[type="email"],
		#slide-out input[type="search"],
		#slide-out input[type="password"],
		#slide-out input[type="text"],
		#slide-out select,
		#slide-out textarea {
			background: ' . esc_attr( ng_option( 'slide_out_input' ) ) . ';
		}

		#footer {
			background: ' . esc_attr( ng_option( 'footer_bg' ) ) . ';
			border-top-color: ' . esc_attr( ng_option( 'footer_border' ) ) . ';
		}
		#footer:after {
			border-color: transparent transparent ' . esc_attr( ng_option( 'footer_bg' ) ) . ' transparent;
		}
		#footer:before {
			border-color: transparent transparent ' . esc_attr( ng_option( 'footer_border' ) ) . ' transparent;
		}
		#footer .widget-area,
		#footer .widget-title,
		#footer .widget.widget_noah_social_media ul li a {
			color: ' . esc_attr( ng_option( 'footer_text' ) ) . ';
		}
		#footer .widget a,
		#footer .widget.widget_noah_social_media ul li a:hover {
			color: ' . esc_attr( ng_option( 'footer_links' ) ) . ';
		}
		#footer input[type="email"],
		#footer input[type="search"],
		#footer input[type="password"],
		#footer input[type="text"],
		#footer select,
		#footer textarea {
			background: ' . esc_attr( ng_option( 'footer_input' ) ) . ';
		}
		#footer .attribution {
			background: ' . esc_attr( ng_option( 'footer_attribution' ) ) . ';
		}
	';

	return $css;
}