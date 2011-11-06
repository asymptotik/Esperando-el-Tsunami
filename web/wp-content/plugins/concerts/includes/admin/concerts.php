<?php
/**
	* File: view_concerts
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>

<?php
global $wpdb;
$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events ORDER BY active asc, id desc" );

$sceeningsActive = 0;
$sceeningsOpen = 0;
$sceeningsAll = 0;

?>
<div class="wrap">
	<h2>Concerts <a class="add-new-h2" href="admin.php?page=concerts&action=concert_new">Add New</a></h2>
	<table class="wp-list-table widefat fixed bookmarks">
	<thead>
	  <tr>
			<th class="lc-column">Place</th>
			<th class="lc-column">Date</th>
			<th class="lc-column">Max att.</th>
			<th class="lc-column">Full</th>
			<th class="lc-column">Active</th>
	  </tr>
	</thead>
	<tfoot>
	<tr>
		<th class="manage-column lc-column" style="" scope="col">Venue Name</th>
		<th class="manage-column lc-column" style="" scope="col">Date</th>
		<th class="manage-column lc-column" style="" scope="col">Max att.</th>
		<th class="manage-column lc-column" style="" scope="col">Full</th>
		<th class="manage-column lc-column" style="" scope="col">Active</th>
	</tr>
  </tfoot>
		  
	<?php if(count($events) > 0) {
		foreach ($events as $event) {

		if ($event->active == 1) $sceeningsActive++;
		if ($event->status == 0) $sceeningsOpen++;
		$sceeningsAll++;
		$plugin_url = plugin_dir_url( __FILE__ ) . "../../";
		?>
		<tr>

			 <td class="column-name">
				<strong>
					<a class="row-title" title="Edit ÒDocumentationÓ" href="admin.php?page=concerts&action=concert_view&concert_id=<?php echo $event->id ?>"><?php echo stripslashes($event->venue_name);?></a>
				</strong>
				<br>
				<div class="row-actions">
				  <span class="view">
					  <a href="admin.php?page=concerts&action=concert_view&concert_id=<?php echo $event->id ?>">View</a> |
					</span>
					<span class="edit">
					  <a href="admin.php?page=concerts&action=concert_edit&concert_id=<?php echo $event->id ?>">Edit</a> |
					</span>
					<span class="delete">
					  <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this Concert.\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=concert_delete&amp;concert_id=$event->id", 'delete-concert_' . $event->id )  ?>">Delete</a>
					</span>
				</div>
			</td>
			<td><?php echo $event->dateandtime;?></td>
			<td><?php echo $event->venue_capacity;?></td>
			<td>
					<?php if($event->status == 0) :?>
					  <a href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=concert_status&amp;concert_id=$event->id", 'update-concert_' . $event->id )  ?>"><img src="<?php echo $plugin_url . "images/block_16_grey.png" ?>"></a>
					<?php else :?>
					  <a href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=concert_status&amp;concert_id=$event->id", 'update-concert_' . $event->id )  ?>"><img src="<?php echo $plugin_url . "images/block_16.png" ?>"></a>
					<?php endif;?>
			</td>
			<td>
					<?php if($event->active == 0) :?>
					  <a href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=concert_activate&amp;concert_id=$event->id", 'update-concert_' . $event->id )  ?>"><img src="<?php echo $plugin_url . "images/tick_16_grey.png" ?>"></a>
					<?php else :?>
					  <a href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=concert_activate&amp;concert_id=$event->id", 'update-concert_' . $event->id )  ?>"><img src="<?php echo $plugin_url . "images/tick_16.png" ?>"></a>
					<?php endif;?>
			</td>
		</tr>
	<?php   } // endforeach ?>
	<?php } else { // endif ?>
			<tr class="no-items">
	    <td class="colspanchange" colspan="5">No Concerts found.</td>
	  </tr>
	<?php } ?>
	
</table>
<p><b>Total:</b> <?php echo $sceeningsAll; ?></p>
<p><b>Active:</b> <?php echo $sceeningsActive; ?></p>
<p><b>Open for attendants:</b> <?php echo $sceeningsOpen; ?></p>

</div>
