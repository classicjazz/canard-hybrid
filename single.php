<?php
declare( strict_types = 1 );

/**
 * The template for displaying all single posts.
 *
 * Requires: PHP 8.4+, WordPress 6.7+ (Hybrid Theme support)
 *
 * @package Canard
 * @since   1.0.0
 * @version 2.0.0
 */

get_header();
?>

	<div class="site-content-inner">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) :
					the_post();
				?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php
					// Load comments only when the post supports them AND either
					// comments are open or at least one comment already exists.
					// Cast strictly: get_comments_number() returns int|string.
					if ( comments_open() || ( (int) get_comments_number() > 0 ) ) :
						comments_template();
					endif;
					?>

					<?php
					// Author bio — rendered only for singular posts (not pages,
					// custom post types, etc.).  The strict equality check avoids
					// any type-juggling ambiguity introduced by get_post_type().
					if ( 'post' === get_post_type() ) :
						get_template_part( 'template-tags', 'author-bio' );
					endif;
					?>

					<?php
					// Previous / next post navigation.
					// Navigation label markup is composed here for readability;
					// the_post_navigation() escapes %title internally via
					// wp_kses_post(), so no additional sanitisation is required
					// on the static label spans.
					$next_label = '<span class="meta-nav" aria-hidden="true">'
						. __( 'Next', 'canard' )
						. '</span> '
						. '<span class="screen-reader-text">'
						. __( 'Next post:', 'canard' )
						. '</span> '
						. '<span class="post-title">%title</span>';

					$prev_label = '<span class="meta-nav" aria-hidden="true">'
						. __( 'Previous', 'canard' )
						. '</span> '
						. '<span class="screen-reader-text">'
						. __( 'Previous post:', 'canard' )
						. '</span> '
						. '<span class="post-title">%title</span>';

					the_post_navigation( [
						'next_text' => $next_label,
						'prev_text' => $prev_label,
					] );
					?>

				<?php endwhile; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!-- .site-content-inner -->

<?php get_footer(); ?>
