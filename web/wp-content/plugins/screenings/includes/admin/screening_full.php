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
global $wpdb;
extract(lc_screenings_get_vars(array('screening_id')));
check_admin_referer('update-screening_' . $screening_id); 

$screening = get_lc_screening($screening_id);

if ($screening->status == false) {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'status' => 1), array( 'id' => $screening_id));	
	echo "<p>".esc_html($screening->place).' has been set to full'.'</p>';
}
else if ($screening->status == true) {
	$wpdb->update( $wpdb->prefix . 'screenings_events', array( 'status' => 0), array( 'id' => $screening_id));	
	echo "<p>".esc_html($screening->place).' has been opened for more attendants '.'</p>';
}
?>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>
