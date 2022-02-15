( function($) {	
	"use strict";

	const $close = $( '.exit-notice__popup__close' );
	const $overlay = $( '.exit-notice__overlay' );
	const $popup = $( '.exit-notice__popup' );
	const $overlayPopup = $( '.exit-notice__overlay, .exit-notice__popup' );
	const $popupBody = $( '.exit-notice__popup__body' );
	const $cancel = $('#exit-back');
	const $proceed = $( '#exit-continue' );
	const whitelist = window.EXITNOTICE_WHITELIST || {};


	$( document ).on( 'ready', function() {
		var external_link = '#';

		$close.on( 'click', function(){
			$overlay.fadeOut( '500' );
			$popup.fadeOut( '500' );
			external_link = '#';
		} );
		$cancel.on( 'click', function(){
			$overlay.fadeOut( '500' );
			$popup.fadeOut( '500' );
			external_link = '#';
		} );
		$overlayPopup.on( 'click', function ( event ) {
			event.stopPropagation();
			if ( $( event.target ).closest( '.exit-notice__popup__body' ).length > 0 ) { return; }
			$overlayPopup.fadeOut( '500' );
			external_link = '#';
		} );

		$( 'a' ).on( 'click', function( e ){
		    const href = $( this ).attr( 'href' );
		    let base = window.location.origin;
            base = base.replace( 'https://','://' );
            base = base.replace( 'http://','://' );
			if( href && (href.indexOf( '://' ) !== -1 ) && href.indexOf( base ) == -1 ) {
				e.preventDefault();
				external_link = $( this ).attr( 'href' );

				let inWitelist = false;
				for ( const item of whitelist ) {
					if( href.indexOf( item ) !== -1 ) {
						inWitelist = true;
					}
				};

				if ( whitelist.join( ',' ).indexOf( href ) !== -1 || inWitelist ){
					document.location.href = external_link;
				} else {
					$overlayPopup.fadeIn( '500' );
				}
			}
		});

		$proceed.on( 'click', function() {
			document.location.href = external_link;
		} );
	} );
}(jQuery) );	
