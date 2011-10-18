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
$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) <= date(now()) AND active = 1 ORDER BY dateandtime desc" );

$output = '';

$array = array();
foreach ($events as $event) {
	
	$date = new DateTime($event->dateandtime);
	$details = '<div class="hidden" id="concert'.$event->id.'"><hr>';
	$details .= '<p><b>Time:</b> '.$date->format('H:i').'<br/>';
	$details .= '<b>Max attendants:</b> '.$event->max.' people<br/>';
	if ($event->show_address != 1){
		$details .= '<b>Adresse:</b> '.$event->address.'<br/>';
	}
	if ($event->postalcode != 'Postal Code'){
		$details .= '<b>Postal Code:</b> '.$event->postalcode.'<br/>';
	}
	if ($event->additional != 'optional'){
		$details .= '<b>Additional info:</b> '.$event->additional.'<br/>';
	}
	$details .= '<hr></div>';
	
	$slideID = '<a class="toggleID" href="#concert'.$event->id.'">more...</a>';
	
	if ($event->status == 1){
		$status = ' <img title="This is concert is fully booked" src="http://petitesplanetes.cc/home/wp-content/plugins/concerts/images/btnfull.jpg"> ';
	}
	else {
		$status = ' <img title="This is concert is fully booked" src="http://petitesplanetes.cc/home/wp-content/plugins/concerts/images/btnattend.jpg"> ';
		}

	$array[] = '<div class="allinline"><p>'.$date->format('d.m').' - <b>'.$event->city.', '.$event->country.'</b> / '.$event->place.' / '.$slideID.'</p></div>'.$details;

}

$list = implode("\n", $array);

$output = '<div class="concertlistpast">'.$list.'</div>';


return $output;
?>
