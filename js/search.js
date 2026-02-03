( function() {

	/* --- Search-form hover / focus highlight --- */
	window.addEventListener( 'load', function() {
		const submitButtons = document.querySelectorAll( '.search-submit' );

		function addHoverClass( event ) {
			const form = event.currentTarget.closest( '.search-form' );
			if ( form ) {
				form.classList.add( 'hover' );
			}
		}

		function removeHoverClass( event ) {
			const form = event.currentTarget.closest( '.search-form' );
			if ( form ) {
				form.classList.remove( 'hover' );
			}
		}

		submitButtons.forEach( function( btn ) {
			btn.addEventListener( 'mouseenter', addHoverClass );
			btn.addEventListener( 'mouseleave', removeHoverClass );
			btn.addEventListener( 'focusin',     addHoverClass );
			btn.addEventListener( 'focusout',    removeHoverClass );
		} );
	} );

	/* --- Search-header toggle --- */
	( function() {
		const container = document.getElementById( 'search-header' );
		if ( ! container ) {
			return;
		}

		const button = container.querySelector( 'button' );
		if ( ! button ) {
			return;
		}

		const form = container.querySelector( 'form' );
		if ( ! form ) {
			button.style.display = 'none';
			return;
		}

		form.setAttribute( 'aria-expanded', 'false' );

		button.addEventListener( 'click', function() {
			const isOpen = container.classList.contains( 'toggled' );

			document.body.classList.toggle( 'search-toggled' );
			container.classList.toggle( 'toggled' );

			const state = isOpen ? 'false' : 'true';
			button.setAttribute( 'aria-expanded', state );
			form.setAttribute( 'aria-expanded', state );
		} );
	} )();

} )();
