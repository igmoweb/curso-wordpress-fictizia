<?php


function ignacio_scripts() {
	wp_enqueue_style( 'ignacio-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'ignacio_scripts' );



function ignacio_setup() {
	register_nav_menu( 'primary', __( 'Main Menu', 'ignacio' ) );	
}
add_action( 'after_setup_theme', 'ignacio_setup' );

