<div id="state_bar">
<?php 
	$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	if($title == "index") {
		?>
		<form action="login.php" >
			<input name="login" type="submit" id="login" value="Log in">
		</form>
		<?php 
	} elseif($title == "login") {
		?>
		<form action="index.php" >
			<input name="home" type="submit" id="home" value="Home">
		</form>
		<?php
	}
	else {
	?>
	<form action="includes/logout.inc.php" method="post">
		<input name="logout" type="submit" id="logout" value="Log out">
	</form>
	<?php 
	}
	
	?>
</div>