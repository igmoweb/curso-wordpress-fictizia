<article id="id-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header class="post-header">
		
	</header>

	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>

	<footer class="post-footer">
		<?php if ( ! is_category() ): ?>
			<div class="post-category meta"><?php the_category( ' | ' ); ?></div>
		<?php endif; ?>
		<div class="post-category meta"><?php the_tags( ' | ' ); ?></div>
		<?php edit_post_link(); ?><br>
		<?php wp_link_pages(); ?><br>
		<?php comments_popup_link(); ?><br>

	</footer>
</article>