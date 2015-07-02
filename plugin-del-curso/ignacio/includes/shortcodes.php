<?php

add_shortcode( 'posts-list', 'ignacio_posts_list_shortcode' );
function ignacio_posts_list_shortcode( $atts ) {

	$defaults = array(
		'items' => 3
	);
	$atts = wp_parse_args( $atts, $defaults );

	$args = array(
		'ignore_sticky_posts' => true,
		'posts_per_page' => $atts['items'],
		'post_type' => 'post',
		'post_status' => 'publish'
	);

	$posts = get_posts( $args );

	ob_start();
	?>
		<ol>
			<?php foreach ( $posts as $post ): ?>
				<li><?php echo get_the_title( $post->ID ); ?></li>
		 	<?php endforeach; ?>
		</ol>
	<?php

	return ob_get_clean();
}