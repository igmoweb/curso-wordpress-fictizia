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

	add_submenu_page( 
		'ignacio-plugin', 
		__( 'Submenu', 'ignacio' ),
		__( 'Submenu', 'ignacio' ), 
		'manage_options', 
		'ignacio-sub-plugin',
		'ignacio_display_settings_menu' 
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


function ignacio_render_submenu() {
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		Hola
	</div>
	<?php
}







function ignacio_settings_init() { 
	register_setting( 'ignacio_options', 'ignacio_options', 'ignacio_sanitize_settings' );

	add_settings_section( 'ignacio_general_options', __( 'General Options', 'ignacio' ), 'ignacio_render_general_options_section', 'ignacio-sub-plugin' );
	add_settings_field( 'ignacio_admin_background_color', __( 'Background color', 'fictizia' ), 'ignacio_display_color_field', 'ignacio-sub-plugin', 'ignacio_general_options' );
}
add_action( 'admin_init', 'ignacio_settings_init' );


function ignacio_render_general_options_section() { 
	echo __( 'This section description', 'fictizia' );
}

function ignacio_display_color_field() { 
	$options = get_option( 'ignacio_options' );
	$color = $options['admin_color'];
	?>
		<input type='text' name='ignacio_options[admin_color]' value="<?php echo $color; ?>">
	<?php
}


function ignacio_display_settings_menu() {
	?>
		<div class="wrap">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
 
			<form action="options.php" method="post">
				<?php settings_fields( 'ignacio_options' ); ?>
				<?php do_settings_sections( 'ignacio-sub-plugin' ); ?>
 
				<?php submit_button( null, 'primary', 'ignacio_options[submit_settings]' ); ?>
			</form>
		</div>
	<?php
}

function ignacio_sanitize_settings( $input ) {
	$options = get_option( 'ignacio_options' );

	if ( ! current_user_can( 'manage_options' ) )
		return $options;

	if ( ! is_array( $options ) )
		$options = array();

	$options['admin_color'] = sanitize_text_field( $input['admin_color'] );

	return $options;
}

add_action( 'admin_head', 'ignacio_change_background');
function ignacio_change_background() {
	$options = get_option( 'ignacio_options' );
	?>
	<style>
		body {
			background-color:<?php echo $options['admin_color']; ?>;
		}
	</style>
	<?php
}
