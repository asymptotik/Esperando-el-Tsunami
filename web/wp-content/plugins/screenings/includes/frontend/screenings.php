<?php
/**
	* File: screenings
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php
global $wpdb;
if ($_POST['country_select']) {
	if ($_POST['screening_country'] != '') {
		$country = $_POST['screening_country'];
		$events = $wpdb->get_results( $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE date(dateandtime) >= date(now()) AND active = 1 AND country = '%s' ORDER BY dateandtime asc", $country));
	}
	else 
	{
		$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
	}
}
else {
	$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
}

$output = '';
$monthBreaker = 0;
$monthLast = '';

$event_count = count($events);

if(count($events) > 0)
{
?>
<div class="lc-host-form-narrow screeninglist">
	<?php 

	foreach ($events as $event) 
	{
		$date = new DateTime($event->dateandtime);
		$month = $date->format('m');
		
		if ($monthBreaker == 0){
			$monthBreaker = $month+1;
			?> <p class="month-name"> <?php echo esc_html($date->format('F')) ?></p> <?php 
		}
		else if ($month == $monthBreaker) {
		$monthBreaker++;
		?> <p class="month-name spacer"> <?php echo esc_html($date->format('F')) ?></p> 
		<?php  } ?>
	
		<p><?php echo esc_html($date->format('d.m')) ?> - <b><?php echo esc_html($event->city) ?>, <?php echo esc_html($event->country) ?></b> / <?php echo esc_html($event->place) ?> / <a class="toggleID" href="#screening_ <?php echo esc_attr($event->id) ?>">more...</a></p><?php echo esc_html($details) ?>
		
	  <div class="screening_details hidden" id="screening_<?php echo esc_attr($event->id) ?>">
	  		<hr>
				<?php  if ($event->status == 1){ ?>
					<img title="This is screening is fully booked" class="screenbt" src="<?php echo lc_screenings_plugin_uri( 'images/btnfull.png' )?>">
				<?php } else { ?>

				<b>Time:</b> <?php echo esc_html($date->format('H:i')) ?><br/>
				<b>Max attendants:</b><?php echo esc_html($event->max) ?> people<br/>
				<?php  if ($event->show_address != 1){ ?>
					<b>Adress:</b> <?php echo esc_html($event->address) ?><br/>
				<?php } ?>
				<b>Postal Code:</b> <?php echo esc_html($event->postalcode) ?><br/>
				<b>Additional info:</b> <?php echo esc_html($event->additional) ?><br/>
				<form style="padding-left:0" method="post" action="/screenings/request-invitation/">
					<input type="hidden" name="screening_id" value="<?php echo esc_attr($event->id) ?>">
					<input type="image" class="screenbt" src="<?php echo lc_screenings_plugin_uri( 'images/btnattend.jpg' )?>" />
			  </form>
				<hr>
			<?php  }  ?>
	   </div>
	<?php } ?>
</div>
<?php } else { // count ?>
<p>There are currently no Private-Public Screenings in this country. Be the first to host one!</p>
<?php } // count ?>

