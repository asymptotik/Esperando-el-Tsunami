<?php
/**
	* File: host
	* Type: 
  * @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

wp_enqueue_script('lc-concerts');
$regions = get_lc_regions('name', 'asc');
?>
<div id="host_concerts" class="lc-host-form-narrow lc-host-form-2col">
  
  <form action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="concert_form" class="validate" id="concert_form">
    <input type="hidden" name="action" value="concerts_host_lookup" />
    <table>
      <tr>
        <td colspan="3">
					<strong>
          (r) required fields<br/>
          (v) fields that will be visible to the public on petitesplanetes.cc
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
	        <label for="concert_venue_region_id">Region:</label><br/>
		      <select id="concert_venue_region_id" name="concert_venue_region_id">
										  <option value="0">Select a Region</option>
										  <?php foreach ($regions as $region) { ?>
										  <option value="<?php echo esc_attr($region->id); ?>"><?php echo esc_html($region->name); ?></option>
										<?php } ?>
					</select>
	      </td>
	      <td class="lc-host-form-empty-col">&nbsp;</td>
				<td>
				  <label for="concert_venue_country">Country:</label><br/>
				  <?php foreach ($regions as $region) { 
					  $countries = get_lc_countries_by_region($region->id);
					  ?>
					  <?php if(count($countries) > 0) { ?>
							<select class="concert_venue_country_select" tabindex="1" id="concert_venue_country_<?php echo esc_attr($region->id) ?>" style="display:none;" name="concert_venue_country_<?php echo esc_attr($region->id) ?>">
							  <option value="0">Select a Country</option>
							  <?php foreach ($countries as $country) { 
							    $selected = ($country->id == $concert_country_id);?>
							    <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($country->id); ?>"><?php echo esc_html($country->name); ?></option>
							  <?php } ?>
							</select>
						<?php } ?>
					<?php } ?>
					
					<input name="concert_venue_country" tabindex="2" style="display:none;" type="text" id="concert_venue_country" value="<?php echo esc_attr($concert_country)?>"/>
					</td>
			</tr>
      
      <tr>
			  <td colspan="3">
          If you represent a Festival or Cultural Institution and would like to host an Official Lulacruza Concert, send us an <a href="mailto:<?php echo get_option('screenings_notify'); ?>?subject=Lulacruza Official Performance Request"> email</a> 
        </td>
      </tr>
      
      <tr>
			  <td>
          <label for="concert_city">City (r)(v)</label><br/>
          <input class="required initialValue" tabindex="3" name="concert_venue_city" id="concert_venue_city" type="text" alt="City" />
        </td>
        <td class="lc-host-form-empty-col">&nbsp;</td>
        <td>
				  <label for="concert_postalcode">Postal Code (r)(v)</label><br/>
				  <input class="required initialValue" tabindex="4" type="text" name="concert_venue_postalcode" id="concert_venue_postalcode" alt="Postal Code" />
				</td>

      </tr>

    </table>
    <a class="btn-rect btn-rect-lg" tabindex="5" onclick="javascript:lc_concerts.submit_host_form()"><div class="btn-rect-text">submit</div></a>
  </form>
</div>