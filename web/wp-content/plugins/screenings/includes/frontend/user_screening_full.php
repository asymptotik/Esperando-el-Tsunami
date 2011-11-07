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

global $wpdb;

extract(lc_screenings_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

echo "screening->status: $screening->status";

if ($screening->status == 0) {
	$wpdb->update($wpdb->prefix . 'screenings_events', array( 'status' => 1), array( 'id' => $screening->id));	
	$message = "has been set to fully booked.";
}
else if ($screening->status == 1) {
	$wpdb->update($wpdb->prefix . 'screenings_events', array( 'status' => 0), array( 'id' => $screening->id));	
	$message = "has been opened for more attendants.";
}
?>
<p><?php echo esc_html($screening->place) . " " . $message; ?></p>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
</div>
