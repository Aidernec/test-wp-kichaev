<?php
/**
 * Custom functions
 */


// Добавим метабокс выбора города к недвижимости
add_action(
	'add_meta_boxes',
	function () {
		add_meta_box( 'city', 'Город', 'city_metabox', 'realestate', 'side', 'low' );
	},
	1
);

// метабокс с селектом города
function city_metabox( $post ) {
	$cities = get_posts(
		array(
			'post_type'      => 'city',
			'posts_per_page' => -1,
			'orderby'        => 'post_title',
			'order'          => 'ASC',
		)
	);

	if ( $cities ) {
		// чтобы портянка пряталась под скролл...
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach ( $cities as $city ) {
			echo '
			<li><label>
				<input type="checkbox" name="post_parent" value="' . $city->ID . '" ' . checked( $city->ID, $post->post_parent, 0 ) . '> ' . esc_html( $city->post_title ) . '
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	}
}
