<?php
/**
	* File: concert_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

$post = new stdClass();
$post->id = $_POST['concert_id'];
$post->place = $_POST['concert_place'];
$post->address = $_POST['concert_address'];
$post->addressShow = $_POST['concert_address_show'];

$collect = $_POST['concert_date'].' '.$_POST['concert_time'];
$datetime = new DateTime($collect);
$post->datetime = $datetime->format('Y-m-d H:i:s');

$post->max = $_POST['concert_max'];
$post->additional = $_POST['concert_additional'];
$post->phone = $_POST['concert_phone'];


global $wpdb;

$rows = array( 
	'place' => $post->place,
	'address' => $post->address,
	'show_address' => $post->addressShow,
	'dateandtime' => $post->datetime,
	'max' => $post->max,
	'additional' => $post->additional,
	'phone' => $post->phone
	);

$wpdb->update($wpdb->prefix . 'concerts_events', $rows, array( 'id' => $post->id));

echo '<div class="screen-wrapper" style="margin-bottom:0;padding-bottom:0"><p>'.$post->place.' - has ben updated!</p></div>';
?>
