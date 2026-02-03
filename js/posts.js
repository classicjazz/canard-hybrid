( function() {

	/* --------------- Post thumbnail styles --------- */
	function postsStyles() {
		// Pull spacing from theme.json CSS custom properties.
		// WordPress registers settings.spacing.scale entries as
		// --wp--preset--spacing--{key} on :root.  "lg" = 60px, "md" = 30px.
		const rootStyle   = getComputedStyle( document.documentElement );
		const spacingLg   = parseFloat( rootStyle.getPropertyValue( '--wp--preset--spacing--lg' ) );
		const spacingMd   = parseFloat( rootStyle.getPropertyValue( '--wp--preset--spacing--md' ) );
		const marginLarge = isNaN( spacingLg ) ? 60 : spacingLg;
		const marginSmall = isNaN( spacingMd ) ? 30 : spacingMd;

		const marginSize  = window.innerWidth > 599 ? marginLarge : marginSmall;

		const entries = document.querySelectorAll( '.site-main .hentry' );

		entries.forEach( function( entry ) {
			const hasThumbnail = entry.classList.contains( 'has-post-thumbnail' );
			const isImageOrGallery = entry.classList.contains( 'format-image' ) || entry.classList.contains( 'format-gallery' );
			const isNotFeatured  = ! entry.parentElement || ! entry.parentElement.classList.contains( 'featured-content' );

			if ( ! ( hasThumbnail && isImageOrGallery && isNotFeatured ) ) {
				return;
			}

			const postThumbnail = entry.querySelector( '.post-thumbnail' );
			const thumbnail     = entry.querySelector( 'img' );

			if ( postThumbnail && thumbnail ) {
				postThumbnail.style.backgroundImage = 'url(' + thumbnail.getAttribute( 'src' ) + ')';
				postThumbnail.style.height          = ( entry.offsetHeight - marginSize ) + 'px';
			}
		} );
	}

	window.addEventListener( 'load',   postsStyles );
	window.addEventListener( 'resize', window.canardUtils.debounce( postsStyles, 500 ) );

	// Jetpack infinite-scroll fires a custom 'post-load' event on document.
	document.addEventListener( 'post-load', postsStyles );

} )();
