<?php

function lc_concerts_get_var( $var ) {
	
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

function lc_concerts_get_vars( $vars ) {
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

// Checks the users logged in status
// Returns 0 if not logged in
// Returns 1 if logged in and has data
// Returns -1 if error
function lc_concerts_check_logged_in()
{
  global $wpdb;
  $output = 0;
  
	extract(lc_concerts_get_vars(array('concerts_username', 'concerts_password')));
	
  $sessionEmail = $_SESSION['concerts_email'];

	if(!empty($concerts_username) ) 
	{
		//add slashes to the username and md5() the password
		$user = $concerts_username;
		$pass = md5($concerts_password);
		
		$user_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->prefix . "concerts_events WHERE host_email='%s' AND password='%s'", $user, $pass ));
		
		if ($user_count >= 1)
		{
			$_SESSION['concerts_email'] = $user;
			$_SESSION['concerts_password'] = $pass;
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
		$user = $_SESSION['concerts_email'];
		$pass = $_SESSION['concerts_password'];
  
		$user_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->prefix . "concerts_events WHERE host_email='%s' AND password='%s'", $user, $pass ));

		if ($user_count >= 1){
			$_SESSION['concerts_email'] = $user;
			$_SESSION['concerts_password'] = $pass;
			$output = 1; 	
		}
		else 
		{
			$output = -1;
		}
	}
	
	return $output;
}

function get_lc_region_schedule($schedule, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	
	if ( empty($schedule) ) {
		if ( isset($GLOBALS['lc_schedule']) )
		{
			$_schedule = & $GLOBALS['lc_schedule'];
		}
		else
		{
			$_schedule = null;
		}
	} elseif ( is_object($schedule) ) {
		wp_cache_add($schedule->id, $schedule, 'lc_schedule');
		$_schedule = $schedule;
	} else {
		if ( isset($GLOBALS['lc_schedule']) && ($GLOBALS['lc_schedule']->id == $schedule) ) {
			$_schedule = & $GLOBALS['lc_schedule'];
		} elseif ( ! $_schedule = wp_cache_get($schedule, 'lc_schedule') ) {
			$_schedule = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_region_schedule WHERE id = %d LIMIT 1", $schedule));
			wp_cache_add($_schedule->id, $_schedule, 'lc_schedule');
		}
	}

	if ( $output == OBJECT ) {
		return $_schedule;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_schedule);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_schedule));
	} else {
		return $_schedule;
	}
}

function get_lc_region_schedules($region) {
	global $wpdb;

	if ( is_object($region) ) {
		$region_id = $region->id;
	} else {
		$region_id = $region;
	}

	return $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_region_schedule WHERE region_id = %d", $region_id));
}

function get_lc_concert($concert, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	
	if ( empty($concert) ) {
		if ( isset($GLOBALS['lc_concert']) )
		{
			$_concert = & $GLOBALS['lc_concert'];
		}
		else
		{
			$_concert = null;
		}
	} elseif ( is_object($concert) ) {
		wp_cache_add($concert->id, $concert, 'lc_concert');
		$_concert = $concert;
	} else {
		if ( isset($GLOBALS['lc_concert']) && ($GLOBALS['lc_concert']->id == $concert) ) {
			$_concert = & $GLOBALS['lc_concert'];
		} elseif ( ! $_concert = wp_cache_get($concert, 'lc_concert') ) {
			$_concert = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_events WHERE id = %d LIMIT 1", $concert));
			wp_cache_add($_concert->id, $_concert, 'lc_concert');
		}
	}

	if ( $output == OBJECT ) {
		return $_concert;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_concert);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_concert));
	} else {
		return $_concert;
	}
}

function get_lc_regions($sorton = 'id', $sortdir = 'desc')
{
	global $wpdb;
	
	$sort_clause = '';
	
	if($sorton != '')
	{
		$sort_clause = " ORDER BY $sorton $sortdir";
		
	}
  return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_regions" .  $sort_clause);
}

function get_lc_region($region, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	
	if ( empty($region) ) {
		if ( isset($GLOBALS['lc_region']) )
		{
			$_region = & $GLOBALS['lc_region'];
		}
		else
		{
			$_region = null;
		}
	} elseif ( is_object($region) ) {
		wp_cache_add($region->id, $region, 'lc_region');
		$_region = $region;
	} else {
		if ( isset($GLOBALS['lc_region']) && ($GLOBALS['lc_region']->id == $region) ) {
			$_region = & $GLOBALS['lc_region'];
		} elseif ( ! $_region = wp_cache_get($region, 'lc_region') ) {
			$_region = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_regions WHERE id = %d LIMIT 1", $region));
			wp_cache_add($_region->id, $_region, 'lc_region');
		}
	}

	if ( $output == OBJECT ) {
		return $_region;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_region);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_region));
	} else {
		return $_region;
	}
}

function get_lc_countries($sorton = 'name', $sortdir = 'asc')
{
	global $wpdb;
	
	$sort_clause = '';
	
	if($sorton != '')
	{
		$sort_clause = " ORDER BY $sorton $sortdir";
		
	}
  return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_countries" .  $sort_clause);
}

function get_lc_countries_by_region($region_id, $sorton = 'name', $sortdir = 'asc')
{
	global $wpdb;
	
	$sort_clause = '';
	
	if($sorton != '')
	{
		$sort_clause = " ORDER BY $sorton $sortdir";
		
	}
  return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "concerts_countries WHERE region_id='" . $region_id . "'" .  $sort_clause);
}

function get_lc_country($country, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	
	if ( empty($country) ) {
		if ( isset($GLOBALS['lc_country']) )
		{
			$_country = & $GLOBALS['lc_country'];
		}
		else
		{
			$_country = null;
		}
	} elseif ( is_object($country) ) {
		wp_cache_add($country->id, $country, 'lc_country');
		$_country = $country;
	} else {
		if ( isset($GLOBALS['lc_country']) && ($GLOBALS['lc_country']->id == $country) ) {
			$_country = & $GLOBALS['lc_country'];
		} elseif ( ! $_country = wp_cache_get($country, 'lc_country') ) {
			$_country = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "concerts_countries WHERE id = %d LIMIT 1", $country));
			wp_cache_add($_country->id, $_country, 'lc_country');
		}
	}

	if ( $output == OBJECT ) {
		return $_country;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_country);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_country));
	} else {
		return $_country;
	}
}

function lc_concerts_get_email($name, $address)
{
	if(!empty($name))
	{
		return "\"" . $name. "\" <" . $address . ">";
	}
	else 
	{
		return $address;
	}
}

function lc_concerts_get_default_language() 
{
   if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
      return lc_concerts_parse_default_language($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
   else
      return lc_concerts_parse_default_language(NULL);
}

function lc_concerts_parse_default_language($http_accept, $deflang = "en") 
{
   if(isset($http_accept) && strlen($http_accept) > 1)  {
      # Split possible languages into array
      $x = explode(",",$http_accept);
      foreach ($x as $val) {
         #check for q-value and create associative array. No q-value means 1 by rule
         if(preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i",$val,$matches))
            $lang[$matches[1]] = (float)$matches[2];
         else
            $lang[$val] = 1.0;
      }

      #return default language (highest q-value)
      $qval = 0.0;
      foreach ($lang as $key => $value) {
         if ($value > $qval) {
            $qval = (float)$value;
            $deflang = $key;
         }
      }
   }
   return strtolower($deflang);
}
?>