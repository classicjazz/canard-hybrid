<?php
declare( strict_types = 1 );

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
					// Load comments only when the post supports them AND either
					// comments are open or at least one comment already exists.
					// get_comments_number() returns int|string so we cast strictly
					// rather than relying on loose truthiness of "0".
					if ( comments_open() || ( (int) get_comments_number() > 0 ) ) :
						comments_template();
					endif;
					?>

				<?php endwhile; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!-- .site-content-inner -->

<?php get_footer(); ?>
