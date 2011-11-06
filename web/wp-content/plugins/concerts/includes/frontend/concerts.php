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

$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );

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
		$date = strtotime($event->dateandtime);
		$month = date('m', $date);
		
		if ($month >= $monthBreaker) {
			$monthBreaker = $month + 1;
			if($event_num > 1)
			{?>
			</ul>
			</div>
			<?php }
			
		?> 
			<div class="event-group">
			<div class="event-month spacer"> <?php echo esc_html(date('F Y', $date)) ?></div>
			<ul>
		<?php  } ?>
	
	  <li><div class="event-summary"><span class="event-date"><?php echo esc_html(date('d.m', $date)) ?></span> - <span class="event-location"><?php echo esc_html($event->venue_city) ?>, <?php echo esc_html($event->venue_country) ?></span> / <span class="event-venue"><?php echo esc_html($event->venue_name) ?></span> / <a class="event-more" href="javascript:void(0)" id="!event-<?php echo esc_attr($event->id) ?>">more</a></div>
		
	  <div class="event-details hidden" id="event-<?php echo esc_attr($event->id) ?>">
	  		<div class="event-divider">&nbsp;</div>
				<?php  if ($event->status == 1){ ?>
					<div>This is concert is fully booked</div>
				<?php } else { ?>

				<b>Time:</b> <?php echo esc_html(date('H:i', $date)) ?><br/>
				<b>Max attendants:</b><?php echo esc_html($event->venue_capacity) ?> people<br/>
				<?php  if ($event->venue_show_address == 1){ ?>
					<b>Adress:</b> <?php echo esc_html($event->venue_address) ?><br/>
				<?php } ?>
				<b>Postal Code:</b> <?php echo esc_html($event->venue_postalcode) ?><br/>
				<b>Additional info:</b> <?php echo esc_html($event->additional_info) ?><br/>
				<form style="padding-left:0" method="post" id="form_<?php echo esc_attr($event->id) ?>" action="<?php echo site_url(); ?>/concerts/request-concert-invitation/">
					<input type="hidden"name="action" value="concerts_user_request_invite">
					<input type="hidden" name="concert_id" value="<?php echo esc_attr($event->id) ?>">
					<br/>
					<a class="" onclick="lc_concerts.submit_form('form_<?php echo esc_attr($event->id) ?>');" href="javascript:void(0);">attend</a>
			  </form>
				
				<?php  }  ?>
				<div class="event-divider">&nbsp;</div>
	   </div>
	   </li>
	<?php } ?>
</div>
<?php } else { // count ?>
<p>There are currently no Private-Public Concerts. Be the first to host one!</p>
<?php } // count ?>

