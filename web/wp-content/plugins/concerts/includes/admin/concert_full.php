<?php
/**
	* File: concert_full
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
global $wpdb;
extract(lc_concerts_get_vars(array('concert_id')));
check_admin_referer('update-concert_' . $concert_id); 

$concert = get_lc_concert($concert_id);

if ($concert->status == false) {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'status' => 1), array( 'id' => $concert_id));	
	echo "<p>".esc_html($concert->place).' has been set to full'.'</p>';
}
else if ($lastRecord->status == true) {
	$wpdb->update( $wpdb->prefix . 'concerts_events', array( 'status' => 0), array( 'id' => $concert_id));	
	echo "<p>".esc_html($concert->place).' has been opened for more attendants '.'</p>';
}
?>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>
