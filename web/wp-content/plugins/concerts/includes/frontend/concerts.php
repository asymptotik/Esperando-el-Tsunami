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
		$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 AND country = '$country' ORDER BY dateandtime asc" );
		
	}
	else 
	{
		$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
	}
}
else {
//echo "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" ;exit;
	$events = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE date(dateandtime) >= date(now()) AND active = 1 ORDER BY dateandtime asc" );
	
}

$output = '';
$monthBreaker = 0;

$monthLast = '';

$array = array();
foreach ($events as $event) {
	$date = new DateTime($event->dateandtime);
	$month = $date->format('m');
	
	if ($monthBreaker == 0){
		$monthBreaker = $month+1;
		$array[] = '<p class="month-name">'.$date->format('F').'</p>';
	}
	else if ($month == $monthBreaker) {
	$monthBreaker++;
	$array[] = '<p class="month-name spacer">'.$date->format('F').'</p>';
	}
	else {
	}
	
	$attend = '<form style="padding-left:0" method="post" action="/concerts/request-invitation/">';
	$attend .= '<input type="hidden" name="concert_id" value="'.$event->id.'">';
	$attend .= '<input type="image" class="screenbt" src="/concerts/wp-content/plugins/concerts/images/btnattend.jpg" />';
	$attend .= '</form>';
	$details = '<div class="hidden" id="concert'.$event->id.'"><hr>';
	$details .= '<p><b>Time:</b> '.$date->format('H:i').'<br/>';
	$details .= '<b>Max attendants:</b> '.$event->max.' people<br/>';
	if ($event->show_address != 1){
		$details .= '<b>Adress:</b> '.$event->address.'<br/>';
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
		$status = ' <img title="This is concert is fully booked" class="screenbt" src="/concerts/wp-content/plugins/concerts/images/btnfull.jpg"> ';
	}
	else {
		$status = $attend;
	}

	$array[] = '<div class="allinline">'.$status.'<p>'.$date->format('d.m').' - <b>'." ".$event->city.', '.$event->country.'</b> / '.stripslashes($event->place).' / '.$slideID.'</p></div>'.$details;

}

$list = implode("\n", $array);

$output = '<div class="concertlist">'.$list.'</div>';


$noConcerts = '<p>There are currently no Private-Public Concerts in this country. Be the first to host one!</p>';

$ci = 0;
foreach ($events as $i) {
	$ci++;
}
if ($ci >= 1){	
	return stripslashes($output);
}
else {
	return $noConcerts;
}
?>
