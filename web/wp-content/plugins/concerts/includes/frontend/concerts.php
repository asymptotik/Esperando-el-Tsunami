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
global $wpdb;
if ($_POST['country_select']) {
	if ($_POST['concert_country'] != '') {
		$country = $_POST['concert_country'];
		
		echo "ONE " . $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 AND country = '%s' ORDER BY dateandtime asc", $country) . "<br/>";
		$events = $wpdb->get_results( $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 AND country = '%s' ORDER BY dateandtime asc", $country));
	}
	else 
	{
		echo "TWO";
		$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
	}
}
else {
	echo "THREE";
//echo "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" ;exit;
	$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
}

$output = '';
$monthBreaker = 0;
$monthLast = '';

$event_count = count($events);

if(count($events) > 0)
{
?>
<div class="concertlist">
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
	
	  <div class="allinline">
			<?php  if ($event->status == 1){ ?>
				<img title="This is concert is fully booked" class="screenbt" src="/concerts/wp-content/plugins/concerts/images/btnfull.jpg">
			<?php } else { ?>
			 <form style="padding-left:0" method="post" action="/concerts/request-invitation/">
				<input type="hidden" name="concert_id" value="<?php echo esc_attr($event->id) ?>">
				<input type="image" class="screenbt" src="/concerts/wp-content/plugins/concerts/images/btnattend.jpg" />
			</form>';
			<div class="hidden" id="concert'.$event->id.'">
				<hr>
				<b>Time:</b><?php echo esc_html($date->format('H:i')) ?><br/>
				<b>Max attendants:</b><?php echo esc_html($event->max) ?> people<br/>
				<?php  if ($event->show_address != 1){ ?>
					<b>Adress:</b><?php echo esc_html($event->address) ?><br/>
				<?php } ?>
				<b>Postal Code:</b><?php echo esc_html($event->postalcode) ?><br/>
				<b>Additional info:</b><?php echo esc_html($event->additional) ?><br/>
				<hr>
			</div>
			<?php  }  ?>
			<p><?php echo esc_html($date->format('d.m')) ?> - <b><?php echo esc_html($event->city) ?>, <?php echo esc_html($event->country) ?></b> / <?php echo esc_html($event->place) ?> / <a class="toggleID" href="#concert'.$event->id.'">more...</a></p>
		</div><?php echo esc_html($details) ?>
	
	<?php } ?>
</div>
<?php } else { // count ?>
<p>There are currently no Private-Public Concerts in this country. Be the first to host one!</p>
<?php } // count ?>

