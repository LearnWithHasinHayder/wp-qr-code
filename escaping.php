<?php

class Escaping {

	public function __construct() {
		add_action( 'wp_head', array( $this, 'render' ) );
	}

	public function render() {
		$instructor_name = esc_html( get_post_meta( get_the_ID(), 'instructor_name', true ) );
		?>
		<div>
			<?php echo $instructor_name; ?>
		</div>
		<?php
	}
}
