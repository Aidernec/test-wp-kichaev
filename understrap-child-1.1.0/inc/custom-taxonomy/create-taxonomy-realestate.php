<?php
/**
 * Register taxonomy realestate-type
 */

function create_taxonomy_realestate_category() {
	$post_type = array( 'realestate' );
	$args      = array(
		'label'               => 'Тип недвижимости',
		'public'              => true,
		'show_admin_column'   => true,
		'exclude_from_search' => false,
		'hierarchical'        => true,
		'rewrite'             => array(
			'slug'         => 'realestate_category',
			'hierarchical' => true,
		),
	);
	register_taxonomy( 'realestate_category', $post_type, $args );
}
add_action( 'after_setup_theme', 'create_taxonomy_realestate_category', 0, 10 );
