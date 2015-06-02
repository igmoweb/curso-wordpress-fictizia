<?php
/**
 * Template Name: Contacto
 */

global $ignacio_errors;

?>

<?php get_header(); ?>
	<div id="inner-content">
		<?php if ( have_posts() ): ?>

			<?php while ( have_posts() ): the_post(); ?>
				
				<?php if ( ! empty( $ignacio_errors ) ): ?>
					<?php foreach ( $ignacio_errors as $error ): ?>
						<div class="error"><?php echo $error; ?></div>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if ( isset( $_GET['form-processed'] ) ): ?>
					<div class="info"><?php _e( 'Thanks!', 'ignacio' ); ?></div>
				<?php else: ?>
					<form action="" method="POST" id="contact-form">
						<p>
							<label for="email"><?php _e( 'Email', 'ignacio' ); ?>
								<input id="email" type="email" name="email" value="" />
							</label>
						</p>
						<p>
							<label for="message"><?php _e( 'Message', 'ignacio' ); ?></label>
							<textarea id="message" name="message"></textarea>
						</p>
						<p><input type="submit" name="fictizia-send-form" value="<?php echo esc_attr( 'Send!', 'ignacio' ); ?>"/></p>
					</form>
				<?php endif; ?>
				
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	</div>		

<?php get_footer(); ?>

