<?php

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