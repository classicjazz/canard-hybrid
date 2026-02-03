( function() {

	window.addEventListener( 'load', function() {

		/* Use Featured Image as a Background Image */
		const featuredContent = document.querySelector( '#featured-content' );
		if ( ! featuredContent ) {
			return;
		}

		const articles = featuredContent.querySelectorAll( 'article' );

		articles.forEach( function( article ) {
			if ( article.classList.contains( 'background-done' ) || ! article.classList.contains( 'has-post-thumbnail' ) ) {
				return;
			}

			const entryImage = article.querySelector( '.post-thumbnail' );
			const thumbnail  = article.querySelector( 'img' );

			if ( entryImage && thumbnail ) {
				entryImage.style.backgroundImage = 'url(' + thumbnail.getAttribute( 'src' ) + ')';
				article.classList.add( 'background-done' );
			}
		} );

	} );

} )();
