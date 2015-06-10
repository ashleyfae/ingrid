<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package   ingrid
 * @copyright Copyright (c) 2015 Ashley Evans and Anna Moore
 * @license   GPL2
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<div class="box">

		<?php ?>

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
				printf(
					_nx( 'response to %1$s', 'responses to %1$s', get_comments_number(), 'comments title', 'ingrid' ),
					'&ldquo;' . get_the_title() . '&rdquo;'
				);
				?>

				<span class=comment-count"><?php echo get_comments_number(); ?></span>
			</h2>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-above" class="comment-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'ingrid' ); ?></h1>

					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ingrid' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ingrid' ) ); ?></div>
				</nav><!-- #comment-nav-above -->
			<?php endif; // check for comment navigation ?>

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'avatar_size' => 42,
					'style'       => 'ol',
					'short_ping'  => true,
				) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="comment-navigation" role="navigation">
					<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'ingrid' ); ?></h3>

					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ingrid' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ingrid' ) ); ?></div>
				</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

	</div>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<div class="no-comments alert alert-warning text-center"><?php _e( 'Comments are closed.', 'ingrid' ); ?></div>
	<?php endif; ?>

	<?php
	/*
	* Comment form args
	*/
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? ' aria-required="true"' : '' );

	$args = array(
		'comment_field'        => '<div class="form-group"><textarea name="comment" id="comment" placeholder="' . sprintf( __( 'What did you think of &ldquo;%1$s&rdquo;?', 'ingrid' ), get_the_title() ) . '" tabindex="4" aria-required="true" rows="12"></textarea></div>',
		'title_reply'          => __( 'Leave a Comment', 'ingrid' ),
		'label_submit'         => __( 'Submit &#x2192;', 'ingrid' ),
		'fields'               => apply_filters( 'comment_form_default_fields', array(
			'author' =>
				'<div class="form-group">' .
				'<label for="author" class="screen-reader-text">' . __( 'Name', 'ingrid' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'ingrid' ) . '" tabindex="1"' . $aria_req . '>' .
				'</div>',
			'email'  =>
				'<div class="form-group">' .
				'<label for="email" class="screen-reader-text">' . __( 'Email', 'ingrid' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input type="text" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'ingrid' ) . '" tabindex="2"' . $aria_req . '>' .
				'</div>',
			'url'    =>
				'<div class="form-group">' .
				'<label for="url" class="screen-reader-text">' . __( 'Website', 'ingrid' ) . '</label> ' .
				'<input type="text" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'URL', 'ingrid' ) . '" tabindex="3">' .
				'</div>'
		) )
	);
	?>

	<div id="respond-wrap" class="box">
		<?php comment_form( $args ); ?>
	</div>

</div><!-- #comments -->
