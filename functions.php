<?php
declare( strict_types = 1 );

/**
 * Canard functions and definitions
 *
 * @package Canard
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 710; /* pixels */
}

if ( ! function_exists( 'canard_content_width' ) ) {
	/**
	 * Adjust content width on static pages.
	 */
	function canard_content_width(): void {
		global $content_width;

		if ( is_page() ) {
			$content_width = 869;
		}
	}
}
add_action( 'template_redirect', 'canard_content_width' );

if ( ! function_exists( 'canard_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Hooked into after_setup_theme, which runs before the init hook. The init
	 * hook is too late for some features, such as indicating support for post
	 * thumbnails.
	 */
	function canard_setup(): void {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Canard, use a find and replace
		 * to change 'canard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'canard', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/features/post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'canard-post-thumbnail', 870, 773, true );
		add_image_size( 'canard-featured-content-thumbnail', 915, 500, true );
		add_image_size( 'canard-single-thumbnail', 1920, 768, true );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for Custom Logo.
		add_theme_support( 'custom-logo' );

		/*
		 * WordPress 6.7 block-era theme supports.
		 * - appearance-tools: enables border, shadow, and spacing controls via theme.json.
		 * - align-wide:       enables wide and full-width block alignments.
		 * - block-template-parts: registers template-part areas declared in theme.json.
		 *
		 * NOTE: editor-color-palette has been intentionally removed.
		 * Brand colours are now exclusively defined in theme.json and injected
		 * by the block editor automatically; no PHP-side palette registration
		 * is needed.
		 */
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'block-template-parts' );

		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus(
			array(
				'primary'   => __( 'Primary Location', 'canard' ),
				'secondary' => __( 'Secondary Location', 'canard' ),
				'footer'    => __( 'Footer Location', 'canard' ),
				'social'    => __( 'Social Location', 'canard' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * @link https://developer.wordpress.org/themes/features/post-formats/
		 */
		add_theme_support(
			'post-formats',
			array(
				'image',
				'link',
				'gallery',
			)
		);
	}
endif; // canard_setup
add_action( 'after_setup_theme', 'canard_setup' );

/**
 * Register widget areas.
 *
 * Sidebar markup uses the `.widget-area` class on the containing template
 * element; the before_widget / after_widget strings here target individual
 * widget instances and must remain unchanged.
 *
 * @link https://developer.wordpress.org/themes/features/widgets/
 */
function canard_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'canard' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'canard' ),
			'id'            => 'sidebar-2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'canard_widgets_init' );

/**
 * Build the Google Fonts URL for Lato and Inconsolata.
 *
 * @return string Google Fonts URL, or empty string if both fonts are off.
 */
function canard_lato_inconsolata_fonts_url(): string {
	$fonts_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	$lato = _x( 'on', 'Lato font: on or off', 'canard' );

	/* translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	$inconsolata = _x( 'on', 'Inconsolata font: on or off', 'canard' );

	if ( 'off' !== $lato || 'off' !== $inconsolata ) {
		$font_families = array();

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,700,400italic,700italic';
		}

		if ( 'off' !== $inconsolata ) {
			$font_families[] = 'Inconsolata:400,700';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url  = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Build the Google Fonts URL for PT Serif and Playfair Display.
 *
 * @return string Google Fonts URL, or empty string if both fonts are off.
 */
function canard_pt_serif_playfair_display_font_url(): string {
	$fonts_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by PT Serif, translate this to 'off'. Do not translate into your own language.
	 */
	$pt_serif = _x( 'on', 'PT Serif font: on or off', 'canard' );

	/* translators: If there are characters in your language that are not supported
	 * by Playfair Display, translate this to 'off'. Do not translate into your own language.
	 */
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'canard' );

	if ( 'off' !== $pt_serif || 'off' !== $playfair_display ) {
		$font_families = array();

		if ( 'off' !== $pt_serif ) {
			$font_families[] = 'PT Serif:400,700,400italic,700italic';
		}

		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:400,700,400italic,700italic';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'cyrillic,latin,latin-ext' ),
		);
		$fonts_url  = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue front-end scripts and styles.
 *
 * NOTE: genericons.css is no longer enqueued here; the icon font is bundled
 * inside the main style.css produced during the recent CSS refactor.
 */
function canard_scripts(): void {

	// ---------------------------------------------------------------------------
	// Gutenberg block styles
	// ---------------------------------------------------------------------------
	wp_enqueue_style( 'canard-blocks', get_template_directory_uri() . '/blocks.css' );

	// ---------------------------------------------------------------------------
	// Google Fonts
	// ---------------------------------------------------------------------------
	wp_enqueue_style( 'canard-pt-serif-playfair-display', canard_pt_serif_playfair_display_font_url() );
	wp_enqueue_style( 'canard-lato-inconsolata', canard_lato_inconsolata_fonts_url() );

	// ---------------------------------------------------------------------------
	// Theme stylesheet
	// ---------------------------------------------------------------------------
	wp_enqueue_style( 'canard-style', get_stylesheet_uri() );

	// ---------------------------------------------------------------------------
	// Shared utilities — must be enqueued before any script that depends on it.
	// ---------------------------------------------------------------------------
	$utils_path = get_template_directory() . '/js/utils.js';
	wp_enqueue_script(
		'canard-utils',
		get_template_directory_uri() . '/js/utils.js',
		array(),
		(string) filemtime( $utils_path ),
		true
	);

	// ---------------------------------------------------------------------------
	// Core theme scripts
	// ---------------------------------------------------------------------------
	wp_enqueue_script(
		'canard-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array( 'canard-utils' ),
		(string) filemtime( get_template_directory() . '/js/navigation.js' ),
		true
	);

	wp_enqueue_script(
		'canard-featured-content',
		get_template_directory_uri() . '/js/featured-content.js',
		array(),
		(string) filemtime( get_template_directory() . '/js/featured-content.js' ),
		true
	);

	wp_enqueue_script(
		'canard-header',
		get_template_directory_uri() . '/js/header.js',
		array(),
		(string) filemtime( get_template_directory() . '/js/header.js' ),
		true
	);

	wp_enqueue_script(
		'canard-search',
		get_template_directory_uri() . '/js/search.js',
		array(),
		(string) filemtime( get_template_directory() . '/js/search.js' ),
		true
	);

	wp_enqueue_script(
		'canard-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		(string) filemtime( get_template_directory() . '/js/skip-link-focus-fix.js' ),
		true
	);

	// ---------------------------------------------------------------------------
	// Conditional / context scripts
	// ---------------------------------------------------------------------------
	if ( is_singular() ) {
		wp_enqueue_script(
			'canard-single',
			get_template_directory_uri() . '/js/single.js',
			array( 'canard-utils' ),
			(string) filemtime( get_template_directory() . '/js/single.js' ),
			true
		);
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script(
			'canard-sidebar',
			get_template_directory_uri() . '/js/sidebar.js',
			array(),
			(string) filemtime( get_template_directory() . '/js/sidebar.js' ),
			true
		);
	}

	if ( is_home() || is_archive() || is_search() ) {
		wp_enqueue_script(
			'canard-posts',
			get_template_directory_uri() . '/js/posts.js',
			array( 'canard-utils' ),
			(string) filemtime( get_template_directory() . '/js/posts.js' ),
			true
		);
	}

	// ---------------------------------------------------------------------------
	// Comment-reply (WordPress core) — singular + open comments only
	// ---------------------------------------------------------------------------
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// ---------------------------------------------------------------------------
	// jQuery removal for anonymous visitors.
	//
	// Every theme script above has been converted to vanilla ES6 and no longer
	// lists 'jquery' as a dependency.  The only remaining consumer is
	// 'comment-reply', which is only enqueued for logged-in users on singular
	// posts with open comments.  For all other (anonymous) page-views we can
	// safely drop the ~90 KB payload.
	// ---------------------------------------------------------------------------
	if ( ! is_user_logged_in() ) {
		wp_deregister_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'canard_scripts' );

/**
 * Enqueue block-editor styles.
 *
 * NOTE: genericons.css is no longer enqueued here; icons are bundled in
 * style.css.
 */
function canard_editor_styles(): void {
	wp_enqueue_style( 'canard-block-style', get_template_directory_uri() . '/blocks.css' );
	wp_enqueue_style( 'canard-editor-block-style', get_template_directory_uri() . '/editor-blocks.css' );
	wp_enqueue_style( 'canard-pt-serif-playfair-display', canard_pt_serif_playfair_display_font_url() );
	wp_enqueue_style( 'canard-lato-inconsolata', canard_lato_inconsolata_fonts_url() );
}
add_action( 'enqueue_block_editor_assets', 'canard_editor_styles' );

// ---------------------------------------------------------------------------
// Include files
// ---------------------------------------------------------------------------

/** Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/** Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/** Custom functions that act independently of the theme templates. */
require get_template_directory() . '/inc/extras.php';

/** Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/** Jetpack compatibility. */
require get_template_directory() . '/inc/jetpack.php';

/** WordPress.com theme updater (admin-only). */
if ( is_admin() ) {
	require get_template_directory() . '/inc/updater.php';
}