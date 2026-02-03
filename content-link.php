<?php
declare( strict_types = 1 );

/**
 * The template for displaying link-format posts.
 *
 * @package Canard
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a class="post-link" href="<?php echo esc_url( canard_get_link_url() ); ?>" target="_blank" rel="noopener noreferrer">
		<span class="genericon genericon-link">
			<span class="screen-reader-text">
				<?php printf( __( 'External link to %s', 'canard' ), (string) the_title( '', '', false ) ); ?>
			</span>
		</span>
	</a>

	<header class="entry-header">
		<?php
			canard_entry_categories();
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( canard_get_link_url() ) ), '</a></h1>' );
		?>
	</header><!-- .entry-header -->

	<?php get_template_part( 'entry', 'script' ); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<div class="entry-meta">
		<?php canard_entry_meta(); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-## -->
