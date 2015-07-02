<?php

function ignacio_create_portfolio_cpt() {

	$labels = array(
		'name'                => _x( 'Portfolios', 'Post Type General Name', 'ignacio' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'ignacio' ),
		'menu_name'           => __( 'Portfolio', 'ignacio' ),
		'name_admin_bar'      => __( 'Portfolio', 'ignacio' ),
		'parent_item_colon'   => __( 'Parent Portfolio', 'ignacio' ),
		'all_items'           => __( 'All Portfolios', 'ignacio' ),
		'add_new_item'        => __( 'Add New Portfolio', 'ignacio' ),
		'add_new'             => __( 'Add New', 'ignacio' ),
		'new_item'            => __( 'New Portfolio', 'ignacio' ),
		'edit_item'           => __( 'Edit Portfolio', 'ignacio' ),
		'update_item'         => __( 'Update Portfolio', 'ignacio' ),
		'view_item'           => __( 'View Portfolio', 'ignacio' ),
		'search_items'        => __( 'Search Portfolio', 'ignacio' ),
		'not_found'           => __( 'Not found', 'ignacio' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ignacio' ),
	);
	$rewrite = array(
		'slug'                => 'proyectos',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'portfolio', 'ignacio' ),
		'description'         => __( 'Porfolio Description', 'ignacio' ),
		'labels'              => $labels,
		'supports'            => array( 'editor', 'thumbnail', 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfolio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'ignacio_create_portfolio_cpt', 0 );

// Register Custom Taxonomy
function ignacio_register_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Types', 'Taxonomy General Name', 'ignacio' ),
		'singular_name'              => _x( 'Portfolio Type', 'Taxonomy Singular Name', 'ignacio' ),
		'menu_name'                  => __( 'Type', 'ignacio' ),
		'all_items'                  => __( 'All Types', 'ignacio' ),
		'parent_item'                => __( 'Parent Type', 'ignacio' ),
		'parent_item_colon'          => __( 'Parent Type:', 'ignacio' ),
		'new_item_name'              => __( 'New Type', 'ignacio' ),
		'add_new_item'               => __( 'Add New Type', 'ignacio' ),
		'edit_item'                  => __( 'Edit Type', 'ignacio' ),
		'update_item'                => __( 'Update Type', 'ignacio' ),
		'view_item'                  => __( 'View Type', 'ignacio' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'ignacio' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'ignacio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ignacio' ),
		'popular_items'              => __( 'Popular types', 'ignacio' ),
		'search_items'               => __( 'Search types', 'ignacio' ),
		'not_found'                  => __( 'Not Found', 'ignacio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio-type', array( 'portfolio' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'ignacio_register_taxonomy', 0 );