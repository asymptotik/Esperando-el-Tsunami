<?php

/*
	Plugin Name: Screenings
	Description: a plugin created for Efterklang.
	Version: 0.1
	Author: Victor Facius
	Author URI: http://www.victorfacius.dk
*/

include('includes/screening_functions.php');

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

// Runs when plugin is activated
register_activation_hook(__FILE__,'lc_screenings_install'); 

function lc_screenings_install() {
	include('includes/installdb.php'); 	
	add_option('screenings_notify', 'default@email.com');
	add_option('screenings_accounts', 'default@email.com');
	}

// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'lc_screenings_deactivate' );
function lc_screenings_deactivate() {}


// ----------- ADMIN ------------ //

add_action('admin_head', 'lc_screenings_custom_css');
function lc_screenings_custom_css() 
{
	$css_file = plugin_dir_url( __FILE__ ) . "css/lc_screenings_admin.css";
  echo "<link rel='stylesheet' id='lc-custom_-css'  href='" . $css_file . "' type='text/css' media='all' />\n";
}


add_action('admin_menu', 'lc_screenings_plugin_menu');
function lc_screenings_plugin_menu() 
{
	add_menu_page('Screenings', 'Screenings', 'manage_options', 'screenings', 'lc_screenings_admin_func','../wp-content/plugins/screenings/images/calendar-16.png',30);
	add_submenu_page('screenings','Settings for Screenings', 'Settings', 'manage_options', 'screenings-settings', 'lc_screenings_sub_func');
}

function lc_screenings_admin_func() {
if (!current_user_can('manage_options'))  
	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	extract(lc_screenings_get_vars(array('action')));

	switch($action)
	{
		case 'screening_activate':
			include('includes/admin/screening_activate.php'); 	
		break;
		case 'screening_delete':
			include('includes/admin/screening_delete.php'); 
		break;
		case 'screening_status':
			include('includes/admin/screening_full.php');
		break;
		case 'screening_view':
			include('includes/admin/screening_view.php'); 
		break;
		case 'screening_new':
			include('includes/admin/screening_edit.php');
		break;
		case 'screening_edit':
			include('includes/admin/screening_edit.php');
		break;
		case 'screening_update':
			include('includes/admin/screening_update.php'); 	
		break;
		case 'screening_add':
			include('includes/admin/screening_update.php'); 	
		break;
		default:
			include('includes/admin/screenings.php'); 	
		break;
	}
	return $adminout;
}

// SUB Menu Function
function lc_screenings_sub_func() {
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
add_shortcode('screenings', 'lc_screenings_show_func');
function lc_screenings_show_func() {
	$output = include('includes/frontend/screenings.php'); 
	return $output;
}

// SHORTCODE FOR SCREENINGS PAGE [screenings_past]
add_shortcode('screenings_past', 'lc_screenings_show_past_func');
function lc_screenings_show_past_func() {
	$output = include('includes/frontend/screening_past.php'); 
	return $output;
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [host_screening]
add_shortcode('host_screening', 'lc_screenings_host_func');
function lc_screenings_host_func() {
	if(isset($_POST['host_screening_post'])) {
		$output = include('includes/frontend/user_screening_add.php'); 		
	}
	else {
		$output = include('includes/frontend/host.php'); 
	}
	return $output;
}

// SHORTCODE FOR LOGIN PAGE [screening_manage]
add_shortcode('screening_manage', 'lc_screenings_manage_func');
function lc_screenings_manage_func() {
	
	
	
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
add_shortcode('attend_screening', 'lc_screenings_attend_func');
function lc_screenings_attend_func() {
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
add_shortcode('screenings_user', 'lc_screenings_user');
function lc_screenings_user() {
  $output = include('includes/frontend/user_login.php'); 
	return $output;
}
?>