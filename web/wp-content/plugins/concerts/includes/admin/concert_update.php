<?php
/**
	* File: concert_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_concerts_get_vars(array(
'concert_id', 
'concert_venue_name', 
'concert_venue_address', 
'concert_venue_city', 
'concert_venue_postalcode',
'concert_venue_hide_address',  
'concert_venue_region_id',
'concert_venue_country',
'concert_dateandtime', 
'concert_venue_type',
'concert_venue_size',
'concert_venue_capacity', 
'concert_additional_info', 
'concert_host_name', 
'concert_host_email',
'concert_host_address', 
'concert_host_city', 
'concert_host_postalcode', 
'concert_host_phone', 
'concert_password')));

$concert_venue_country_name = "concert_venue_country_" . $concert_venue_region_id;
$concert_venue_country_id = lc_concerts_get_var($concert_venue_country_name);
$concert_region_schedule_name = "concert_region_schedule_" . $concert_venue_region_id;
$concert_region_schedule_id = lc_concerts_get_var($concert_region_schedule_name);

$concert_venue_region_id = empty($concert_venue_region_id) ? 0 : $concert_venue_region_id;
$concert_venue_country_id = (empty($concert_venue_region_id) || empty($concert_venue_country_id)) ? 0 : $concert_venue_country_id;
$concert_region_schedule_id = (empty($concert_venue_region_id) || empty($concert_region_schedule_id)) ? 0 : $concert_region_schedule_id;
$concert_venue_country = empty($concert_venue_country_id) ? $concert_venue_country : '';
$concert_venue_show_address = ($concert_venue_hide_address == 1 ? 0 : 1);

global $wpdb;
$rows = array( 
	  'venue_name' => $concert_venue_name,
	  'venue_address' => $concert_venue_address,
	  'venue_city' => $concert_venue_city,
	  'venue_postalcode' => $concert_venue_postalcode,
	  'venue_show_address' => $concert_venue_show_address,
	  'venue_region_id' => $concert_venue_region_id,
	  'venue_country_id' => $concert_venue_country_id,
	  'venue_country' => $concert_venue_country,
    'region_schedule_id' => $concert_region_schedule_id,
	  'dateandtime' => $concert_dateandtime,
	  'venue_type' => $concert_venue_type,
	  'venue_size' => $concert_venue_size,
	  'venue_capacity' => $concert_venue_capacity,
	  'additional_info' => $concert_additional_info,
	  'host_name' => $concert_host_name,
	  'host_email' => $concert_host_email,
	  'host_address' => $concert_host_address,
	  'host_city' => $concert_host_city,
	  'host_postalcode' => $concert_host_postalcode,
	  'host_phone' => $concert_host_phone
	);

if(!empty($concert_id))
{
	check_admin_referer('update-concert_' . $concert_id); 
	$wpdb->update($wpdb->prefix . 'concerts_events', $rows, array( 'id' => $concert_id));
	$message = "The Concert has been updated.";
}
else
{
	check_admin_referer('add-concert'); 
	$wpdb->insert($wpdb->prefix . 'concerts_events', $rows);
	$message = "The Concert has been saved.";
}

if ($concert_password != '') {
	$wpdb->update($wpdb->prefix . 'concerts_events', array('password' => md5($concert_password)), array( 'id' => $concert_id));
	echo "<p>The password has been changed.</p>";
}

?>
<p><?php echo $message; ?></p>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>
