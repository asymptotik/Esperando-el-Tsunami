<?php
/**
	* File: concerts
	* Type: 
	* @author Victor L. Facius
	* @version 1.0
	* @package View
**/
?>
<?php

wp_enqueue_script('lc-concerts');

global $wpdb;

$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) <= date(now()) AND active = 1 ORDER BY dateandtime desc" );

$output = '';
$monthBreaker = 0;
$event_num = 0;
$event_count = count($events);

if($event_count > 0)
{
?>
<div class="lc-host-form-narrow concertlist">
	<?php 

	foreach ($events as $event) 
	{
		$event_num++;
		$date = new DateTime($event->dateandtime);
		$month = $date->format('m');
		
	  $concert_venue_country_name = '';
		if(!empty($event->$venue_country_id))
		{
			$concert_venue_country_object = get_lc_country($event->venue_country_id);
			if(!empty($concert_venue_country_object))
			{
				$concert_venue_country_name = $concert_venue_country_object->name;
			}
		}
		else 
		{
			$concert_venue_country_name = $event->venue_country;
		}
		
		if ($month != $monthBreaker) {
			$monthBreaker = $month;
			if($event_num > 1)
			{?>
			</ul>
			</div>
			<?php }
			
		?> 
			<div class="event-group">
			<div class="event-month spacer"> <?php echo esc_html($date->format('F Y')) ?></div>
			<ul>
		<?php  } ?>
	
	  <li><div class="event-summary"><span class="event-date"><?php echo esc_html($date->format('d.m')) ?></span> - <span class="event-location"><?php echo esc_html($event->venue_city) ?>, <?php echo esc_html($concert_venue_country_name) ?></span> / <span class="event-venue"><?php echo esc_html($event->venue_name) ?></span> / <a class="event-more" href="javascript:void(0)" id="!event-<?php echo esc_attr($event->id) ?>">more info</a></div>
		
	  <div class="event-details hidden" id="event-<?php echo esc_attr($event->id) ?>">
	  		<div class="event-divider">&nbsp;</div>

				<b>Time:</b> <?php echo esc_html($date->format('H:i')) ?><br/>
				<b>Max attendants:</b><?php echo esc_html($event->venue_capacity) ?> people<br/>
				<?php  if ($event->show_address == 1){ ?><b>Adress:</b> <?php echo esc_html($event->venue_address) ?><br/><?php } ?>
				<b>Postal Code:</b> <?php echo esc_html($event->venue_postalcode) ?><br/>
				<b>Additional info:</b> <?php echo esc_html($event->additional_info) ?><br/>

				<div class="event-divider">&nbsp;</div>
	   </div>
	   </li>
	<?php } ?>
</div>
<?php } else { // count ?>
<p>There are currently no Past Private-Public Concerts.</p>
<?php } // count ?>
