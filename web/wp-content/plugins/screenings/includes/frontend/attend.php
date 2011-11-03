<?php
/**
	* File: attend
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

extract(lc_screenings_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

if (isset($_POST['attend_form'])) {

extract(lc_concerts_get_vars(array(
'attend_email',
'attend_name',
'attend_number',
'attent_msg'
)));

	$count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "concerts_attending WHERE email='%s' AND message='%s' LIMIT 1", $attend_email, $attent_msg));

	if ($count < 1) {

		$rows_affected = $wpdb->insert($wpdb->prefix . 'concerts_attending', array( 
			'events_id' => $concert_id,
			'email' => $attend_email,
			'name' => $attend_name,
			'message' => $attent_msg,
			'attendants' => $attend_number
			));
	}
	// multiple recipients
	$to  = $lastRecord->email;
	// subject
	$subject = 'Someone has requested an invitation for your Screening';
	// message
	$message = '
		<html>
	<head>
		<title>'.$subject.'</title>
		</head>
	<body>
	<p>'.$name.' has requested an invitation for your Screening<br />
		'.$name.' has requested an invitation for '.$number.' people.</p>
		<p>Here is a message from '.$name.':</p>
		<p><em>'.$msg.'</em></p>
		<p>&nbsp;</p>
	<p>'.$name.' is awaiting your reply, please reply directly to '.$email.'.<br />
		</p>
		<p>If your Screening is fully booked please login and change status on <a href="http://petitesplanetes.cc/concerts/manage/">http://petitesplanetes.cc/concerts/manage/</a></p>
	<p>Best Wishes,</p>
	<p>Vincent Moon<br />
		<a href="http://www.petitesplanetes.cc">www.petitesplanetes.cc</a></p>
	</body>
		</html>
		';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Additional headers
	$headers .= 'From: Petites Planètes by Vincent Moon <concerts@petitesplanetes.cc>' . "\r\n";
	$headers .= 'Reply-To: '.$email."\r\n";
	
	if ($count < 1) {
		// Mail it
		if (mail($to, $subject, $message, $headers)){
			// success
		} 
		else {
			// fail
		}
		return '<p><b>Your invitation request has been sent. The host of this Screening will hopefully get back to you as soon as possible.</b></p>';
	}
	else {
		return '<p><b>Your request has already been sent, please don\'t refresh this page.</b></p>';
	}
}
else {?>
	
<div id="attent_concert">
	<p>This message will be sent to the host of the Screening at <b><?php echo esc_html($concert->place) ?></b> in <?php echo esc_html($concert->city) ?><br /></p>
	<form class="validate" id="attent_concert" name="attent_concert" method="post"action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
	<p>
		<input type="hidden"name="attend_form"value="true">
		<input type="hidden" name="concert_id" value="'.$itemID.'">
		
		<div class="fff1"><div class="fff2">
		<label>E-mail</label>
		<span class="required initialValue">*</span>
		</div>
		<div class="fff3">
		<input  class="required email initialValue" type="text"name="attend_email"value="your@e-mail.com" alt="your@e-mail.com"/></div>
		</div>
		
		<div class="fff1"><div class="fff2">
		<label>Your Name</label>
		<span class="required">*</span></div>
		<div class="fff3">
		<input  class="required initialValue" type="text"name="attend_name"value="Your Name" alt="Your Name"/></div>
		</div>
		
		
		<div class="fff1">
		<div class="fff4">
	<span>Request Invitation for
	<select name="attend_number">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="4">5</option>
		<option value="4">6</option>
		<option value="4">7</option>
		<option value="4">8</option>
		<option value="4">9</option>
		<option value="4">10</option>
		</select>
		people</span><span class="required">*</span></div>
		</div>
		
		<div class="fff1"><div class="fff2">
		<label>Message</label>
		<span class="required initialValue">*</span></div><div class="fff3" style="height: 120px">
		<textarea class="required" rows="9"name="attent_msg"></textarea><div class="clr"></div></div>
		<div class="clr"></div>
		</div>

		<div class="fff1" style="clear:both;"> <input type="submit" class="submit" id="submit" value="REQUEST INVITE" /></div>
	</form>
</div>
		
<?php } ?>
