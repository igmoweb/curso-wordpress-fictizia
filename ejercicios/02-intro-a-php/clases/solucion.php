<?php

class Post {
	public $post_title;
	public $post_content;
	public $ID;

	public function __construct( $ID, $title ) {
		$this->post_title = $title;
		$this->ID = $ID;
	}

}

$post = new Post( 5, 'Un post' );
$post->post_content = 'El contenido';

?>
<h1><?php echo $post->post_title; ?></h1>
<div>
	<?php echo $post->post_content; ?>
</div>