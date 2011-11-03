<?php
/**
	* File: concert_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_concerts_get_vars(array('concert_id',
'concert_place',
'concert_address',
'concert_address_show',
'concert_date',
'concert_time',
'concert_max',
'concert_additional',
'concert_phone')));

$datetime = new DateTime($concert_date.' '.$concert_time);
$sqldatetime = $datetime->format('Y-m-d H:i:s');

global $wpdb;

$rows = array( 
	'place' => $concert_place,
	'address' => $concert_address,
	'show_address' => $concert_address_show,
	'dateandtime' => $sqldatetime,
	'max' => $concert_max,
	'additional' => $concert_additional,
	'phone' => $concert_phone
	);

$wpdb->update($wpdb->prefix . 'concerts_events', $rows, array( 'id' => $concert_id));
?>

<div class="screen-wrapper" "><p><?php esc_html($concert_place) ?> - has been updated!</p></div>
