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

$datetime = strtotime($concert->dateandtime);
$newdate = date('m/d/Y', $datetime);
$newTime = date('H:i', $datetime);

wp_enqueue_script('lc-concerts');

?>

<div class="lc-host-form-narrow">
<p> 
  <form class="validate" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" method="post" name="concert_form" id="concert_form">
    <a href="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>" title="go back" >&lt; Go back to Events list</a></p><br /><br />
    
    <input type="hidden" name="action" value="concerts_user_update" />
    <input type="hidden" name="concert_id" value="<?php echo esc_attr($concert->id) ?>" />
    <table  border="0" class="cacona">
      <tr>
        <td><label for="concert_venue_name">Venue Name:</label></td>
        <td><input class="required" name="concert_venue_name" id="concert_venue_name" type="text" value="<?php echo esc_attr($concert->venue_name) ?>"/></td>
      </tr>
      <tr>
        <td><label for="concert_venue_address">Venue Address:</label></td>
        <td>
          <input class="required" name="concert_venue_address" id="concert_venue_address" type="text" value="<?php echo esc_attr($concert->venue_address) ?>" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="concert_venue_show_address" value="1" <?php if($concert->venue_show_address != 1) echo "checked";?> />
          hide this field!
        </td>
      </tr>
      <tr>
        <td><label for="concert_date">Date (yyyy-mm-dd):</label></td>
        <td><input class="required date datepicker" name="concert_date" id="concert_date" type="text" value="<?php echo esc_attr($newdate) ?>" alt="yyyy-mm-dd" /></td>
      </tr>
      <tr>
        <td><label for="concert_time">Time (hh:mm 24 hour):</label></td>
        <td><input class="required time timepicker" type="text" name="concert_time" id="concert_time" value="<?php echo esc_attr($newTime) ?>" /></td>
      </tr>
      <tr>
        <td><label for="concert_venue_capacity">Maximum attendants:</label></td>
        <td><input class="required digits" type="text" name="concert_venue_capacity" id="concert_venue_capacity" value="<?php echo esc_attr($concert->venue_capacity) ?>" alt="Maximum Attendants" /></td>
      </tr>
      <tr>
        <td valign="top" style="vertical-align: middle;"><label for="concert_additional_info">Additional Info:</label></td>
        <td rowspan="2"><textarea class="" name="concert_additional_info" id="concert_additional_info" rows="6" alt="additional information"><?php echo esc_html($concert->additional_info) ?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
      </tr>
      
      <tr>
        <td><label for="concert_host_phone">Concert Host Email:</label></td>
        <td><input class="required email" name="concert_host_email" id="concert_host_email" type="text" value="<?php echo esc_attr($concert->host_email) ?>" /></td>
      </tr>
      <tr>
        <td><label for="concert_host_phone">Concert Host Address:</label></td>
        <td><input class="required" name="concert_host_address" id="concert_host_address" type="text" value="<?php echo esc_attr($concert->host_address) ?>" /></td>
      </tr>
      <tr>
        <td><label for="concert_host_phone">Concert Host City:</label></td>
        <td><input class="required" name="concert_host_city" id="concert_host_city" type="text" value="<?php echo esc_attr($concert->host_city) ?>" /></td>
      </tr>
      <tr>
        <td><label for="concert_host_phone">Concert Host Phone:</label></td>
        <td><input class="required" name="concert_host_phone" id="concert_host_phone" type="text" value="<?php echo esc_attr($concert->host_phone) ?>" /></td>
      </tr>
      <tr>
        <td> </td>
        <td><a class="btn-rect btn-rect-lg" tabindex="5" onclick="javascript:lc_concerts.submit_host_form()"><div class="btn-rect-text">save</div></a></td>
      </tr>
    </table>
    
  </form>
</div><br/>

