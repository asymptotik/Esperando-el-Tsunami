<?php
/**
	* File: concert_show
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
global $wpdb;

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

?>

<div class="wrap">
		<div id="icon-index" class="icon32"><br></div>
		<h2><?php _e('Concert') ?> <a href="admin.php?page=concerts&action=concert_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'concert'); ?></a></h2>
		<div id="poststuff" class="metabox-holder">

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
					
					$concert_venue_region_object = get_lc_region($concert_venue_region_id);
					if(!empty($concert_venue_region_object)) 
					{
						$concert_venue_region_name = $concert_venue_region_object->name;
					}
					
					$concert_venue_country_name = '';
					if(!empty($concert_venue_country_id))
					{
						$concert_venue_country_object = get_lc_country($concert_venue_country_id);
						if(!empty($concert_venue_country_object))
						{
							$concert_venue_country_name = $concert_venue_country_object->name;
						}
					}
					else 
					{
						$concert_venue_country_name = $concert_venue_country;
					}
					
					$concert_region_schedule_name = '';
					$concert_dateandtime_text = '';
					$concert_dateandtime_title = 'Date &amp; Time:';
					$datetime = strtotime($concert_dateandtime);
					
					if($concert_region_schedule_id > 0)
					{
						$concert_region_schedule_object = get_lc_region_schedule($concert_region_schedule_id);
						if(!empty($concert_venue_country_object))
						{
							$start_date = date('M jS Y', strtotime($concert_region_schedule_object->startdate));
						  $end_date = date('M jS Y', strtotime($concert_region_schedule_object->enddate));
						  $concert_region_schedule_name = $schedule->name . " " . $start_date . " - " . $end_date;
						  $concert_dateandtime_text = date('G:i');
						  $concert_dateandtime_title = 'Time:';
						}
						else
						{
							$concert_region_schedule_name = 'Custom / Request';
							$concert_dateandtime_text = date('M jS Y G:i');
						}
					}
					else
					{
						$concert_region_schedule_name = 'Custom / Request';
						$concert_dateandtime_text = date('M jS Y G:i');
					}
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
					
					$concert_venue_region_name = '';
					$concert_venue_country_name = '';
				}
			?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3><label for="name"><?php echo esc_html($concert_venue_name)?></label></h3>
					</div>
			    <table class="data-table edit-concert concert-form-table">
			      <tr valign="top" class="alternate">
			        <td class="first">Venue Name:</td>
			        <td><?php echo esc_html($concert_venue_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Venue Address:</td>
			        <td><?php echo esc_html($concert_venue_address)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Venue City:</td>
			        <td><?php echo esc_html($concert_venue_city)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Venue Postal Code:</td>
			        <td><?php echo esc_html($concert_venue_postalcode)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Venue Region:</td>
			        <td><?php echo esc_html($concert_venue_region_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Venue Country:</td>
			        <td><?php echo esc_html($concert_venue_country_name)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Region Schedule:</td>
			        <td><?php echo esc_html($concert_region_schedule_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first"><?php echo esc_html($concert_dateandtime_title)?></td>
			        <td><?php echo esc_html($concert_dateandtime_text)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Venue Type:</td>
			        <td><?php echo esc_html($concert_venue_type)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Venue Size:</td>
			        <td><?php echo esc_html($concert_venue_size)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Venue Capacity:</td>
			        <td><?php echo esc_html($concert_venue_capacity)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Additional Info:</td>
			        <td><?php echo esc_html($concert_additional_info)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Concert Host Name:</td>
			        <td><?php echo esc_html($concert_host_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Concert Host Email:</td>
			        <td><?php echo esc_html($concert_host_email)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Concert Host Address:</td>
			        <td><?php echo esc_html($concert_host_address)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Concert Host City:</td>
			        <td><?php echo esc_html($concert_host_city)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Concert Host Postal Code:</td>
			        <td><?php echo esc_html($concert_host_postalcode)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Concert Host Phone:</td>
			        <td><?php echo esc_html($concert_host_phone)?></td>
					  </tr>
					  </table>
				</div>
			</div>
		</div>
	</div>
<br>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go back</a>
