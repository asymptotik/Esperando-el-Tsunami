<?php
/**
	* File: concert_activate
	* Type: 
  * @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php
extract(lc_concerts_get_vars(array('concert_id')));
check_admin_referer('update-concert_' . $concert_id); 

global $wpdb;
$concert = get_lc_concert($concert_id);

if ($lastRecord->active == 1) {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'active' => 0), array( 'id' => $concert_id));	
	echo "<p>" . esc_html($concert->place) . ' has been deactivated'.'</p>';
}
else {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'active' => 1), array( 'id' => $concert_id));	
	echo "<p>" . esc_html($concert->place) . ' has been activated'.'</p>';
	
	$home_rl = get_bloginfo('url', 'display');
	// multiple recipients
	$to  = $concert->email;
	// subject
	$subject = 'Approval of your Private-Public Concert of Lulacruza';
	// message
	$message = '
		<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			
			<p>Congratulations! Your <strong>Private-Public Concert</strong> has been approved.<br>
The concert is now featured in the concert calendar at ' . $home_rl . 'concerts/all/</p>

<p>As a host of a Private-Public Concert you can invite friends to your concert any way you prefer. In addition to this it will be possible for others to contact you via the <a href="' . $home_rl . 'concerts/all">Attend a Concert</a> section on <a href="' . $home_rl . '">' . $home_rl . '</a>. Here people can request to be invited to your Private-Public Concert. We encourage you to reply to all the emails you might receive concerning your concert.</p>
<p>If you need to change any details regarding your Private-Public Concert or <strong>mark the concert as fully booked </strong>you can login at <a href="' . $home_rl . 'concerts/manage/" target="_blank">' . $home_rl . 'concerts/manage/</a>.Please make sure you display the <strong>Time</strong> for the concert correct. We use the 24-hour clock on the site. I also suggest that you let your guests know who you are and how you will screen the film? And if they should bring something? etc You can do this in the <strong>Additional Info</strong> field.</p> 

<p>We encourage you to <strong>spread the word</strong> about your <strong>Private-Public Concert</strong>. A good idea is to create a Facebook event for your concert - then it is easy to invite friends.</p>

<p>As a host you need to download the films you want to screen from the vimeo page of each film. You can email me if you have troubles during this process</p>

<p>If you would like to use a DVD player to screen the films then you can burn a playable DVD using a DVD burner application.
The easiest is to play the films via your computer. You can either connect it to a projector or one of those modern TVs, or simply screen it on your computer´s screen.</p>
<p>Please remember that my films are music films. I encourage you to make sure that you can screen the film properly and with good and clear sound.</p>
<p>For more info about the Private-Public Concerts please refer to <a href="' . $home_rl . 'concerts/host-a-concert/">' . $home_rl . 'concerts/host-a-concert/</a></p>

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
	$headers .= 'From: ' . get_option('concerts_notify_from_name') . ' ' . get_option('concerts_notify_from_email') . "\r\n";
	
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
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>
<?
