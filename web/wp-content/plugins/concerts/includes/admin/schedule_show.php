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
$regions = get_lc_regions();
?>
<div class="wrap">
	<h2>Edit Region Schedule <a class="add-new-h2" href="admin.php?page=concerts-regions&action=new">Add New</a></h2> 
	
	<?php foreach ($regions as $region) {?>
	<h3><?php echo $region->name ?></h3>
	
		<?php
			$plugin_url = plugin_dir_url( __FILE__ );
			//$the_query = "SELECT * FROM " . $wpdb->prefix . "concerts_region_schedule WHERE id='" . $region->id . "' ORDER BY startdate desc";
			//echo $the_query ."<br>";
			$region_scheds = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_region_schedule WHERE region_id='" . $region->id . "' ORDER BY startdate desc");
		?>
			
	  <?php if (count($region_scheds) <= 0) {?>
	    no scedule found for this region.
	    <?php } else { ?>
			<table class="wp-list-table widefat fixed bookmarks">
			<thead>

			  <tr>
					<th class="lc-column">Name</th>
					<th class="lc-column">Start Date</th>
					<th class="lc-column">End Date</th>
			  </tr>
			</thead>
			<tfoot>
			<tr>
				<th class="manage-column lc-column" style="" scope="col">Name</th>
				<th class="manage-column lc-column" style="" scope="col">Start Date</th>
				<th class="manage-column lc-column" style="" scope="col">End Date</th>
			</tr>
		  </tfoot>
	
			<?php foreach ($region_scheds as $sched) {?>
				<tr>
				  <td class="column-name">
						<strong>
							<a class="row-title" title="Edit ÒDocumentationÓ" href="admin.php?page=concerts-regions&action=edit&sched_id=<?php echo $sched->id ?>"><?php echo stripslashes($sched->name);?></a>
						</strong>
						<br>
						<div class="row-actions">
							<span class="edit">
							  <a href="admin.php?page=concerts-regions&action=edit&sched_id=<?php echo $sched->id ?>">Edit</a> |
							</span>
							<span class="delete">
							  <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this link \'Documentation\'\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=concerts-regions&amp;action=delete&amp;sched_id=$sched->id", 'delete-concert-sched_' . $sched->id )  ?>">Delete</a>
							</span>
						</div>
					</td>
					<td><?php echo $sched->startdate;?></td>
					<td><?php echo $sched->enddate;?></td>
				</tr>
			<?php } // foreach ?>
			</table>
		<?php } // region?>
		
	<?php } // region?>
  
</div>
