/**
 * Canard Utilities
 *
 * Shared helpers for the Canard theme.  Attached to window.canardUtils so that
 * every other theme script (navigation, posts, single) can reference the same
 * copy without bundling its own.
 *
 * Enqueue order: this file MUST load before any script that calls
 * window.canardUtils.  functions.php registers it with no dependencies and
 * lists 'canard-utils' as a dependency of the consuming scripts.
 */
( function() {

	/**
	 * Trailing-edge debounce.
	 *
	 * Returns a wrapper that delays invoking `func` until `wait` ms have
	 * elapsed since the *last* time the wrapper was called.  If the wrapper
	 * is called again before the timer fires, the timer resets to the full
	 * `wait` duration from that point.
	 *
	 * @param {Function} func - The function to debounce.
	 * @param {number}   wait - Delay in milliseconds.
	 * @return {Function} Debounced version of `func`.
	 */
	const debounce = function( func, wait ) {
		let timeout = null;
		let timestamp;

		return function( ...args ) {
			timestamp = Date.now();

			const later = () => {
				const elapsed = Date.now() - timestamp;
				if ( elapsed < wait ) {
					timeout = setTimeout( later, wait - elapsed );
				} else {
					timeout = null;
					func.apply( this, args );
				}
			};

			if ( ! timeout ) {
				timeout = setTimeout( later, wait );
			}
		};
	};

	// ---------------------------------------------------------------------------
	// Export
	// ---------------------------------------------------------------------------
	window.canardUtils = {
		debounce: debounce
	};

} )();
