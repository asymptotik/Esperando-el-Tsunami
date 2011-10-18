<?php
/**
	* File: screening_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_screenings_get_vars(array(
'screening_id', 
'screening_place', 
'screening_address', 
'screening_show_address', 
'screening_city', 
'screening_postalcode', 
'screening_country', 
'screening_date', 
'screening_max', 
'screening_additional', 
'screening_name', 
'screening_email', 
'screening_phone', 
'screening_password')));

$screening = get_lc_screening($screening_id);

global $wpdb;
$rows = array( 
	'place' => $screening_place,
	'address' => $screening_address,
	'show_address' => $screening_show_address,
	'city' => $screening_city,
	'postalcode' => $screening_postalcode,
	'country' => $screening_country,
	'dateandtime' => $screening_datetime,
	'max' => $screening_max,
	'additional' => $screening_additional,
	'name' => $screening_name,
	'email' => $screening_email,
	'phone' => $screening_phone,
	);

if(!empty($screening_id))
{
	check_admin_referer('update-screening_' . $screening_id); 
	$wpdb->update($wpdb->prefix . 'screenings_events', $rows, array( 'id' => $post->id));
}
else
{
	check_admin_referer('add-screening'); 
	$wpdb->insert($wpdb->prefix . 'screenings_events', $rows);
}

if ($_POST['screening_password'] != '') {
	$wpdb->update($wpdb->prefix . 'screenings_events', array('password' => md5($screening_password)), array( 'id' => $post->id));
	echo "<p>The password has been changed.</p>";
}

?>
<p>The Screening has been saved.</p>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
