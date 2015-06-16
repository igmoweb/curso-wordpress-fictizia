( function( $ ) {
    wp.customize( 'ignacio_header_color', function( value ) {
        value.bind( function( to ) {
            $( '#header' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ignacio_footer_color', function( value ) {
        value.bind( function( to ) {
            $( '#footer' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ignacio_footer_text', function( value ) {
        value.bind( function( to ) {
            $( '#footer' ).html( to );
        } );
    } );
} )( jQuery );