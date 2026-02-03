( function() {

	/* --------------- Author-info relocation -------- */
	function relocateAuthorInfo() {
		const authorInfo = document.querySelector( '.author-info' );
		if ( ! authorInfo ) {
			return;
		}

		if ( window.innerWidth > 959 ) {
			const widgetArea = document.querySelector( '.widget-area' );
			if ( ! widgetArea ) {
				return;
			}
			widgetArea.insertAdjacentElement( 'afterbegin', authorInfo );
		} else {
			const entryContent = document.querySelector( '.entry-content' );
			if ( ! entryContent ) {
				return;
			}
			entryContent.insertAdjacentElement( 'afterend', authorInfo );
		}
	}

	window.addEventListener( 'load',   relocateAuthorInfo );
	window.addEventListener( 'resize', window.canardUtils.debounce( relocateAuthorInfo, 500 ) );

	/* --------------- Jetpack widgets & table fix --- */
	window.addEventListener( 'load', function() {

		// Move Sharedaddy widgets into the entry footer.
		const entryFooter = document.querySelector( '.entry-footer' );

		if ( entryFooter ) {
			const sharedaddySelectors = [
				'.sd-sharing-enabled:not(#jp-post-flair)',
				'.sd-like.jetpack-likes-widget-wrapper',
				'.sd-rating'
			];

			sharedaddySelectors.forEach( function( selector ) {
				const widgets = document.querySelectorAll( selector );
				widgets.forEach( function( widget ) {
					entryFooter.appendChild( widget );
				} );
			} );
		}

		// Move Related Posts (jp-post-flair) after the entry footer.
		const relatedPosts = document.getElementById( 'jp-relatedposts' );
		if ( relatedPosts ) {
			const postFlair = document.getElementById( 'jp-post-flair' );
			if ( postFlair && entryFooter ) {
				entryFooter.insertAdjacentElement( 'afterend', postFlair );
			}
		}

		// Prevent tables from overflowing entry content.
		const entryContent = document.querySelector( '.entry-content' );
		if ( entryContent ) {
			const tables = entryContent.querySelectorAll( 'table' );
			tables.forEach( function( table ) {
				if ( table.offsetWidth > table.parentElement.offsetWidth ) {
					table.style.tableLayout = 'fixed';
				}
			} );
		}
	} );

} )();
