<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */

namespace VigilantMedia\WordPress\Themes\VexVox;

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="row">
	<div id="comments" class="col-md-offset-4 col-md-8">

	<?php if ( have_comments() ) : ?>

		<header class="source-label">
			<h3 class="source-title">Comments</h3>
		</header>

		<div class="comments-list-area">
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav role="navigation">
			<h4 class="sr-only"><?php _e( 'Comment navigation', WP_TEXT_DOMAIN ); ?></h4>

			<ul class="pager">
				<li><?php previous_comments_link( __( '&larr; Older Comments', WP_TEXT_DOMAIN ) ); ?></li>
				<li><?php next_comments_link( __( 'Newer Comments &rarr;', WP_TEXT_DOMAIN ) ); ?></li>
			</ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 34,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav role="navigation">
			<h4 class="sr-only"><?php _e( 'Comment navigation', WP_TEXT_DOMAIN ); ?></h4>

			<ul class="pager">
				<li><?php previous_comments_link( __( '&laquo; Older Comments', WP_TEXT_DOMAIN ) ); ?></li>
				<li><?php next_comments_link( __( 'Newer Comments &raquo;', WP_TEXT_DOMAIN ) ); ?></li>
			</ul>
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', WP_TEXT_DOMAIN ); ?></p>
	<?php endif; ?>

	</div>
	<?php endif; // have_comments() ?>

	<?php
	$comment_args = array(
		'fields' => apply_filters('comment_form_default_fields', array(
			'author' => '<div class="form-group"><label for="author" class="control-label">' . __( 'Name', WP_TEXT_DOMAIN ) . ' <span class="required">*</span></label> ' . ( $req ? '<div class="">' : '' ) . '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
			'email' => '<div class="form-group"><label for="email" class="control-label">' . __( 'Email', WP_TEXT_DOMAIN ) . ' <span class="required">*</span></label> ' . ( $req ? '<div class="">' : '' ) . '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
			'url' => '<div class="form-group"><label for="url" class="control-label">' . __( 'Website', WP_TEXT_DOMAIN ) . '</label>' . '<div class=""><input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
		)),
		'comment_field' => '<div class="form-group"><label for="comment" class="control-label">' . _x( 'Comment', 'noun' ) . '</label><div class=""><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea></div></div>',
		'comment_notes_after' => '<p class="form-allowed-tags help-block">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), allowed_tags() ) . '</p>',
		'class_form' => 'form',
		'class_submit' => 'btn btn-default',
		'title_reply' => __('Post a comment'),
	);
	(function_exists( 'bootstrap_comment_form' ) === true ) ? bootstrap_comment_form($comment_args) : comment_form($comment_args);
	?>
		

	</div><!-- #comments -->
</div>
