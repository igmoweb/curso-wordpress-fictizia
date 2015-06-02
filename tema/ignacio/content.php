<article id="id-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header class="post-header">

		<?php if ( is_singular() ): ?>
			<h1><?php the_title(); ?></h1>															
		<?php else: ?>
			<h2><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>							
		<?php endif; ?>
		
	</header>

	<div class="post-content">
		<?php if ( is_singular() ): ?>
			<?php the_content(); ?>
		<?php elseif ( ! is_search() ): ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
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