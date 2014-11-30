<?php
	session_start();
	// if session variable not set, redirect to login page
	if(!(isset($_SESSION['authenticate1']) || isset($_SESSION['authenticate2']))) {
		header("Location: http://localhost/project_esigelec/login.php");
		exit();
	}
	// run only if the logout button has been clicked
	if(isset($_POST['logout'])) {
		// empty the $_SESSION array
		$_SESSION = array();
		// invalide the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-86400, '/');
		}
		// end session and redirect
		session_destroy();
		header("Location: http://localhost/project_esigelec/login.php");
		exit();
	}