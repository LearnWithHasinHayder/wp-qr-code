<?php

class Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add() {
		add_meta_box(
			'wedevs_academy_custom',
			'weDevs Academy - Custom',
			array( $this, 'show' ),
			array( 'course' ),
		);
	}

	public function show( $post ) {
		$value = get_post_meta( $post->ID, 'instructor_name', true );

		?>
		<label for="instructor_name">Instructor name</label>
		<br>
		<input type="text" name="instructor_name" id="instructor_name" value="<?php echo esc_attr( $value ); ?>" />
		<?php
	}

	public function save( $post_id ) {
		$value = sanitize_text_field( $_POST[ 'instructor_name' ] );

		update_post_meta( $post_id, 'instructor_name', $value );
	}
}
