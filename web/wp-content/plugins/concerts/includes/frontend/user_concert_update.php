<?php
/**
	* File: concert_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_concerts_get_vars(array('concert_id',
'concert_venue_name',
'concert_venue_address',
'concert_venue_show_address',
'concert_date',
'concert_time',
'concert_venu_capacity',
'concert_additional_info',
'concert_host_email',
'concert_host_address',
'concert_host_city',
'concert_host_phone')));

echo "date time string: " . $concert_date.' '.$concert_time;

$datetime = new DateTime($concert_date.' '.$concert_time);
$sqldatetime = $datetime->format('Y-m-d H:i:s');

global $wpdb;

$rows = array( 
	'venue_name' => $concert_venue_name,
	'venue_address' => $concert_venue_address,
	'venue_show_address' => $concert_venue_show_address,
	'dateandtime' => $sqldatetime,
	'venue_capacity' => $concert_venu_capacity,
	'additional_info' => $concert_additional_info,
  'host_email' => $concert_host_email,
  'host_address' => $concert_host_address,
  'host_city' => $concert_host_city,
	'host_phone' => $concert_host_phone
	);

$wpdb->update($wpdb->prefix . 'concerts_events', $rows, array( 'id' => $concert_id));
?>

<div class="lc-host-form-narrow screen-wrapper" "><p><?php echo esc_html($concert_venue_name) ?> - has been updated!</p></div>
