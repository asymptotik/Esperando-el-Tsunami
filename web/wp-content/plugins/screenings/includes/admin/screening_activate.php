<?php
/**
	* File: screening_activate
	* Type: 
  * @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php
extract(lc_screenings_get_vars(array('screening_id')));
check_admin_referer('update-screening_' . $screening_id); 

global $wpdb;
$screening = get_lc_screening($screening_id);

if ($lastRecord->active == 1) {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'active' => 0), array( 'id' => $screening_id));	
	echo "<p>" . esc_html($screening->place) . ' has been deactivated'.'</p>';
}
else {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'active' => 1), array( 'id' => $screening_id));	
	echo "<p>" . esc_html($screening->place) . ' has been activated'.'</p>';
	
	// multiple recipients
	$to  = $screening->email;
	// subject
	$subject = 'Approval of your Private-Public Screening of Esperando el Tsunami';
	// message
	$message = '
		<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			
			<p>Congratulations! Your <strong>Private-Public Screening</strong> has been approved.<br>
The screening is now featured in the screening calendar at ' . bloginfo('url') . 'screenings/all/</p>

<p>As a host of a Private-Public Screening you can invite friends to your screening any way you prefer. In addition to this it will be possible for others to contact you via the <a href="' . bloginfo('url') . 'screenings/all">Attend a Concert</a> section on <a href="' . bloginfo('url') . '">' . bloginfo('url') . '</a>. Here people can request to be invited to your Private-Public Concert. We encourage you to reply to all the emails you might receive concerning your screening.</p>
<p>If you need to change any details regarding your Private-Public Screening or <strong>mark the screening as fully booked </strong>you can login at <a href="' . bloginfo('url') . 'screenings/manage/" target="_blank">' . bloginfo('url') . 'screenings/manage/</a>.Please make sure you display the <strong>Time</strong> for the screening correct. We use the 24-hour clock on the site. I also suggest that you let your guests know who you are and how you will screen the film? And if they should bring something? etc You can do this in the <strong>Additional Info</strong> field.</p> 

<p>We encourage you to <strong>spread the word</strong> about your <strong>Private-Public Screening</strong>. A good idea is to create a Facebook event for your screening - then it is easy to invite friends.</p>

<p>As a host you need to download the films you want to screen from the vimeo page of each film. You can email me if you have troubles during this process</p>

<p>If you would like to use a DVD player to screen the films then you can burn a playable DVD using a DVD burner application.
The easiest is to play the films via your computer. You can either connect it to a projector or one of those modern TVs, or simply screen it on your computer´s screen.</p>
<p>Please remember that my films are music films. I encourage you to make sure that you can screen the film properly and with good and clear sound.</p>
<p>For more info about the Private-Public Screenings please refer to <a href="' . bloginfo('url') . 'screenings/host-a-screening/">' . bloginfo('url') . 'screenings/host-a-screening/</a></p>

<p>Best Wishes and Good Luck!</p>

<p>Lulacruza
<a href="http://lulacruza">www.lulacruza.com</a></p>

		</body>
			</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'From: ' . get_option('screenings_notify_from_name') . ' ' . get_option('screenings_notify_from_email') . "\r\n";
	
	$message = stripslashes($message);

	// Mail it
	if (mail($to, $subject, $message, $headers)){
		// success
	} 
	else {
		// fail
	}
	
}

?>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
<?
