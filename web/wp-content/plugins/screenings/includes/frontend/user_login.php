<?php
/**
	* File: user_login
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
	
?>

<div>
  <form id="userlogin" name="form1" method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
	  <table>
		  <tr>
			  <td><label for="screenings_username">Email</label></td>
			  <td><input class="required initialValue" value="your@email.com" alt="your@email.com" type="text" name="screenings_username" id="screenings_username" /></td>
		  </tr>
		  <tr>
			  <td><label for="screenings_password">password</label></td>
			  <td><input class="required initialValue" value="password" alt="password" type="password" name="screenings_password" id="screenings_password" /></td>
		  </tr>
		  <?php if(isset($lc_message)) { ?>
		  <tr><td colspan="2"><?php echo $lc_message; ?></td></tr>
		  <?php } ?>
		  <tr>
		  	<td colspan="2"><input type="submit" class="submit" id="submit" value="LOG IN" /></td>
		  </tr>
	  </table>
  </form>
</div>


