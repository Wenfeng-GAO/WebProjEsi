<div id="state_bar">
<?php 
	$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	if($title == "index") {
		?>
		<form action="login.php"  id="login_form">
			<input name="login" type="submit" id="login" value="Log in">
		</form>
		<?php 
	} else {
	?>
	<form action="includes/logout.inc.php" method="post" id="logout_form">
		<input name="logout" type="submit" id="logout" value="Log out">
	</form>
	<?php 
	}
	
	?>
</div>