<?php
/**
	* File: user_screening_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
extract(lc_screenings_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

$datetime = new DateTime($screening->dateandtime);
$newdate = $datetime->format('m/d/Y');
$newTime = $datetime->format('H:i');

wp_enqueue_script('lc-screenings');

?>
<script type="text/javascript">
	$(document).ready(function() {
		
						
		$("#screening_update").submit(function() {
			
			var error = false;
			
			$("input.required,select.required").each(function() {
				if($(this).val()=="" || ($(this).hasClass("initialValue")&&$(this).val()==$(this).data("od"))) {
					error = true;
				}
			});
			
			if(error) {
				alert("Please fill in all fields marked as required");
			}else{
				$("#screening_update").submit();
			}
			
			
			return false;
		});
	});
</script>
<div class="lc-host-form-narrow">
<p> 
  <form class="validate" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="screening_update" id="screening_update">
    <a href="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" title="go back" >&lt; Go back to Events list</a></p><br /><br />
    
    <input type="hidden" name="action" value="screenings_user_update" />
    <input type="hidden" name="screening_id" value="<?php echo esc_attr($screening->id) ?>" />
    <table  border="0" class="cacona">
      <tr>
        <td><label>Place</label></td>
        <td><input class="required" name="screening_place" type="text" value="<?php echo esc_attr($screening->place) ?>"/></td>
      </tr>
      <tr>
        <td><label>Address</label></td>
        <td>
          <input class="required" name="screening_address" type="text" value="<?php echo esc_attr($screening->address) ?>" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="screening_address_show" value="1" <?php if($screening->show_address != 1) echo "checked";?> />
          hide this field!
        </td>
      </tr>
      <tr>
        <td><label>Date &amp; Time:</label></td>
        <td><input class="required datepicker" name="screening_date" type="text" value="<?php echo esc_attr($newdate) ?>" alt="date/month/year" /> <input class="required timepicker" type="text" name="screening_time" value="<?php echo esc_attr($newTime) ?>" /></td>
      </tr>
      <tr>
        <td><label>Maximum attendants:</label></td>
        <td><input class="required" name="screening_max" type="text" id="screening_max" value="<?php echo esc_attr($screening->max) ?>" alt="Maximum Attendants" /></td>
      </tr>
      <tr>
        <td><label>Additional Info:</label></td>
        <td rowspan="2"><textarea class="required" name="screening_additional" rows="6" alt="additional information"><?php echo esc_html($screening->additional) ?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
      </tr>
      <tr>
        <td><label>Phone:</label></td>
        <td><input class="required" name="screening_phone" type="text" value="<?php echo esc_attr($screening->phone) ?>" /></td>
      </tr>
      <tr>
        <td> </td>
        <td><input type="submit" class="submit" id="submit" value="SAVE" /></td>
      </tr>
    </table>
    
  </form>
</div><br/>

