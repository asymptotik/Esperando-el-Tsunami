<?php
/**
	* File: screening_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_screenings_get_vars(array('screening_id',
'screening_place',
'screening_address',
'screening_address_show',
'screening_date',
'screening_time',
'screening_max',
'screening_additional',
'screening_phone')));

$datetime = new DateTime($screening_date.' '.$screening_time);
$sqldatetime = $datetime->format('Y-m-d H:i:s');

global $wpdb;

$rows = array( 
	'place' => $screening_place,
	'address' => $screening_address,
	'show_address' => $screening_address_show,
	'dateandtime' => $sqldatetime,
	'max' => $screening_max,
	'additional' => $screening_additional,
	'phone' => $screening_phone
	);

$wpdb->update($wpdb->prefix . 'screenings_events', $rows, array( 'id' => $screening_id));
?>

<div class="screen-wrapper" "><p><?php esc_html($screening_place) ?> - has been updated!</p></div>
