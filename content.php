<?php
declare( strict_types = 1 );

/**
 * The default template for displaying a single content entry.
 *
 * This template is used across the Canard theme to render
 * individual posts and pages in the magazine layout. Dynamic
 * color and spacing attributes are managed by theme.json.
 *
 * @package Canard
 * @version 1.3
 */
?>

<article id="post-<?php echo (int) get_the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && 'post' === get_post_type() && ( ! has_post_format() || has_post_format( 'image' ) || has_post_format( 'gallery' ) ) ) : ?>

		<?php
			if ( ! has_post_format() ) {
				echo '<a class="post-thumbnail" href="' . esc_url( get_permalink() ) . '">';
			} elseif ( has_post_format( 'image' ) || has_post_format( 'gallery' ) ) {
				echo '<div class="post-thumbnail">';
			}
			the_post_thumbnail( 'canard-post-thumbnail' );
		?>

		<?php if ( is_sticky() ) : ?>
			<span class="sticky-post"><span class="genericon genericon-pinned"><span class="screen-reader-text"><?php esc_html_e( 'Sticky post', 'canard' ); ?></span></span></span>
		<?php endif; ?>

		<?php
			if ( ! has_post_format() ) {
				echo '</a>';
			} elseif ( has_post_format( 'image' ) || has_post_format( 'gallery' ) ) {
				echo '</div>';
			}
		?>

	<?php endif; ?>

	<header class="entry-header">
		<?php
			canard_entry_categories();
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		?>
	</header><!-- /header.entry-header -->

	<?php get_template_part( 'entry', 'script' ); ?>

	<div class="entry-summary">
		<?php
			if ( strpos( $post->post_content, '<!--more' ) !== false ) {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( esc_html__( 'Continue reading %s', 'canard' ), [ 'span' => [ 'class' => [] ] ] ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			} else {
				the_excerpt();
			}
		?>
	</div><!-- /div.entry-summary -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php canard_entry_meta(); ?>
		</div><!-- /div.entry-meta -->
	<?php endif; ?>
</article><!-- /article#post -->
