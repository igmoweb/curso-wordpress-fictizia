<?php

add_action( 'add_meta_boxes', 'ignacio_mbe_create' );
function ignacio_mbe_create() {
  add_meta_box( 'ignacio-meta', __( 'Info adicional', 'ignacio' ), 'ignacio_show_meta_box', 'post', 'normal', 'high' );
}

function ignacio_show_meta_box( $post ) {
  $info = get_post_meta( $post->ID, 'ignacio_additional_info', true );
  $type = get_post_meta( $post->ID, 'ignacio_type', true );
  if ( empty( $info ) )
    $info = '';
  
  ?>
    <?php wp_nonce_field( 'my_meta_box', 'my_meta_box_nonce' ); ?>
    <input type="text" name="additional_info" value="<?php echo esc_attr( $info ); ?>" />
    <select name="ignacio-type" id="">
      <option value="libro" <?php selected( $type, 'book' ); ?>><?php _e( 'Book Type', 'ignacio' ); ?></option>
      <option value="digital" <?php selected( $type, 'digital' ); ?>><?php _e( 'Digital Type', 'ignacio' ); ?></option>
    </select>
  <?php
}

add_action( 'save_post', 'fictizia_save_meta' );
function fictizia_save_meta( $post_id ) {  
  // Verificar que el nonce es válido
  if ( ! wp_verify_nonce( $_POST['my_meta_box_nonce'], 'my_meta_box' ) )
    return;
    
  // Si es un autosave no lo guardamos
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( isset( $_POST['additional_info'] ) ) {
    $info = sanitize_text_field( $_POST['additional_info'] );
    $type = 'book';
    if ( in_array( $_POST['ignacio-type'], array( 'book', 'digital' ) ) )
    	$type = $_POST['ignacio-type'];

    update_post_meta( $post_id, 'ignacio_additional_info', $info );
    update_post_meta( $post_id, 'ignacio_type', $type );
  }
}