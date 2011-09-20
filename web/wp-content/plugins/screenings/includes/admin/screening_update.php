<?php
/**
	* File: screening_update
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/

$post = new stdClass();
$post->id = $_POST['screening_id'];
$post->place = $_POST['screening_place'];
$post->address = $_POST['screening_address'];
$post->addressShow = $_POST['screening_address_show'];
$post->city = $_POST['screening_city'];
$post->zipcode = $_POST['screening_zipcode'];
$post->country = $_POST['screening_country'];
$post->datetime = $_POST['screening_date'];
$post->max = $_POST['screening_max'];
$post->additional = $_POST['screening_additional'];
$post->name = $_POST['screening_name'];
$post->email = $_POST['screening_email'];
$post->phone = $_POST['screening_phone'];
$post->password = md5($_POST['screening_password']);

global $wpdb;
$rows = array( 
	'place' => $post->place,
	'address' => $post->address,
	'show_address' => $post->addressShow,
	'city' => $post->city,
	'zipcode' => $post->zipcode,
	'country' => $post->country,
	'dateandtime' => $post->datetime,
	'max' => $post->max,
	'additional' => $post->additional,
	'name' => $post->name,
	'email' => $post->email,
	'phone' => $post->phone,
	);

$wpdb->update('wp_screenings_events', $rows, array( 'id' => $post->id));

if ($_POST['screening_password'] != '') {
	$wpdb->update('wp_screenings_events', array('password' => $post->password), array( 'id' => $post->id));
	echo "<p>The password has been changed.</p>";
}

?>
<p>The event has been saved</p>
<a href="<?=str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>" title='go back'>Go Back</a>
