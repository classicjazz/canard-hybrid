<?php
declare( strict_types = 1 );

/**
 * Entry Hero Script — Canard Theme
 *
 * Conditionally enqueues the inline script that promotes a post or page's
 * `.entry-header` into a full-bleed hero layout when a featured image is
 * present and eligible for display.
 *
 * @package Canard
 * @since   1.3
 */

if (
	(
		is_single()
		&& has_post_thumbnail()
		&& canard_jetpack_featured_image_display()
		&& (
			! has_post_format()
			|| has_post_format( 'aside' )
			|| has_post_format( 'image' )
			|| has_post_format( 'gallery' )
		)
	)
	|| (
		is_page()
		&& has_post_thumbnail()
		&& canard_jetpack_featured_image_display()
	)
) {
	?>
	<script>
	( function() {
		document.addEventListener( 'DOMContentLoaded', function() {

			// 1. Locate the contextual .entry-header that contains the thumbnail.
			var entryHeaders = document.querySelectorAll(
				'.page  .hentry.has-post-thumbnail .entry-header,' +
				'.single .hentry.has-post-thumbnail .entry-header'
			);

			// Nothing to promote — exit early.
			if ( entryHeaders.length === 0 ) {
				return;
			}

			// 2. Collect every .entry-title and .entry-meta that lives inside
			//    one of those headers.  jQuery's .wrapAll() gathers *all*
			//    matched nodes into a single new parent, so we replicate that
			//    behaviour here rather than wrapping per-element.
			var targets = [];

			entryHeaders.forEach( function( header ) {
				var innerNodes = header.querySelectorAll(
					'.entry-title, .entry-meta'
				);
				innerNodes.forEach( function( node ) {
					targets.push( node );
				} );
			} );

			// Nothing to wrap — exit early.
			if ( targets.length === 0 ) {
				return;
			}

			// 3. Create .entry-header-inner and move all target nodes into it.
			//    Insert the new container at the position of the *first* target
			//    so the DOM order is preserved (mirrors jQuery .wrapAll()).
			var headerInner   = document.createElement( 'div' );
			headerInner.className = 'entry-header-inner';

			targets[ 0 ].parentNode.insertBefore( headerInner, targets[ 0 ] );

			targets.forEach( function( node ) {
				headerInner.appendChild( node );
			} );

			// 4. Wrap .entry-header-inner inside .entry-header-wrapper.
			var headerWrapper   = document.createElement( 'div' );
			headerWrapper.className = 'entry-header-wrapper';

			headerInner.parentNode.insertBefore( headerWrapper, headerInner );
			headerWrapper.appendChild( headerInner );

			// 5. Move each .entry-header before .site-content-inner and
			//    promote it to the hero role.
			var siteContentInner = document.querySelector( '.site-content-inner' );

			if ( siteContentInner ) {
				entryHeaders.forEach( function( header ) {
					siteContentInner.parentNode.insertBefore( header, siteContentInner );
					header.classList.add( 'entry-hero' );
				} );
			}

		} );
	} )();
	</script>
	<?php
}
