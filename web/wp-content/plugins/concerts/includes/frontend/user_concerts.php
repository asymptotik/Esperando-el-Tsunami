<?php
/**
	* File: user_concerts
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

global $wpdb;

//add slashes to the username and md5() the password
$user = $_SESSION['concerts_email'];
$pass = $_SESSION['concerts_password'];
//echo "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc";
$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc" );

$rows = '';

foreach ($events as $items) {
	
	if($items->status == 0) {
		$activate = '<input title="Click here to mark your concert as fully booked" type="image" src="/concerts/wp-content/plugins/concerts/images/btnfully_gray.png" />';
	}
	else if($items->status == 1) {
		$activate = '<input title="Click here to mark your concert as open for attendants" type="image" src="/concerts/wp-content/plugins/concerts/images/btnfully.png" />';
	}
	else {
		$activate = '';
	}

	$rows .= '<tr>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_concert_delete" value="true">
		<input type="hidden" name="concert_id" value="'.$items->id.'">
		<input type="image" src="/concerts/wp-content/plugins/concerts/images/btndelete.png" title="Click here to delete your concert" />
	</form></td>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_concert_edit" value="true">
		<input type="hidden" name="concert_id" value="'.$items->id.'">
		<input type="image" src="/concerts/wp-content/plugins/concerts/images/btnedit.png" />
	</form></td>
		<td>'.stripslashes($items->place).'</td>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_concert_status" value="true">
		<input type="hidden" name="concert_id" value="'.$items->id.'">
		'.$activate.'
		</form></td>
		</tr>';
}

$table = '<table class="usereventlist">
<tr>
	<td class="icon"><b>Delete</b></td>
	<td class="icon"><b>Edit</b></td>
	<td ><b>Place</b></td>
	<td class="icon"><b>Fully Booked</b></td>
	</tr>
	'.$rows.'
	</table><br/><br/>';

return $table;
