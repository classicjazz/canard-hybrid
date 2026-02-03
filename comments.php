<?php
declare( strict_types = 1 );

/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Canard
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

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comment_count = (int) get_comments_number();
				$escaped_title = '<span>' . esc_html( get_the_title() ) . '</span>';

				printf(
					_nx(
						'One thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comment_count,
						'comments title',
						'canard'
					),
					number_format_i18n( $comment_count ),
					$escaped_title
				);
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( [
					'avatar_size' => 60,
					'short_ping'  => true,
					'style'       => 'ol',
				] );
			?>
		</ol><!-- .comment-list -->

		<?php if ( (int) get_comment_pages_count() > 1 && get_option( 'page_comments' ) === true ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'canard' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'canard' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'canard' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
		if ( ! comments_open() && (int) get_comments_number() !== 0 && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'canard' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
