<?php


add_action( 'woocommerce_before_main_content', 'ignacio_woo_before_main_content', 50 );
function ignacio_woo_before_main_content() {
	?>
		<main class="content" id="content">
	<?php	
}

add_action( 'woocommerce_after_main_content', 'ignacio_woo_after_main_content',1 );
function ignacio_woo_after_main_content() {
	?>
		</main>
	<?php
}


add_action( 'woocommerce_loaded', 'ignacio_remove_woo_hooks' );
function ignacio_remove_woo_hooks() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );	
}


