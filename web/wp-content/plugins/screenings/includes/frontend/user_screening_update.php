<?php
/**
	* File: screening_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

$post = new stdClass();
$post->id = $_POST['screening_id'];
$post->place = $_POST['screening_place'];
$post->address = $_POST['screening_address'];
$post->addressShow = $_POST['screening_address_show'];

$collect = $_POST['screening_date'].' '.$_POST['screening_time'];
$datetime = new DateTime($collect);
$post->datetime = $datetime->format('Y-m-d H:i:s');

$post->max = $_POST['screening_max'];
$post->additional = $_POST['screening_additional'];
$post->phone = $_POST['screening_phone'];
$post->film = $_POST['screening_film'];


global $wpdb;

$rows = array( 
	'place' => $post->place,
	'address' => $post->address,
	'show_address' => $post->addressShow,
	'dateandtime' => $post->datetime,
	'max' => $post->max,
	'additional' => $post->additional,
	'phone' => $post->phone,
	'film' => $post->film
	);

$wpdb->update('wp_screenings_events', $rows, array( 'id' => $post->id));

echo '<div class="screen-wrapper" style="margin-bottom:0;padding-bottom:0"><p>'.$post->place.' - has ben updated!</p></div>';
?>