<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div id="page">

		<div id="header">
			<nav id="menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>
		</div>

		<div id="content">
			<div id="inner-content">
				<?php if ( have_posts() ): ?>
					<?php while ( have_posts() ): the_post(); ?>
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
								<div class="post-category meta"><?php the_category( ' | ' ); ?></div>
								<div class="post-category meta"><?php the_tags( ' | ' ); ?></div>
								<?php edit_post_link(); ?><br>
								<?php wp_link_pages(); ?><br>
								<?php comments_popup_link(); ?><br>

							</footer>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>		
			<div id="sidebar">
				<?php if ( is_active_sidebar( 'right-sidebar' ) ): ?>
					<?php dynamic_sidebar( 'right-sidebar' ); ?>
				<?php endif; ?>
			</div>
		</div>

		<div id="footer">
			
		</div>

	</div>

	<?php wp_footer(); ?>
</body>
</html>