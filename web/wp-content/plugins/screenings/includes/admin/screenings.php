<?php
/**
	* File: view_screenings
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>

<?php
global $wpdb;
$events = $wpdb->get_results( "SELECT * FROM wp_screenings_events ORDER BY active asc, id desc" );

$sceeningsActive = 0;
$sceeningsOpen = 0;
$sceeningsAll = 0;


?>
<div class="wrap">
	<h2>Edit Screening</h2>
	<table>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td style="width:250px;">Place</td>
		<td style="width:170px;">Date</td>
		<td style="width:70px;">Max att.</td>
		<td>Full </td>
		<td>Active </td>
	</tr>
	<?php foreach ($events as $event) :?>
		<?
		if ($event->active == 1) $sceeningsActive++;
		if ($event->status == 0) $sceeningsOpen++;
		$sceeningsAll++;
		?>
		<tr>
			<td>
				<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="screening_show" value="true">
					<input type="hidden" name="screening_id" value="<?=$event->id?>">
					<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/search_16.png" />
				</form>
			</td>
			<td>
				<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="screening_edit" value="true">
					<input type="hidden" name="screening_id" value="<?=$event->id?>">
					<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/pencil_16.png" />
				</form>
			</td>
			<td>
				<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="screening_delete" value="true">
					<input type="hidden" name="screening_id" value="<?=$event->id?>">
					<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/delete_16.png" />
				</form>
			</td>
			<td><?php echo stripslashes($event->place);?></td>
			<td><?php echo $event->dateandtime;?></td>
			<td><?php echo $event->max;?></td>
			<td>
				<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="screening_status" value="true">
					<input type="hidden" name="screening_id" value="<?=$event->id?>">
					<?php if($event->status == 0) :?>
						<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/block_16_grey.png" />
					<?php else :?>
						<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/block_16.png" />
					<?php endif;?>
				</form>
			</td>
			<td>
				<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="screening_activate" value="true">
					<input type="hidden" name="screening_id" value="<?=$event->id?>">
					<?php if($event->active == 0) :?>
						<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/tick_16_grey.png" />
					<?php else :?>
						<input type="image" src="http://anisland.cc/home/wp-content/plugins/screenings/images/tick_16.png" />
					<?php endif;?>
				</form>
			</td>
		</tr>
	<?php endforeach?>
</table>
<p><b>Total:</b> <?php echo $sceeningsAll; ?></p>
<p><b>Active:</b> <?php echo $sceeningsActive; ?></p>
<p><b>Open for attendants:</b> <?php echo $sceeningsOpen; ?></p>

</div>