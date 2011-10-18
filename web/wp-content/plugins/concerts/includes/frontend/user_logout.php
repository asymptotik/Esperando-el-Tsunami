<?php
/**
	* File: user_concerts
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

if(isset($_POST['concerts_logout'])) {
	session_unset();
	//destroy the session 
	session_destroy(); 
	return true;
}
else {
	return '<div id="concert_logout"><form id="logout" name="logout" method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'"><input name="concerts_logout" type="hidden" id="concerts_logout" value="true" />
	<input type="submit" class="submit" id="submit" value="LOG OUT" />
	<!--<input type="submit" name="submit" id="submit" value="Log Out" />-->
	</form></div>';	
}
?>
