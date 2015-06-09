<?php get_header(); ?>
	<div id="inner-content">
		<?php if ( have_posts() ): ?>

			<?php while ( have_posts() ): the_post(); ?>

				<?php ignacio_related_posts(); ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>
				
				<?php comments_template(); ?>
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	</div>		

	<?php get_sidebar( 'post' ); ?>


<?php get_footer(); ?>