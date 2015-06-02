<?php


function ignacio_scripts() {
	wp_enqueue_style( 'ignacio-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'ignacio_scripts' );



function ignacio_setup() {
	register_nav_menu( 'primary', __( 'Main Menu', 'ignacio' ) );

	add_theme_support( 'post-formats', array( 'link', 'aside' ) );	
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

	$args = array(
		'name'          => __( 'Post Sidebar', 'ignacio' ),
		'id'            => 'post-sidebar',
		'description'   => __( 'The sidebar for the posts', 'ignacio' ),
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

add_action( 'init', 'ignacio_process_form' );
function ignacio_process_form() {
	global $ignacio_errors;

	if ( is_null( $ignacio_errors ) )
		$ignacio_errors = array();

	if ( isset( $_POST['fictizia-send-form'] ) ) {
		$email = sanitize_email( $_POST['email'] );
		if ( ! is_email( $email ) ) {
			$ignacio_errors['contact-form-email'] = __( 'That is not a valid email', 'ignacio' );
		}

		if ( empty( $_POST['message'] ) ) {
			$ignacio_errors['contact-form-message'] =  __( 'Empty message', 'ignacio' );
		}

		if ( empty( $ignacio_errors ) ) {
			$redirect_to = add_query_arg( 'form-processed', 'true' );
			wp_redirect( $redirect_to );
			die();
		}
	}
}

function ignacio_related_posts() {
	$post_id = get_the_ID();
	$tags = get_the_tags();
	$rand_key = array_rand( $tags );
	$tag_id = $tags[ $rand_key ]->term_id;

	$args = array(
		'posts_per_page' => 3,
		'ignore_sticky_posts' => true,
		'tag_id' => $tag_id,
		'post__not_in' => array( $post_id )
	);
	$my_query = new WP_Query( $args );

	?>
	<ul class="related-posts">
		<?php
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
			}
		?>
	</ul>
	<?php

	wp_reset_query();
}