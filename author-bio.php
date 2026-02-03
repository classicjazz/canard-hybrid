<?php
declare( strict_types = 1 );

/**
 * The template for displaying Author Bio
 *
 * @package Canard
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = (int) apply_filters( 'canard_author_bio_avatar_size', 60 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- div.author-avatar -->

	<div class="author-heading">
		<h2 class="author-title"><?php esc_html_e( 'Published by', 'canard' ); ?></h2>
		<h3 class="author-name"><?php echo esc_html( get_the_author() ); ?></h3>
	</div><!-- div.author-heading -->

	<p class="author-bio">
		<?php the_author_meta( 'description' ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( esc_html__( 'View all posts by %s', 'canard' ), esc_html( get_the_author() ) ); ?>
		</a>
	</p><!-- p.author-bio -->
</div><!-- div.author-info -->
