<?php
global $wpdb;

extract(lc_screenings_get_vars(array('screening_id')));

$screening = get_lc_screening($screening_id);

extract(lc_screenings_get_vars(array(
'attend_email',
'attend_name',
'attend_number',
'attent_msg'
)));

$count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "screenings_attending WHERE email='%s' AND events_id='%s' LIMIT 1", $attend_email, $screening_id));

if ($count < 1) {

	$rows_affected = $wpdb->insert($wpdb->prefix . 'screenings_attending', array( 
		'events_id' => $screening_id,
		'email' => $attend_email,
		'name' => $attend_name,
		'message' => $attent_msg,
		'attendants' => $attend_number
		));
}

// multiple recipients
$to  = $screening->email;

// subject
$subject = 'Someone has requested an invitation for your Screening';
// message
$message = '
	<html>
<head>
	<title>'.$subject.'</title>
	</head>
<body>
<p>'.$attend_name.' has requested an invitation for your Screening<br />
	'.$attend_name.' has requested an invitation for '.$attend_number.' people.</p>
	<p>Here is a message from '.$attend_name.':</p>
	<p><em>'.$attent_msg.'</em></p>
	<p>&nbsp;</p>
<p>'.$attend_name.' is awaiting your reply, please reply directly to '.$attend_email.'.<br />
	</p>
	<p>If your Screening is fully booked please login and change status on <a href="'. site_url() .'/screenings/manage/">'. site_url() .'/screenings/manage/</a></p>
<p>Best Wishes,</p>
<p>Vincent Moon<br />
	<a href="'. site_url() .'">'. site_url() .'</a></p>
</body>
	</html>
	';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Additional headers
$headers .= 'From: ' . lc_screenings_get_email(get_option('screenings_notify_from_name'), get_option('screenings_notify_from_email')). "\r\n";
$headers .= 'Reply-To: '.$attend_email."\r\n";

if ($count < 1) {
	// Mail it
	if (mail($to, $subject, $message, $headers)){
		// success
	} 
	else {
		// fail
	}
	?>
	<p><b>Your invitation request has been sent. The host of this Screening will hopefully get back to you as soon as possible.</b></p>
	<?php 
}
else {
	?>
	<p><b>Your request has already been sent, please do not refresh this page.</b></p>
	<?php 
}
?>