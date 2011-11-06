<?php
/**
	* File: user_concert_delete
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/

global $wpdb;

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

$wpdb->query( $wpdb->prepare("DELETE FROM " . $wpdb->prefix . "concerts_events WHERE id = '%s'", $concert_id));
?>

<p><?php echo esc_html($concert->venue_name) ?> has been deleted from your database</p>
<a href="<?php echo str_replace( "%7E", "~", $_SERVER["REQUEST_URI"])?>" title="go back">Go Back</a>