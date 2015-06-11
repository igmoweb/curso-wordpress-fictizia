<?php get_header( 'archive' ); ?>

			<div id="inner-content">
				<?php if ( have_posts() ): ?>

					<h1><?php echo get_the_archive_title(); ?></h1>
					
					<?php if ( have_posts() ): the_post(); ?>
						<div class="author-bio">
							<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></div>
							<?php if ( get_the_author_meta( 'description' ) ) : ?>
								<div class="author-bio-content"><?php the_author_meta( 'description' ); ?></div>
							<?php endif; ?>
						</div>
						<?php rewind_posts(); ?>
					<?php endif; ?>

					<?php while ( have_posts() ): the_post(); ?>

						<?php get_template_part( 'content' ); ?>
						
					<?php endwhile; ?>
					
					<?php echo get_the_posts_pagination( array( 'mid_size' => 2 ) ); ?>

				<?php endif; ?>
			</div>		

			<?php get_sidebar(); ?>


<?php get_footer(); ?>