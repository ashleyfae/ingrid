<?php
/**
 * Theme functions and definitions
 *
 * @package   noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/**
 * Sets up the theme defaults and registers support for various WordPress features.
 */
function ng_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CW Theme, use a find and replace
	 * to change 'netgalley' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'noah', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu' => __( 'Main Menu', 'noah' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'creativewhim_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'nosegraze_custom_header_args', array(
		'default-text-color' => '555555',
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'ng_theme_header_style'
	) ) );

	// Adds support for <title> tags, so we don't have to add them to the header.
	add_theme_support( 'title-tag' );

	/*
	 * Remove unnecessary elements from the header
	 */
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Category Feeds
	remove_action( 'wp_head', 'rsd_link' ); // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' ); // WP version
}

add_action( 'after_setup_theme', 'ng_theme_setup' );

// Specify the content width.
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ng_theme_widgets_init() {

	// Only register these widget areas if the top bar is set
	// to slide out.
	$slide_out_visibility = ng_option( 'slide_out_visibility' );
	if ( $slide_out_visibility == 'widget' ) {
		register_sidebar( array(
			'name'          => __( 'Slide Out - Column #1', 'noah' ),
			'id'            => 'slide_out_1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Slide Out - Column #2', 'noah' ),
			'id'            => 'slide_out_2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Slide Out - Column #3', 'noah' ),
			'id'            => 'slide_out_3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	// Register the footer widgets.
	register_sidebar( array(
		'name'          => __( 'Footer - Column #1', 'noah' ),
		'id'            => 'footer_1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer - Column #2', 'noah' ),
		'id'            => 'footer_2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer - Column #3', 'noah' ),
		'id'            => 'footer_3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Only register these widget areas if the homepage is set
	// to show a static page.
	if ( 'page' == get_option( 'show_on_front' ) ) {
		register_sidebar( array(
			'name'          => __( 'Homepage - Third #1', 'noah' ),
			'id'            => 'home_third_1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Homepage - Third #2', 'noah' ),
			'id'            => 'home_third_2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Homepage - Third #3', 'noah' ),
			'id'            => 'home_third_3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Homepage - Full Width', 'noah' ),
			'id'            => 'home_full',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}

add_action( 'widgets_init', 'ng_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ng_theme_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	wp_enqueue_style( 'droid-serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' );

	wp_enqueue_style( 'noah', get_stylesheet_uri(), array(), '1.0' );
	wp_add_inline_style( 'noah', ng_theme_generate_custom_styles() );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', true );

	$image_slider = ng_option( 'image_slider' );
	// Only include the image slider scripts if it's activated.
	if ( $image_slider == true && is_front_page() ) {
		wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', array(), '2.4.0' );
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '2.4.0', true );
	}

	wp_enqueue_script( 'noah', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '1.0.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ng_theme_scripts' );

/**
 * Adds the admin stylesheet for custom metaboxes.
 */
function ng_admin_styles() {
	$screen = get_current_screen();
	// If we're not on the right post type, bail.
	if ( $screen->post_type != 'ng_slider' && $screen->post_type != 'testimonial' ) {
		return;
	}

	$image_slider          = ng_option( 'image_slider' );
	$activate_testimonials = ng_option( 'testimonials' );

	// Only add this stylesheet if the testimonials or the image
	// slider is activated.
	if ( $activate_testimonials != 'none' || $image_slider === true ) {
		wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/assets/css/admin-meta-boxes.css', false, '1.0.0' );
	}
}

add_action( 'admin_enqueue_scripts', 'ng_admin_styles' );

/**
 * Adds JavaScript only to the testimonial post type.
 */
function ng_testimonial_admin_script() {
	global $post_type;
	if ( 'testimonial' == $post_type ) {
		wp_enqueue_script( 'testimonial-admin-script', get_template_directory_uri() . '/assets/js/testimonial-preview.js' );
	}
}

add_action( 'admin_print_scripts-post-new.php', 'ng_testimonial_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'ng_testimonial_admin_script', 11 );

/**
 * Customizer additions.
 */
function ng_theme_customizer_uri( $uri ) {
	return get_template_directory_uri() . '/inc/customizer';
}

add_filter( 'thsp_cbp_directory_uri', 'ng_theme_customizer_uri' );
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * aq_resizer script
 */
require get_template_directory() . '/inc/aq_resizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load UBB integration file.
 */
require get_template_directory() . '/inc/ubb.php';

/**
 * Load Testimonials custom post type.
 */
require get_template_directory() . '/inc/testimonials.php';

/**
 * Load the Image Slider custom post type.
 */
require get_template_directory() . '/inc/image-slider.php';

/**
 * Custom widgets.
 */
require get_template_directory() . '/inc/widgets/social-media.php';
require get_template_directory() . '/inc/widgets/icon-box.php';
require get_template_directory() . '/inc/widgets/callout.php';
require get_template_directory() . '/inc/widgets/latest-comment.php';
require get_template_directory() . '/inc/widgets/popular-posts.php';
require get_template_directory() . '/inc/widgets/browse.php';

/*	--------------------------------------------------
	:: License Key Menu
	-------------------------------------------------- */
add_action( 'admin_menu', 'ng_license_key_menu' );
function ng_license_key_menu() {
	add_theme_page( 'License Key', 'License Key', 'manage_options', 'ngtheme-license', 'ng_theme_license_page' );
}


/*	--------------------------------------------------
	:: Theme Version
	-------------------------------------------------- */
$theme_version = '';

if ( function_exists( 'wp_get_theme' ) ) {
	if ( is_child_theme() ) {
		$temp_obj  = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get( 'Template' ) );
	} else {
		$theme_obj = wp_get_theme();
	}

	$theme_version = $theme_obj->get( 'Version' );
	$theme_name    = $theme_obj->get( 'Name' );
	$theme_uri     = $theme_obj->get( 'ThemeURI' );
	$author_uri    = $theme_obj->get( 'AuthorURI' );
} else {
	$theme_data    = get_theme_data( get_template_directory() . '/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name    = $theme_data['Name'];
	$theme_uri     = $theme_data['ThemeURI'];
	$author_uri    = $theme_data['AuthorURI'];
}

define( 'THEMEVERSION', $theme_version );


/*	--------------------------------------------------
	:: Automatic Updates
	-------------------------------------------------- */
// This is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
if ( ! defined( 'EDD_CREATIVE_WHIM_URL' ) ) {
	define( 'EDD_CREATIVE_WHIM_URL', 'https://creativewhim.com' );
} // add your own unique prefix to prevent conflicts

// The name of your product. This should match the download name in EDD exactly
define( 'NG_THEME_NAME', 'Noah Theme' ); // add your own unique prefix to prevent conflicts


/***********************************************
 * This is our updater
 ***********************************************/

if ( ! class_exists( 'EDD_SL_Theme_Updater' ) ) {
	// Load our custom theme updater
	include( 'inc/EDD_SL_Theme_Updater.php' );
}

$ng_theme_license = trim( get_option( 'noah_theme_license_key' ) );

$edd_updater = new EDD_SL_Theme_Updater( array(
		'remote_api_url' => EDD_CREATIVE_WHIM_URL,    // Our store URL that is running EDD
		'version'        => THEMEVERSION,                // The current theme version we are running
		'license'        => $ng_theme_license,        // The license key (used get_option above to retrieve from DB)
		'item_name'      => NG_THEME_NAME,    // The name of this theme
		'author'         => 'Ashley Evans'    // The author's name
	)
);


/***********************************************
 * License key settings page
 ***********************************************/

function ng_theme_license_page() {
	$license = get_option( 'noah_theme_license_key' );
	$status  = get_option( 'noah_theme_license_key_status' );
	?>
	<div class="wrap">
	<h2><?php _e( 'Theme License Options', 'noah' ); ?></h2>

	<p><?php _e( 'In order to enable automatic updates, please enter and activate your license key.  This was given to you in your purchase email.', 'noah' ); ?></p>

	<form method="post" action="options.php">

		<?php settings_fields( 'noah_theme_license' ); ?>

		<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e( 'License Key', 'noah' ); ?>
				</th>
				<td>
					<input id="noah_theme_license_key" name="noah_theme_license_key" type="text" class="regular-text" value="<?php esc_attr( $license ); ?>"/>
					<label class="description" for="noah_theme_license_key"><?php _e( 'Enter your license key', 'noah' ); ?></label>
				</td>
			</tr>
			<?php if ( false !== $license ) { ?>
				<tr valign="top">
					<th scope="row" valign="top">
						<?php _e( 'Activate License', 'noah' ); ?>
					</th>
					<td>
						<?php if ( $status !== false && $status == 'valid' ) { ?>
							<span style="color:green;"><?php _e( 'active', 'noah' ); ?></span>
							<?php wp_nonce_field( 'ng_theme_nonce', 'ng_theme_nonce' ); ?>
							<input type="submit" class="button-secondary" name="ng_theme_license_deactivate" value="<?php _e( 'Deactivate License', 'noah' ); ?>"/>
						<?php } else {
							wp_nonce_field( 'ng_theme_nonce', 'ng_theme_nonce' ); ?>
							<input type="submit" class="button-secondary" name="ng_theme_license_activate" value="<?php _e( 'Activate License', 'noah' ); ?>"/>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php submit_button(); ?>

	</form>
<?php
}

function ng_theme_register_option() {
	// creates our settings in the options table
	register_setting( 'noah_theme_license', 'noah_theme_license_key', 'ng_theme_sanitize_license' );
}

add_action( 'admin_init', 'ng_theme_register_option' );


/***********************************************
 * Gets rid of the local license status option
 * when adding a new one
 ***********************************************/

function ng_theme_sanitize_license( $new ) {
	$old = get_option( 'noah_theme_license_key' );
	if ( $old && $old != $new ) {
		delete_option( 'noah_theme_license_key_status' ); // new license has been entered, so must reactivate
	}

	return $new;
}

/***********************************************
 * Illustrates how to activate a license key.
 ***********************************************/

function ng_theme_activate_license() {

	if ( isset( $_POST['ng_theme_license_activate'] ) ) {
		if ( ! check_admin_referer( 'ng_theme_nonce', 'ng_theme_nonce' ) ) {
			return;
		} // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( 'noah_theme_license_key' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( NG_THEME_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, EDD_CREATIVE_WHIM_URL ), array(
			'timeout'   => 15,
			'sslverify' => false
		) );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'noah_theme_license_key_status', $license_data->license );

	}
}

add_action( 'admin_init', 'ng_theme_activate_license' );

/***********************************************
 * Illustrates how to deactivate a license key.
 * This will descrease the site count
 ***********************************************/

function ng_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if ( isset( $_POST['ng_theme_license_deactivate'] ) ) {

		// run a quick security check
		if ( ! check_admin_referer( 'ng_theme_nonce', 'ng_theme_nonce' ) ) {
			return;
		} // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'noah_theme_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( NG_THEME_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, EDD_CREATIVE_WHIM_URL ), array(
			'timeout'   => 15,
			'sslverify' => false
		) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data->license == 'deactivated' ) {
			delete_option( 'noah_theme_license_key' );
		}

	}
}

add_action( 'admin_init', 'ng_theme_deactivate_license' );