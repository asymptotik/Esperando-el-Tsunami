<?php
/**
	* File: settings
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>

<form name="editsettings" id="editsettings" method="post" action="admin.php?page=concerts-settings">

<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2>Concert Settings</h2>
	<div id="poststuff" class="metabox-holder has-right-sidebar">
	

	  <input type="hidden" name="action" value="update" />
    <input type="hidden" name="concerts_option" value="thehe" />

		<div id="side-info-column" class="inner-sidebar">
			<div id="side-sortables" class="meta-box-sortables ui-sortable">
				<div id="linksubmitdiv" class="postbox ">
					<div class="handlediv" title="Click to toggle">
						<br>
					</div>
					<h3 class="hndle">
						<span><?php _e('Save Settings') ?></span>
					</h3>
					<div class="inside">
						<div id="submitlink" class="submitbox">
							<div id="major-publishing-actions">
								<div id="publishing-action">
									<input id="publish" class="button-primary" type="submit" value="<?php _e('Save Settings') ?>" accesskey="p" tabindex="4" name="save">
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3>
							<label for="name"><?php _e('Concert') ?></label>
						</h3>
						<div class="inside">
					    <table class="form-table edit-concert concert-form-table">
					    
								<tr valign="top">
									<td class="first">Notification email <br/>Email will be sent here when a user signs up to Host a Concert.</td>
									<td><input type="text" name="concerts_notify" value="<?php echo esc_attr(get_option('concerts_notify')); ?>" /></td>
								</tr>
								<tr valign="top">
									<td class="first">Send Notification from name. <br/>Emails sent to the user will be from this name.</td>
									<td><input type="text" name="concerts_notify_from_name" value="<?php echo esc_attr(get_option('concerts_notify_from_name')); ?>" /></td>
								</tr>
								<tr valign="top">
									<td class="first">Send Notification from email. <br/>Emails sent to the user will be from this email.</td>
									<td><input type="text" name="concerts_notify_from_email" value="<?php echo esc_attr(get_option('concerts_notify_from_email')); ?>" /></td>
								</tr>
								<tr valign="top">
									<td class="first">Account backup email. <br/>Email sent to the user will be sent here as well.</td>
									<td><input type="text" name="concerts_accounts" value="<?php echo esc_attr(get_option('concerts_accounts')); ?>" /></td>
								</tr>
							</table>
					<br>
						</div>
					</div>
					<div id="postdiv" class="postarea"></div>
					<div id="normal-sortables" class="meta-box-sortables"></div>
					<input type="hidden" id="referredby" name="referredby" value="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" />
				</div>
			</div>
		</div>
	</div>
</form>