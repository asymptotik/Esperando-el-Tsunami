<?php
/**
	* File: screening_full
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

if ($lastRecord->status == false) {
	$wpdb->update( 'wp_screenings_events', array( 'status' => 1), array( 'id' => $lastRecord->id));	
	echo "<p>".$lastRecord->place.' has been set to full'.'</p>';
}
else if ($lastRecord->status == true) {
	$wpdb->update( 'wp_screenings_events', array( 'status' => 0), array( 'id' => $lastRecord->id));	
	echo "<p>".$lastRecord->place.' has been opened for more attendants '.'</p>';
}
?>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>