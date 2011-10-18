<?php
/**
	* File: screening_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/

extract(lc_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( ! empty($screening_id) ) {
	$heading = sprintf( __( '<a href="%s">Screening</a> / Edit Screening' ), 'admin.php?page=screenings' );
	$submit_text = __('Update Screening');
	$form = '<form name="editscreening" id="editscreening" method="post" action="admin.php?page=screenings">';
	$nonce_action = 'update-screening_' . $screening_id;
} else {
	$heading = sprintf( __( '<a href="%s">Screening</a> / Add New Screening' ), 'admin.php?page=screenings' );
	$submit_text = __('Add Screening');
	$form = '<form name="addscreening" id="addscreening" method="post" action="admin.php?page=screenings">';
	$nonce_action = 'add-screening';
}

require_once(ABSPATH . 'wp-admin/includes/meta-boxes.php');

add_screen_option('layout_columns', array('max' => 2) );

$user_ID = isset($user_ID) ? (int) $user_ID : 0;
?>

<?php if ( isset( $_GET['added'] ) ) : ?>
<div id="message" class="updated"><p><?php _e('Schedule added.'); ?></p></div>
<?php endif; ?>

<?php
if ( !empty($form) )
	echo $form;
if ( !empty($link_added) )
	echo $link_added;
	
echo "\n";
wp_nonce_field( $nonce_action ); echo "\n";
?>

	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>
		<h2><?php echo $heading; ?> <a href="admin.php?page=screenings&action=screening_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'screening'); ?></a></h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
		
			<?php if ( $screening_id ) : ?>
			<input type="hidden" name="action" value="screening_update" />
			<input type="hidden" name="screening_id" value="<?php echo (int) $screening_id; ?>" />
			<?php else: ?>
			<input type="hidden" name="action" value="screening_add" />
			<?php endif; ?>

			<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID ?>" /> 

			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="linksubmitdiv" class="postbox ">
						<div class="handlediv" title="Click to toggle">
							<br>
						</div>
						<h3 class="hndle">
							<span><?php _e('Save Screening') ?></span>
						</h3>
						<div class="inside">
							<div id="submitlink" class="submitbox">
								<div id="major-publishing-actions">
								  <?php if(!empty($screening_id)) { ?>
										<div id="delete-action">
										  <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this screening \'<?php echo esc_attr($screening_place) ?>\'\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=screenings&amp;action=delete&amp;screening_id=$screening_id", 'delete-screening_' . $screening_id )  ?>">Delete</a>
										</div>
									<?php } ?>
									<div id="publishing-action">
										<input id="publish" class="button-primary" type="submit" value="<?php echo $submit_text ?>" accesskey="p" tabindex="4" name="save">
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php 
			
			if ( !empty($screening_id) ) 
			{
				$screening_place = $screening->place;
				$screening_address = $screening->address;
				$screening_show_address = $screening->show_address;
				$screening_city = $screening->city;
				$screening_postalcode = $screening->postalcode;
				$screening_country = $screening->country;
				$screening_dateandtime = $screening->dateandtime;
				$screening_max = $screening->max;
				$screening_name = $screening->name;
				$screening_additional = $screening->additional;
				$screening_email = $screening->email;
				$screening_pass = '';
				$screening_phone = $screening->phone;
			}
			else 
			{
				$screening_place = '';
				$screening_address = '';
				$screening_show_address = '';
				$screening_city = '';
				$screening_postalcode = '';
				$screening_country = '';
				$screening_dateandtime = '';
				$screening_max = '';
				$screening_name = '';
				$screening_additional = '';
				$screening_email = '';
				$screening_pass = '';
				$screening_phone = '';
			}
			?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3>
							<label for="name"><?php _e('Screening') ?></label>
						</h3>
						<div class="inside">
					    <table class="form-table edit-screening screening-form-table">
					      <tr valign="top">
					        <td class="first">Place:</td>
					        <td><input name="screening_place" type="text" value="<?php echo esc_attr($screening_place)?>" alt="Mike\'s place / Caf&eacute; Luna / etc" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Address:</td>
					        <td>
					          <input name="screening_address" type="text" value="<?php echo esc_attr($screening_address)?>" alt="Street name &amp; number" />
					          <p><input type="checkbox" name="screening_show_address" value="1" <?php if($screening_show_address == 1) echo "checked";?> />
					          don't make this visible!</p>
					        </td>
					      </tr>
					      <tr valign="top">
					        <td class="first">City:</td>
					        <td><input name="screening_city" type="text" value="<?php echo esc_attr($screening_city)?>" alt="City" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Postal Code:</td>
					        <td><input name="screening_postalcode" type="text" class="required" value="<?php echo esc_attr($screening_postalcode)?>" alt="Postal Code" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Country Code:</td>
					        <td><label for="screening_country"></label>
					        <input name="screening_country" type="text" id="screening_country" value="<?php echo esc_attr($screening_country)?>"/></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Date &amp; Time:</td>
					        <td><input name="screening_date" type="text" value="<?php echo esc_attr($screening_dateandtime)?>" alt="date/month/year" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Maximum attendants:</td>
					        <td><input name="screening_max" type="text" id="screening_max" value="<?php echo esc_attr($screening_max)?>" alt="Maximum Attendants" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Additional Info:</td>
					        <td rowspan="2"><textarea name="screening_additional" rows="6" alt="optional"><?php echo esc_attr($screening_additional)?></textarea></td>
					      </tr>
					      <tr valign="top">
					        <td><div align="right"></div></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Name:</td>
					        <td><input name="screening_name" type="text" value="<?php echo esc_attr($screening_name)?>" alt="Name" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Email:</td>
					        <td><input name="screening_email" type="text" value="<?php echo esc_attr($screening_email)?>" alt="your@e-mail.com" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">New Password:</td>
					        <td><input name="screening_password" type="text" value="" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Phone:</td>
					        <td><input name="screening_phone" type="text" value="<?php echo esc_attr($screening_phone)?>" /></td>
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
    
    