<?php
declare( strict_types = 1 );

/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 * @package Canard
 */

/**
 * Register Jetpack theme-support declarations.
 *
 * The featured-content block (filter name, max_posts, post_types) and the
 * infinite-scroll container/footer IDs are load-bearing for the homepage
 * grid layout — they are preserved exactly as originally declared.
 */
function canard_jetpack_setup(): void {
	// Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'page',
		'footer_widgets' => array( 'sidebar-2' ),
	) );

	// Featured Content – powers the homepage carousel/grid.
	add_theme_support( 'featured-content', array(
		'filter'      => 'canard_get_featured_posts',
		'description' => __( 'The featured content section displays on the front page above the header.', 'canard' ),
		'max_posts'   => 5,
		'post_types'  => array( 'post', 'page' ),
	) );

	// Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Site Logo.
	add_image_size( 'canard-logo', 400, 90 );
	add_theme_support( 'site-logo', array( 'size' => 'canard-logo' ) );

	// Content Options – controls visibility of post-detail elements.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'canard-style',
			'date'       => '.posted-on, body:not(.group-blog) .entry-summary + .entry-meta > .comments-link:before',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline, .group-blog .entry-summary + .entry-meta > .posted-on:before',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive' => true,
			'post'    => true,
			'page'    => true,
		),
	) );
}
add_action( 'after_setup_theme', 'canard_jetpack_setup' );

// ---------------------------------------------------------------------------
// Featured Posts helpers
// ---------------------------------------------------------------------------

/**
 * Return true when the site has more than one featured post.
 *
 * @return bool
 */
function canard_has_multiple_featured_posts(): bool {
	$featured_posts = apply_filters( 'canard_get_featured_posts', array() );

	return is_array( $featured_posts ) && 1 < count( $featured_posts );
}

/**
 * Retrieve the array of featured posts via the theme filter.
 *
 * Returns false when no posts have been set (the filter's default fallback).
 *
 * @return array|false
 */
function canard_get_featured_posts(): array|false {
	return apply_filters( 'canard_get_featured_posts', false );
}

// ---------------------------------------------------------------------------
// Jetpack / WordPress.com compatibility shims
// ---------------------------------------------------------------------------

/**
 * Strip Jetpack's SharedAddy sharing buttons from post excerpts inside
 * archive loops so the theme can render its own sharing UI.
 */
function canard_remove_sharedaddy(): void {
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'canard_remove_sharedaddy' );

/**
 * Output the Jetpack Site Logo, or return silently when the function is
 * unavailable (Jetpack not active).
 */
function canard_the_site_logo(): void {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	}

	jetpack_the_site_logo();
}

/**
 * Determine whether the featured image should be shown on the current
 * singular view, honouring the per-post-type toggle exposed by Jetpack's
 * Content Options module.
 *
 * @return bool True when the featured image should render.
 */
function canard_jetpack_featured_image_display(): bool {
	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
		return true;
	}

	$options         = get_theme_support( 'jetpack-content-options' );
	$featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;

	$settings = array(
		'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
		'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
	);

	$settings = array_merge( $settings, array(
		'post-option' => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
		'page-option' => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
	) );

	if ( ( ! $settings['post-option'] && is_single() )
		|| ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
		return false;
	}

	return true;
}

// ---------------------------------------------------------------------------
// Portfolio post-format class cleanup
// ---------------------------------------------------------------------------

/**
 * Strip the `format-*` class from Jetpack Portfolio items so the theme's
 * own portfolio layout styles are not overridden by post-format defaults.
 *
 * @param array $classes Array of CSS classes applied to the post element.
 * @return array         Filtered class list.
 */
function canard_jetpack_portfolio_classes( array $classes ): array {
	$post_format = get_post_format();

	$class = ( $post_format && ! is_wp_error( $post_format ) )
		? 'format-' . sanitize_html_class( $post_format )
		: 'format-standard';

	$class_key = array_search( $class, $classes );

	if ( false !== $class_key && 'jetpack-portfolio' === get_post_type() ) {
		unset( $classes[ $class_key ] );
	}

	return $classes;
}
add_filter( 'post_class', 'canard_jetpack_portfolio_classes' );
