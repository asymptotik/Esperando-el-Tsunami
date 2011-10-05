<?php
/**
	* File: screening_show
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
$itemID = $_POST['screening_id'];	

global $wpdb;
$events = $wpdb->get_results("SELECT * FROM wp_screenings_events WHERE id = $itemID");

foreach ($events as $event) {
	$lastRecord = $event;
}

echo '<p><b>Film: </b>'.stripslashes($lastRecord->film).'</p>';
echo '<p><b>Status: </b>';
	if ($lastRecord->status == 1){
		echo 'Fully booked';
	}
	else {
		echo 'Open for attendants';
	}
	echo'</p>';
echo '<p><b>Active: </b>';
		if ($lastRecord->active == 1){
			echo 'Activated';
		}
		else {
			echo 'Deactivated';
		}
		echo'</p>';
echo '<p><b>Place: </b>'.stripslashes($lastRecord->place).'</p>';
echo '<p><b>Adress: </b>'.stripslashes($lastRecord->address).'</p>';
echo '<p><b>Show Adress: </b>';
		if ($lastRecord->show_address == 1){
			echo 'This is not a public address';
		}
		else {
			echo 'Public address';
		}
		echo'</p>';
echo '<p><b>City: </b>'.stripslashes($lastRecord->city).'</p>';
echo '<p><b>ZipCode: </b>'.stripslashes($lastRecord->zipcode).'</p>';
echo '<p><b>Country: </b>'.stripslashes($lastRecord->country).'</p>';
echo '<p><b>Date And Time: </b>'.$lastRecord->dateandtime.'</p>';
echo '<p><b>Max Attendants: </b>'.$lastRecord->max.'</p>';
echo '<p><b>Additional: </b>'.stripslashes($lastRecord->additional).'</p>';
echo '<p><b>Name: </b>'.stripslashes($lastRecord->name).'</p>';
echo '<p><b>Email: </b>'.stripslashes($lastRecord->email).'</p>';
echo '<p><b>Phone: </b>'.$lastRecord->phone.'</p>';


?>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go back</a>
