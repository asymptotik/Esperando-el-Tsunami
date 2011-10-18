<?php

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( ! empty($sched_id) ) {
	$heading = sprintf( __( '<a href="%s">Region Schedule</a> / Edit Region Schedule Segment' ), 'admin.php?page=concerts-regions' );
	$submit_text = __('Update Segment');
	$form = '<form name="editschedule" id="editschedule" method="post" action="admin.php?page=concerts-regions">';
	$nonce_action = 'update-concert-schedule_' . $sched_id;
} else {
	$heading = sprintf( __( '<a href="%s">Region Schedule</a> / Add New Schedule Segment' ), 'admin.php?page=concerts-regions' );
	$submit_text = __('Add Segment');
	$form = '<form name="addschedule" id="addschedule" method="post" action="admin.php?page=concerts-regions">';
	$nonce_action = 'add-concert-schedule';
}

require_once(ABSPATH . 'wp-admin/includes/meta-boxes.php');

add_screen_option('layout_columns', array('max' => 2) );

$user_ID = isset($user_ID) ? (int) $user_ID : 0;

$regions = get_lc_regions('name', 'asc');
?>

<?php if ( isset( $_GET['added'] ) ) : ?>
<div id="message" class="updated"><p><?php _e('Schedule added.'); ?></p></div>
<?php endif; ?>

<?php
if ( !empty($form) )
	echo $form;
if ( !empty($link_added) )
	echo $link_added;
	
echo "\n";
wp_nonce_field( $nonce_action ); echo "\n";
?>
	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>
		<h2><?php echo $heading; ?> <a href="admin.php?page=concerts-regions&action=new" class="add-new-h2"><?php echo esc_html_x('Add New', 'schedule segment'); ?></a></h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
		
			<?php if ( $sched_id ) : ?>
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="sched_id" value="<?php echo (int) $sched_id; ?>" />
			<?php else: ?>
			<input type="hidden" name="action" value="add" />
			<?php endif; ?>

			<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID ?>" /> 

			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="linksubmitdiv" class="postbox ">
						<div class="handlediv" title="Click to toggle">
							<br>
						</div>
						<h3 class="hndle">
							<span><?php _e('Save Schedule Segment') ?></span>
						</h3>
						<div class="inside">
							<div id="submitlink" class="submitbox">
								<!--  div id="minor-publishing">
									<div style="display: none;">
										<input id="save" class="button" type="submit" value="Save" name="save">
									</div>
									<div id="minor-publishing-actions">
										<div id="preview-action">
											<a class="preview button" tabindex="4" target="_blank" href="http://codex.wordpress.org/">Visit Link</a>
										</div>
										<div class="clear"></div>
									</div>
									<div id="misc-publishing-actions">
										<div class="misc-pub-section misc-pub-section-last">
											<label class="selectit" for="link_private"> <input id="link_private" type="checkbox" value="N" name="link_visible"> Keep this link private </label>
										</div>
									</div>
								</div -->
								<div id="major-publishing-actions">
								  <?php if(!empty($sched_id)) { ?>
										<div id="delete-action">
									 	 <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this Schedule Segment \'<?php echo esc_attr($schedule->name) ?>\'\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=concerts-regions&amp;action=delete&amp;sched_id=$sched_id", 'delete-concert-sched_' . $sched_id )  ?>">Delete</a>
										</div>
									<?php } ?>
									<div id="publishing-action">
										<input id="publish" class="button-primary" type="submit" value="<?php echo $submit_text ?>" accesskey="p" tabindex="4" name="save">
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>


<?php 

if ( empty($sched_id) ) {
	$sched_region_id = 0;
	$sched_name = '';
	$sched_desc = '';
	$sched_startdate = '';
	$sched_enddate = '';
}
else 
{
	$sched_region_id = $schedule->region_id;
	$sched_name = $schedule->name;
	$sched_desc = $schedule->desc;
	$sched_startdate = $schedule->startdate;
	$sched_enddate = $schedule->enddate;
}
?>
			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3>
							<label for="name"><?php _e('Segment') ?></label>
						</h3>
						<div class="inside">
							<table class="form-table edit-concert-sched  concert-form-table">
								<tbody>
								  <tr valign="top">
										<td class="first">Region:</td>
										<td>
										<select id="sched_region_id" name="sched_region_id">
										<?php foreach ($regions as $region) { 
											$selected = ($region->id == $sched_region_id);
										?>
										  <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($region->id); ?>"><?php echo esc_html($region->name); ?></option>
										<?php } ?>
										</select>
										</td>
									</tr>
								
									<tr valign="top">
										<td class="first">Name:</td>
										<td><input id="sched_name" type="text" tabindex="1" value="<?php echo esc_attr($sched_name); ?>" size="30" name="sched_name"></td>
									</tr>
									<tr valign="top">
										<td class="first">Description:</td>
										<td><div id='editor'><textarea rows='5' id='sched_desc' name='sched_desc' tabindex='2' id='sched_desc'><?php echo esc_html($sched_desc); ?></textarea></div></td>
									</tr>
									<tr valign="top">
										<td class="first">Start Date:</td>
										<td><input id="sched_startdate" type="text" tabindex="2" value="<?php echo esc_attr($sched_startdate); ?>" size="30" name="sched_startdate"><br>
										<p>date format: yyyy-mm-dd</p>
										</td>
									</tr>
									<tr valign="top">
										<td class="first">End Date:</td>
										<td><input id="sched_enddate" class="code" type="text" tabindex="3" value="<?php echo esc_attr($sched_enddate); ?>" size="30" name="sched_enddate">
										<p>date format: yyyy-mm-dd</p>
										</td>
									</tr>
								</tbody>
							</table>
							<br>
						</div>
					</div>
					<div id="postdiv" class="postarea"></div>
					<div id="normal-sortables" class="meta-box-sortables"></div>
					<input type="hidden" id="referredby" name="referredby" value="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" />
				</div>
			</div>
		</div>
	</div>
</form>
