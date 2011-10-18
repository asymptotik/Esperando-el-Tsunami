<?php
/**
	* File: concert_edit
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( ! empty($concert_id) ) {
	$heading = sprintf( __( '<a href="%s">Concert</a> / Edit Concert' ), 'admin.php?page=concerts' );
	$submit_text = __('Update Concert');
	$form = '<form name="editconcert" id="editconcert" method="post" action="admin.php?page=concerts">';
	$nonce_action = 'update-concert_' . $concert_id;
} else {
	$heading = sprintf( __( '<a href="%s">Concert</a> / Add New Concert' ), 'admin.php?page=concerts' );
	$submit_text = __('Add Concert');
	$form = '<form name="addconcert" id="addconcert" method="post" action="admin.php?page=concerts">';
	$nonce_action = 'add-concert';
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
		<h2><?php echo $heading; ?> <a href="admin.php?page=concerts&action=concert_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'concert'); ?></a></h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
		
			<?php if ( $concert_id ) : ?>
			<input type="hidden" name="action" value="concert_update" />
			<input type="hidden" name="concert_id" value="<?php echo (int) $concert_id; ?>" />
			<?php else: ?>
			<input type="hidden" name="action" value="concert_add" />
			<?php endif; ?>

			<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID ?>" /> 

			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="linksubmitdiv" class="postbox ">
						<div class="handlediv" title="Click to toggle">
							<br>
						</div>
						<h3 class="hndle">
							<span><?php _e('Save Concert') ?></span>
						</h3>
						<div class="inside">
							<div id="submitlink" class="submitbox">
								<div id="major-publishing-actions">
								  <?php if(!empty($concert_id)) { ?>
										<div id="delete-action">
										  <a class="submitdelete" onclick="if ( confirm( 'You are about to delete this concert \'<?php echo esc_attr($concert_place) ?>\'\n \'Cancel\' to stop, \'OK\' to delete.' ) ) { return true;}return false;" href="<?php echo wp_nonce_url( "admin.php?page=concerts&amp;action=delete&amp;concert_id=$concert_id", 'delete-concert_' . $concert_id )  ?>">Delete</a>
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
			
			if ( !empty($concert_id) ) 
			{
				$concert_place = $concert->place;
				$concert_address = $concert->address;
				$concert_show_address = $concert->show_address;
				$concert_city = $concert->city;
				$concert_postalcode = $concert->postalcode;
				$concert_region_id = $concert->region_id;
				$concert_country_id = $concert->country_id;
				$concert_country = (empty($concert->country_id) || $concert->country_id = 0) ? $concert->country : '';
				$concert_dateandtime = $concert->dateandtime;
				$concert_max = $concert->max;
				$concert_name = $concert->name;
				$concert_additional = $concert->additional;
				$concert_email = $concert->email;
				$concert_pass = '';
				$concert_phone = $concert->phone;
			}
			else 
			{
				$concert_place = '';
				$concert_address = '';
				$concert_show_address = '';
				$concert_city = '';
				$concert_postalcode = '';
				$concert_region_id = 0;
				$concert_country_id = 0;
				$concert_country = '';
				$concert_dateandtime = '';
				$concert_max = '';
				$concert_name = '';
				$concert_additional = '';
				$concert_email = '';
				$concert_pass = '';
				$concert_phone = '';
			}

			$regions = get_lc_regions('name', 'asc');
			?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3>
							<label for="name"><?php _e('Concert') ?></label>
						</h3>
						<div class="inside">
					    <table class="form-table edit-concert concert-form-table">
					      <tr valign="top">
					        <td class="first">Place:</td>
					        <td><input name="concert_place" type="text" value="<?php echo esc_attr($concert_place)?>" alt="Mike\'s place / Caf&eacute; Luna / etc" /></td>
					      </tr>
					      
					      <tr valign="top">
									<td class="first">Region:</td>
									<td>
									<select id="concert-region-id" name="concert_region_id">
									  <option value="0">Select a Region</option>
									  <?php foreach ($regions as $region) { 
										  $selected = ($region->id == $concert_region_id);
									  ?>
									  <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($region->id); ?>"><?php echo esc_html($region->name); ?></option>
									<?php } ?>
									</select>
									</td>
								</tr>
									
								<tr valign="top">
									<td class="first">Country:</td>
									<td>
									  <?php foreach ($regions as $region) { 
										  $countries = get_lc_countries_by_region($region->id);
										  ?>
										  <?php if(count($countries) > 0) { ?>
												<select class="country-select" id="country-select-<?php echo esc_attr($region->id) ?>" style="display:none;" name="concert_country_<?php echo esc_attr($region->id) ?>">
												  <option value="0">Select a Country</option>
												  <?php foreach ($countries as $country) { 
												    $selected = ($country->id == $concert_country_id);?>
												    <option <?php echo  ($selected == true) ? 'selected="true" ' : ''; ?>value="<?php echo esc_attr($country->id); ?>"><?php echo esc_html($country->name); ?></option>
												  <?php } ?>
												</select>
											<?php } ?>
										<?php } ?>
										
										<input name="concert_country" style="display:none;" type="text" id="concert_country" value="<?php echo esc_attr($concert_country)?>"/></td>
									</td>
								</tr>
								
					      <tr valign="top">
					        <td class="first">Address:</td>
					        <td>
					          <input name="concert_address" type="text" value="<?php echo esc_attr($concert_address)?>" alt="Street name &amp; number" />
					          <p><input type="checkbox" name="concert_hide_address" value="1" <?php if($concert_show_address != 1) echo "checked";?> />
					          hide this field!</p>
					        </td>
					      </tr>
					      <tr valign="top">
					        <td class="first">City:</td>
					        <td><input name="concert_city" type="text" value="<?php echo esc_attr($concert_city)?>" alt="City" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Postal Code:</td>
					        <td><input name="concert_postalcode" type="text" class="required" value="<?php echo esc_attr($concert_postalcode)?>" alt="Postal Code" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Date &amp; Time:</td>
					        <td><input name="concert_dateandtime" type="text" value="<?php echo esc_attr($concert_dateandtime)?>" alt="date/month/year" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Maximum attendants:</td>
					        <td><input name="concert_max" type="text" id="concert_max" value="<?php echo esc_attr($concert_max)?>" alt="Maximum Attendants" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Additional Info:</td>
					        <td rowspan="2"><textarea name="concert_additional" rows="6" alt="optional"><?php echo esc_attr($concert_additional)?></textarea></td>
					      </tr>
					      <tr valign="top">
					        <td><div align="right"></div></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Name:</td>
					        <td><input name="concert_name" type="text" value="<?php echo esc_attr($concert_name)?>" alt="Name" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Email:</td>
					        <td><input name="concert_email" type="text" value="<?php echo esc_attr($concert_email)?>" alt="your@e-mail.com" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">New Password:</td>
					        <td><input name="concert_password" type="text" value="" /></td>
					      </tr>
					      <tr valign="top">
					        <td class="first">Phone:</td>
					        <td><input name="concert_phone" type="text" value="<?php echo esc_attr($concert_phone)?>" /></td>
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
    
    