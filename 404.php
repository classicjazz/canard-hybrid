<?php
declare( strict_types = 1 );

/**
 * The template for displaying 404 pages (not found).
 *
 * @package Canard
 */

get_header();
?>

<div class="site-content-inner">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can\'t be found.', 'canard' ); ?></h1>
				</header><!-- /header.page-header -->

				<div class="page-content">
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'canard' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- /div.page-content -->
			</section><!-- /section.error-404 -->

		</main><!-- /main#main -->
	</div><!-- /div#primary -->

	<?php get_sidebar(); ?>
</div><!-- /div.site-content-inner -->

<?php get_footer(); ?>
