<?php

if ( post_password_required() )
	return;

?>

<div id="comments" class="comments-area">

	<?php if ( comments_open() && get_comments_number() ): ?>

		<?php if ( have_comments() ) : ?>
			
			<h2><?php printf( _n( '%d comment', '%d comments', get_comments_number(), 'ignacio' ), get_comments_number() ); ?></h2>

			<ul class="commentlist">
				<?php wp_list_comments( array(
					'style'       => 'ol',
					'callback' => 'ignacio_comment'
				) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav class="comment-navigation">
					<div class="nav-previous"><?php previous_comments_link(); ?></div>
					<div class="nav-next"><?php next_comments_link(); ?></div>
				</nav>
			<?php endif; ?>

		<?php endif; ?>

		<?php comment_form(); ?>
		
	<?php endif; ?>

</div>