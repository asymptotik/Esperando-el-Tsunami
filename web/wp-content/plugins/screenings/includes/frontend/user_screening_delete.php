<?php
/**
	* File: user_screening_delete
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/

global $wpdb;

extract(lc_screenings_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

$wpdb->query( $wpdb->prepare("DELETE FROM " . $wpdb->prefix . "screenings_events WHERE id = '%s'", $screening_id));
?>

<p><?php echo esc_html($screening->place) ?> has been deleted from your database</p>
<a href="<?php echo str_replace( "%7E", "~", $_SERVER["REQUEST_URI"])?>" title="go back">Go Back</a>