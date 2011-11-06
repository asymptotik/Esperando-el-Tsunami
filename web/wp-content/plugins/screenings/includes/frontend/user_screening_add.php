<?php
/**
	* File: user_screening_add
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

extract(lc_screenings_get_vars(array(
'screening_status',
'screening_place',
'screening_address',
'screening_address_show',
'screening_city',
'screening_postalcode',
'screening_country',
'screening_date',
'screening_time',
'screening_max',
'screening_additional',
'screening_name',
'screening_email',
'screening_phone',
'screening_password',
'screening_imageurl'
)));

$timestamp = strtotime($screening_date . ' ' . $screening_time);
$mysqldatetime = date('Y-m-d H:i:s', $timestamp);

// IMPORT DB 
global $wpdb;

$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "screenings_events WHERE place='%s' AND dateandtime='%s' AND email='%s'", $screening_place, $mysqldatetime, $screening_email));

$rows_affected = 0;
if ($count < 1) {
	$rows_affected = $wpdb->insert($wpdb->prefix . 'screenings_events', array( 
		'status' => $screening_status,
		'active' => 0,
		'place' => $screening_place,
		'address' => $screening_address,
		'show_address' => $screening_address_show,
		'city' => $screening_city,
		'postalcode' => $screening_postalcode,
		'country' => $screening_country,
		'dateandtime' => $mysqldatetime,
		'max' => $screening_max,
		'additional' => $screening_additional,
		'name' => $screening_name,
		'email' => $screening_email,
		'phone' => $screening_phone,
		'password' => md5($screening_password),
		'imageurl' => $screening_imageurl,
		));
}


// EMAIL /////

// multiple recipients

$to  = $screening_email; 
$backup = get_option('screenings_accounts');

// subject
$subject = 'Thanks for creating a Screening of Esperando el Tsunami.';
// message
	
$message = "
<html>
	<head>
		<title>'.$subject.'</title>
	</head>
	<body>
	
<p>Hello, and thanks for wishing to screen <b>Esperando el Tsunami</b>.</p>
<p>It is really exciting for us to share with you this film in such a unique way. We encourage you to make the screenings open to strangers, it's part of what we envision. These screenings are moments to come together. And we hope that they become rewarding experiences.</b>
<p>We will approve your screening as soon as possible and inform you by email once it is approved. More information regarding technical questions will be included in the following email.</b>
<p>Here is your login information so you can edit the information for the screening once it is approved.</p>
<p>Login at <a href=\"http://esperando.cc/esperando/screenings/manage-screenings\">http://esperando.cc/esperando/screenings/manage-screenings</a>.</p>
<p>Thanks,<br/>
Vincent Moon & Lulacruza</p>
</body>
</html>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Additional headers
$headers .=  'From: ' . lc_screenings_get_email(get_option('screenings_notify_from_name'), get_option('screenings_notify_from_email')). "\r\n";

if(!empty($backup))
{
	$headers .=  'Cc: ' . $backup . "\r\n";
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
$notify = get_option('screenings_notify');
$sub = "New screening";
$msg = 'There is a new SCREENING awaiting your approval';
$head = 'From: ' . lc_screenings_get_email(get_option('screenings_notify_from_name'), get_option('screenings_notify_from_email')). "\r\n";

if ($count < 1) {
	if (mail($notify,$sub,$msg,$head)) {
		// success
	} 
	else {
		// fail
	}	
}

$msg = "<p>Thank you for creating a Screening of <b>Esperando el Tsunami</b></p>
<p>We will approve your screening as soon as possible and inform you by email once it has been approved.</p>
<p>Please add <b>" . get_option('screenings_notify_from_email') . "</b> to your address book to prevent the email from being categorized as junk mail.</p>
<p>You should receive an email shortly with the details you just registered and your log-in info for <a href=\"http://www.esperando.cc/\">www.esperando.cc</a> so you can edit and manage your event. Please make sure you have received this email.</p>
<p>Thanks,</p>
<p>Vincent Moon & Lulacruza</p>";

if ($count < 1) {
	return $msg;
}
else {
	return '<p class="dest upper">Thank you for creating a Screening!</p>
	<p>Your screening has already been submitted, please check your email.</p>';
}

?>
