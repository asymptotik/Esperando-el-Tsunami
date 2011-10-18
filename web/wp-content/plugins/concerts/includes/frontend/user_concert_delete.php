<?php
/**
	* File: user_concert_delete
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
$itemID = $_POST['concert_id'];	

global $wpdb;
$events = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE id = $itemID");
foreach ($events as $event) {
	$lastRecord = $event;
}

if (!$_POST['concert_delete_confirm'])
{
	echo 'Are you sure you want to delete: '.$lastRecord->place;
	echo '<form method="post" action="'.str_replace( "%7E", "~", $_SERVER["REQUEST_URI"]).'">';
		echo '<input type="hidden" name="user_concert_delete" value="true">';
		echo '<input type="hidden" name="concert_delete_confirm" value="true">';
		echo '<input type="hidden" name="concert_id" value="'.$event->id.'">';
		echo '<input type="submit" value="Yes" />';
		echo '</form>';
		echo '<a href="'.str_replace( "%7E", "~", $_SERVER["REQUEST_URI"]).'" title="go back">NO! -Go Back</a>';
	}
	else {
		$wpdb->query("DELETE FROM " . $wpdb->prefix . "concerts_events WHERE id = $itemID");
		echo '<p>'.$lastRecord->place.' has been deleted from your database</p>';
		echo '<a href="'.str_replace( "%7E", "~", $_SERVER["REQUEST_URI"]).'" title="go back">Go Back</a>';
	}
?>
