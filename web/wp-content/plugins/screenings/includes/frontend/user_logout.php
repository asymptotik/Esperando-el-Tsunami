<?php
/**
	* File: user_screenings
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php

if(isset($_POST['screenings_logout'])) {
	session_unset();
	//destroy the session 
	session_destroy(); 
	return true;
}
else {
	return '<div id="screening_logout"><form id="logout" name="logout" method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'"><input name="screenings_logout" type="hidden" id="screenings_logout" value="true" />
	<input type="submit" class="submit" id="submit" value="LOG OUT" />
	<!--<input type="submit" name="submit" id="submit" value="Log Out" />-->
	</form></div>';	
}
?>
