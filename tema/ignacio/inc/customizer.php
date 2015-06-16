<?php

add_action( 'customize_register', 'ignacio_customizer_setup' );
function ignacio_customizer_setup( $wp_customize ) {
	//Panel
	$wp_customize->add_panel( 'ignacio_panel', array(
		'title' => 'Ignacio',
		'description' => __( 'Ignacio Options' , 'ignacio' ),
		'priority' => 200
	));

	// Secciones
	$wp_customize->add_section( 'ignacio_colors', array(
	    'title' => __( 'Colors', 'ignacio' ),
	    'panel' => 'ignacio_panel', // Panel ID
	    'capability' => 'edit_theme_options'
	) );

	$wp_customize->add_section( 'ignacio_footer', array(
	    'title' => __( 'Footer', 'ignacio' ),
	    'panel' => 'ignacio_panel', // Panel ID
	    'capability' => 'edit_theme_options'
	) );

	// Settings
	$wp_customize->add_setting( 'ignacio_header_color', array(
	    'type' => 'theme_mod', // u 'option'
	    'capability' => 'edit_theme_options',
	    'default' => '#EEE', // Valor por defecto
	    'transport' => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color' // Función que validará el dato
	) );
	$wp_customize->add_setting( 'ignacio_footer_color', array(
	    'type' => 'theme_mod', // u 'option'
	    'capability' => 'edit_theme_options',
	    'default' => '#EEE', // Valor por defecto
	    'transport' => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color' // Función que validará el dato
	) );

	$wp_customize->add_setting( 'ignacio_footer_text', array(
	    'type' => 'theme_mod', // u 'option'
	    'capability' => 'edit_theme_options',
	    'default' => '', // Valor por defecto
	    'transport' => 'postMessage',
	    'sanitize_callback' => 'ignacio_sanitize_textfield' // Función que validará el dato
	) );

	// Controls
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'ignacio_header_color',
	        array( 
	            'label' => __( 'Header Color', 'ignacio' ),
	            'section' => 'ignacio_colors',
	        )
	    )
	);

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'ignacio_footer_color',
	        array( 
	            'label' => __( 'Footer Color', 'ignacio' ),
	            'section' => 'ignacio_colors',
	        )
	    )
	);

	$wp_customize->add_control( 'ignacio_footer_text', array(
	    'label' => __( 'Footer Text' ),
	    'type' => 'textarea',
	    'section' => 'ignacio_footer',
	) );
}



function ignacio_sanitize_textfield( $input ) {
	global $allowedposttags;
	$output = wpautop( wp_kses( $input, $allowedposttags ), true );
	return $output;
}

function ignacio_preview_js() {
    wp_enqueue_script( 'ignacio_customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ) );
}
add_action( 'customize_preview_init', 'ignacio_preview_js' );

function ignacio_apply_theme_mods() {
	?>
	<style>
		<?php if ( get_theme_mod( 'ignacio_header_color') ): ?>
			#header {
			   background-color:<?php echo get_theme_mod( 'ignacio_header_color' ); ?>;	
			}
		<?php endif; ?>

		<?php if ( get_theme_mod( 'ignacio_footer_color') ): ?>
			#footer {
			   background-color:<?php echo get_theme_mod( 'ignacio_footer_color' ); ?>;	
			}
		<?php endif; ?>
	</style>
    <?php
}
add_action( 'wp_head', 'ignacio_apply_theme_mods');