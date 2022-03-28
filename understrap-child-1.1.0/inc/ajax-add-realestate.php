<?php

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$title       = ! empty( $_POST['title'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['title'] ) ) ) : '';
$description = ! empty( $_POST['description'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['description'] ) ) ) : '';
$square      = ! empty( $_POST['square'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['square'] ) ) ) : '';
$price       = ! empty( $_POST['price'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['price'] ) ) ) : '';
$adress      = ! empty( $_POST['adress'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['adress'] ) ) ) : '';
$liveSq      = ! empty( $_POST['liveSq'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['liveSq'] ) ) ) : '';
$floor       = ! empty( $_POST['floor'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['floor'] ) ) ) : '';
$type        = ! empty( $_POST['type'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['type'] ) ) ) : '';
$city        = ! empty( $_POST['city'] ) ? htmlentities( sanitize_text_field( wp_unslash( $_POST['city'] ) ) ) : '';


if ( empty( $title ) ) {
	$result = array(
		'type'  => 'error',
		'title' => 'Что-то пошло не так',
		'text'  => 'Заполните обязательные поля',
	);
	echo wp_json_encode( $result );
	exit();
}

$city_id = get_page_by_title( $city, 'OBJECT', 'city' )->ID;

$new_post_id = wp_insert_post(
	array(
		'post_type'    => 'realestate',
		'post_title'   => $title,
		'post_content' => $description,
		'post_parent'  => $city_id,
		'post_status'  => 'publish',
	)
);


wp_set_object_terms( $new_post_id, $type, 'realestate_category' );

update_field( 'ploshhad', $square, $new_post_id );
update_field( 'stoimost', $price, $new_post_id );
update_field( 'adres', $adress, $new_post_id );
update_field( 'zhilaya_ploshhad', $liveSq, $new_post_id );
update_field( 'etazh', $floor, $new_post_id );

$thumbnail_id = media_handle_upload( 'image', 0 );

set_post_thumbnail( $new_post_id, $thumbnail_id );

$result = intval( $new_post_id ) ? 'Объект недвижимости успешно добавлен!' : 'Что то пошло не так';

echo wp_json_encode( $result );
exit();
