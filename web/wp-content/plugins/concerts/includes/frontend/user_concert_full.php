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

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

if ($concert->status == 0) {
	$wpdb->update($wpdb->prefix . 'concerts_events', array( 'status' => 1), array( 'id' => $concert->id));	
	echo "<p>".$concert->place.' has been set to fully booked'.'</p>';
}
else if ($concert->status == 1) {
	$wpdb->update($wpdb->prefix . 'concerts_events', array( 'status' => 0), array( 'id' => $concert->id));	
	echo "<p>".$concert->place.' has been opened for more attendants '.'</p>';
}
?>

<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
</div>
