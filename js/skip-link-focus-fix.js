( function() {

	window.addEventListener( 'hashchange', function() {
		const id = location.hash.substring( 1 );

		if ( ! /^[A-Za-z0-9_-]+$/.test( id ) ) {
			return;
		}

		const element = document.getElementById( id );
		if ( ! element ) {
			return;
		}

		// Only set tabIndex on elements that are not natively focusable.
		if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
			element.tabIndex = -1;
		}

		element.focus();
	} );

} )();
