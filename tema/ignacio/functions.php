<?php


function ignacio_scripts() {
	wp_enqueue_style( 'ignacio-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'ignacio_scripts' );



function ignacio_setup() {
	register_nav_menu( 'primary', __( 'Main Menu', 'ignacio' ) );	
}
add_action( 'after_setup_theme', 'ignacio_setup' );


function ignacio_widgets_init() {
	$args = array(
		'name'          => __( 'Right Sidebar', 'ignacio' ),
		'id'            => 'right-sidebar',
		'description'   => __( 'The sidebar on the right', 'ignacio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);

	register_sidebar( $args );	
}


add_action( 'widgets_init' , 'ignacio_widgets_init' );

function ignacio_excerpt_length( $length ) {
	return 5;
}
add_filter( 'excerpt_length', 'ignacio_excerpt_length' );

function ignacio_excerpt_more( $more ) {
	$link = get_permalink();
	return sprintf( __( '<a href="%s">Read more...</a>', 'ignacio' ), $link );

}
add_filter( 'excerpt_more', 'ignacio_excerpt_more' );