<?php
/**
	* File: attend
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

$itemID = $_POST['concert_id'];	
global $wpdb;

$events = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE id = '$itemID'");
foreach ($events as $event) { 
	$concert = $event; 
	}
	
	
if (isset($_POST['attend_form'])) {

	$email = $_POST['attend_email'];
	$name = $_POST['attend_name'];
	$number = $_POST['attend_number'];
	$msg =	$_POST['attent_msg'];

	$events = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE id = '$itemID'");
	foreach ($events as $event) {
		$lastRecord = $event;
	}

	$check = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "concerts_attending WHERE email='$email' AND message='$msg'");

	$count = 0;
	foreach ($check as $i) {
		$count++;
	}
	if ($count < 1) {

		$rows_affected = $wpdb->insert($wpdb->prefix . 'concerts_attending', array( 
			'events_id' => $itemID,
			'email' => $email,
			'name' => $name,
			'message' => $msg,
			'attendants' => $number
			));
	}
	// multiple recipients
	$to  = $lastRecord->email;
	// subject
	$subject = 'Someone has requested an invitation for your Concert';
	// message
	$message = '
		<html>
	<head>
		<title>'.$subject.'</title>
		</head>
	<body>
	<p>'.$name.' has requested an invitation for your Concert<br />
		'.$name.' has requested an invitation for '.$number.' people.</p>
		<p>Here is a message from '.$name.':</p>
		<p><em>'.$msg.'</em></p>
		<p>&nbsp;</p>
	<p>'.$name.' is awaiting your reply, please reply directly to '.$email.'.<br />
		</p>
		<p>If your Concert is fully booked please login and change status on <a href="http://petitesplanetes.cc/concerts/manage/">http://petitesplanetes.cc/concerts/manage/</a></p>
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
		return '<p><b>Your invitation request has been sent. The host of this Concert will hopefully get back to you as soon as possible.</b></p>';
	}
	else {
		return '<p><b>Your request has already been sent, please don\'t refresh this page.</b></p>';
	}
}
else {
	$output = '	
	
	<script type="text/javascript">
	$(document).ready(function() {
		
		$(".initialValue").each(function() {
			$(this).data("od",$(this).val());
			$(this).click(function() {
				if($(this).val() == $(this).data("od")) $(this).val("");
			});
			$(this).blur(function() {
				if($(this).val() == "") $(this).val($(this).data("od"));
			});
		});
				
		$("#attent_concert").submit(function() {
			
			var error = false;
			
			$("input.required,select.required").each(function() {
				if($(this).val()=="" || ($(this).hasClass("initialValue")&&$(this).val()==$(this).data("od"))) {
					//$(this).val("---ERROR---");
					//alert($(this).attr("id"));
					error = true;
				}
			});
			
			if(error) {
				alert("Please fill in all fields marked as required");
			}else{
				$("#attent_concert").submit();
			}
			
			
			return false;
		});
	});
</script>
	<div id="attent_concert">
		<p>This message will be sent to the host of the Concert at <b>'.$concert->place.'</b> in '.$concert->city.'.<br /></p>
	<form class="validate" id="attent_concert" name="attent_concert" method="post"action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
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
		<!--<input id="submit" type="image"src="http://anisland.cc/home/wp-content/themes/anisland/images/btnsubmit.jpg"/>-->
	</form>
		</div>';
	return $output;
}
?>
