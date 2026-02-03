<?php
declare( strict_types = 1 );

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core
 * features.
 *
 * @package Canard
 */

// ---------------------------------------------------------------------------
// Post-set navigation (archive pages)
// ---------------------------------------------------------------------------

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next / previous set of posts when applicable.
 *
 * @todo Remove this shim when the minimum supported WordPress version
 *       includes the_posts_navigation() in core (added in 4.3).
 */
function the_posts_navigation(): void {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'canard' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'canard' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'canard' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

// ---------------------------------------------------------------------------
// Single-post navigation
// ---------------------------------------------------------------------------

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next / previous post when applicable.
 *
 * @todo Remove this shim when the minimum supported WordPress version
 *       includes the_post_navigation() in core (added in 4.3).
 */
function the_post_navigation(): void {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'canard' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

// ---------------------------------------------------------------------------
// Entry meta helpers
// ---------------------------------------------------------------------------

if ( ! function_exists( 'canard_entry_categories' ) ) :
/**
 * Print HTML with meta information for the post categories.
 */
function canard_entry_categories(): void {
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'canard' ) );

		if ( $categories_list && canard_categorized_blog() ) {
			printf( '<div class="entry-meta"><span class="cat-links">%1$s</span></div>', $categories_list );
		}
	}
}
endif;

if ( ! function_exists( 'canard_entry_meta' ) ) :
/**
 * Print HTML with meta information for the author, date/time and comments.
 */
function canard_entry_meta(): void {
	/**
	 * Filter the author bio avatar size.
	 *
	 * @param int $size The avatar height and width in pixels.
	 */
	$author_bio_avatar_size = apply_filters( 'canard_author_bio_avatar_size', 20 );

	$byline = sprintf(
		'<span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span>',
		get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>'
			. '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<a href="%1$s" rel="bookmark">%2$s</a>',
		esc_url( get_permalink() ),
		$time_string
	);

	/*
	 * On single posts where the author bio is enabled and actually populated,
	 * suppress the inline byline (the bio block already contains the author).
	 * Strict comparison used: get_theme_mod returns a mixed value.
	 */
	if ( is_single() && ( 1 === (int) get_theme_mod( 'canard_author_bio' ) && get_the_author_meta( 'description' ) ) ) {
		echo '<span class="posted-on">' . $posted_on . '</span>';
	} else {
		echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'canard' ), __( '1 Comment', 'canard' ), __( '% Comments', 'canard' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'canard_entry_footer' ) ) :
/**
 * Print HTML with meta information for the categories, tags and comments.
 */
function canard_entry_footer(): void {
	canard_entry_meta();

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		the_tags( '<span class="tags-links">', esc_html__( ', ', 'canard' ), '</span>' );
	}

	edit_post_link( __( 'Edit', 'canard' ), '<span class="edit-link">', '</span>' );
}
endif;

// ---------------------------------------------------------------------------
// Archive title / description shims
// ---------------------------------------------------------------------------

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Display the archive title based on the queried object.
 *
 * @todo Remove this shim when the minimum supported WordPress version
 *       includes the_archive_title() in core (added in 4.3).
 *
 * @param string $before Content to prepend to the title.
 * @param string $after  Content to append to the title.
 */
function the_archive_title( string $before = '', string $after = '' ): void {
	$title = '';

	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'canard' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'canard' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'canard' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'canard' ), get_the_date( _x( 'Y', 'yearly archives date format', 'canard' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'canard' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'canard' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'canard' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'canard' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'canard' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'canard' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'canard' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'canard' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'canard' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Display category, tag, or term description.
 *
 * @todo Remove this shim when the minimum supported WordPress version
 *       includes the_archive_description() in core (added in 4.3).
 *
 * @param string $before Content to prepend to the description.
 * @param string $after  Content to append to the description.
 */
function the_archive_description( string $before = '', string $after = '' ): void {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

// ---------------------------------------------------------------------------
// Category helpers & transient cache
// ---------------------------------------------------------------------------

/**
 * Return true when the blog uses more than one category.
 *
 * The result is cached in a transient that is flushed on category saves and
 * post saves to stay in sync cheaply.
 *
 * @return bool
 */
function canard_categorized_blog(): bool {
	$all_the_cool_cats = get_transient( 'canard_categories' );

	if ( false === $all_the_cool_cats ) {
		// Fetch only category IDs; limit to 2 because we only care whether
		// the count exceeds 1.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = is_countable( $all_the_cool_cats ) ? count( $all_the_cool_cats ) : 0;

		set_transient( 'canard_categories', $all_the_cool_cats );
	}

	return $all_the_cool_cats > 1;
}

/**
 * Flush the category-count transient so that canard_categorized_blog()
 * re-queries on the next page load.
 */
function canard_category_transient_flusher(): void {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	delete_transient( 'canard_categories' );
}
add_action( 'edit_category', 'canard_category_transient_flusher' );
add_action( 'save_post',     'canard_category_transient_flusher' );

// ---------------------------------------------------------------------------
// Post-navigation background images
// ---------------------------------------------------------------------------

/**
 * Inject inline CSS that sets the adjacent-post thumbnails as background
 * images on the single-post navigation links.
 *
 * These are per-request, data-driven styles (not brand colours) and are
 * therefore generated in PHP rather than theme.json.
 */
function canard_post_nav_background(): void {
	if ( ! is_single() ) {
		return;
	}

	if ( ! canard_jetpack_featured_image_display() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	// Attachments within the same gallery share a parent; bail when the
	// previous item is also an attachment to avoid a redundant nav block.
	if ( is_attachment() && $previous && 'attachment' === $previous->post_type ) {
		return;
	}

	if ( $previous && has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ?? '' ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a { background-color: rgba(0, 0, 0, 0.3); border: 0; text-shadow: 0 0 0.125em rgba(0, 0, 0, 0.3); }
			.post-navigation .nav-previous a:focus, .post-navigation .nav-previous a:hover { background-color: rgba(0, 0, 0, 0.6); }
			.post-navigation .nav-previous a:focus .post-title { color: #fff; }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ?? '' ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a { background-color: rgba(0, 0, 0, 0.3); border: 0; text-shadow: 0 0 0.125em rgba(0, 0, 0, 0.3); }
			.post-navigation .nav-next a:focus, .post-navigation .nav-next a:hover { background-color: rgba(0, 0, 0, 0.6); }
			.post-navigation .nav-next a:focus .post-title { color: #fff; }
		';
	}

	wp_add_inline_style( 'canard-style', $css );
}
add_action( 'wp_enqueue_scripts', 'canard_post_nav_background' );
