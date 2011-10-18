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
'concert_place', 
'concert_address', 
'concert_hide_address', 
'concert_city', 
'concert_postalcode', 
'concert_region_id',
'concert_country', 
'concert_dateandtime', 
'concert_max', 
'concert_additional', 
'concert_name', 
'concert_email', 
'concert_phone', 
'concert_password')));

$concert_country_name = "concert_country_" . $concert_region_id;
$concert_country_id = lc_concerts_get_var($concert_country_name);

$concert_region_id = empty($concert_region_id) ? 0 : $concert_region_id;
$concert_country_id = (empty($concert_region_id) || empty($concert_country_id)) ? 0 : $concert_country_id;
$concert_country = empty($concert_country_id) ? $concert_country : '';
$concert_show_address = ($concert_hide_address == 1 ? 0 : 1);

echo "concert_place: $concert_place <br>";

global $wpdb;
$rows = array( 
	'place' => $concert_place,
	'address' => $concert_address,
	'show_address' => $concert_show_address,
	'city' => $concert_city,
	'postalcode' => $concert_postalcode,
  'region_id' => $concert_region_id,
  'country_id' => $concert_country_id,
	'country' => $concert_country,
	'dateandtime' => $concert_dateandtime,
	'max' => $concert_max,
	'additional' => $concert_additional,
	'name' => $concert_name,
	'email' => $concert_email,
	'phone' => $concert_phone,
	);

if(!empty($concert_id))
{
	check_admin_referer('update-concert_' . $concert_id); 
	$wpdb->update($wpdb->prefix . 'concerts_events', $rows, array( 'id' => $concert_id));
}
else
{
	check_admin_referer('add-concert'); 
	$wpdb->insert($wpdb->prefix . 'concerts_events', $rows);
}

if ($_POST['concert_password'] != '') {
	$wpdb->update($wpdb->prefix . 'concerts_events', array('password' => md5($concert_password)), array( 'id' => $post->id));
	echo "<p>The password has been changed.</p>";
}

?>
<p>The Concert has been saved.</p>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
