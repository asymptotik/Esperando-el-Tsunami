<?php
/**
	* File: user_login
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
	
?>

<?php
$loginform = '

<script type="text/javascript">
	$(document).ready(function() {
		
		$(".initialValue").each(function() {
			$(this).data("od",$(this).val());
			$(this).click(function() {
				if($(this).val() == $(this).data("od")) $(this).val("");
			});
			$(this).blur(function() {
				if($(this).val() == "") $(this).val($(this).data("od"));
			});
		});
				
		$("#userlogin").submit(function() {
			
			var error = false;
			
			$("input.required,select.required").each(function() {
				if($(this).val()=="" || ($(this).hasClass("initialValue")&&$(this).val()==$(this).data("od"))) {
					//$(this).val("---ERROR---");
					//alert($(this).attr("id"));
					error = true;
				}
			});
			
			if(error) {
				alert("Please fill in all fields marked as required");
			}else{
				$("#userlogin").submit();
			}
			
			
			return false;
		});
	});
</script>
<div>
  <form id="userlogin" name="form1" method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
    <p>
      <div class="fff1">
      <div class="fff2"><label for="screenings_username">Email</label></div>
      <div class="fff3"><input class="required initialValue" value="your@email.com" alt="your@email.com" type="text" name="screenings_username" id="screenings_username" /></div>
      
      </div>
      <div class="fff1">
      <div class="fff2"><label for="screenings_password">password</label></div>
      <div class="fff3"><input class="required initialValue" value="password" alt="password" type="password" name="screenings_password" id="screenings_password" /></div>
      </div>
      
      <div class="fff1">
      	<input type="submit" class="submit" id="submit" value="LOG IN" />
      </div>
      
      <!--<input type="image" name="screenings_login" id="screenings_login" src="http://anisland.cc/home//wp-content/plugins/screenings/images/btnlogin.jpg" />-->
    </p>
  </form>
</div>';

$loginError = '<div>
  <form id="userlogin" name="form1" method="post" action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'">
    <p>
      <div class="fff1">
      <div class="fff2"><label for="screenings_username">Email</label></div>
      <div class="fff3"><input value="your@email.com" alt="your@email.com" type="text" name="screenings_username" id="screenings_username" /></div>
      
      </div>
      <div class="fff1">
      <div class="fff2"><label for="screenings_password">password</label></div>
      <div class="fff3"><input value="password" alt="password" type="password" name="screenings_password" id="screenings_password" /></div>
      </div>
      
      <div class="fff1">
      	<input type="submit" class="submit" id="submit" value="LOG IN" />
      </div>
      
      <!--<input type="image" name="screenings_login" id="screenings_login" src="http://anisland.cc/home//wp-content/plugins/screenings/images/btnlogin.jpg" />-->
    </p>
  </form>
  <p class="error">There where no screenings for that specific email and password, please try again!</p>
</div>';

$sessionEmail = $_SESSION['screenings_email'];
//echo "sess:".$sessionEmail;
//var_dump($_SESSION);

if(isset($_POST['screenings_username']) ) {



	global $wpdb;
	//add slashes to the username and md5() the password
	$user = addslashes($_POST['screenings_username']);
	$pass = md5($_POST['screenings_password']);

	$result = $wpdb->get_results( "SELECT * from wp_screenings_events WHERE email='$user' AND password='$pass'");

	$rowCount = 0;
	foreach($result as $item){
		$rowCount++;
	}

	if ($rowCount >= 1){
		$_SESSION['screenings_email'] = $user;
		$_SESSION['screenings_password'] = $pass;
		//session_register('screenings_email',$user);
		//session_register('screenings_password',$pass);
		$output = 'loggedin';
		
		
		//$output = true; 	
	}
	else {
		$output = $loginError;
	}

}/*else if(isset($_SESSION['screenings_username']) ) {
	$output = "loggedin";
}*/else if ($sessionEmail != false) {
	
	global $wpdb;
	//add slashes to the username and md5() the password
	$user = $_SESSION['screenings_email'];
	$pass = $_SESSION['screenings_password'];

	$result = $wpdb->get_results( "SELECT * from wp_screenings_events WHERE email='$user' AND password='$pass'");

	$rowCount = 0;
	foreach($result as $item){
		$rowCount++;
	}

	if ($rowCount >= 1){
		$_SESSION['screenings_email'] = $user;
		$_SESSION['screenings_password'] = $pass;
		$output = 'loggedin'; 	
	}
	else {
		$output = $loginError;
	}
}
else {
	$output = $loginform;
}
return $output;

?>
