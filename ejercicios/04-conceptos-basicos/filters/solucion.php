<?php

add_filter( 'show_admin_bar', 'fictizia_show_admin_bar' );
function fictizia_show_admin_bar() {
	return false;
}

// Otra manera
add_filter( 'show_admin_bar', '__return_false' );
