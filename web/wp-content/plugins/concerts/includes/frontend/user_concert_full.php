<?php
/**
	* File: user_concert_full
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<div class="screen-wrapper" style="margin-bottom:0;padding-bottom:0;">
<?php
$itemID = $_POST['concert_id'];	

global $wpdb;
$events = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE id = $itemID");

foreach ($events as $event) {
	$lastRecord = $event;
}

if ($lastRecord->status == 0) {
	$wpdb->update($wpdb->prefix . 'concerts_events', array( 'status' => 1), array( 'id' => $lastRecord->id));	
	echo "<p>".$lastRecord->place.' has been set to fully booked'.'</p>';
}
else if ($lastRecord->status == 1) {
	$wpdb->update($wpdb->prefix . 'concerts_events', array( 'status' => 0), array( 'id' => $lastRecord->id));	
	echo "<p>".$lastRecord->place.' has been opened for more attendants '.'</p>';
}
?>

<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a><br /><br /><br /><br />
</div>
