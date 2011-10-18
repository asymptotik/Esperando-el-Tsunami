<?php
/**
	* File: concert_show
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
global $wpdb;

extract(lc_concerts_get_vars(array('concert_id')));
$concert = get_lc_concert($concert_id);

?>

<div class="wrap">
		<div id="icon-index" class="icon32"><br></div>
		<h2><?php _e('Concert') ?> <a href="admin.php?page=concerts&action=concert_new" class="add-new-h2"><?php echo esc_html_x('Add New', 'concert'); ?></a></h2>
		<div id="poststuff" class="metabox-holder">

			<?php 
			
			if ( !empty($concert_id) ) 
			{
				$concert_place = $concert->place;
				$concert_address = $concert->address;
				$concert_show_address = $concert->show_address;
				$concert_city = $concert->city;
				$concert_postalcode = $concert->postalcode;
				$concert_country = $concert->country;
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
				$concert_country = '';
				$concert_dateandtime = '';
				$concert_max = '';
				$concert_name = '';
				$concert_additional = '';
				$concert_email = '';
				$concert_pass = '';
				$concert_phone = '';
			}
			?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3><label for="name"><?php echo esc_html($concert_place)?></label></h3>
					</div>
			    <table class="data-table edit-concert concert-form-table">
			      <tr valign="top" class="alternate">
			        <td class="first">Place:</td>
			        <td><?php echo esc_html($concert_place)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Address:</td>
			        <td><?php echo esc_html($concert_address)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">City:</td>
			        <td><?php echo esc_html($concert_city)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Postal Code:</td>
			        <td><?php echo esc_html($concert_postalcode)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Country Code:</td>
			        <td><?php echo esc_html($concert_country)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Date &amp; Time:</td>
			        <td><?php echo esc_html($concert_dateandtime)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Maximum attendants:</td>
			        <td><?php echo esc_html($concert_max)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Additional Info:</td>
			        <td><?php echo esc_html($concert_additional)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Name:</td>
			        <td><?php echo esc_html($concert_name)?></td>
			      </tr>
			      <tr valign="top">
			        <td class="first">Email:</td>
			        <td><?php echo esc_html($concert_email)?></td>
			      </tr>
			      <tr valign="top" class="alternate">
			        <td class="first">Phone:</td>
			        <td><?php echo esc_html($concert_phone)?></td>
					  </tr>
					  </table>
				</div>
			</div>
		</div>
	</div>
<br>
<a href="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" title='go back'>Go back</a>
