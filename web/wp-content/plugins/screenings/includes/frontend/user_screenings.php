<?php
/**
	* File: user_screenings
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

global $wpdb;

//add slashes to the username and md5() the password
$user = $_SESSION['screenings_email'];
$pass = $_SESSION['screenings_password'];
//echo "SELECT * FROM wp_screenings_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc";
$events = $wpdb->get_results( "SELECT * FROM wp_screenings_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc" );

$rows = '';

foreach ($events as $items) {
	
	if($items->status == 0) {
		$activate = '<input title="Click here to mark your screening as fully booked" type="image" src="/screenings/wp-content/plugins/screenings/images/btnfully_gray.png" />';
	}
	else if($items->status == 1) {
		$activate = '<input title="Click here to mark your screening as open for attendants" type="image" src="/screenings/wp-content/plugins/screenings/images/btnfully.png" />';
	}
	else {
		$activate = '';
	}

	$rows .= '<tr>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_screening_delete" value="true">
		<input type="hidden" name="screening_id" value="'.$items->id.'">
		<input type="image" src="/screenings/wp-content/plugins/screenings/images/btndelete.png" title="Click here to delete your screening" />
	</form></td>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_screening_edit" value="true">
		<input type="hidden" name="screening_id" value="'.$items->id.'">
		<input type="image" src="/screenings/wp-content/plugins/screenings/images/btnedit.png" />
	</form></td>
		<td>'.stripslashes($items->place).'</td>
	<td><form method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
		<input type="hidden" name="user_screening_status" value="true">
		<input type="hidden" name="screening_id" value="'.$items->id.'">
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