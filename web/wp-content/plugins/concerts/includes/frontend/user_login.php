<?php
/**
	* File: user_login
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
	
?>

<div class="lc-host-form-narrow">
  <form id="userlogin" name="form1" method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
	  <table>
		  <tr>
			  <td><label for="concerts_username">Email</label></td>
			  <td><input class="required initialValue" value="your@email.com" alt="your@email.com" type="text" name="concerts_username" id="concerts_username" /></td>
		  </tr>
		  <tr>
			  <td><label for="concerts_password">password</label></td>
			  <td><input class="required initialValue" value="password" alt="password" type="password" name="concerts_password" id="concerts_password" /></td>
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


