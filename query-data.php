<?php
/**
 * Query data from the database
 */

class Query_Data {
	public function __construct() {
		add_shortcode( 'query-data', array( $this, 'get_option' ) );
	}

	public function get_option() {
		$theme = get_option( 'current_theme' );
		return '<h2>' . $theme . '</h2>';
	}

	public function get_users() {
		ob_start();

		$args = array(
			'role'   => 'administrator',
		);

		$users = get_users( $args );

		?>
		<ul>
		<?php

		foreach ( $users as $user ) {
			?>
				<li>
					<a href="<?php echo get_author_posts_url( $user->ID ); ?>">
					<?php echo esc_html( $user->display_name ); ?></a>
				</li>
			<?php
		}

		?>
		</ul>

		<?php

		return ob_get_clean();
	}

	public function get_categories() {
		ob_start();

		$args = array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		);

		$categories = get_terms( $args );

		?>
		<ul>
		<?php

		foreach ( $categories as $category ) {
			?>
				<li>
					<a href="<?php echo get_category_link( $category->term_id ); ?>">
					<?php echo esc_html( $category->name ); ?></a>
				</li>
			<?php
		}

		?>
		</ul>

		<?php

		return ob_get_clean();
	}

	public function get_post() {
		$post = get_post( 2 );

		return '<h2>' . $post->post_title . '</h2>' . '<p>' . $post->post_content . '</p>';
	}

	public function wp_db() {
		ob_start();

		global $wpdb;

		$results = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 10" );

		?>
		<ul>
		<?php
		foreach ( $results as $post ) {
			?>
			<li><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></li>
			<?php
		}
		?>
		</ul>
		<?php
		return ob_get_clean();
	}

	public function wp_query() {
		ob_start();
	
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 20,
			'order'          => 'ASC',
		);

		$query = new WP_Query( $args );

		?>
		<ul>
		<?php

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<li>
					<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
				</li>
				<?php
			}
		}

		?>
		</ul>
		<?php
		wp_reset_postdata();

		return ob_get_clean();
	}

	public function get_posts() {
		ob_start();

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 10,
		);

		$posts = get_posts( $args );
	
		?>
		<ul>
		<?php
		foreach ( $posts as $post ) {
			?>
				<li><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
				<p><?php echo $post->post_content; ?></p>
			</li>
			<?php
		}
		?>
		</ul>
		<?php
		return ob_get_clean();
	}
}
