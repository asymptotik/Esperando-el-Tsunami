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

$datetime = strtotime($screening->dateandtime);
$newdate = date('m/d/Y', $datetime);
$newTime = date('H:i', $datetime);

wp_enqueue_script('lc-screenings');

?>

<div class="lc-host-form-narrow">
<p> 
  <form class="validate" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="screening_form" id="screening_form">
    <a href="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" title="go back" >&lt; Go back to Events list</a></p><br /><br />
    
    <input type="hidden" name="action" value="screenings_user_update" />
    <input type="hidden" name="screening_id" value="<?php echo esc_attr($screening->id) ?>" />
    <table  border="0" class="cacona">
      <tr>
        <td><label for="screening_place">Place</label></td>
        <td><input class="required" name="screening_place" id="screening_place" type="text" value="<?php echo esc_attr($screening->place) ?>"/></td>
      </tr>
      <tr>
        <td><label for="screening_address">Address</label></td>
        <td>
          <input class="required" name="screening_address" id="screening_address" type="text" value="<?php echo esc_attr($screening->address) ?>" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="screening_address_show" value="1" <?php if($screening->show_address != 1) echo "checked";?> />
          hide this field!
        </td>
      </tr>
      <tr>
        <td><label for="screening_date">Date (mm/dd/yyyy):</label></td>
        <td><input class="required date datepicker" name="screening_date" id="screening_date" type="text" value="<?php echo esc_attr($newdate) ?>" alt="date/month/year" /></td>
      </tr>
      <tr>
        <td><label for="screening_time">Time (hh:mm 24 hour):</label></td>
        <td><input class="required time timepicker" type="text" name="screening_time" value="<?php echo esc_attr($newTime) ?>" /></td>
      </tr>
      <tr>
        <td><label for="screening_max">Maximum attendants:</label></td>
        <td><input class="required digits" name="screening_max" id="screening_max" type="text" id="screening_max" value="<?php echo esc_attr($screening->max) ?>" alt="Maximum Attendants" /></td>
      </tr>
      <tr>
        <td><label for="screening_additional">Additional Info:</label></td>
        <td rowspan="2"><textarea class="" name="screening_additional" id="screening_additional" rows="6" alt="additional information"><?php echo esc_html($screening->additional) ?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
      </tr>
      <tr>
        <td><label for="screening_phone">Phone:</label></td>
        <td><input class="required" name="screening_phone" id="screening_phone" type="text" value="<?php echo esc_attr($screening->phone) ?>" /></td>
      </tr>
      <tr>
        <td> </td>
        <td><a class="btn-rect btn-rect-lg" tabindex="5" onclick="javascript:lc_screenings.submit_host_form()"><div class="btn-rect-text">submit</div></a></td>
      </tr>
    </table>
    
  </form>
</div><br/>

