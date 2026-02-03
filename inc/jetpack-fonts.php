<?php declare( strict_types = 1 ); ?>
<?php
/**
 * Jetpack / Typekit font category rules for the Canard theme.
 *
 * @package Canard
 */

add_filter( 'typekit_add_font_category_rules', function( $category_rules ) {

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'b,
		strong',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'dfn',
		[
			[ 'property' => 'font-style', 'value' => 'italic' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'optgroup',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'body,
		button,
		input,
		select,
		textarea',
		[
			[ 'property' => 'font-family', 'value' => '"PT Serif", serif' ],
			[ 'property' => 'font-size',   'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h1,
		h2:not(site-description):not(.author-title),
		h3,
		h4,
		h5,
		h6',
		[
			[ 'property' => 'font-family', 'value' => '"Playfair Display", serif' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h1',
		[
			[ 'property' => 'font-size', 'value' => '49px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h2:not(site-description):not(.author-title)',
		[
			[ 'property' => 'font-size', 'value' => '39px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h3',
		[
			[ 'property' => 'font-size', 'value' => '31px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h4',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h5',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h6',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'cite,
		dfn,
		em,
		i',
		[
			[ 'property' => 'font-style', 'value' => 'italic' ],
		]
	);

	// Fixed: 'font-wieght' → 'font-weight'
	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'cite',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'blockquote',
		[
			[ 'property' => 'font-style', 'value' => 'italic' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'blockquote cite',
		[
			[ 'property' => 'font-style', 'value' => 'normal' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'dt',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'a',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'a:visited',
		[
			[ 'property' => 'font-weight', 'value' => 'normal' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.secondary-navigation,
		.footer-navigation,
		.bottom-navigation',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-navigation a,
		.posts-navigation a',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.post-navigation .post-title',
		[
			[ 'property' => 'font-family', 'value' => '"Playfair Display", serif' ],
			[ 'property' => 'font-size',   'value' => '25px' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.widget-title,
		.widgettitle',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_recent_entries .post-date',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_rss .rss-date,
		.widget_rss cite',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-title',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-description',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.site-info',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.site-info .sep',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.featured-content .entry-title',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.entry-summary',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.page-title',
		[
			[ 'property' => 'font-size', 'value' => '39px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.archive .hentry .entry-title,
		.blog .hentry .entry-title,
		.search .hentry .entry-title',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.page .entry-title,
		.single .entry-title',
		[
			[ 'property' => 'font-size', 'value' => '39px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.entry-meta',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.entry-footer',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.page-links',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.author-info .author-title',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.author-info .author-name',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.author-info .author-bio',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comments-area',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.comment-reply-title,
		.comments-title,
		.no-comments',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.no-comments',
		[
			[ 'property' => 'font-family', 'value' => '"Playfair Display", sans-serif' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-form,
		.comment-form code',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-content blockquote:before',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.comment-author',
		[
			[ 'property' => 'font-size',   'value' => '16px' ],
			[ 'property' => 'font-family', 'value' => '"Playfair Display", sans-serif' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-author a,
		.comment-author b',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-metadata .edit-link:before',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-list .comment-reply-title small,
		.comment-metadata,
		.comment-reply-link',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.required',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.wp-caption',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.gallery-caption',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'#infinite-handle span button,
		#infinite-handle span button:active,
		#infinite-handle span button:focus,
		#infinite-handle span button:hover',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'#infinite-footer',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.hentry div.sd-rating h3.sd-title,
		.hentry div.sharedaddy h3.sd-title',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	// Fixed: '"P{layfair Display"' → '"Playfair Display"' and 'blod' → 'bold'
	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.hentry div#jp-relatedposts h3.jp-relatedposts-headline',
		[
			[ 'property' => 'font-family', 'value' => '"Playfair Display", sans-serif' ],
			[ 'property' => 'font-size',   'value' => '25px' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.hentry div#jp-relatedposts div.jp-relatedposts-items p',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.hentry div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post-context',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.hentry div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post-title',
		[
			[ 'property' => 'font-family', 'value' => '"PT Serif", serif' ],
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.hentry div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post-title',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_jetpack_display_posts_widget .jetpack-display-remote-posts h4',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_jetpack_display_posts_widget .jetpack-display-remote-posts p',
		[
			[ 'property' => 'font-size', 'value' => '16px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_goodreads h2[class^="gr_custom_header"]',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_goodreads div[class^="gr_custom_title"]',
		[
			[ 'property' => 'font-weight', 'value' => 'bold' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_goodreads div[class^="gr_custom_author"]',
		[
			[ 'property' => 'font-size', 'value' => '13px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.widget-grofile h4',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'body',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		],
		[
			'screen and (min-width: 768px)',
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-title',
		[
			[ 'property' => 'font-size', 'value' => '49px' ],
		],
		[
			'screen and (min-width: 768px)',
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'body .hentry .wpcom-reblog-snapshot .reblogger-note-content blockquote',
		[
			[ 'property' => 'font-style', 'value' => 'italic' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.aboutme_widget #am_name',
		[
			[ 'property' => 'font-size', 'value' => '25px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.aboutme_widget #am_headline',
		[
			[ 'property' => 'font-size', 'value' => '20px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_akismet_widget .a-stats',
		[
			[ 'property' => 'font-size', 'value' => '14px' ],
		]
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_authors > ul > li > a',
		[
			[ 'property' => 'font-family', 'value' => '"PT Serif", serif' ],
		]
	);

	return $category_rules;
} );
