<?php
/**
	* File: screening_delete
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php

global $wpdb;
extract(lc_screenings_get_vars(array('screening_id')));
check_admin_referer('delete-screening_' . $screening_id); 

if(!empty($screening_id))
{
	$screening = get_lc_screening($screening_id);
	$wpdb->query("DELETE FROM wp_screenings_events WHERE id = $screening_id");
	echo '<p>'. esc_html($screening->place) .' has been deleted from your database</p>';
}
else 
{
	echo '<p>Could not delete screening. Item not found.</p>';
}
?>

<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>