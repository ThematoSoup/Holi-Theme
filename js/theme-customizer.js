/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title and description changes.
 */

( function( $ ) {
	// Color scheme change
	wp.customize( 'twentythirteen_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'holi-color-scheme-orange holi-color-scheme-green holi-color-scheme-purple holi-color-scheme-pink holi-color-scheme-red holi-color-scheme-blue holi-color-scheme-yellow holi-color-scheme-turquoise holi-color-scheme-sepia holi-color-scheme-gray' );
			$( 'body' ).addClass( 'holi-color-scheme-' + to );
		} );
	} );
} )( jQuery );