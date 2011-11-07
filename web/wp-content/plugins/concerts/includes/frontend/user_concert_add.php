<?php
/**
	* File: user_concert_add
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

extract(lc_concerts_get_vars(array(
'concert_id', 
'concert_status',
'concert_venue_name', 
'concert_venue_address', 
'concert_venue_city', 
'concert_venue_postalcode',
'concert_venue_hide_address',  
'concert_venue_region_id',
'concert_venue_country_id',
'concert_venue_country',
'concert_region_schedule_id',
'concert_date',
'concert_time',
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


$timestamp = strtotime($concert_date . ' ' . $concert_time);
$mysqldatetime = date('Y-m-d H:i:s', $timestamp);

$concert_venue_region_id = empty($concert_venue_region_id) ? 0 : $concert_venue_region_id;
$concert_venue_country_id = (empty($concert_venue_region_id) || empty($concert_venue_country_id)) ? 0 : $concert_venue_country_id;
$concert_venue_country = empty($concert_venue_country_id) ? $concert_venue_country : '';
$concert_venue_show_address = ($concert_venue_hide_address == 1 ? 0 : 1);
$concert_region_schedule_id = (empty($concert_region_schedule_id) || $concert_region_schedule_id < 0) ? 0 : $concert_region_schedule_id;

// IMPORT DB 
global $wpdb;

$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "concerts_events WHERE venue_name='%s' AND dateandtime='%s' AND host_email='%s'", $concert_venue_name, $mysqldatetime, $concert_host_email));

$rows_affected = 0;
if ($count < 1) {
	$rows_affected = $wpdb->insert($wpdb->prefix . 'concerts_events', array( 
		'status' => $concert_status,
		'active' => 0,
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
	  'host_phone' => $concert_host_phone,
	  'password' => md5($concert_password)
		));
}


// EMAIL /////

// multiple recipients
$to  = $concert_host_email;
$backup = get_option('concerts_accounts');

// subject
$subject = 'Thanks for creating a Concert for Lulacruza';
// message

$message = "
<html>
	<head>
		<title>'.$subject.'</title>
		</head>
	<body>
		<p>Hello, and thanks for wishing to participate by hosting a Lulacruza Private-Public Concert.</p>

<p>And thanks for wishing to screen some of those little films i make</p>

<p>It is really exciting for us to share with you our music in such a unique way. These concerts are our attempt at creating a healthy, sustainable touring method that creates a direct link between the audience and the performer and gives Lulacruza the opportunity to go to places Ôoff the tour grid,Õ reaching new audiences and sharing the necessary tools for clusters of people to organize their own community events. We want the audience and the performer to share equally as co-creators of the experience.</p>

<p>We encourage you to make the concerts open to strangers, it's part of what we envision. These concerts are moments to come together. And we hope that they become rewarding experiences.</p>
<p>Before approving your screening we will get in touch with you to determine a few more details about the concert and to decide collectively on the best time and day when it could happen. You will hear from us soon.</p>
<p>Thanks,<br />
Lulacruza</p>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Additional headers
$headers .=  'From: ' . lc_concerts_get_email(get_option('concerts_notify_from_name'), get_option('concerts_notify_from_email')). "\r\n";

if(!empty($backup))
{
	$headers .= 'Cc: ' . $backup . "\r\n";
}

$message = stripslashes($message);
if ($count < 1) {
	// Mail it
	if (mail($to, $subject, $message, $headers)){
		// success
	} 
	else {
		// fail
	}
}

// CREATE A SCREENING notice
$notify = get_option('concerts_notify');
$sub = "New concert";
$msg = 'There is a new CONCERT awaiting your approval';
$head = 'From: ' . lc_concerts_get_email(get_option('concerts_notify_from_name'), get_option('concerts_notify_from_email')). "\r\n";

if ($count < 1) {
	if (mail($notify,$sub,$msg,$head)) {
		// success
	} 
	else {
		// fail
	}	
}

$msg = '<p>Thank you for your interest in hosting a Private/Public Concert with Lulacruza! We are excited to connect with you.</p>

<p>First you will receive an auto-reply stating that we have received your form. Then we will be contacting you over email to talk about details for the concert. Once your event is approved we will work with you over email to create your concert.</p>
<p>Looking forward to meeting and sharing with you!</p>
<p>Abrazos - Lulacruza</p>
<p>----------------------------------</p>
<p>Disclaimer: While Lulacruza would like to accept every offer for a Private/Public Concert, it will not always be possible to visit every host that we connect with. Distance, timing and travel costs are important factors that will determine where and when we will be able to perform. In order to keep the Private/Public Concerts affordable for everybody, we are supporting the tour with Official Concert at Festivals and Cultural Institutions. These events will partly dictate our schedule and allow us to come to your region of the world and perform Private/Public Concerts in your space.</p>
<p>We reserve the right to change or cancel a P/P Concert at our own discretion within a reasonable time frame. </p>';

if ($count < 1) {
	return $msg;
}
else {
	return '<p class="dest upper">Thank you for creating a Concert!</p>
	<p>Your concert has already been submitted, please check your email.</p>';
}

?>
