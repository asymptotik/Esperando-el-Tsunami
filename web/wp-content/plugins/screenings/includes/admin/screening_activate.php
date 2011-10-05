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
$id = $_POST['screening_id'];	

global $wpdb;
$events = $wpdb->get_results("SELECT * FROM wp_screenings_events WHERE id = '$id'");

foreach ($events as $event) {
	$lastRecord = $event;
}

if ($lastRecord->active == 1) {
	$wpdb->update( 'wp_screenings_events', array( 'active' => 0), array( 'id' => $lastRecord->id));	
	echo "<p>".stripslashes($lastRecord->place).' has been deactivated'.'</p>';
}
else {
	$wpdb->update( 'wp_screenings_events', array( 'active' => 1), array( 'id' => $lastRecord->id));	
	echo "<p>".$lastRecord->place.' has been activated'.'</p>';
	
	// multiple recipients
	$to  = $lastRecord->email;
	// subject
	$subject = 'Approval of your Private-Public Screening of Petites Planètes';
	// message
	$message = '
		<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			
			<p>Congratulations! Your <strong>Private-Public Screening</strong> of some of my films has been approved.<br>
The event is now featured in the screening calendar at http://petitesplanetes.cc/screenings/all/</p>

<p>As a host of a Private-Public Screening you can invite friends to your screening any way you prefer. In addition to this it will be possible for others to contact you via the <a href="http://www.petitesplanetes.cc/screenings/all">Attend a Screening</a> section on <a href="http://petitesplanetes.cc">www.petitesplanetes.cc</a>. Here people can request to be invited to your Private-Public Screening. We encourage you to reply to all the emails you might receive concerning your screening.</p>
<p>If you need to change any details regarding your Private-Public Screening or <strong>mark the screening as fully booked </strong>you can login at <a href="http://www.petitesplanetes.cc/screenings/manage/" target="_blank">http://www.petitesplanetes.cc/screenings/manage/</a>.Please make sure you display the <strong>Time</strong> for the screening correct. We use the 24-hour clock on the site. I also suggest that you let your guests know who you are and how you will screen the film? And if they should bring something? etc You can do this in the <strong>Additional Info</strong> field.</p> 


<p>We encourage you to <strong>spread the word</strong> about your <strong>Private-Public Screening</strong>. A good idea is to create a Facebook event for your screening - then it is easy to invite friends.</p>

<!--<p>You can download a PETITES PLANETES flyer and poster here</p>-->

<p>As a host you need to download the films you want to screen from the vimeo page of each film. You can email me if you have troubles during this process</p>

<p>If you would like to use a DVD player to screen the films then you can burn a playable DVD using a DVD burner application.
The easiest is to play the films via your computer. You can either connect it to a projector or one of those modern TVs, or simply screen it on your computer´s screen.</p>
<p>Please remember that my films are music films. I encourage you to make sure that you can screen the film properly and with good and clear sound.</p>
<p>For more info about the Private-Public Screenings please refer to <a href="http://petitesplanetes.cc/screenings/host-a-screening/">http://petitesplanetes.cc/screenings/host-a-screening/</a></p>

<p>Best Wishes and Good Luck!</p>

<p>Vincent Moon
<a href="http://petitesplanetes.cc">www.petitesplanetes.cc</a></p>

		</body>
			</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'From: Petites Planètes <vincentmoon@gmail.com>' . "\r\n";
	
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