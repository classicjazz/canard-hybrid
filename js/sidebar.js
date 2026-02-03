( function() {

	const sidebar = document.getElementById( 'secondary' );
	if ( ! sidebar ) {
		return;
	}

	const button = document.querySelector( '.sidebar-toggle' );
	if ( ! button ) {
		return;
	}

	sidebar.setAttribute( 'aria-expanded', 'false' );
	button.setAttribute( 'aria-expanded', 'false' );

	button.addEventListener( 'click', function() {
		const isOpen = sidebar.classList.contains( 'toggled' );

		sidebar.classList.toggle( 'toggled' );
		button.classList.toggle( 'toggled' );

		const state = isOpen ? 'false' : 'true';
		sidebar.setAttribute( 'aria-expanded', state );
		button.setAttribute( 'aria-expanded', state );
	} );

} )();
