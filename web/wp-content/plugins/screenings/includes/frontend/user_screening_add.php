<?php
/**
	* File: user_screening_add
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

extract(lc_screenings_get_vars(array(
'screening_status',
'screening_place',
'screening_address',
'screening_address_show',
'screening_city',
'screening_postalcode',
'screening_country',
'screening_date',
'screening_time',
'screening_max',
'screening_additional',
'screening_name',
'screening_email',
'screening_phone',
'screening_password',
'screening_imageurl'
)));

$datetime = DateTime::createFromFormat('n/j/Y G:i', $screening_date .' '. $screening_time);
$mysqldatetime = $datetime->format('Y-m-d H:i:s');

echo "Date Parsed: " . $mysqldatetime;

// IMPORT DB 
global $wpdb;

$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "screenings_events WHERE place='%s' AND dateandtime='%s' AND email='%s'", $screening_place, $mysqldatetime, $screening_email));

$rows_affected = 0;
if ($count < 1) {
	$rows_affected = $wpdb->insert($wpdb->prefix . 'screenings_events', array( 
		'status' => $screening_status,
		'active' => 0,
		'place' => $screening_place,
		'address' => $screening_address,
		'show_address' => $screening_address_show,
		'city' => $screening_city,
		'postalcode' => $screening_postalcode,
		'country' => $screening_country,
		'dateandtime' => $mysqldatetime,
		'max' => $screening_max,
		'additional' => $screening_additional,
		'name' => $screening_name,
		'email' => $screening_email,
		'phone' => $screening_phone,
		'password' => md5($screening_password),
		'imageurl' => $screening_imageurl,
		));
}


// EMAIL /////

// multiple recipients
$to  = $post->email; // note the comma
$backup = get_option('screenings_accounts');

// subject
$subject = 'Thanks for creating a Screening of Petites Planètes';
// message
/*
$message = '
		<html>
	<head>
		<title>'.$subject.'</title>
		</head>
	<body>
		<p>Hello '.$post->name.'</p>
		<p>Thank you for creating a <strong>Private-Public Screening of An Island</strong>.</p>
		<p>We will approve your screening as soon as possible and inform you by email once it has been approved. </p>
	<p>Please add <a href="mailto:screenings@anisland.cc">screenings@anisland.cc</a> to your address book to prevent the email from being categorized as junk mail.</p>
		<p>If you need to change any details regarding your Private-Public Screening or mark the screening as fully booked, you can log in at <a href="http://anisland.cc/home/host-a-screening/login/">http://anisland.cc/home/host-a-screening/login/</a> Please make sure you display the <strong>Time</strong> for the screening correct. We use the 24-hour clock on the site. We also suggest that you let your guests know who you are and how you will screen the film? And if they should bring something? etc You can do this in the <strong>Additional Info</strong> field. </p>
	<p>Username: '.$post->email.'<br />
		Password: '.$_POST['screening_password'].'</p>
		<p>For more info about the Private-Public Screenings please refer to www.anisland.cc/home/host-a-screening/</p>
	<p>These are the details you have registered:<p><b>Place: </b>'.$post->place.'<br />
		<b>Address: </b>'.$post->address.'<br />
		<b>City: </b>'.$post->city.'<br />
		<b>postalcode: </b>'.$post->postalcode.'<br />
		<b>Country: </b>'.$post->country.'<br />
		<b>Date And Time: </b>'.$_POST['screening_date'].'<br />
		<b>Max Attendants: </b>'.$post->max.'<br />
		<b>Additional: </b>'.$post->additional.'<br />
		<b>Name: </b>'.$post->name.'<br />
		<b>Email: </b>'.$post->email.'<br />
		<b>Phone: </b>'.$post->phone.'	</p>
	<p>Best Wishes,</p>
		<p>Vincent Moon &amp; Efterklang</p>
		<p><a href="http://www.AnIsland.cc">www.AnIsland.cc</a></p>
	</body>
		</html>
	';*/
	
$message = "
<html>
	<head>
		<title>'.$subject.'</title>
		</head>
	<body>
		<p>Helloooo you, beautiful stranger </p>

<p>And thanks for wishing to screen some of those little films i make</p>

<p>As you have read on the website, you are welcome to screen any films you want - and not only the ones from the collection <strong>Petites Planetes</strong>. You might even ask me for some un-released films - check on my vincentmoon.com website to see what i have been up to recently. i can send you links to work in progress for some of them.</p>

<p>The vast majority of the films is available on internet for free, on vimeo - <a href=\"http://www.vimeo.com/vincentmoon/videos\">http://www.vimeo.com/vincentmoon/videos</a><br />
You can download the films directly from the pages, you will find a link on the right side, in the little About This Video box</p>

<p>Some films though requires a password to be viewed. It's often because i dont have the right to offer them online. Most of them are feature length films, and are or were sold as dvds. If you want to screen them also, ask me the password, i will give it to you.</p>

<p>The quality of each film on vimeo should be good enough for the screening. But be careful maybe with some older films, which are not that well compressed.</p>

<p>Fill the informations on my website to let people know more or less what you are gonna screen, and how many people can join. Alright?</p>

<p>And here is some important info that I would like to be sure you have read:</p>

<p>you don't need to use a projector to screen the films, but it would probably be better as soon as you are more than 3 people in the room. Be careful to screen the films are the right size too! they are all in 16/9 format.</p>

<p>what you need though, is a good sound system. LOUD please, as much as possible - dont worry about the neighbours, send me their complaints.</p>

<p>please, be open to welcome strangers in your home, or where you screen those films. It's part of the game, right?</p>

<p>last thing, the entrance is supposed to be for free. I can imagine if you rented a place, you might ask for a little contribution. all good, just let me know about it</p>

<p><span style='font-size:16pt;'>THANK YOU</span> <br />
and i hope you will enjoy the films and the moment<br />
talk soon</p>

v.";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Additional headers
$headers .= 'From: Petites Planètes by Vincent Moon <screenings@petitesplanetes.cc>' . "\r\n";

$message = stripslashes($message);
if ($count < 1) {
	// Mail it
	if (mail($to, $subject, $message, $headers)){
		// success
	} 
	else {
		// fail
	}
	// Mail it
	if (mail($backup, $subject, $message, $headers)){
		// success
	} 
	else {
		// fail
	}
}

// CREATE A SCREENING notice
$notify = get_option('screenings_notify');
$sub = "New screening";
$msg = 'There is a new SCREENING awaiting your approval';
$sender = "no-reply@petitesplanetes.cc";
$head = "From: $sender";

if ($count < 1) {
	if (mail($notify,$sub,$msg,$head)) {
		// success
	} 
	else {
		// fail
	}	
}

$msg = '<p class="dest upper">Thank you for creating a Screening of Petites Planètes!</p>
<p>We will approve your screening as soon as possible and inform you by email once it has been approved.</p>
<p>Please add <a href="screenings@petitesplanetes.cc">screenings@petitesplanetes.cc</a> to your address book to prevent the email from being categorized as junk mail.</p>
<p>Already now you should have received an email with the details you just registered and your log-in info for <a href="http://www.petitesplanetes.cc">www.petitesplanetes.cc</a> so you can edit and manage your event. Please make sure you have received this email.</p>
<p>Thanks,<br />Vincent Moon</p>';

if ($count < 1) {
	return $msg;
}
else {
	return '<p class="dest upper">Thank you for creating a Screening!</p>
	<p>Your screening has already been submitted, please check your email.</p>';
}

?>
