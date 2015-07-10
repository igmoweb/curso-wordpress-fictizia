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

	wp_schedule_event( current_time(), 'ignacio_minutely', 'ignacio_minutely' );
}

add_action( 'cron_schedules', 'ignacio_add_minutely_recurrence' );
function ignacio_add_minutely_recurrence( $schedules ) {
	$schedules['ignacio_minutely'] = array(
		'interval' => 60,
		'display' => 'Ignacio'
	);

	return $schedules;
}



add_action( 'ignacio_minutely', 'ignacio_send_email' );
function ignacio_send_email() {
	//error_log( "CRON EJECUTADO" );
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
	wp_clear_scheduled_hook( 'ignacio_minutely' );
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
include_once ignacio_get_path() . 'includes/woocommerce.php';
include_once ignacio_get_path() . 'includes/dashboard-widget.php';

//add_action( 'init', 'test_queries' );
function test_queries() {
	global $wpdb;

	$results = $wpdb->get_row( "SELECT * FROM $wpdb->options WHERE option_name = 'siteurl'");
	var_dump($results);
}

// AJAX
add_action( 'wp_enqueue_scripts', 'ignacio_enqueue_scripts' );
function ignacio_enqueue_scripts() {
	wp_enqueue_script( 'ignacio-load-posts', ignacio_get_url() . 'js/load-posts.js', array( 'jquery' ) );

	$ignacio = array(
		'ajaxurl' => admin_url() . '/admin-ajax.php',
		'gracias_string' => __( 'Gracias', 'ignacio' ),
		'nonce' => wp_create_nonce( 'load-posts' )
	);
	wp_localize_script( 'ignacio-load-posts', 'ignacio', $ignacio );
}

add_action( 'wp_ajax_fictizia_load_posts', 'ignacio_load_posts' );
add_action( 'wp_ajax_nopriv_fictizia_load_posts', 'ignacio_load_posts' );
function ignacio_load_posts() {
	check_ajax_referer( 'load-posts', 'security' );

	$posts = get_posts( array(
		'posts_per_page' => absint( $_POST['num_posts'] ),
		'orderby' => 'rand'
	));

	foreach ( $posts as $post ) {
		?>
		<li><?php echo get_the_title( $post->ID ); ?></li>
		<?php
	}

	die();
}


//add_action( 'init', 'ignacio_http_api' );
function ignacio_http_api() {
	$url = 'http://www.fdfdsfdsfsdg.com/';
	$response = wp_remote_get( $url );
	var_dump( $response );

	$url = 'http://www.google.es';
	$response = wp_remote_get( $url );
	var_dump( $response );
}

