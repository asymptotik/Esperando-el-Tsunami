<?php

function lc_screenings_get_var( $var ) {
	
	$val = '';
	
	if ( empty( $_POST[$var] ) ) 
	{
			if ( !empty( $_GET[$var] ) )
			{
				$val = $_GET[$var];
			}
	}
	else 
	{
		$val = $_POST[$var];
	}
	
	// negate magic quotes, if necessary
	// magic quotes is evil since it assumes a data usage and a proper way and what to quote
  if ( get_magic_quotes_gpc() ) {
			$val = stripslashes_deep($val);
	}
	
	return $val;
}

function lc_screenings_get_vars( $vars ) {
	$ret = array();
	
	for ( $i=0; $i<count( $vars ); $i += 1 ) {
		$var = $vars[$i];

		if ( empty( $_POST[$var] ) ) {
			if ( empty( $_GET[$var] ) )
			{
				$val = '';
			}
			else
			{
				$val = $_GET[$var];
			}
		} else {
			$val = $_POST[$var];
		}
		
		// negate magic quotes, if necessary
		// magic quotes is evil since it assumes a data usage and a proper way and what to quote
		if ( get_magic_quotes_gpc() ) {
			$ret[$var] = stripslashes_deep($val);
		}
		else 
		{
			$ret[$var] = $val;
		}
	}
	
	return $ret;
}

function lc_screenings_check_logged_in()
{
  global $wpdb;
  $output = 0;
  
	extract(lc_screenings_get_vars(array('screenings_username', 'screenings_password')));
	
  $sessionEmail = $_SESSION['screenings_email'];

	if(!empty($screenings_username) ) 
	{
		//add slashes to the username and md5() the password
		$user = $screenings_username;
		$pass = md5($screenings_password);
		
		$user_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->prefix . "screenings_events WHERE email='%s' AND password='%s'", $user, $pass ));
		
		if ($user_count >= 1)
		{
			$_SESSION['screenings_email'] = $user;
			$_SESSION['screenings_password'] = $pass;
			$output = 1;
		}
		else 
		{
			$output = -1;
		}
	} 
	else if ($sessionEmail != false) 
	{
		//add slashes to the username and md5() the password
		$user = $_SESSION['screenings_email'];
		$pass = $_SESSION['screenings_password'];
	
		$user_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->prefix . "screenings_events WHERE email='%s' AND password='%s'", $user, $pass ));

		if ($user_count >= 1){
			$_SESSION['screenings_email'] = $user;
			$_SESSION['screenings_password'] = $pass;
			$output = 1; 	
		}
		else 
		{
			$output = -1;
		}
	}
	
	return $output;
}

function get_lc_screening($screening, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	
	if ( empty($screening) ) {
		if ( isset($GLOBALS['lc_screening']) )
		{
			$_screening = & $GLOBALS['lc_screening'];
		}
		else
		{
			$_screening = null;
		}
	} elseif ( is_object($screening) ) {
		wp_cache_add($screening->id, $screening, 'lc_screening');
		$_screening = $screening;
	} else {
		if ( isset($GLOBALS['lc_screening']) && ($GLOBALS['lc_screening']->id == $screening) ) {
			$_screening = & $GLOBALS['lc_screening'];
		} elseif ( ! $_screening = wp_cache_get($screening, 'lc_screening') ) {
			$_screening = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "screenings_events WHERE id = %d LIMIT 1", $screening));
			wp_cache_add($_screening->id, $_screening, 'lc_screening');
		}
	}

	if ( $output == OBJECT ) {
		return $_screening;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_screening);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_screening));
	} else {
		return $_screening;
	}
}

?>