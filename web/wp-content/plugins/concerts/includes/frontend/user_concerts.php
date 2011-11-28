<?php
/**
	* File: user_concerts
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

global $wpdb;

//add slashes to the username and md5() the password
$user = $_SESSION['concerts_email'];
$pass = $_SESSION['concerts_password'];
//echo "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc";
$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE host_email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc" );

?>
<div class="lc-host-form-narrow">
	<table class="usereventlist">
	<tr>
		<td class="glyph-btn"></td>
		<td class="glyph-btn"></td>
		<td><b>Place</b></td>
		<td><b>Date</b></td>
		<td><b>Fully Booked</b></td>
		</tr>
		<?php 
			foreach ($events as $items) {
				
				if($items->status == 0) {
					$activate = '<input title="Click here to mark your concert as fully booked" type="image" src="' . lc_concerts_plugin_uri( 'images/btnfully_gray.png' ) . '" />';
				}
				else if($items->status == 1) {
					$activate = '<input title="Click here to mark your concert as open for attendants" type="image" src="' . lc_concerts_plugin_uri( 'images/btnfully.png' ) . '" />';
				}
				else {
					$activate = '';
				}
				
				$datetime = new DateTime($items->dateandtime);
				$dateandtime = $datetime->format('Y-m-d H:i');
		?>
		
		<tr>
		<td class="glyph-btn"><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="concerts_user_delete"/>
			<input type="hidden" name="concert_id" value="<?php echo $items->id ?>"/>
			<input type="image" src="<?php echo lc_concerts_plugin_uri( 'images/btndelete.png' )?>" title="Click here to delete your concert" onclick="if ( confirm( 'You are about to delete this Concert.\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;"/>
		</form></td>
		<td class="glyph-btn"><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="concerts_user_edit"/>
			<input type="hidden" name="concert_id" value="<?php echo $items->id ?>"/>
			<input type="image" src="<?php echo lc_concerts_plugin_uri( 'images/btnedit.png' )?>" title="Click here to edit your concert"  />
		</form></td>
			<td><?php echo esc_html($items->venue_name) ?></td>
			<td><?php echo esc_html($dateandtime) ?></td>
		<td><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="concerts_user_status"/>
			<input type="hidden" name="concert_id" value="<?php echo $items->id ?>"/>
			<?php echo $activate ?>
			</form></td>
			</tr>
		<?php 
		}
		?>

	</table>
</div>
