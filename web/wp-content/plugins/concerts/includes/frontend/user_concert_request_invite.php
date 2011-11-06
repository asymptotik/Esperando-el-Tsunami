<?php
/**
	* File: attend
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

wp_enqueue_script('lc-concerts');

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

?>	
<div id="attent_concert" class="lc-host-form-narrow">
	<p>This message will be sent to the host of the Concert at <b><?php echo esc_html($concert->venue_name) ?></b> in <b><?php echo esc_html($concert->venue_city) ?></b><br /></p>
	<form class="validate" id="concert_form" name="concert_form" method="post"action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
	<input type="hidden"name="action" value="concerts_user_request_invite_send">
	<input type="hidden"name="attend_form"value="true">
	<input type="hidden" name="concert_id" value="<?php echo esc_attr($concert_id) ?>">
	<table>
	  <tr>
      <td>
				<strong>(r) required fields</strong>
      </td>
    </tr>
    <tr>
			<td colspan="3">
				<div class="divider-dotted-full">&nbsp;</div>
			</td>
    </tr>
		<tr>
			<td>
				<label for="attend_email">E-mail (r)</label><br/>
				<input class="required email initialValue" id="attend_email" type="text" name="attend_email" value="your@e-mail.com" alt="your@e-mail.com"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="attend_name">Your Name (r)</label><br/>
				<input  class="required initialValue" type="text" id="attend_name" name="attend_name"value="Your Name" alt="Your Name"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="attend_number">Number of invitation requested (r)</label><br/>
				<input class="required digits initialValue" type="text" id="attend_number" name="attend_number" value="1" alt="Number"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="attent_msg">Message</label><br/>
				<textarea rows="9" id="attent_msg" name="attent_msg"></textarea>
			</td>
		</tr>
	</table>
	<a class="btn-rect btn-rect-lg" onclick="javascript:lc_concerts.submit_host_form()"><div class="btn-rect-text">submit</div></a>
	</form>
</div>
