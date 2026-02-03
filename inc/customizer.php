<?php
declare( strict_types = 1 );

/**
 * Canard Theme Customizer
 *
 * @package Canard
 */

/**
 * Add postMessage support for site title and description, and register
 * the theme's custom Customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer instance.
 */
function canard_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Theme Options section */
	$wp_customize->add_section( 'canard_theme_options', array(
		'title'    => __( 'Theme Options', 'canard' ),
		'priority' => 130,
	) );

	/* Author Bio toggle */
	$wp_customize->add_setting( 'canard_author_bio', array(
		'sanitize_callback' => 'canard_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'canard_author_bio', array(
		'label'    => __( 'Show author bio on single posts.', 'canard' ),
		'section'  => 'canard_theme_options',
		'priority' => 10,
		'type'     => 'checkbox',
	) );
}
add_action( 'customize_register', 'canard_customize_register' );

/**
 * Sanitize a checkbox value.
 *
 * WordPress Customizer passes the raw POST value, which is a mixed type.
 * We cast it strictly to bool so that only a truthy value survives.
 *
 * @param mixed $input Raw value from the Customizer.
 * @return bool         Sanitized boolean.
 */
function canard_sanitize_checkbox( mixed $input ): bool {
	return (bool) $input;
}

/**
 * Enqueue the Customizer preview script that binds postMessage handlers.
 */
function canard_customize_preview_js(): void {
	wp_enqueue_script(
		'canard-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_preview_init', 'canard_customize_preview_js' );
