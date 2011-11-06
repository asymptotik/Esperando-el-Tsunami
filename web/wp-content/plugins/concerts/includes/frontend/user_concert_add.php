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
		<p>Helloooo you, beautiful stranger </p>

<p>And thanks for wishing to screen some of those little films i make</p>

<p>As you have read on the website, you are welcome to screen any films you want - and not only the ones from the collection <strong>Petites Planetes</strong>. You might even ask me for some un-released films - check on my vincentmoon.com website to see what i have been up to recently. i can send you links to work in progress for some of them.</p>

<p>The vast majority of the films is available on internet for free, on vimeo - <a href=\"http://www.vimeo.com/vincentmoon/videos\">http://www.vimeo.com/vincentmoon/videos</a><br />
You can download the films directly from the pages, you will find a link on the right side, in the little About This Video box</p>

<p>Some films though requires a password to be viewed. It's often because i dont have the right to offer them online. Most of them are feature length films, and are or were sold as dvds. If you want to screen them also, ask me the password, i will give it to you.</p>

<p>The quality of each film on vimeo should be good enough for the concert. But be careful maybe with some older films, which are not that well compressed.</p>

<p>Fill the informations on my website to let people know more or less what you are gonna screen, and how many people can join. Alright?</p>

<p>And here is some important info that I would like to be sure you have read:</p>

<p>you don't need to use a projector to screen the films, but it would probably be better as soon as you are more than 3 people in the room. Be careful to screen the films are the right size too! they are all in 16/9 format.</p>

<p>what you need though, is a good sound system. LOUD please, as much as possible - dont worry about the neighbours, send me their complaints.</p>

<p>please, be open to welcome strangers in your home, or where you screen those films. It's part of the game, right?</p>

<p>last thing, the entrance is supposed to be for free. I can imagine if you rented a place, you might ask for a little contribution. all good, just let me know about it</p>

<p><span style='font-size:16pt;'>THANK YOU</span> <br />
and i hope you will enjoy the films and the moment<br />
talk soon</p>

v.";

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
$msg = 'There is a new SCREENING awaiting your approval';
$head = 'From: ' . lc_concerts_get_email(get_option('concerts_notify_from_name'), get_option('concerts_notify_from_email')). "\r\n";

if ($count < 1) {
	if (mail($notify,$sub,$msg,$head)) {
		// success
	} 
	else {
		// fail
	}	
}

$msg = '<p class="dest upper">Thank you for creating a Concert for Lulacruza!</p>
<p>We will approve your concert as soon as possible and inform you by email once it has been approved.</p>
<p>Please add <a href="concerts@petitesplanetes.cc">concerts@petitesplanetes.cc</a> to your address book to prevent the email from being categorized as junk mail.</p>
<p>Already now you should have received an email with the details you just registered and your log-in info for <a href="http://www.petitesplanetes.cc">www.petitesplanetes.cc</a> so you can edit and manage your event. Please make sure you have received this email.</p>
<p>Thanks,<br />Vincent Moon</p>';

if ($count < 1) {
	return $msg;
}
else {
	return '<p class="dest upper">Thank you for creating a Concert!</p>
	<p>Your concert has already been submitted, please check your email.</p>';
}

?>
