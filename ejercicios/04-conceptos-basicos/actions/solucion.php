<?php

add_action( 'init', 'fictizia_muere' );
add_action( 'get_footer', 'fictizia_muere' );
function fictizia_muere() {
	if ( isset( $_GET['muere'] ) && $_GET['muere'] == 'si' ) {
		wp_die( "MUERE" );
	}
}
