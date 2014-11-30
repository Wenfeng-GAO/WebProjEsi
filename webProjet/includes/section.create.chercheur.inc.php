<?php
$username_verify = "";
$password_verify = "";
if (isset ( $_POST ['create_account'] )) {
	include 'includes/connection.inc.php';
	$lastname = $_POST ['lastname'];
	$firstname = $_POST ['firstname'];
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	
	// verify the username
	if (! empty ( $username )) {
		$sql_username = "SELECT account_username FROM accounts WHERE account_username='$username'";
		$result = $link->query($sql_username);
		if(! $result) {
			die("Database Connection Error, Please Try Later.");
		} else if (!empty($result->fetch_assoc())) {
// 			$username_verify = "Username is already taken";
			$username_verify = $username;
		}
	} else {
		$username_verify = "Username can't be blank";
	}
	// verify the password
	if (! empty ( $password )) {
		if ($password != $_POST ['confirm_password']) {
			$password_verify = "The passwords are not the same";
		}
	} else {
		$password_verify = "Password can't be blank";
	}
	// insert the account info
	if (empty($username_verify) && empty($password_verify)) {
		$sql_insert = "INSERT INTO accounts (account_lastname, account_firstname, account_username, account_password) 
				VALUES ('$lastname', '$firstname', '$username', '$password')";
		if ($link->query ( $sql_insert )) {
			die ( "new account created successfully" );
		} else {
			die ( "Error" );
		}
	}
}
?>

<section>
	<div id="create_chercheur_form_container">
		<div id="create_chercheur_form_header">
			<h1>Create a new account</h1>
		</div>
		<div id="create_chercheur_form_body">
			<form action="" method="post">
				<label for="lastname"><b>Nom</b></label><br> <input type="text"
					name="lastname" id="lastname" autofocus="autofocus"><br> <br> <label
					for="firstname"><b>Prenom</b></label><br> <input type="text"
					name="firstname" id="firstname"><br> <br> <label for="username"><b>Username</b></label><br>
				<input type="text" name="username" id="username"> <label><?php echo $username_verify ?></label><br>
				<br> <label for="password"><b>Password</b></label><br> <input
					type="password" name="password" id="password"> <label><?php echo $password_verify ?></label><br>
				<br> <label for="confirm_password"><b>Confirm your password</b></label><br>
				<input type="password" name="confirm_password" id="confirm_password"><br>
				<br> <input type="submit" name="create_account" id="acreate_account"
					value="Create an account">
			</form>
		</div>
	</div>
</section>

