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
extract(lc_concerts_get_vars(array('concert_id')));
check_admin_referer('delete-concert_' . $concert_id); 

if(!empty($concert_id))
{
	$concert = get_lc_concert($concert_id);
	$wpdb->query("DELETE FROM wp_concerts_events WHERE id = $concert_id");
	echo '<p>'. esc_html($concert->place) .' has been deleted from your database</p>';
}
else 
{
	echo '<p>Could not delete concert. Item not found.</p>';
}
?>

<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go Back</a>
