<?php get_header(); ?>
	<div id="inner-content">
		<?php if ( have_posts() ): ?>

			<?php while ( have_posts() ): the_post(); ?>

				<?php ignacio_related_posts(); ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>

				<div class="additional-info">
					<p><?php echo get_post_meta( get_the_ID(), 'ignacio_additional_info', true ); ?></p>
				</div>

				<div class="type">
					<?php $type = get_post_meta( get_the_ID(), 'ignacio_type', true ); ?>
					<h2><?php echo ucfirst( $type ); ?></h2>
				</div>
				
				<?php comments_template(); ?>
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	</div>		

	<?php get_sidebar( 'post' ); ?>


<?php get_footer(); ?>