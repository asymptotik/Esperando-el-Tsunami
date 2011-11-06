<?php
/**
	* File: concert_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( ! empty($concert_id) ) {
	$heading = sprintf( __( '<a href="%s">Concert</a> / Edit Concert' ), 'admin.php?page=concerts' );
	$submit_text = __('Update Concert');
	$form = '<form name="editconcert" id="editconcert" method="post" action="admin.php?page=concerts">';
	$nonce_action = 'update-concert_' . $concert_id;
} else {
	$heading = sprintf( __( '<a href="%s">Concert</a> / Add New Concert' ), 'admin.php?page=concerts' );
	$submit_text = __('Add Concert');
	$form = '<form name="addconcert" id="addconcert" method="post" action="admin.php?page=concerts">';
	$nonce_action = 'add-concert';
}

require_once(ABSPATH . 'wp-admin/includes/meta-boxes.php');

add_screen_option('layout_columns', array('max' => 2) );

$user_ID = isset($user_ID) ? (int) $user_ID : 0;
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
		<h2><?php echo $heading; ?> <a href="admin.php?page=concerts&action=concert_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'concert'); ?></a></h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
		
			<?php if ( $concert_id ) : ?>
			<input type="hidden" name="action" value="concert_update" />
			<input type="hidden" name="concert_id" value="<?php echo (int) $concert_id; ?>" />
			<?php else: ?>
			<input type="hidden" name="action" value="concert_add" />
			<?php endif; ?>

			<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID ?>" /> 

			<?php 
				if ( !empty($concert_id) ) 
				{					
					$concert_venue_name = $concert->venue_name;
					$concert_venue_address = $concert->venue_address;
					$concert_venue_city = $concert->venue_city;
					$concert_venue_postalcode = $concert->venue_postalcode;
					$concert_venue_show_address = $concert->venue_show_address;
					$concert_venue_region_id = $concert->venue_region_id;
					$concert_venue_country_id = $concert->venue_country_id;
					$concert_venue_country = (empty($concert->venue_country_id) || $concert->venue_country_id = 0) ? $concert->venue_country : '';
					$concert_region_schedule_id = $concert->region_schedule_id;
					$concert_dateandtime = $concert->dateandtime;
					$concert_venue_type = $concert->venue_type;
					$concert_venue_size = $concert->venue_size;
					$concert_venue_capacity = $concert->venue_capacity;
					$concert_additional_info = $concert->additional_info;
					$concert_host_name = $concert->host_name;
					$concert_host_email = $concert->host_email;
					$concert_host_address = $concert->host_address;
					$concert_host_city = $concert->host_city;
					$concert_host_postalcode = $concert->host_postalcode;
					$concert_host_phone = $concert->host_phone;
					$concert_pass = '';
				}
				else 
				{
					$concert_venue_name = '';
					$concert_venue_address = '';
					$concert_venue_city = '';
					$concert_venue_postalcode = '';
					$concert_venue_show_address = '';
					$concert_venue_region_id = '';
					$concert_venue_country_id = '';
					$concert_venue_country = '';
					$concert_region_schedule_id = '';
					$concert_dateandtime = '';
					$concert_venue_type = '';
					$concert_venue_size = '';
					$concert_venue_capacity = '';
					$concert_additional_info = '';
					$concert_host_name = '';
					$concert_host_email = '';
					$concert_host_address = '';
					$concert_host_city = '';
					$concert_host_postalcode = '';
					$concert_host_phone = '';
					$concert_pass = '';
				}
	
				$regions = get_lc_regions('name', 'asc');
			?>
			
			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="linksubmitdiv" class="postbox ">
						<div class="handlediv" title="Click to toggle">
							<br>
						</div>
						<h3 class="hndle">
							<span><?php _e('Save Concert') ?></span>
						</h3>
						<div class="inside">
							<div id="submitlink" class="submitbox">
								<div id="major-publishing-actions">
								  <?php if(!empty($concert_id)) { ?>
										<div id="delete-action">
										  <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this concert \'<?php echo esc_attr($concert_venue_name) ?>\'\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=delete&amp;concert_id=$concert_id", 'delete-concert_' . $concert_id )  ?>">Delete</a>
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

			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3>
							<label for="name"><?php _e('Concert') ?></label>
						</h3>
						<div class="inside">
					    <table class="form-table edit-concert concert-form-table">
					      <tr valign="top">
					        <td class="first">Venue Name:</td>
					        <td><input name="concert_venue_name" type="text" value="<?php echo esc_attr($concert_venue_name)?>" alt="Mike\'s place / Caf&eacute; Luna / etc" /></td>
					      </tr>
					      
					      <tr valign="top">
									<td class="first">Venue Region:</td>
									<td>
									<select id="concert_venue_region_id" name="concert_venue_region_id">
									  <option value="0">Select a Region</option>
									  <?php foreach ($regions as $region) { 
										  $selected = ($region->id == $concert_venue_region_id);
									  ?>
									  <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($region->id); ?>"><?php echo esc_html($region->name); ?></option>
									<?php } ?>
									</select>
									</td>
								</tr>
									
								<tr valign="top">
									<td class="first">Venue Country:</td>
									<td>
									  <?php foreach ($regions as $region) { 
										  $countries = get_lc_countries_by_region($region->id);
										  ?>
										  <?php if(count($countries) > 0) { ?>
												<select class="concert_venue_country_select" id="concert_venue_country_<?php echo esc_attr($region->id) ?>" style="display:none;" name="concert_venue_country_<?php echo esc_attr($region->id) ?>">
												  <option value="0">Select a Country</option>
												  <?php foreach ($countries as $country) { 
												    $selected = ($country->id == $concert_venue_country_id);?>
												    <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($country->id); ?>"><?php echo esc_html($country->name); ?></option>
												  <?php } ?>
												</select>
											<?php } ?>
										<?php } ?>
										
										<input name="concert_venue_country" style="display:none;" type="text" id="concert_venue_country" value="<?php echo esc_attr($concert_venue_country)?>"/></td>
									</td>
								</tr>
								
					      <tr valign="top">
					        <td class="first">Venue Address:</td>
					        <td>
					          <input name="concert_venue_address" type="text" value="<?php echo esc_attr($concert_venue_address)?>" alt="Street name &amp; number" />
					          <p><input type="checkbox" name="concert_venue_hide_address" value="1" <?php if($concert_venue_show_address != 1) echo "checked";?> />
					          hide this field!</p>
					        </td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Venue City:</td>
					        <td><input name="concert_venue_city" type="text" value="<?php echo esc_attr($concert_venue_city)?>" alt="Venue City" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Venue Postal Code:</td>
					        <td><input name="concert_venue_postalcode" type="text" class="required" value="<?php echo esc_attr($concert_venue_postalcode)?>" alt="Venue Postal Code" /></td>
					      </tr>
					      
					      <tr valign="top">
					        <td class="first">Region Schedule:</td>
					        <td>
					        	<?php foreach ($regions as $region) { 
					        		$region_schedule = get_lc_region_schedules($region->id);
										  ?>
										  <?php if(count($region_schedule) > 0) { ?>
												<select class="concert_region_schedule_select" id="concert_region_schedule_<?php echo esc_attr($region->id) ?>" style="display:none;" name="concert_region_schedule_<?php echo esc_attr($region->id) ?>">
												  <option value="0">Select a Schedule</option>
												  <?php foreach ($region_schedule as $schedule) { 
												  	$start_date = date('M jS Y', strtotime($schedule->startdate));
						  							$end_date = date('M jS Y', strtotime($schedule->enddate));
												    $selected = ($schedule->id == $concert_region_schedule_id);
												    ?>
												    <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($region->id); ?>"><?php echo esc_html($schedule->name . " " . $start_date . " - " . $end_date); ?></option>
												  <?php } ?>
												</select>
											<?php } ?>
										<?php } ?>
										
					        </td>
					      </tr>

					      <tr valign="top">
					        <td class="first">Concert Date &amp; Time (yyyy-mm-dd hh:mm):</td>
					        <td><input name="concert_dateandtime" type="text" value="<?php echo esc_attr($concert_dateandtime)?>" alt="date/month/year" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Venue Type (Cafe, House, Theater, Concert Hall, etc.):</td>
					        <td><input name="concert_venue_type" type="text" id="concert_venue_type" value="<?php echo esc_attr($concert_venue_type)?>" alt="Venue Type" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Venue Size (500 sq/meters etc.):</td>
					        <td><input name="concert_venue_size" type="text" id="concert_venue_size" value="<?php echo esc_attr($concert_venue_size)?>" alt="Venue Size" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Venue Capacity:</td>
					        <td><input name="concert_venue_capacity" type="text" id="concert_venue_capacity" value="<?php echo esc_attr($concert_venue_capacity)?>" alt="Venue Capacity" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Additional Information:</td>
					        <td rowspan="2"><textarea name="concert_additional_info" rows="6" alt="Additional Information"><?php echo esc_attr($concert_additional_info)?></textarea></td>
					      </tr>
					      <tr valign="top">
					        <td><div align="right"></div></td>
					      </tr>								
					      <tr valign="top">
					        <td class="first">Concert Host Name:</td>
					        <td><input name="concert_host_name" type="text" value="<?php echo esc_attr($concert_host_name)?>" alt="Host Name" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Concert Host Address:</td>
					        <td><input name="concert_host_address" type="text" value="<?php echo esc_attr($concert_host_address)?>" alt="Street name &amp; number" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Concert Host City:</td>
					        <td><input name="concert_host_city" type="text" value="<?php echo esc_attr($concert_host_city)?>" alt="Host City" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Concert Host Postal Code:</td>
					        <td><input name="concert_host_postalcode" type="text" class="required" value="<?php echo esc_attr($concert_host_postalcode)?>" alt="Concert Host Postal Code" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Phone:</td>
					        <td><input name="concert_host_phone" type="text" value="<?php echo esc_attr($concert_host_phone)?>" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Concert Host Email:</td>
					        <td><input name="concert_host_email" type="text" value="<?php echo esc_attr($concert_host_email)?>" alt="your@e-mail.com" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">New Password:</td>
					        <td><input name="concert_password" type="text" value="" /></td>
					      </tr>
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
    
    