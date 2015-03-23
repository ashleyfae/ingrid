<?php
/**
 * Registers the "ng_slider" post type and adds meta boxes.
 *
 * @package noah
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license GPL2
 */

/**
 * Registers the image slider post type.
 */
function ng_register_slider_post_type() {

	$labels = array(
		'name'               => _x( 'Sliders', 'Post Type General Name', 'ingrid' ),
		'singular_name'      => _x( 'Slider', 'Post Type Singular Name', 'ingrid' ),
		'menu_name'          => __( 'Image Slider', 'ingrid' ),
		'parent_item_colon'  => __( 'Parent Slide:', 'ingrid' ),
		'all_items'          => __( 'All Slides', 'ingrid' ),
		'view_item'          => __( 'View Slide', 'ingrid' ),
		'add_new_item'       => __( 'Add New Slide', 'ingrid' ),
		'add_new'            => __( 'Add New', 'ingrid' ),
		'edit_item'          => __( 'Edit Slide', 'ingrid' ),
		'update_item'        => __( 'Update Slide', 'ingrid' ),
		'search_items'       => __( 'Search Slide', 'ingrid' ),
		'not_found'          => __( 'Not found', 'ingrid' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ingrid' ),
	);
	$args   = array(
		'label'               => __( 'ng_slider', 'ingrid' ),
		'description'         => __( 'Create an image slider', 'ingrid' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 48,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'ng_slider', $args );

}

// Hook into the 'init' action
add_action( 'init', 'ng_register_slider_post_type', 0 );

/**
 * Moves the Featured Image box below the title.
 * Also adds another box for the link URL.
 */
function ng_move_slider_featured_image_meta() {
	// Featured Image Box
	remove_meta_box( 'postimagediv', 'cw_slider', 'side' );
	add_meta_box( 'postimagediv', __( 'Slider Image', 'ingrid' ), 'post_thumbnail_meta_box', 'ng_slider', 'normal', 'high' );

	// Link
	add_meta_box( 'cw_slider_link', __( 'Link URL', 'ingrid' ), 'ng_slider_url_metabox_cb', 'ng_slider', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'ng_move_slider_featured_image_meta' );

/**
 * Adds a filter for the featured image label.
 *
 * @param $content
 */
function ng_changed_slider_html( $content ) {
	if ( 'ng_slider' == $GLOBALS['post_type'] ) {
		add_filter( 'admin_post_thumbnail_html', 'ng_slider_featured_image_label' );
	}
}

add_action( 'admin_head-post-new.php', 'ng_changed_slider_html' );
add_action( 'admin_head-post.php', 'ng_changed_slider_html' );

/**
 * Replaces the "set featured image" text with "add slider image".
 *
 * @param string $content
 *
 * @return string
 */
function ng_slider_featured_image_label( $content ) {
	$content = str_replace( __( 'Set featured image' ), __( 'Add slider image', 'ingrid' ), $content );
	$content = str_replace( __( 'Remove featured image' ), __( 'Remove slider image', 'ingrid' ), $content );

	return $content;
}


/**
 * Adds a meta box for the post URL.
 *
 * @param object $post
 */
function ng_slider_url_metabox_cb( $post ) {
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'save_ng_slider_link', 'ng_slider_link_nonce' );
	$link = get_post_meta( $post->ID, 'ng_slider_link', true );

	?>
	<p><label for="ng_slider_link"><?php _e('Enter a URL you\'d like the slide to link to:', 'ingrid'); ?></label></p>
	<input type="url" id="ng_slider_link" name="ng_slider_link" value="<?php echo esc_attr( $link ); ?>" style="width:300px" placeholder="http://">
<?php
}

/**
 * Saves the meta box value.
 *
 * @param int $post_id
 */
function cw_save_slider_metabox( $post_id ) {
	// Bail if the nonce isn't there
	if ( ! isset( $_POST['ng_slider_link_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['ng_slider_link_nonce'], 'save_ng_slider_link' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'ng_slider' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/*
	 * Start saving data!
	 */
	// Make sure that it is set.
	if ( ! isset( $_POST['ng_slider_link'] ) ) {
		return;
	}

	// Sanitize user input.
	$link = sanitize_text_field( $_POST['ng_slider_link'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'ng_slider_link', $link );
}

add_action( 'save_post', 'cw_save_slider_metabox' );