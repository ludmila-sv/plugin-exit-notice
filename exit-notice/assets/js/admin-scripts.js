( function($) {	
	"use strict";

	const $tab = $( '.exit-notice__nav > div' );
	const $sections = $( '.exit-notice__sections' );

	$sections.find( 'h2' ).hide();
	$sections.find( '.form-table' ).hide();
	$sections.find( 'h2' ).eq( 0 ).show();
	$sections.find( '.form-table' ).eq( 0 ).show();
	$tab.eq(0).addClass( 'active' );

	$( document ).on( 'ready', function() {

		$tab.on( 'click', function(){
			$tab.removeClass( 'active' );
			$( this ).addClass( 'active' );
			const index = $tab.index( $( this ) );
			$sections.find( 'h2' ).hide();
			$sections.find( '.form-table' ).hide();
			$sections.find( 'h2' ).eq( index ).show();
			$sections.find( '.form-table' ).eq( index ).show();
		} );

	} );
}(jQuery) );	
