<?php
/**
	* File: host
	* Type: 
  * @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

wp_enqueue_script('lc-concerts');

extract(lc_concerts_get_vars(array(
'concert_venue_city', 
'concert_venue_postalcode', 
'concert_venue_region_id',
'concert_venue_country')));

$concert_venue_country_id_name = "concert_venue_country_" . $concert_venue_region_id;
$concert_venue_country_id = lc_concerts_get_var($concert_venue_country_id_name);

$concert_venue_region_id = empty($concert_venue_region_id) ? 0 : $concert_venue_region_id;
$concert_venue_country_id = (empty($concert_venue_region_id) || empty($concert_venue_country_id)) ? 0 : $concert_venue_country_id;
$concert_venue_country = empty($concert_venue_country_id) ? $concert_venue_country : '';

if(!empty($concert_venue_country_id))
{
	$concert_venue_country_name = '';
	$concert_venue_country_object = get_lc_country($concert_venue_country_id);
	if(!empty($concert_venue_country_object))
		$concert_venue_country_name = $concert_venue_country_object->name;
}
else
{
	$concert_venue_country_name = $concert_venue_country;
}

$concert_venue_region_name = '';
if(!empty($concert_venue_region_id))
{
	$concert_venue_region_object = get_lc_region($concert_venue_region_id);
	if(!empty($concert_venue_region_object))
		$concert_venue_region_name = $concert_venue_region_object->name;
}

$region_schedule = get_lc_region_schedules($concert_venue_region_id);

?>
<div id="host_concerts" class="lc-host-form-narrow lc-host-form-2col">
  
  <form action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="concert_form" class="validate" id="concert_form">
    
    <input type="hidden" name="action" value="concerts_host_add" />
    <input type="hidden" name="concert_venue_region_id" value="<?php echo esc_attr($concert_venue_region_id) ?>" />
    <input type="hidden" name="concert_venue_country_id" value="<?php echo esc_attr($concert_venue_country_id) ?>" />
    <input type="hidden" name="concert_venue_country" value="<?php echo esc_attr($concert_venue_country) ?>" />
    <input type="hidden" name="concert_venue_city" value="<?php echo esc_attr($concert_venue_city) ?>" />
    <input type="hidden" name="concert_venue_postalcode" value="<?php echo esc_attr($concert_venue_postalcode) ?>" />
    <table>
      <tr>
        <td colspan="3">
					<strong>
          (r) required fields<br/>
          (v) fields that will be visible to the public on esperando.cc
          </strong>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div class="divider-dotted-full">&nbsp;</div>
        </td>
      </tr>
      <tr>
	      <td>
	        <label>Venue Region:</label><br/>
		      <?php echo esc_html($concert_venue_region_name) ?>
	      </td>
	      <td class="lc-host-form-empty-col">&nbsp;</td>
				<td>
				  <label>Venue Country:</label><br/>
				  <?php echo esc_html($concert_venue_country_name) ?>
				</td>
			</tr>
      <tr>
	      <td>
	        <label>Venue City:</label><br/>
		      <?php echo esc_html($concert_venue_city) ?>
	      </td>
	      <td class="lc-host-form-empty-col">&nbsp;</td>
				<td>
				  <label>Venue Postal Code:</label><br/>
				  <?php echo esc_html($concert_venue_postalcode) ?>
				</td>
			</tr>
      <tr>
			  <td colspan="3">
          <label>This is the timeframe that we will be in your region!</label>
					<select tabindex="1" id="concert_region_schedule_id" name="concert_region_schedule_id">
						  <option class="required" value="0">Select a Time Frame</option>
						  <?php foreach ($region_schedule as $schedule) { 
						  	
						  	$start_date = date('M jS Y', strtotime($schedule->startdate));
						  	$end_date = date('M jS Y', strtotime($schedule->enddate));
						  	?>
						  <option value="<?php echo esc_attr($schedule->id); ?>"><?php echo esc_html($schedule->name . " " . $start_date . " - " . $end_date); ?></option>
						<?php } ?>
						  <option value="-1">Other (suggest a date)</option>
					</select>
        </td>
      </tr>
      
      <tr id="concert_date_wrapper" style="display:none;">
        <td>
          <label for="concert_date">Suggest a Date mm/dd/yyyy (r)(v)</label><br/>
          <input class="date datepicker required initialValue" tabindex="2" type="text" name="concert_date" id="concert_date" alt="mm/dd/yyyy" /> 
        </td>
      </tr>
      
      <tr>
        <td>
          <label for="concert_venue_name">Venue Name (r)(v)</label><br/>
          <input class="required initialValue" tabindex="3" type="text" name="concert_venue_name" id="concert_venue_name" alt="Venue Name" /><br/>
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td>
          <label for="concert_venue_address">Venue Address (r)(v)</label><br/>
          <input class="required initialValue" tabindex="3" type="text" name="concert_venue_address" id="concert_venue_address" alt="Street name &amp; number" /><br/>
          <input type="checkbox" tabindex="4" name="concert_address_show" value="1" /><span class="sub">don't make this info visible!</span>
        </td>
			</tr>
			<tr valign="bottom">
				<td>
          <label for="concert_venue_type">What type of space will you host the P/P Concert in? IE: House, Garden, DIY art space, Rooftop, etc.. (r)(v)</label><br/>
          <input class="required initialValue" tabindex="5" type="text" id="concert_venue_type" name="concert_venue_type" alt="Venue Type" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td valign="bottom">
          <label for="concert_venue_size">What is the size of the Venue (1000 square meters, 2000 square feet, etc) (r)(v)</label><br/>
          <input class="required initialValue" tabindex="6" type="text" id="concert_venue_size" name="concert_venue_size" alt="Venue Size" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="concert_venue_capacity">Venue Maximum Attendants (r)(v)</label><br/>
          <input class="required digits initialValue" tabindex="7" type="text" name="concert_venue_capacity" id="concert_venue_capacity" alt="Maximum Attendants" /><br/>
          <input type="checkbox" tabindex="8" name="concert_status" value="1" /><span class="sub">Already fully booked</span>
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
				<td>
          <label for="concert_time">Concert Time hh:mm (r)(v)</label><br/>
          <input class="required time timepicker initialValue" tabindex="9" type="text" name="concert_time" id="concert_time" alt="hh:mm" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="3">
        	<label for="concert_additional">Additional Info</label><br/>
          <textarea name="concert_additional_info" tabindex="10" class="initialValue" id="concert_additional_info" rows="6" alt="Let your guests know who you are and how you will screen the film? And if they should bring something? etc. ">Let your guests know who you are and how you will screen the film? And if they should bring something? etc. </textarea>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div class="divider-dotted-full">&nbsp;</div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <strong>The info below is needed so you are able to log in and manage your event and so we are able to contact you if needed </strong>
        </td>
      </tr>
      
      <tr>
        <td>
          <label for="concert_host_name">Your Name (r)</label><br/>
          <input class="required initialValue" tabindex="22" name="concert_host_name" id="concert_host_name" type="text" alt="Name" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td>
          <label for="concert_host_email">Your Email (r)</label><br/>
          <input class="required email initialValue" tabindex="23" name="concert_host_email" id="concert_host_email" type="text" alt="your@e-mail.com" />
        </td>
      </tr>
      
      <tr>
        <td>
          <label for="concert_host_address">Your Address (r)</label><br/>
          <input class="required initialValue" tabindex="24" name="concert_host_address" id="concert_host_address" type="text" alt="Address" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td>
          <label for="concert_host_city">Your City (r)</label><br/>
          <input class="required initialValue" tabindex="25" name="concert_host_city" id="concert_host_city" type="text" alt="City" />
        </td>
      </tr>

      <tr>
        <td>
          <label for="concert_host_postalcode">Your Postal Code (r)</label><br/>
          <input class="required initialValue" tabindex="26" name="concert_host_postalcode" id="concert_host_postalcode" type="text" alt="Postal Code" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td>
          <label for="concert_host_phone">Your Phone Number (r)</label><br/>
          <input class="required initialValue" tabindex="27" name="concert_host_phone" id="concert_host_phone" type="text" alt="Phone" />
        </td>
      </tr>
      
      <tr>
        <td>
          <label for="concert_password">Your Password</label><br/>
          <input class="initialValue" tabindex="28" name="concert_password" id="concert_password" type="password" alt="password" />
        </td>
      </tr>
    </table>
    <a class="btn-rect btn-rect-lg" href="javascript:void(0)" tabindex="29" onclick="javascript:lc_concerts.submit_host_form()"><div class="btn-rect-text">submit</div></a>
  </form>
</div>