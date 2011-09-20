<?php
/**
	* File: screening_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
global $wpdb;
$id = $_POST['screening_id'];	
$events = $wpdb->get_results("SELECT * FROM wp_screenings_events WHERE id = '$id'");
foreach ($events as $event) { $edit = $event; }
?>
<div class="wrap">
	<h2>Edit Screening</h2>
	<br/>
  <form action="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) ?>" method="post" name="screening_update" id="screening_update">
    <input type="hidden" name="screening_update" value="true" />
    <input type="hidden" name="screening_id" value="<?php echo $edit->id?>" />

    <table  border="0">
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Place: </strong></div>
        </label></td>
        <td><input name="screening_place" type="text" value="<?php echo stripslashes($edit->place)?>" alt="Mike\'s place / Caf&eacute; Luna / etc" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Address: </strong></div>
        </label></td>
        <td><p>
          <input name="screening_address" type="text" value="<?php echo stripslashes($edit->address)?>" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="screening_address_show" value="1" <?php if($edit->show_address == 1) echo "checked";?> />
          don't make this visible!
          <span class="sub"></span></p></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>City: </strong></div>
        </label></td>
        <td><input name="screening_city" type="text" value="<?php echo stripslashes($edit->city)?>" alt="City" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Zip Code: </strong></div>
        </label></td>
        <td><input name="screening_zipcode" type="text" class="required" value="<?php echo stripslashes($edit->zipcode)?>" alt="Zip Code" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Country Code: </strong></div>
        </label></td>
        <td><label for="screening_country"></label>
        <input name="screening_country" type="text" id="screening_country" value="<?php echo stripslashes($edit->country)?>"/></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Date &amp; Time: </strong></div>
        </label></td>
        <td><input name="screening_date" type="text" value="<?php echo $edit->dateandtime?>" alt="date/month/year" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Maximum attendants: </strong></div>
        </label></td>
        <td><input name="screening_max" type="text" id="screening_max" value="<?php echo $edit->max?>" alt="Maximum Attendants" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Additional Info: </strong></div>
        </label></td>
        <td rowspan="2"><textarea name="screening_additional" rows="6" alt="optional"><?php echo stripslashes($edit->additional)?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Name: </strong></div>
        </label></td>
        <td><input name="screening_name" type="text" value="<?php echo stripslashes($edit->name)?>" alt="Name" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Email: </strong></div>
        </label></td>
        <td><input name="screening_email" type="text" value="<?php echo stripslashes($edit->email)?>" alt="your@e-mail.com" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>New Password: </strong></div>
        </label></td>
        <td><input name="screening_password" type="text" value="" /></td>
      </tr>
      <tr>
        <td class="label"><label>
          <div align="right"><strong>Phone: </strong></div>
        </label></td>
        <td><input name="screening_phone" type="text" value="<?php echo stripslashes($edit->phone)?>" /></td>
      </tr>
        <td class="label"> </td>
        <td><p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		 - <a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go back</a></p></td>
      </tr>
    </table>
  </form>
</div>
