( function() {

	const siteBranding = document.querySelector( '.site-branding' );
	if ( ! siteBranding ) {
		return;
	}

	if ( siteBranding.clientHeight > 0 ) {
		return;
	}

	document.body.classList.add( 'no-site-branding' );

} )();
