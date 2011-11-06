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

// Runs when plugin is activated
register_activation_hook(__FILE__,'lc_screenings_install'); 

function lc_screenings_install() {
	include('includes/installdb.php'); 	
	add_option('screenings_notify', 'default@email.com');
	add_option('screenings_accounts', 'default@email.com');
	add_option('screenings_notify_from_name', 'Your Name');
	add_option('screenings_notify_from_email', 'default@email.com');
	}

// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'lc_screenings_deactivate' );
function lc_screenings_deactivate() {}

// ----------- FUNCTIONS -------------//

function lc_screenings_plugin_uri($file)
{
	return plugins_url( $file, __FILE__ );
}

// ----------- SCRIPTS -------------//

add_action('wp_footer', 'lc_screenings_print_scripts');
function lc_screenings_print_scripts()
{
	wp_print_scripts();
}

wp_deregister_script('jquery-validate');
wp_register_script('jquery-validate', plugins_url( 'js/jquery.validate.min.js', __FILE__ ), array( 'jquery' ), false, true);
wp_deregister_script('lc-screenings');
wp_register_script('lc-screenings', plugins_url( 'js/screenings.js', __FILE__ ), array( 'jquery', 'jquery-watermark', 'jquery-validate' ), false, true);

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
		update_option('screenings_notify_from_name', $_POST['screenings_notify_from_name']);
		update_option('screenings_notify_from_email', $_POST['screenings_notify_from_email']);
		$updateSucces = true;
	}

	include('includes/admin/settings.php'); 	
}

// ----------- FRONTEND ------------ //

function lc_screenings_contents($filename) {
	ob_start();
	include ($filename);
	return ob_get_clean();
}

// SHORTCODE FOR SCREENINGS PAGE [screenings]
add_shortcode('screenings', 'lc_screenings_show_func');
function lc_screenings_show_func() {
	$output = lc_screenings_contents('includes/frontend/screenings.php'); 
	return $output;
}

// SHORTCODE FOR SCREENINGS PAGE [screenings_past]
add_shortcode('screenings_past', 'lc_screenings_show_past_func');
function lc_screenings_show_past_func() {
	$output = lc_screenings_contents('includes/frontend/screening_past.php'); 
	return $output;
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [host_screening]
add_shortcode('screenings_host', 'lc_screenings_host_func');
function lc_screenings_host_func() {

	extract(lc_concerts_get_vars(array('action')));
	
	//echo "action: " . $action . "<br/>";
	
	if($action == "screenings_host_add") {
		//echo "screenings_host_add action: " . $action;
		$output = include('includes/frontend/user_screening_add.php'); 		
	}
	else {
		$output = lc_screenings_contents('includes/frontend/user_screening_host.php'); 
	}
	return $output;
}

// SHORTCODE FOR LOGIN PAGE [screenings_manage]
add_shortcode('screenings_manage', 'lc_screenings_manage_func');
function lc_screenings_manage_func() 
{	
	$logged_in_check = lc_screenings_check_logged_in();
	
	if ($logged_in_check != 1)
	{
		$values = 0;
		if($logged_in_check == -1)
		{
			$values = array('lc_message' => 'No Concerts were found for the username and password. Please try again.');
		}
		
		return lc_screenings_contents('includes/frontend/user_login.php', $values);
	}
	else {
		
		extract(lc_screenings_get_vars(array('action')));
		//echo "action $action <br/>";
		
		if ($action == "screenings_user_delete")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_delete.php'); 	
		}
		else if ($action == "screenings_user_status")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_full.php'); 	
		}
		else if ($action == "screenings_user_update")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_update.php'); 	
		}
		else if ($action == "screenings_user_edit")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_edit.php');
		}
		else if($action == "screenings_user_logout")
		{
			$output = lc_screenings_contents('includes/frontend/user_logout.php') . " " . lc_screenings_contents('includes/frontend/user_login.php');
			return $output;
		}
		else {
			$output = lc_screenings_contents('includes/frontend/user_screenings.php'); 
		}
		
		$logout_button = lc_screenings_contents('includes/frontend/user_logout_button.php');
		return $output.$logout_button;
	}
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [attend_screening]
add_shortcode('screenings_attend', 'lc_screenings_attend_func');
function lc_screenings_attend_func() {
	
		extract(lc_screenings_get_vars(array('action')));
		
		if ($action == "screenings_user_request_invite")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_request_invite.php'); 
		}
		else if ($action == "screenings_user_request_invite_send")
		{
			$output = lc_screenings_contents('includes/frontend/user_screening_request_invite_send.php'); 	
		}

	  return $output;	
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [country_select]
add_shortcode('screenings_country_select', 'country_select_func');
function country_select_func() {
	$output = lc_screenings_contents('includes/frontend/country_select.php'); 
	return $output;
		
}

// SHORTCODE FOR HOST A SCREENINGS PAGE [screenings_user]
add_shortcode('screenings_user', 'lc_screenings_user');
function lc_screenings_user() {
  $output = lc_screenings_contents('includes/frontend/user_login.php'); 
	return $output;
}
?>