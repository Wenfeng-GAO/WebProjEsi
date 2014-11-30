<section>
	<h3>We have 10 chercheurs in total:</h3>
	<?php
	// connect to the database, get the $link variable
	include 'includes/connection.inc.php';
	$result = $link->query ( "SELECT account_lastname, account_firstname, account_username, account_projects_active FROM accounts WHERE 1" );
	if (! $result) {
		throw new Exception ( "Database Error" );
	} else {
		while ( $row = $result->fetch_assoc ()) {
			printf ( "Nom:%s Prenom:%s Username:%s Projets rejoints:%d <br/>"
				, $row ['account_lastname'], $row ['account_firstname'], $row ['account_username'], $row['account_projects_active']);
		}
		
	}
	?>
</section>

