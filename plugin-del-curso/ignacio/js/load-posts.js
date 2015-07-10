jQuery( document ).ready( function( $ ) {
	
	$('#load-posts').click( function( e ) {
		e.preventDefault();

		$.ajax({
			url: ignacio.ajaxurl,
			type: 'POST',
			data: {
				action: 'fictizia_load_posts',
				security: ignacio.nonce,
				num_posts: 3
			},
		})
		.done( function( response ) {
			$('#load-posts-results').html( response );
			alert( ignacio.gracias_string );
		});
	});

});

