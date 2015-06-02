<?php get_header(); ?>

			<div id="inner-content">
				<?php if ( have_posts() ): ?>

					<h1><?php printf( __( 'Searching by: %s', 'ignacio' ), get_search_query() ); ?></h1>

					<?php while ( have_posts() ): the_post(); ?>

						<?php get_template_part( 'content' ); ?>

					<?php endwhile; ?>
					
					<?php echo get_the_posts_pagination( array( 'mid_size' => 2 ) ); ?>

				<?php endif; ?>
			</div>		

			<?php get_sidebar(); ?>

<?php get_footer(); ?>