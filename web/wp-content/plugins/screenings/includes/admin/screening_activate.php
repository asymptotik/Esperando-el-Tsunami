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

if ($screening->active == 1) {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'active' => 0), array( 'id' => $screening_id));	
	echo "<p>" . esc_html($screening->place) . ' has been deactivated'.'</p>';
}
else {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'active' => 1), array( 'id' => $screening_id));	
	echo "<p>" . esc_html($screening->place) . ' has been activated'.'</p>';
	
	$home_url = get_bloginfo('url', 'display');
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
			
			<p>Congratulations! Your Private-Public Screening has been approved.</p>
      <p>The screening is now featured in the screening calendar at <a href=" ' . $home_url . '/screenings/attend-a-screening/">' . $home_url . '/screenings/attend-a-screening/</a>.</p>

      <p>If you need to change any details regarding your Private-Public Screening or mark the screening as fully booked you can login at <a href="' . $home_url . '/screenings/manage-screenings/">' . $home_url . '/screenings/manage-screenings/</a>.</p>
      <p>Please make sure you display the <b>Time</b> for the screening correct. We use the 24-hour clock on the site. We also suggest that you let your guests know who you are and how you will screen the film. Also, if they should bring something (drinks, food to share, pillows etc). You can do this in the <b>Additional Info</b> field.</p>
			<p>The film is 80 minutes long.</p>
			
      <p>-----------------------------</p>
      
      <p><b>HOSTING</b></p>
      <p>As a host of a Private-Public Screening you can invite friends to your screening any way you prefer. In addition to this it will be possible for others to contact you via the <a href=" ' . $home_url . '/screenings/attend-a-screening/">Attend a Screening</a> section. Here people can request to be invited to your Private-Public Screening. We encourage you to reply to all the emails you might receive concerning your screening.</p>
      <p>We encourage you to <b>spread the word</b> about your <b>Private-Public Screening</b>. You can copy/paste information about the film from our website <a href="' . $home_url . '">www.esperando.cc</a>. A good idea is to create a Facebook event for your screening - then it is easy to invite friends. You can also post your event on the <a href="https://www.facebook.com/pages/Esperando-el-Tsunami/154059141355362">Esperando el Tsunami Facebook page</a>.</p>
      
      <p>-----------------------------</p>
      
      <p><b>DOWNLOADING THE FILM</b></p>
      <p>As a host you need to download the film from the following link. Please make sure to give yourself plenty of time since the file is big and will take a while to download. You can email us if you have troubles during this process.</p>
      <p><a href="http://www.lulacruza.com/downloads/ESPERANDOelTSUNAMI.zip">http://www.lulacruza.com/downloads/ESPERANDOelTSUNAMI.zip</a></p>
      
      <p>-----------------------------</p>
      
      <p><b>TECHNICAL SUGGESTIONS</b></p>
      <p>The easiest is to play the film via your computer. You can either connect it to a projector or one of those modern TVs, or simply screen it on your computer\'s screen. If you would like to use a DVD player to screen the film then you can burn a playable DVD using a DVD burner application.</p>
      <p><b>Please remember that Esperando el Tsunami is a music film. We encourage you to make sure that you can screen the film properly: In a dark and quiet room, and with good and clear sound.</b> This will make the experience enjoyable for everyone attending!</p>

      <p>-----------------------------</p>
      
      <p><b>FEEDBACK</b></p>
      <p>After the screening, we would love to hear from you! We encourage you and your guests to share about it online, and upload pictures of the event to Flickr. We would love to find out, so please post on our <a href="https://www.facebook.com/pages/Esperando-el-Tsunami/154059141355362">Facebook</a> and <a href="http://twitter.com/#!/esperandTsunami">Twitter</a> pages, tag us or use the tag #esperandoeltsunami.</p>
      <p>Lulacruza will be touring worldwide in 2012 through Private-Public Concerts. Please let your guests know that they can also host their own screening or a concert at their place (homes, community centers, art galleries, collective spaces, etc.). You can direct them to the <a href="http://esperando.cc/">www.esperando.cc</a> website and find out more about it on <a href="http://esperando.cc/esperando/concerts/host-a-concert-description/">HOST A CONCERT</a></p>
      
      <p>-----------------------------</p>
      
      <p>For more info about the Private-Public Screenings please refer to <a href="' . $home_url . '/screenings/host-a-screening/">' . $home_url . '/screenings/host-a-screening/</a></p>
      <p>Thanks for spreading the love!</p>

			<p>Vincent Moon & Lulacruza</p>

		</body>
			</html>';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'From: ' . lc_screenings_get_email(get_option('screenings_notify_from_name'), get_option('screenings_notify_from_email')). "\r\n";
	
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
