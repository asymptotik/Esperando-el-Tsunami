<?php
/**
	* File: user_screenings
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

global $wpdb;

//add slashes to the username and md5() the password
$user = $_SESSION['screenings_email'];
$pass = $_SESSION['screenings_password'];
//echo "SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc";
$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE email='$user' AND password='$pass' ORDER BY status asc, dateandtime desc" );

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
					$activate = '<input title="Click here to mark your screening as fully booked" type="image" src="' . lc_screenings_plugin_uri( 'images/btnfully_gray.png' ) . '" />';
				}
				else if($items->status == 1) {
					$activate = '<input title="Click here to mark your screening as open for attendants" type="image" src="' . lc_screenings_plugin_uri( 'images/btnfully.png' ) . '" />';
				}
				else {
					$activate = '';
				}
				
				$datetime = new DateTime($screening->dateandtime);
				$dateandtime = $datetime->format('m/d/Y H:i');
		?>
		
		<tr>
		<td class="glyph-btn"><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="screenings_user_delete"/>
			<input type="hidden" name="screening_id" value="<?php echo $items->id ?>"/>
			<input type="image" src="<?php echo lc_screenings_plugin_uri( 'images/btndelete.png' )?>" title="Click here to delete your screening" onclick="if ( confirm( 'You are about to delete this Screening.\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;"/>
		</form></td>
		<td class="glyph-btn"><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="screenings_user_edit"/>
			<input type="hidden" name="screening_id" value="<?php echo $items->id ?>"/>
			<input type="image" src="<?php echo lc_screenings_plugin_uri( 'images/btnedit.png' )?>" title="Click here to edit your screening"  />
		</form></td>
			<td><?php echo esc_html($items->place) ?></td>
			<td><?php echo esc_html($dateandtime) ?></td>
		<td><form method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
			<input type="hidden" name="action" value="screenings_user_status"/>
			<input type="hidden" name="screening_id" value="<?php echo $items->id ?>"/>
			<?php echo $activate ?>
			</form></td>
			</tr>
		<?php 
		}
		?>

	</table>
</div>
