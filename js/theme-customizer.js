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
		
			/*
			var currentBgImage = $( '.site-header' ).css( 'background-image' );
			if( currentBgImage.indexOf( 'holi/images/headers' ) >= 0) {
				var replacedBgImage = currentBgImage.replace( 'images/headers/green', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/orange', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/purple', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/pink', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/red', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/blue', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/yellow', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/turquoise', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/sepia', 'images/headers/' + to );
				replacedBgImage = replacedBgImage.replace( 'images/headers/gray', 'images/headers/' + to );
				// replacedBgImage = replacedBgImage.replace( 'url(', '' );
				// replacedBgImage = replacedBgImage.replace( ')', '' );
				
				$( '.site-header' ).css({ 'background-image': replacedBgImage });
			}
			*/
		} );
	} );
} )( jQuery );