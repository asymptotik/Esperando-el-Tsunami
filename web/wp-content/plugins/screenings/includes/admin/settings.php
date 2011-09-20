<?php
/**
	* File: settings
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>

<div class="wrap">
	<h2>Plugin Settings</h2>
	<p><?php if ($updateSucces == true) echo "Fields Updated"; ?></p>
	<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Notification email</th>
				<td><input type="text" name="screenings_notify" value="<?php echo get_option('screenings_notify'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Account backup email</th>
				<td><input type="text" name="screenings_accounts" value="<?php echo get_option('screenings_accounts'); ?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="screenings_option" value="thehe" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
