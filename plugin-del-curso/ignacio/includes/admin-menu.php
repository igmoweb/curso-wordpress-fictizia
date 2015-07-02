<?php

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page() {

	add_menu_page( 
		__( 'Ignacio', 'ignacio' ), 
		__( 'Ignacio', 'ignacio' ),
		'manage_options', 
		'ignacio-plugin', 
		'ignacio_render_menu', 
		'dashicons-admin-media' 
	);

}

add_action( 'admin_init', 'ignacio_process_clients_form' );
function ignacio_process_clients_form() {
	if ( isset( $_POST['add-new-client'] ) ) {
		jaime();
		$url = add_query_arg( 'updated', 'true' );
		wp_redirect( $url );
		exit;
	}
}

function ignacio_render_menu() {

	$clientes = ignacio_get_clientes();
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<?php if ( isset( $_GET['updated'] ) ): ?>
			<div class="updated"><p><?php _e( 'Gracias' ); ?></p></div>
		<?php endif; ?>
		<form action="" method="POST">
			<ul>
			<?php foreach ( $clientes as $cliente ): ?>
				<li><?php echo $cliente->nombre_cliente; ?></li>
			<?php endforeach; ?>
			</ul>

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e( 'New customer', 'fictizia' ); ?></th>
					<td>
						<input type="text" name="cliente" value=""/>
					</td>
				</tr>
			</table>
		 
			<?php wp_nonce_field( 'add-new-client' ); ?>
			<?php submit_button( null, 'primary', 'add-new-client' ); ?>
		</form>
	</div>
	<?php
}

function jaime() {
	global $wpdb;

	$table = ignacio_get_table_name();
	$cliente = sanitize_text_field( $_POST['cliente'] );

	if ( empty( $cliente ) )
		return;

	$wpdb->insert(
		$table,
		array( 'nombre_cliente' => $cliente ),
		array( '%s' )
	);
}

function ignacio_get_clientes() {
	global $wpdb;

	$table = ignacio_get_table_name();
	$sql = "SELECT * FROM $table";

	$results = $wpdb->get_results( $sql );
	return $results;
}

function ignacio_get_table_name() {
	global $wpdb;
	return $wpdb->prefix . 'fictizia_clientes';
}