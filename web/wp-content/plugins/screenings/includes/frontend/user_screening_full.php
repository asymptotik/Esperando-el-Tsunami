<?php
/**
	* File: user_screening_full
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<div class="screen-wrapper" style="margin-bottom:0;padding-bottom:0;">
<?php

extract(lc_screenings_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

if ($screening->status == 0) {
	$wpdb->update($wpdb->prefix . 'screenings_events', array( 'status' => 1), array( 'id' => $screening->id));	
	echo "<p>".$screening->place.' has been set to fully booked'.'</p>';
}
else if ($screening->status == 1) {
	$wpdb->update($wpdb->prefix . 'screenings_events', array( 'status' => 0), array( 'id' => $screening->id));	
	echo "<p>".$screening->place.' has been opened for more attendants '.'</p>';
}
?>

<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
</div>