<?php
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
?>