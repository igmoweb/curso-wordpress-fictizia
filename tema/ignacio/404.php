<?php get_header(); ?>

			<div id="inner-content">
				<p><?php _e( 'Nothing found', 'ignacio' ); ?></p>
			</div>		

			<div id="sidebar">
				<?php if ( is_active_sidebar( 'right-sidebar' ) ): ?>
					<?php dynamic_sidebar( 'right-sidebar' ); ?>
				<?php endif; ?>
			</div>

<?php get_footer(); ?>