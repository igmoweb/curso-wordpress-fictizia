<?php 
class Fictizia_Widget extends WP_Widget {

	// El nombre de la clase tiene que coincidir con esta función
	function Fictizia_Widget() {
		// Argumentos
		$args = array( 
			'classname' => 'fictizia-widget', 
			'description' => __( 'Fictizia Widget Description', 'fictizia' ) 
		);

		// La clase superior es la que se encarga de crear realmente el widget
		parent::WP_Widget( false, __( 'Fictizia Widget', 'fictizia' ), $args );	
	}

	function form($instance) {
		$title = $instance['title'];

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ignacio' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
			</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$old_instance['title'] = strip_tags( $new_instance['title'] );
		return $old_instance;
	}


	function widget($args, $instance) {

		echo $args['before_widget']; // <aside>

			echo $args['before_title']; // <h2>

				echo apply_filters( 'widget_title', $instance['title'] );

			echo $args['after_title']; // </h2>

		echo $args['after_widget']; // </aside>
	}

}

add_action( 'widgets_init', 'fictizia_register_widget' );
function fictizia_register_widget() {
	register_widget( 'Fictizia_Widget' );
}