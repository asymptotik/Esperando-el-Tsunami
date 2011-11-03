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

wp_enqueue_script('lc-screenings');

global $wpdb;

$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE date(dateandtime) <= date(now()) AND active = 1 ORDER BY dateandtime desc" );

$output = '';
$monthBreaker = 0;
$event_num = 0;
$event_count = count($events);

if($event_count > 0)
{
?>
<div class="lc-host-form-narrow screeninglist">
	<?php 

	foreach ($events as $event) 
	{
		$event_num++;
		$date = new DateTime($event->dateandtime);
		$month = $date->format('m');
		
		if ($month >= $monthBreaker) {
			$monthBreaker = $month + 1;
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
	
	  <li><div class="event-summary"><span class="event-date"><?php echo esc_html($date->format('d.m')) ?></span> - <span class="event-location"><?php echo esc_html($event->city) ?>, <?php echo esc_html($event->country) ?></span> / <span class="event-venue"><?php echo esc_html($event->place) ?></span> / <a class="event-more" href="javascript:void(0)" id="!event-<?php echo esc_attr($event->id) ?>">more...</a></div>
		
	  <div class="event-details hidden" id="event-<?php echo esc_attr($event->id) ?>">
	  		<div class="event-divider">&nbsp;</div>
				<?php  if ($event->status == 1){ ?>
					<div>This is screening is fully booked</div>
				<?php } else { ?>

				<b>Time:</b> <?php echo esc_html($date->format('H:i')) ?><br/>
				<b>Max attendants:</b><?php echo esc_html($event->max) ?> people<br/>
				<?php  if ($event->show_address == 1){ ?>
					<b>Adress:</b> <?php echo esc_html($event->address) ?><br/>
				<?php } ?>
				<b>Postal Code:</b> <?php echo esc_html($event->postalcode) ?><br/>
				<b>Additional info:</b> <?php echo esc_html($event->additional) ?><br/>
				<form style="padding-left:0" method="post" action="/screenings/request-invitation/">
					<input type="hidden" name="screening_id" value="<?php echo esc_attr($event->id) ?>">
					<input type="image" class="screenbt" src="<?php echo lc_screenings_plugin_uri( 'images/btnattend.jpg' )?>" />
			  </form>
				
				<?php  }  ?>
				<div class="event-divider">&nbsp;</div>
	   </div>
	   </li>
	<?php } ?>
</div>
<?php } else { // count ?>
<p>There are currently no Past Private-Public Screenings.</p>
<?php } // count ?>
