/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function() {

	// Site title.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			const titleLink = document.querySelector( '.site-title a' );
			if ( titleLink ) {
				titleLink.textContent = to;
			}
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			const description = document.querySelector( '.site-description' );
			if ( description ) {
				description.textContent = to;
			}
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			const headerElements = document.querySelectorAll( '.site-title, .site-description' );

			headerElements.forEach( function( element ) {
				if ( 'blank' === to ) {
					element.style.clip     = 'rect(1px, 1px, 1px, 1px)';
					element.style.position = 'absolute';
				} else {
					element.style.clip     = 'auto';
					element.style.color    = to;
					element.style.position = 'relative';
				}
			} );
		} );
	} );

} )();
