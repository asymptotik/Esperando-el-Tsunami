<div class="lc-host-form-narrow"  id="concert_logout">
	<form id="logout" name="logout" method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
		<input name="action" type="hidden" value="concerts_user_logout" />
		<input type="submit" class="submit" value="LOG OUT" />
	</form>
</div>
