<?php

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}


function ignacio_scripts() {
	wp_enqueue_style( 'ignacio-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

add_action( 'wp_enqueue_scripts', 'ignacio_scripts' );



function ignacio_setup() {
	register_nav_menu( 'primary', __( 'Main Menu', 'ignacio' ) );

	add_theme_support( 'post-formats', array( 'link', 'aside' ) );	

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'imagen-destacada', 600, 300, true );

	add_editor_style( 'css/editor-style.css' );

	add_theme_support( 'automatic-feed-links');

	add_theme_support( 'title-tag' );

	load_theme_textdomain( 'ignacio', get_template_directory() . '/languages' );

	$args = array(
		'flex-width'    => true,
		'width'         => 1024,
		'flex-height'    => true,
		'height'        => 768,
		'default-image' => get_template_directory_uri() . '/images/header.jpg',
	);
	add_theme_support( 'custom-header', $args );

	$args = array(
		'default-color' => '000000',
		'default-image' => get_template_directory_uri() . '/images/background.png',
	);
	add_theme_support( 'custom-background', $args );
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

function ignacio_comment( $comment, $args, $depth ) {
	?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment->user_id, $args['avatar_size'] ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
			</div><!-- .comment-author -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em><br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<a href="<?php echo esc_url( get_comment_link( get_comment_ID(), $args ) ); ?>">
					<?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?>
				</a>
				<?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' ); ?>
			</div>

			<?php comment_text(); ?>

			<?php
				comment_reply_link( array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
			?>

	<?php
}

include_once( 'inc/meta-boxes.php' );
include_once( 'inc/customizer.php' );