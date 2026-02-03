<?php 
declare( strict_types = 1 );

/**
 * The template for displaying search results pages.
 *
 * @package Canard
 */

get_header(); ?>

	<div class="site-content-inner">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutputGit.OutputNotEscaped — the span is trusted static markup; the query is escaped below.
						printf(
							esc_html__( 'Search Results for: %s', 'canard' ),
							'<span>' . esc_html( get_search_query() ) . '</span>'
						);
						?>
					</h1>
				</header><!-- header.page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );
					?>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- main#main -->
		</div><!-- div#primary -->

		<?php get_sidebar(); ?>
	</div><!-- div.site-content-inner -->

<?php get_footer(); ?>
