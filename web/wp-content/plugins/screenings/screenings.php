<?php

/*
	Plugin Name: Screenings
	Description: a plugin created for Efterklang.
	Version: 0.1
	Author: Victor Facius
	Author URI: http://www.victorfacius.dk
*/

// ----------- INSTALL ------------ //

if (!class_exists('DateTime')) {
class DateTime {
    var $date;
    
    function DateTime($date) {
        $this->date = strtotime($date);
		
    }
    
    function setTimeZone($timezone) {
        return;
    }
    
    function __getDate() {
        return date(DATE_ATOM, $this->date);    
    }
    
    function modify($multiplier) {
        $this->date = strtotime($this->__getDate() . ' ' . $multiplier);
    }
    
    function format($format) {
        return date($format, $this->date);
    }
}
}

// Runs when plugin is activated
register_activation_hook(__FILE__,'screenings_install'); 

function screenings_install() {
	include('includes/installdb.php'); 	
	add_option('screenings_notify', 'default@email.com');
	add_option('screenings_accounts', 'default@email.com');
	}

// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'screenings_deactivate' );
function screenings_deactivate() {}


// ----------- ADMIN ------------ //
add_action('admin_menu', 'my_plugin_menu');
function my_plugin_menu() {
	add_menu_page('Screenings', 'Screenings', 'manage_options', 'screenings', 'screenings_admin_func','../wp-content/plugins/screenings/images/calendar-16.png',30);

	add_submenu_page('screenings','Settings for Screenings', 'Settings', 'manage_options', 'screenings-settings', 'screenings_sub_func');
}

function screenings_admin_func() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	if (!$_POST){
		include('includes/admin/screenings.php'); 	
	}
	if ($_POST['screening_activate']){
		include('includes/admin/screening_activate.php'); 	
	}
	if ($_POST['screening_delete']){
		include('includes/admin/screening_delete.php'); 	
	}
	if ($_POST['screening_status']){
		include('includes/admin/screening_full.php'); 	
	}
	if ($_POST['screening_show']){
		include('includes/admin/screening_show.php'); 	
	}
	if ($_POST['screening_edit']){
		include('includes/admin/screening_edit.php'); 	
	}
	if ($_POST['screening_update']){
		include('includes/admin/screening_update.php'); 	
	}
	return $adminout;
}

// SUB Menu Function
function screenings_sub_func() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	$updateSucces = false;
	if ($_POST['screenings_option']){
		update_option('screenings_notify', $_POST['screenings_notify']);
		update_option('screenings_accounts', $_POST['screenings_accounts']);
		$updateSucces = true;
		
	}

	include('includes/admin/settings.php'); 	
}

// ----------- FRONTEND ------------ //

// SHORTCODE FOR SCREENINGS PAGE [screenings]
add_shortcode('screenings', 'screenings_show_func');
function screenings_show_func() {
	$output = include('includes/frontend/screenings.php'); 
	return $output;
}

// SHORTCODE FOR SCREENINGS PAGE [screenings_past]
add_shortcode('screenings_past', 'screenings_show_past_func');
function screenings_show_past_func() {
	$output = include('includes/frontend/screening_past.php'); 
	return $output;
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [host_screening]
add_shortcode('host_screening', 'screenings_host_func');
function screenings_host_func() {
	if(isset($_POST['host_screening_post'])) {
		$output = include('includes/frontend/user_screening_add.php'); 		
	}
	else {
		$output = include('includes/frontend/host.php'); 
	}
	return $output;
}

// SHORTCODE FOR LOGIN PAGE [screening_manage]
add_shortcode('screening_manage', 'screenings_manage_func');
function screenings_manage_func() {
	
	
	
	$logout = include('includes/frontend/user_logout.php');
	$checklogin = include('includes/frontend/user_login.php');
	
	//echo "post::".$checklogin.":::".$_POST['user_screening_status'];
	
	if ($checklogin != 'loggedin'){
		return $checklogin;
	}
	else {
		if ($_POST['user_screening_delete']){
			$output = include('includes/frontend/user_screening_delete.php'); 	
		}
		if ($_POST['user_screening_status']){
			$output = include('includes/frontend/user_screening_full.php'); 	
		}
		if ($_POST['user_screening_update']){
		
			$output = include('includes/frontend/user_screening_update.php'); 	
		}
		if ($_POST['user_screening_edit']){
			$output = include('includes/frontend/user_screening_edit.php');
			
		}
		else {
			$output = include('includes/frontend/user_screenings.php'); 
		}
		return $output.$logout;
	}

}

// SHORTCODE FOR HOST A SCREENINGS PAGE [attend_screening]
add_shortcode('attend_screening', 'screenings_attend_func');
function screenings_attend_func() {
	$output = include('includes/frontend/attend.php'); 
	return $output;	
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [country_select]
add_shortcode('country_select', 'country_select_func');
function country_select_func() {
	$output = include('includes/frontend/country_select.php'); 
	return $output;
		
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [screenings_user]
add_shortcode('screenings_user', 'screenings_user');
function screenings_user() {
 include('includes/frontend/user_login.php'); 
	
}
?>