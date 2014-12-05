<section>
	<h3>We have 10 chercheurs in total:</h3>
	<?php
	$account_number = 0;
	// connect to the database, get the $link variable
	include 'includes/connection.inc.php';
	$result = $link->query ( "SELECT account_lastname, account_firstname, account_username FROM accounts WHERE 1" );
	$sql_count = $link->query("SELECT COUNT(account_id) FROM accounts");
	if (! ($result && $sql_count)) {
		throw new Exception ( "Database Error" );
	} else {
		if($tmp = $sql_count->fetch_assoc()) {
			$account_number = $tmp['COUNT(account_id)'];
		}
		echo "account number is: $account_number <br>";
		while ( $row = $result->fetch_assoc ()) {
			printf ( "Nom:%s Prenom:%s Username:%s <br/>"
				, $row ['account_lastname'], $row ['account_firstname'], $row ['account_username']);
		}
		
	}
	?>
</section>

