<?php

class Metabox_IO {
	public function __construct() {
		add_filter( 'rwmb_meta_boxes', array( $this, 'add' ) );
	}

	public function add( $meta_boxes ) {
		$meta_boxes[] = [
			'title'      => esc_html__( 'weDevs Academy - Metabox.io', 'online-generator' ),
			'id'         => 'wedevs_academy_metabox_io',
			'post_types' => array( 'course' ),
			'fields'     => [
				[
					'type' => 'text',
					'name' => esc_html__( 'Instructor name', 'online-generator' ),
					'id'   => 'instructor_name',
				],
				[
					'type' => 'color',
					'name' => esc_html__( 'Color', 'online-generator' ),
					'id'   => 'color_8qdfqchdb4m',
				],
			],
		];

		return $meta_boxes;
	}
}
