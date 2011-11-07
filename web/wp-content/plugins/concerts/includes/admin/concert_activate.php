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

if ($concert->active == 1) {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'active' => 0), array( 'id' => $concert_id));	
	echo "<p>" . esc_html($concert->place) . ' has been deactivated'.'</p>';
}
else {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'active' => 1), array( 'id' => $concert_id));	
	echo "<p>" . esc_html($concert->place) . ' has been activated'.'</p>';
	
	$home_url = get_bloginfo('url', 'display');
	// multiple recipients
	$to  = $concert->host_email;
	// subject
	$subject = 'Approval of your Private-Public Concert of Lulacruza';
	// message
	$message = '
		<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			<p>Congratulations! Your <b>Private-Public Concert</b> has been approved. The concert is now featured in the concert calendar at <a href="' . $home_url . '/concerts/attend-a-concert/">' . $home_url . '/concerts/attend-a-concert/</a></p>
			<p>THERE IS IMPORTANT INFORMATION IN THIS EMAIL. PLEASE READ IN ITS ENTIRETY</p>
			<p>If you need to change any details regarding your Private-Public Concert or mark the concert as fully booked you can login at <a href="' . $home_url . '/concerts/manage-concerts/">' . $home_url . '/concerts/manage-concerts/</a>.</p>
			<p>Please make sure you display the <b>Time</b> for the concert correct. We use the 24-hour clock on the site. I also suggest that you let your guests know who you are and how you will screen the film? And if they should bring something? etc You can do this in the <b>Additional Info</b> field.</p>
			<p>----------------------------------</p>
			<p>As a host of a Private-Public Concert you can invite friends to your concert any way you prefer. In addition to this it will be possible for others to contact you via the <a href="' . $home_url . '/concerts/attend-a-concert/">Attend a Concert</a> section. Here people can request to be invited to your Private-Public Concert. We encourage you to reply to all the emails you might receive concerning your concert.</p>
			<p>We encourage you to <b>spread the word</b> about your <b>Private-Public Concert</b>. A good idea is to create a Facebook event for your concert - then it is easy to invite friends.</p>
			<p>----------------------------------</p>
			<p>As a host there are many things that we will need to work on together.</p>
			<p>We put together this amazing Toolkit for you to download. This download package will provide you with all the information you need to get your event off of the ground, including: how to build collaborative volunteer groups; how to create a space that is inviting and appropriate for the event; how to satisfy the technical and logistical requirements of the event; how to promote your event; and how to fund-raise or sell tickets for the event.</p>
			<p>Here&#39;s the link.</p>
			<p>Over the next few weeks and months we will be in close contact regarding the preparations for the concert. In order for this to work we need full participation and collaboration. This new touring method requires that we work together on making the concert a profound and enriching experience.</p>
			<p>----------------------------------</p>
			<p>For more info about the Private-Public Concerts please refer to <a href="' . $home_url . '/concerts/host-a-concert-description/">' . $home_url . '/concerts/attend-a-concert-description/</a></p>
			<p>Looking forward to meeting and connecting</p>
			<p>Lulacruza - Ale & Luis</p>
			<p>----------------------------------</p>
			<p>Disclaimer: While Lulacruza would like to accept every offer for a Private/Public Concert, it will not always be possible to visit every host that we connect with. Distance, timing and travel costs are important factors that will determine where and when we will be able to perform. In order to keep the Private/Public Concerts affordable for everybody, we are supporting the tour with Official Concert at Festivals and Cultural Institutions. These events will partly dictate our schedule and allow us to come to your region of the world and perform Private/Public Concerts in your space.</p>
			<p>We reserve the right to change or cancel a P/P Concert at our own discretion within a reasonable time frame.</p>
		  </body>
	</html>';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'From: ' . lc_concerts_get_email(get_option('concerts_notify_from_name'), get_option('concerts_notify_from_email')). "\r\n";
	
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
