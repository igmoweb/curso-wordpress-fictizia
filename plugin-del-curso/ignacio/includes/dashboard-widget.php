<?php
function ignacio_add_dashboard_widgets() {
	wp_add_dashboard_widget(
             'ignacio_dashboard_widget',         // Widget slug.
             'Widget de Ignacio',         // Title.
             'ignacio_dashboard_widget_function' // Display function.
    );	
}
add_action( 'wp_dashboard_setup', 'ignacio_add_dashboard_widgets' );

function ignacio_dashboard_widget_function() {
	$number = wp_count_posts( 'portfolio' );
	
	echo sprintf( _n( "There are %d portfolio", "There are %d portfolios", $number->publish, 'ignacio' ), $number->publish );
}