<?php
/*
* Plugin Name: Ignacio Plugin
*/

function ignacio_get_url() {
	return plugin_dir_url( __FILE__ );
}

function ignacio_get_path() {
	return plugin_dir_path( __FILE__ );
}

function ignacio_get_plugin_version() {
	return '1.0';
}

register_activation_hook( __FILE__, 'ignacio_activate' );
function ignacio_activate() {
	update_option( 'ignacio_version', ignacio_get_plugin_version() );
	ignacio_create_table();

	$capabilities = array(
		'edit_posts' => true,
		'publish_posts' => true,
		'delete_posts' => true,
		'see_my_page' => true
	);
	add_role( 'ignacio-role-2', __( 'Ignacio Role 2', 'ignacio' ), $capabilities );
	
	ignacio_create_portfolio_cpt();
	ignacio_register_taxonomy();
	flush_rewrite_rules();
}

add_action( 'template_redirect', 'ignacio_see_my_page' );
function ignacio_see_my_page() {
	if ( ! current_user_can( 'see_my_page' ) && is_page( 7 ) ) {
		wp_die();
	}
}

register_deactivation_hook( __FILE__, 'ignacio_deactivate' );
function ignacio_deactivate() {
	delete_option( 'ignacio_version' );
}

function ignacio_create_table() {
	global $wpdb;

	$tablename = $wpdb->prefix . 'fictizia_clientes';

	$charset_collate = '';
	if ( ! empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if ( ! empty($wpdb->collate) )
		$charset_collate .= " COLLATE $wpdb->collate";

	$sql = "CREATE TABLE IF NOT EXISTS $tablename (
		`ID` bigint(20) NOT NULL auto_increment,
		`nombre_cliente` varchar(200) DEFAULT '',
		PRIMARY KEY  (ID),
		KEY nombre_cliente (nombre_cliente)
	) $charset_collate";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}


include_once ignacio_get_path() . 'includes/shortcodes.php';
include_once ignacio_get_path() . 'includes/widget.php';
include_once ignacio_get_path() . 'includes/portfolio.php';
include_once ignacio_get_path() . 'includes/admin-menu.php';

//add_action( 'init', 'test_queries' );
function test_queries() {
	global $wpdb;

	$results = $wpdb->get_row( "SELECT * FROM $wpdb->options WHERE option_name = 'siteurl'");
	var_dump($results);
}



