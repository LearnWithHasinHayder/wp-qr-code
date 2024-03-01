<?php

class Sanitization_Validation {

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
		$instructor_name = get_post_meta( $post->ID, 'instructor_name', true );
		$course_type     = get_post_meta( $post->ID, 'course_type', true );
		wp_nonce_field( 'course_meta', 'course_meta_nonce' );
		?>
		<label for="instructor_name">Instructor name:</label>
		<br>
		<input type="text" name="instructor_name" id="instructor_name" value="<?php echo esc_attr( $instructor_name ); ?>" />
		<br>

		<br>

		<label for="course_type">Course type:</label>
		<br>
		<input type="radio" name="course_type" value="online" <?php checked( $course_type, 'online' ); ?> /> Online
		<br>
		<input type="radio" name="course_type" value="offline" <?php checked( $course_type, 'offline' ); ?> /> Offline
		<?php
	}

	public function save( $post_id ) {
		if (
			! isset( $_POST[ 'course_meta_nonce' ] ) ||
			! wp_verify_nonce( $_POST[ 'course_meta_nonce' ], 'course_meta' )
		) {
			return;
		}

		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}
		
		$instructor_name = sanitize_text_field( $_POST[ 'instructor_name' ] );
		$course_type     = sanitize_text_field( $_POST[ 'course_type' ] );

		update_post_meta( $post_id, 'instructor_name', $instructor_name );

		if ( in_array( $course_type, array( 'online', 'offline' ) ) ) {
			update_post_meta( $post_id, 'course_type', $course_type );
		}

	}
}
