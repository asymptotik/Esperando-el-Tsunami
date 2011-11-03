<?php
/**
	* File: user_concert_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

$datetime = new DateTime($concert->dateandtime);
$newdate = $datetime->format('m/d/Y');
$newTime = $datetime->format('H:i');

wp_enqueue_script('lc-concerts');

?>
<script type="text/javascript">
	$(document).ready(function() {
		
						
		$("#concert_update").submit(function() {
			
			var error = false;
			
			$("input.required,select.required").each(function() {
				if($(this).val()=="" || ($(this).hasClass("initialValue")&&$(this).val()==$(this).data("od"))) {
					error = true;
				}
			});
			
			if(error) {
				alert("Please fill in all fields marked as required");
			}else{
				$("#concert_update").submit();
			}
			
			
			return false;
		});
	});
</script>
<div class="">
<p> 
  <form class="validate" action="'<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="concert_update" id="concert_update">
    <a href="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" title="go back" >&lt; Go back to Events list</a></p><br /><br />
    
    <input type="hidden" name="action" value="concerts_user_update" />
    <input type="hidden" name="concert_id" value="<?php echo esc_attr($concert->id) ?>" />
    <table  border="0" class="cacona">
      <tr>
        <td><label>Place</label></td>
        <td><input class="required" name="concert_place" type="text" value="<?php echo esc_attr($concert->place) ?>"/></td>
      </tr>
      <tr>
        <td><label>Address</label></td>
        <td>
          <input class="required" name="concert_address" type="text" value="<?php echo esc_attr($concert->address) ?>" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="concert_address_show" value="1" <?php if($concert->show_address != 1) echo "checked";?> />
          hide this field!
        </td>
      </tr>
      <tr>
        <td><label>Date &amp; Time:</label></td>
        <td><input class="required datepicker" name="concert_date" type="text" value="<?php echo esc_attr($newdate) ?>" alt="date/month/year" /> <input class="required timepicker" type="text" name="concert_time" value="<?php echo esc_attr($newTime) ?>" /></td>
      </tr>
      <tr>
        <td><label>Maximum attendants:</label></td>
        <td><input class="required" name="concert_max" type="text" id="concert_max" value="<?php echo esc_attr($concert->max) ?>" alt="Maximum Attendants" /></td>
      </tr>
      <tr>
        <td><label>Additional Info:</label></td>
        <td rowspan="2"><textarea class="required" name="concert_additional" rows="6" alt="additional information"><?php echo esc_html($concert->additional) ?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
      </tr>
      <tr>
        <td><label>Phone:</label></td>
        <td><input class="required" name="concert_phone" type="text" value="<?php echo esc_attr($concert->phone) ?>" /></td>
      </tr>
      <tr>
        <td> </td>
        <td><input type="submit" class="submit" id="submit" value="SAVE" /></td>
      </tr>
    </table>
    
  </form>
</div><br/>

