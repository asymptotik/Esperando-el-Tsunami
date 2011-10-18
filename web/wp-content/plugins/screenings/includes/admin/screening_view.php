<?php
/**
	* File: screening_show
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
global $wpdb;

extract(lc_screenings_get_vars(array('screening_id')));
$screening = get_lc_screening($screening_id);

?>

<div class="wrap">
		<div id="icon-index" class="icon32"><br></div>
		<h2><?php _e('Screening') ?> <a href="admin.php?page=screenings&action=screening_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'screening'); ?></a></h2>
		<div id="poststuff" class="metabox-holder">

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
						<h3><label for="name"><?php echo esc_html($screening_place)?></label></h3>
					</div>
			    <table class="data-table edit-screening screening-form-table">
			      <tr valign="top" class="alternate">
			        <td class="first">Place:</td>
			        <td><?php echo esc_html($screening_place)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Address:</td>
			        <td><?php echo esc_html($screening_address)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">City:</td>
			        <td><?php echo esc_html($screening_city)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Postal Code:</td>
			        <td><?php echo esc_html($screening_postalcode)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Country Code:</td>
			        <td><?php echo esc_html($screening_country)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Date &amp; Time:</td>
			        <td><?php echo esc_html($screening_dateandtime)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Maximum attendants:</td>
			        <td><?php echo esc_html($screening_max)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Additional Info:</td>
			        <td><?php echo esc_html($screening_additional)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Name:</td>
			        <td><?php echo esc_html($screening_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Email:</td>
			        <td><?php echo esc_html($screening_email)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Phone:</td>
			        <td><?php echo esc_html($screening_phone)?></td>
					  </tr>
					  </table>
				</div>
			</div>
		</div>
	</div>
<br>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go back</a>
