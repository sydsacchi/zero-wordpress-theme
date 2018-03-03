/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#site-title a').css('color', newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update site link color in real time...
	wp.customize( 'link_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	
	//Update site footer background color...
	wp.customize( 'footer_background', function( value ) {
		value.bind( function( newval ) {
			$('#footer').css('footer_background', newval );
		} );
	} );
	
	//Update site footer text color...
	wp.customize( 'footer_text', function( value ) {
		value.bind( function( newval ) {
			$('#footer').css('footer_text', newval );
		} );
	} );
	
	//Update site footer links color...
	wp.customize( 'footer_links', function( value ) {
		value.bind( function( newval ) {
			$('#footer a').css('footer_links', newval );
		} );
	} );
	
	//Update site footer widgets title color...
	wp.customize( 'footer_widgets', function( value ) {
		value.bind( function( newval ) {
			$('#footer h3.widget-title').css('footer_widgets', newval );
		} );
	} );
	
	
	//Update site footer widgets title color...
	wp.customize( 'typo_family', function( value ) {
		value.bind( function( newval ) {
			$('body').css('typo', newval );
		} );
	} );
	
} )( jQuery );