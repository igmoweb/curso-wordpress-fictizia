<?php get_header(); ?>
	<div id="inner-content">
		<?php if ( have_posts() ): ?>

			<?php while ( have_posts() ): the_post(); ?>

				<?php get_template_part( 'content' ); ?>
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	</div>		

<?php get_footer(); ?>