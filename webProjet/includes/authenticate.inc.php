<?php
// location to redirect on success
$redirect1 = 'http://localhost/project_esigelec/chercheur_list.php';
$redirect2 = 'http://localhost/project_esigelec/project_list.php';

// open a MySQL connection
include 'includes/connection.inc.php';

// create and query Sql
$result = $link->query("SELECT * FROM accounts WHERE account_username='$username' AND account_password='$password'");
if(!$result) {
	throw new Exception("Database Error ");
} else {
	$result_array = $result->fetch_assoc();

	if($result_array) {
		$_SESSION['authenticate2'] = $username;
		session_regenerate_id();
	}
}

if($username == 'admin' && $password == 'admin') {
	$_SESSION['authenticate1'] = "administrator";
	session_regenerate_id();
}

// if the session variable has been set, redirect
if(isset($_SESSION['authenticate1'])) {
	header("Location: $redirect1");
	exit();
} elseif (isset($_SESSION['authenticate2'])) {
	header("Location: $redirect2");
	exit();
}
else {
	$error = "Incorrect username or password.";
}