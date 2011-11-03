<div class="lc-host-form-narrow"  id="screening_logout">
	<form id="logout" name="logout" method="post" action="<?php echo str_replace("%7E", "~", $_SERVER["REQUEST_URI"]) ?>">
		<input name="action" type="hidden" value="screenings_user_logout" />
		<input type="submit" class="submit" value="LOG OUT" />
	</form>
</div>
